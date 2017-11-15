<?php

namespace App;

use DB;
use Excel, File;
use App\Traits\GlobalScopeBusiness;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use GlobalScopeBusiness;
    
    protected $fillable = ['business_id', 'status', 'vehicle_id', 'name', 'description', 'photo', 'price', 'stock', 'weight', 'lenght', 'height', 'width', 'is_best_seller', 'in_promotion', 'all_day', 'istop20'];
    
    /**
     * The product's business.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function business() {
        return $this->belongsTo(Business::class);
    }
    
    /**
     * The product's status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo(Status::class);
    }
    
    /**
     * The product's delivery method.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
    
    /**
     * The orders in which the product was requested.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function orders() {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Count the total of active products.
     *
     */
    public static function countActiveProducts($business_id = false) {
        $products = Product::where('status', 1);
        $business_id ? $products = $products->where('business_id', $business_id) : '';
        
        return $products->count();
    }

    /**
     * Count the total of rejected products.
     *
     */
    public static function countRejectedProducts($business_id = false) {
        $products = Product::where('status', 0);
        $business_id ? $products = $products->where('business_id', $business_id) : '';
        
        return $products->count();
    }

    /**
     * Count the total of pending products.
     *
     */
    public static function countPendingProducts($business_id = false) {
        $products = Product::where('status', 2);
        $business_id ? $products = $products->where('business_id', $business_id) : '';
        
        return $products->count();
    }
    
    public static function exportProducts()
    {
        $productos = Product::select(DB::raw("products.name AS nombre, products.description AS descripcion, SUBSTRING_INDEX(photo, '/', -1) AS foto,
        products.price AS precio, products.stock, products.weight AS peso, products.lenght AS largo, products.height AS alto, products.width AS ancho,
        vehicles.name AS metodo_entrega, IF(products.is_best_seller = 1, 'si','no') AS mas_vendido, IF(products.in_promotion = 1, 'si','no') AS en_promocion,
        IF(products.all_day = 1, 'si','no') AS all_hrs, IF(products.istop20 = 1, 'si','no') AS istop20"))
        ->leftJoin('vehicles', 'products.vehicle_id', '=', 'vehicles.id')
        ->where('business_id', auth()->user()->business_id)
        ->get();
        Excel::create('Productos', function($excel) use($productos) {
            $excel->sheet('Hoja 1', function($sheet) use($productos) {
                $sheet->cells('A:N', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:N1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($productos);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }

    public static function downloadTemplate()
    {
        Excel::create('Plantilla productos', function($excel) {
            $excel->sheet('Hoja 1', function($sheet) {
                $sheet->cells('A:N', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:N1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $cabeceras = array ('nombre', 'descripcion', 'foto', 'precio', 'stock', 'peso', 'largo', 'alto', 'ancho', 'metodo_entrega', 'mas_vendido', 'en_promocion', 'all_hrs', 'istop20');
                $sheet->fromArray($cabeceras);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }

    public static function importProducts($request)
    {
        if (Input::hasFile('excel')) {
            $folder = auth()->user()->business_id;
            $path = Input::file('excel')->getRealPath();
            $extension = Input::file('excel')->getClientOriginalExtension();

            if ($extension == 'xlsx' || $extension == 'xls') {
                $data = Excel::load($path, function($reader) {
                    $reader->setDateFormat('H:i:s');
                })->get();

                if (!empty($data) && $data->count()) {
                    foreach ($data as $key => $value) {

                        $vehicle_id = DB::table('vehicles')->where('name', $value->metodo_entrega)->pluck('id');
                        if (!$vehicle_id) {
                            return ['msg' => 'Error: Tipo de vehículo inválido'];
                        }

                        $is_best_seller = $value->mas_vendido == 'si' ? 1 : 0;
                        $in_promotion = $value->en_promocion == 'si' ? 1 : 0;
                        $all_hrs = $value->all_hrs == 'si' ? 1 : 0;
                        $istop20 = $value->istop20 == 'si' ? 1 : 0;

                        $insert = [
                            'business_id' => auth()->user()->business_id,
                            'status' => 2,
                            'name' => $value->nombre,
                            'description' => $value->descripcion,
                            'photo' => $value->foto ? 'products/'.$folder.'/'.$value->foto : 'products/default.jpg',
                            'price' => $value->precio,
                            'stock' => $value->stock,
                            'weight' => $value->peso,
                            'lenght' => $value->largo,
                            'height' => $value->alto,
                            'width' => $value->ancho,
                            'vehicle_id' => $vehicle_id[0],
                            'is_best_seller' => $is_best_seller,
                            'in_promotion' => $in_promotion,
                            'all_day' => $all_hrs,
                            'istop20' => $istop20,
                        ];

                        Product::updateOrCreate([
                            'business_id' => auth()->user()->business_id,
                            'name' => $insert['name']
                        ], $insert);
                    }
                }//End data count if
            }//End of extension if
        }//End first if
    }//End import product
}
