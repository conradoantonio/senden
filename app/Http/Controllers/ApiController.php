<?php 

namespace App\Http\Controllers; 

use App\User; 
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Hashing\BcryptHasher; 
use DB; 
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;

require_once("conekta/lib/Conekta.php");

class appController extends Controller 
{ 

     public function __construct() 
       { 
          \Conekta\Conekta::setApiKey("key_WmBmjHZY4pQASbyzr3j7sg"); 
          \Conekta\Conekta::setApiVersion("2.0.0"); 
       }  
     

     




    /** 
     * Da de alta el registro de un usuario tipo cliente. 
     * 
     * @param  Request  $request 
     * @return response()->json($user_id) 
     */ 
    public function register(Request $request) 
    { 
        $validar_user = DB::table('users')  
        ->orWhere('email', '=', $request->input('email'))  
        ->orWhere('username', '=', $request->input('username'))  
        ->get();  

        if (count($validar_user) > 0) { return '0'; }  

        date_default_timezone_set('America/Mexico_City');//Horario de méxico

        $user_id = DB::table('users')->insertGetId(  
            ['username' => $request->input('username'),  
             'name' => $request->input('name'),
             'surname' => $request->input('surname'),
             'email' => $request->input('email'),  
             'user_type_id' => 5,
             'isPanelUser' => 0,
            // 'password_hash' => (new BcryptHasher)->make($request->input('password')),  
             'user_password' => $request->input('password'),
             'password' => $request->input('password'),
             'status' => 1,  
           //  'auth_key' => (new BcryptHasher)->make($request->input('password')),
             'phoneNumber' => $request->input('phoneNumber'),
             'street' => $request->input('address'),  
             'int_number' => $request->input('intNumber'),  
             'ext_number' => $request->input('extNumber'),  
             'colony' => $request->input('neighborhood'),  
             'postal_code' => $request->input('cp'),  
             'state' => $request->input('state'),  
             'municipality' => $request->input('city'),
             'created_at' => date("Y-m-d H:i:s")
            ]  
        );  

    /*    DB::table('person')->insert(  
            ['name' => $request->input('name'),  
             'surname' => $request->input('surname'),  
             'phoneNumber' => $request->input('phoneNumber'),  
             'user_id' => $user_id,  
             'address' => $request->input('address'),  
             'intNumber' => $request->input('intNumber'),  
             'extNumber' => $request->input('extNumber'),  
             'neighborhood' => $request->input('neighborhood'),  
             'cp' => $request->input('cp'),  
             'state' => $request->input('state'),  
             'city' => $request->input('city'),  
             'personType_id' => 2  
            ] 
        );  */

        return response()->json($user_id);  
    } 

    /** 
     * Actualiza los datos de un usuario. 
     * 
     * @param  Request  $request (email, password_hash, name, surname, phoneNumber, address,  
     * intNumber, extNumber, neightborhood, cp, state, city) 
     * @return response()->json($request->input('id')) 
     */ 
    public function updateUser(Request $request) 
    { 
        $v_email = DB::table('users')  
        ->where('email', '=', $request->input('email'))  
        ->get();  

        if (count($v_email) > 0) { return ['success' => false]; }  

        if ($request->input('password_hash') != '' && $request->input('email') != '') {  
            $update_user = ['email'=> $request->input('email'),  
                            'password_hash'=>(new BcryptHasher)->make($request->input('password_hash'))];  
        } else if ($request->input('email') != '' && ($request->input('password_hash') == '' || $request->input('password_hash') == null)) {  
            $update_user = ['email'=> $request->input('email')];  
        } else if ($request->input('password_hash') != '' && ($request->input('email') == '' || $request->input('email') == null)) {  
            $update_user = ['password_hash'=>(new BcryptHasher)->make($request->input('password_hash'))];  
        }  

        if ($request->input('password_hash') != '' || $request->input('email') != '') {  
            DB::table('users')  
            ->where('user.id', $request->input('id'))  
            ->update($update_user);  
        }  
          
        DB::table('users')  
        ->where('id', $request->input('id'))  
        ->update( 
            ['name' => $request->input('name'),  
             'surname' => $request->input('surname'),  
             'phoneNumber' => $request->input('phoneNumber') 
            ] 
        );  
         
        return response()->json($request->input('id'));  
    } 
     
     
    public function updateUserAddress(Request $req)  
    { 
         DB::table('users') 
         ->where('id', $req->input('id')) 
         ->update( 
            [  
             'int_number' => $req->input('intNumber'),  
             'ext_number' => $req->input('extNumber'),  
             'colony' => $req->input('neighborhood'),  
             'postal_code' => $req->input('cp'),  
             'state' => $req->input('state'),  
             'municipality' => $req->input('city'),
             'street' => $req->input('address') 
            ]);  
         
        return response()->json($req->input('id'));     
    } 
     
     
     
     
     

    /**  
     * Obtiene todos los productos que coincidan con la cadena otorgada por el usuario  
     *  
     * @param  Request $request  
     * @return $products   
     */  
    public function searchProduct(Request $request) 
    { 
        $products = DB::table('product') 
        ->select(DB::raw('product.id as idProduct, name, description, price, picture, isTop20, isPromotion, 
        physicalproperty.weight, physicalproperty.height, physicalproperty.breadth, physicalproperty.totalLength,
        physicalproperty.unitMeasurement')) 
        ->leftJoin('physicalproperty', 'product.id', '=', 'physicalproperty.product_id') 
        ->where('business_id', '=', $request->input('business_id')) 
        ->where('name', 'like', '%'.$request->input('name').'%') 
        ->get(); 

        return response()->json($products);  
    } 

    /**  
     * Obtiene todos los productos de un negocio en específico  
     *  
     * @param  Request $request  
     * @return $products   
     */ 
    public function get_products(Request $request) 
    { 
        $products = DB::table('products')
        ->select(DB::raw('products.id as idProduct, products.name, products.description, products.price, products.photo as picture, products.isTop20 as isTop20, in_promotion as isPromotion, stock'))
      /*  ->select(DB::raw('product.id as idProduct, name, description, price, picture, isTop20, isPromotion, 
        physicalProperty.weight, physicalProperty.height, physicalProperty.breadth, physicalProperty.totalLength,
        physicalProperty.unitMeasurement, stock')) */
      //  ->leftJoin('physicalProperty', 'product.id', '=', 'physicalProperty.product_id') 
        ->where('business_id', '=', $request->input('business_id'))
       // ->where('validation','=', 1)
        ->where('stock','>', 0) 
        ->where('status', '=', 1) 
        ->get();  

        return response()->json($products); 
    } 

    /**  
     * Obtiene todos los negocios de una cierta categoría que estén a 5km de distancia  
     *  
     * @param  Request $request  
     * @return $businessFiltered   
     */  
    public function get_businessApp(Request $request) 
    { 
    
    	 date_default_timezone_set('America/Mexico_City');
    	 
    	 $hora_actual = date('H:i:s');
    	 $fecha = date('Y-m-d');
    	 
    	//return $hora_actual;
    	
    	$array_dias['Sunday'] = "Domingo";
	$array_dias['Monday'] = "Lunes";
	$array_dias['Tuesday'] = "Martes";
	$array_dias['Wednesday'] = "Miercoles";
	$array_dias['Thursday'] = "Jueves";
	$array_dias['Friday'] = "Viernes";
	$array_dias['Saturday'] = "Sabado";

	
       // echo "El dia es ".$array_dias[date('l', strtotime($fecha))];
        
        $dia =  $array_dias[date('l', strtotime($fecha))];
        
    	 
      $hora =  "'".$hora_actual."'";
       
   
      /*if ($dia == 'Lunes' || $dia == 'Martes' || $dia == 'Miercoles' || $dia == 'Jueves' || $dia == 'Viernes') {
          $business = DB::select("        
          SELECT businesses.id, businesses.name, businesses.phone, CONCAT( businesses.street,  ' ', businesses.ext_number,  ' ', businesses.colony ) AS address, businesses.tradename AS description, businesses.logo AS logotype, latitude, longitude, isOpen, photo1 AS facade1, semana_inicio, semana_fin, semana_com_inicio, semana_com_fin, sabado_inicio, sabado_fin, sabado_com_inicio, sabado_com_fin, domingo_inicio, domingo_fin, domingo_com_inicio, domingo_com_fin
       	  FROM businesses
	  INNER JOIN categories ON businesses.category_id = categories.id
	  WHERE  ".$hora." BETWEEN semana_inicio AND semana_fin
  	  AND  ".$hora." NOT BETWEEN semana_com_inicio AND semana_com_fin
	  #AND businesses.isOpen =1
	  AND businesses.category_id = ".$request->input('category_id')."	
          ");
      } else if($dia == 'Sabado'){
      	 $business = DB::select("        
          SELECT businesses.id, businesses.name, businesses.phone, CONCAT( businesses.street,  ' ', businesses.ext_number,  ' ', businesses.colony ) AS address, businesses.tradename AS description, businesses.logo AS logotype, latitude, longitude, isOpen, photo1 AS facade1, semana_inicio, semana_fin, semana_com_inicio, semana_com_fin, sabado_inicio, sabado_fin, sabado_com_inicio, sabado_com_fin, domingo_inicio, domingo_fin, domingo_com_inicio, domingo_com_fin
       	  FROM businesses
	  INNER JOIN categories ON businesses.category_id = categories.id
	  WHERE  ".$hora." BETWEEN sabado_inicio AND sabado_fin
  	  AND  ".$hora." NOT BETWEEN sabado_com_inicio AND sabado_com_fin
	  #AND businesses.isOpen =1
	  AND businesses.category_id = ".$request->input('category_id')."	
          ");	
      } else {
      	  $business = DB::select("        
          SELECT businesses.id, businesses.name, businesses.phone, CONCAT( businesses.street,  ' ', businesses.ext_number,  ' ', businesses.colony ) AS address, businesses.tradename AS description, businesses.logo AS logotype, latitude, longitude, isOpen, photo1 AS facade1, semana_inicio, semana_fin, semana_com_inicio, semana_com_fin, sabado_inicio, sabado_fin, sabado_com_inicio, sabado_com_fin, domingo_inicio, domingo_fin, domingo_com_inicio, domingo_com_fin
       	  FROM businesses
	  INNER JOIN categories ON businesses.category_id = categories.id
	  WHERE  ".$hora." BETWEEN domingo_inicio AND domingo_fin
  	  AND  ".$hora." NOT BETWEEN domingo_com_inicio AND domingo_com_fin
	  #AND businesses.isOpen =1
	  AND businesses.category_id = ".$request->input('category_id')."	
          ");	
      } */
     
       
      
       $business = DB::table('businesses') 
        ->select(DB::raw("businesses.isOpen, businesses.id, businesses.name,businesses.phone, CONCAT(businesses.street,' ',businesses.ext_number,' ',businesses.colony) as address, businesses.tradename as description, businesses.logo as logotype, latitude, longitude, isOpen, photo1 as facade1, semana_inicio, semana_fin, semana_com_inicio, semana_com_fin,sabado_inicio, sabado_fin,sabado_com_inicio, sabado_com_fin, domingo_inicio, domingo_fin, domingo_com_inicio, domingo_com_fin
"))
        ->join('categories', 'businesses.category_id', '=', 'categories.id') 
        ->where('businesses.category_id', '=', $request->input('category_id')) 
        //->where('businesses.isOpen', '=', '1')
        ->where('businesses.status', 1)
        ->get(); 
       
      if(empty($business)){
        return response()->json([]);
      }
        

        $km = 111.302; 
        //1 Grado = 0.01745329 Radianes 
        $degtorad = 0.01745329; 
        //1 Radian = 57.29577951 Grados 
        $radtodeg = 57.29577951; 

        foreach ($business as $b) { 
            $dlong = ($b->longitude - $request->input('longitude')); 
            $dvalue = (sin($b->latitude * $degtorad) * sin($request->input('latitude') * $degtorad)) + (cos($b->latitude * $degtorad) * cos($request->input('latitude') * $degtorad) * cos($dlong * $degtorad));   
            $dd = acos($dvalue) * $radtodeg;   
            $distance = round(($dd * $km), 2);   

            if ($distance <= 5) {      // 5 km around   
                $b->distance = $distance;   
            }   
        }   
	
	$business = collect($business);	
	
        $businessFiltered = $business->reject(function($value, $key) {   
            if(!isset($value->distance)) {   
                return $value;   
            }    
        });
        
        
          if($businessFiltered->count() == 0) {
          	return response()->json([]);
          }
          
          
       foreach($businessFiltered as $bf) {
         if($bf->isOpen==1) {  
             $bf->isOpen = 0;
             
             if ($dia == 'Lunes' || $dia == 'Martes' || $dia == 'Miercoles' || $dia == 'Jueves' || $dia == 'Viernes') {
                 if($hora_actual < $bf->semana_com_inicio || $hora_actual > $bf->semana_com_fin ) {
	                 if($hora_actual > $bf->semana_inicio && $hora_actual < $bf->semana_fin) {
	                 	$bf->isOpen = 1;
	  
	                 }
	           }         
             }
             
             
              if($dia == "Sabado") {
                 if($hora_actual < $bf->sabado_com_inicio || $hora_actual > $bf->sabado_com_fin ) {
	                 if($hora_actual > $bf->sabado_inicio && $hora_actual < $bf->sabado_fin) {
	                 	$bf->isOpen = 1;
	                 		
	                 }
	           }         
               } else {
               	   if($hora_actual < $bf->domingo_com_inicio || $hora_actual > $bf->domingo_com_fin ) {
	                 if($hora_actual > $bf->domingo_inicio && $hora_actual < $bf->domingo_fin) {
	                 	$bf->isOpen = 1;
	                 	
	                 }
	            }  
               
               }
            }               
        }
          
          
          
         $businessFiltered = $businessFiltered->sortBy('distance'); 
         
         
         
         
        
       // return $businessFiltered;
          // $fecha
        
          	
        
        foreach($businessFiltered  as $bf) {  // se eliminan las localidades del objeto
            $bfr[] = $bf;
        }
        
      
        
     

        return response()->json($bfr); 
    } 

    /**  
     * Introduce el código del sendenboy y cambia el status del pedido a "en camino".  
     *  
     * @param  Request $request  
     * @return response()->json(true)   
     */  
    public function pickup_product(Request $request) 
    { 
        $exist = DB::table('tkey') 
        ->where('akey_user', '=', $request->input('code')) 
        ->first(); 

        if (count($exist) == 0){ 
            return response()->json(false);  
        } 

        DB::table('orders')  
            ->where('id', $exist->id)  
            ->update(['status_id' => '2']); 

        return response()->json(true); 
    } 

    /**  
     * Indica un negocio como favorito del usuario..  
     *  
     * @param  Request $request  
     * @return response()->json(true)   
     */  
  
    public function make_favorite(Request $request)  
    {  
        DB::table('user_business_fav')->insert(   
            ['user_id' => $request->input('user_id'),   
             'business_id' => $request->input('business_id')  
            ]  
        );  

        return response()->json(true);  
    }  
     
     
     
     /**  
     * Desmarca el negocio favorito.  
     *  
     * @param  Request $request  
     * @return response()->json(true)   
     */  
    
     public function dislike_favorite(Request $request)  
    {  
        DB::table('user_business_fav')->where([ 
           ['user_id', '=', $request->input('user_id')], 
           ['business_id', '=', $request->input('business_id')]  
          ])->delete();  

        return response()->json(true);  
    }  



    /**  
     * Trae los negocios favoritos de un usuario.  
     *  
     * @param  Request $request  
     * @return response()->json($favoritos)   
     */  
    public function get_favorites(Request $request) 
    { 
        $favoritos = DB::table('user_business_fav') 
        //->select(DB::raw("businesses.id AS id, name, businesses.street AS address, description, logotype, latitude,longitude, isOpen"))
        ->select('businesses.*')
        ->where('user_id', '=', $request->input('user_id')) 
        ->leftJoin('businesses', 'user_business_fav.business_id', '=', 'businesses.id') 
        ->get(); 

        return response()->json($favoritos); 
    } 
    
    
    /*Realiza la insercion de la tarjeta de pago del usuario */  
    public function set_card(Request $req) 
    { 
        $id = DB::table('user_card')->insertGetId( 
          [ 
            'token' => $req->input("token"), 
            'last_digits' => $req->input("last_digits"), 
            'id_user' => $req->input("id") 
          ]); 
          
          
          $tokenCard = DB::table('user_card')->select('token','last_digits')
          ->where('id', $req->input("cardId"))->get();
          
          
       $isCreatedConektaUser = DB::table('users')->select('id_conekta')->where('id', $req->input("id"))->get(); 
       
      if($isCreatedConektaUser[0]->id_conekta == NULL){
        $customer_conekta = $this->create_customer($req->input("id"));
       }
        
       $isCreatedConektaUser = DB::table('users')->where('id', $req->input("id"))->first(); 
            
            $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);//Se tiene que volver a buscar
          
           
          
          
            foreach($customer->payment_sources as $c) {
                    if($tokenCard[0]->last_digits == $c->last4 ){
                         $payment_source_conekta = $c; 	
                    } 
            }
            
            if(!isset($payment_source_conekta)) {
            	 $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);
            	 $source = $customer->createPaymentSource(array('token_id' =>  $tokenCard[0]->token, 'type' => 'card'));	   
            	 
            	foreach($customer->payment_sources as $c) {
                    if($tokenCard[0]->last_digits == $c->last4 ){
                         $payment_source_conekta = $c; 	
                    } 
                 }
             }    
          
           
          return response()->json($id);      
    } 
     
    /* Elimina tarjeta del usuario */ 
    public function delete_card(Request $req) 
    { 
        DB::table('user_card') 
        ->where('id', $req->input("id")) 
        ->delete(); 
         
         return response()->json(true); 
    } 
     
    /*Trae las tarjetas del usuario*/ 
    public function get_cards(Request $req) 
    { 
       $userCards = DB::table('user_card') 
        ->where('id_user', $req->input("id")) 
        ->get(); 
         
        return response()->json($userCards); 
    } 
    
     
     
     

    /**  
     * Trae los negocios favoritos de un usuario.  
     *  
     * @param  Request $request  
     * @return response()->json($favoritos)   
     */  
    public function get_history(Request $request) 
    { 
        $historial = DB::table('order_has_user') 
        ->select(DB::raw('order.id AS idOrder, order.comment, order.total, order.status, order.updatedAt AS fechaEntrega'))
        ->where('order_has_user.user_id', '=', $request->input('user_id')) 
        ->leftJoin('order', 'order_has_user.order_id', '=', 'order.id') 
        ->get(); 

        foreach ($historial as $val) { 
            $productos = DB::table('product_has_order') 
            ->select(DB::raw("product_has_order.quantity ,product.*, physicalproperty.*")) 
            ->leftJoin('product', 'product_has_order.product_id', '=', 'product.id') 
            ->leftJoin('physicalproperty', 'physicalproperty.product_id', '=', 'product.id') 
            ->where('product_has_order.order_id', '=', $val->idOrder) 
            ->get(); 

            $val->detalles = $productos; 
        } 

        return response()->json($historial); 
    } 
     
    /**  
     * Genera una nueva contraseña para el usuario.  
     *  
     * @param  Request $request  
     * @return ['success'=>'true']   
     */  
    public function recuperar_contra(Request $request) 
    { 
        $errors = ''; 
        //$myemail = 'soporte@senden.com';//<-----Put Your email address here. 
        if (empty($request->input('email'))) { 
            $errors .= "\n Error: Email is required"; 
            return ['msg'=>'No hay correo']; 
        } 
        $name = 'Senden'; 
        $email_address = $request->input('email'); 
        $message = 'Nueva contraseña';  
        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) { 
            $errors .= "\n Error: Invalid email address"; 
            return ['msg'=>'Correo inválido']; 
        } 

        if (empty($errors)) {
            $new_pass = str_random(8); 
            $existe = DB::table('users')->where('email', $email_address)->get(); 
            if (count($existe) > 0) { 
                DB::table('users') 
                ->where('email', $email_address) 
                ->update(['password' => (new BcryptHasher)->make($new_pass),
                'password' => $new_pass, 'user_password' => $new_pass]); 

                $to = $email_address; 
                $email_subject = "Restablecimiento de su cuenta senden."; 
                $email_body = "A continuación se muestra una nueva contraseña para su cuenta en nuestra aplicación senden".
                "\nNueva contraseña: $new_pass". 
                "\nSi recibiste este mensaje y no pediste el restablecimiento de una nueva contraseña para tu cuenta, porfavor contáctanos.";
                $headers = "From: Senden\n";
                //$headers .= "Reply-To: $email_address"; 
                mail($to,$email_subject,$email_body,$headers); 
                return ['msg'=>'enviado']; 
            } else { 
                return ['msg' => 'No existe el correo']; 
            } 
        } 
    } 

    /** 
     * Actualiza una foto de perfil de un usuario. 
     * 
     * @param  Request $request 
     * @return $nombre_foto si la imagen fue subida exitosamente, 0 si hubo algún error subiendo la imagen.
     */ 
     public function actualizar_foto(Request $request) 
    { 
        $id = $request->input('user_id');
        $name_default = "img/default.jpg"; 
        $url_main = $_SERVER['DOCUMENT_ROOT'] . "/sendenv2/public/sendenshop";
        $target_path = $url_main;
        
        $extension = explode(".", basename($_FILES['file']['name']));
        $nombre = time().'.'.$extension[1];
        $target_path = $target_path .'/'. $nombre; 
        
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) { 
            
            DB::table('users')  
            ->where('id', $id)  
            ->update(['photo' => "sendenshop/".$nombre]); 

            //echo "Upload and move success"; 
            return "sendenshop/".$nombre; 
        } else {
            //echo "There was an error uploading the file, please try again!"; 
            return 0; 
        } 
    } 
   
     
     
    // senden boy 
     
     
    public function getIncidence() { 
        $incidences = DB::table('incidence_types')->get(); 
         return response()->json($incidences); 
    } 
    
    
    public function setIncidence(Request $req) { 
   //    $postData = json_decode(file_get_contents('php://input')); 

      // $res = DB::table('incidenceControl')->insert(['comment' => $req->input("description"), 'order_id' => $req->input("order_id"), 'typeIncidence_id' => $req->input("incidence_id")]); 
       
       $business = DB::table('orders')->where('id', $req->input("order_id"))->first();
          
       $res = DB::table('incidences')->insert(['business_id' => $business->id, 'incidence_type_id' => $req->input("incidence_id"), 'order_id' => $req->input("order_id"), 'description' => $req->input("description") ]);
	
	$res[] = $business->id;
		
       return response()->json($res);  
    }      
     
     
    public function getInfoApp() { 
        $info = DB::table('informationEnterprise')->get(); 
       return response()->json($info); 
    } 
     
     
    
   public function getBusiness(Request $req) { 
         
          date_default_timezone_set('America/Mexico_City');
    	 
    	// $hora_actual = date('h:m:s');
    	$hora_actual = date('H:i:s');
    	 $fecha = date('Y-m-d');
    	 
    	$array_dias['Sunday'] = "Domingo";
	$array_dias['Monday'] = "Lunes";
	$array_dias['Tuesday'] = "Martes";
	$array_dias['Wednesday'] = "Miercoles";
	$array_dias['Thursday'] = "Jueves";
	$array_dias['Friday'] = "Viernes";
	$array_dias['Saturday'] = "Sabado";
        
        $dia =  $array_dias[date('l', strtotime($fecha))];
         
       
       $sendenboy = DB::select("
       	 SELECT * FROM sendenboys WHERE id = ".$req->input("id")."
       ");  
       
      
         $hora =  "'".$hora_actual."'";
       
   
      if ($dia == 'Lunes' || $dia == 'Martes' || $dia == 'Miercoles' || $dia == 'Jueves' || $dia == 'Viernes') {
       $business = DB::select("
       	SELECT products.vehicle_id, businesses.id, businesses.name, CONCAT(businesses.street, ' ', businesses.ext_number, ' ', businesses.colony ) AS address, businesses.logo AS logotype, businesses.latitude, businesses.longitude, businesses.photo1 AS facade1, categories.id AS category, COUNT( DISTINCT orders.id ) AS numOrders, semana_inicio, semana_fin
	FROM businesses
	INNER JOIN categories ON businesses.category_id = categories.id
	INNER JOIN orders ON businesses.id = orders.business_id
	INNER JOIN products ON businesses.id = products.business_id
	WHERE ".$hora."
	BETWEEN semana_inicio AND  semana_fin
	AND ".$hora." NOT BETWEEN semana_com_inicio AND semana_com_fin
	AND orders.status_id = 1
	AND isOpen = 1
	GROUP BY id
       ");
      } else if($dia == 'Sabado') {
       $business = DB::select("
       	SELECT products.vehicle_id, businesses.id, businesses.name, CONCAT(businesses.street, ' ', businesses.ext_number, ' ', businesses.colony ) AS address, businesses.logo AS logotype, businesses.latitude, businesses.longitude, businesses.photo1 AS facade1, categories.id AS category, COUNT( DISTINCT orders.id ) AS numOrders, semana_inicio, semana_fin
	FROM businesses
	INNER JOIN categories ON businesses.category_id = categories.id
	INNER JOIN orders ON businesses.id = orders.business_id
	INNER JOIN products ON businesses.id = products.business_id
	WHERE  ".$hora."
	BETWEEN sabado_inicio AND  sabado_fin
	AND ".$hora." NOT BETWEEN sabado_com_inicio AND sabado_com_fin
	AND orders.status_id = 1
	AND isOpen = 1
	GROUP BY id
       ");	
      
      } else {
      	   $business = DB::select("
       	SELECT products.vehicle_id, businesses.id, businesses.name,CONCAT(businesses.street, ' ', businesses.ext_number, ' ', businesses.colony ) AS address, businesses.logo AS logotype, businesses.latitude, businesses.longitude, businesses.photo1 AS facade1, categories.id AS category, COUNT( DISTINCT orders.id ) AS numOrders, semana_inicio, semana_fin
	FROM businesses
	INNER JOIN categories ON businesses.category_id = categories.id
	INNER JOIN orders ON businesses.id = orders.business_id
	INNER JOIN products ON businesses.id = products.business_id
	WHERE  ".$hora."
	BETWEEN domingo_inicio AND  domingo_fin
	AND ".$hora." NOT BETWEEN domingo_com_inicio AND domingo_com_fin
	AND orders.status_id = 1
	AND isOpen = 1
	GROUP BY id
       ");	
      
      
      
      }
       
      if(empty($business)){
        return response()->json([]);
      }
      /* $business = DB::table('businesses')->select(DB::raw("products.vehicle_id,  businesses.id,businesses.name, businesses.street AS address,businesses.logo AS logotype ,businesses.latitude,businesses.longitude,businesses.photo1 AS facade1, categories.id AS category, COUNT(DISTINCT orders.id) AS numOrders"))       
       ->join('categories', 'businesses.category_id', '=', 'categories.id') 
       ->join('orders', 'businesses.id', '=', 'orders.business_id')
       ->join('products', 'businesses.id', '=', 'products.business_id')
        ->groupBy("id")
        ->where('orders.status_id', '=', 1)
       ->where(['isOpen' => '1'])->get(); */
       
     
  
       
       /*Cambiar si no sirve*/


          $km = 111.302; 
          //1 Grado = 0.01745329 Radianes 
          $degtorad = 0.01745329; 
          //1 Radian = 57.29577951 Grados 
          $radtodeg = 57.29577951; 

    foreach ($business as $b) {   
        $dlong = ($b->longitude - $req->input("longitude")); 
        $dvalue = (sin($b->latitude * $degtorad) * sin($req->input("latitude") * $degtorad)) + (cos($b->latitude * $degtorad) * cos($req->input("latitude") * $degtorad) * cos($dlong * $degtorad)); 
        $dd = acos($dvalue) * $radtodeg; 
        $distance = round(($dd * $km), 2); 

        if ($distance <= 10) {      // 5 km around 
            $b->distance = $distance; 
        } 
    } 
    
    
     $business = collect($business);

      $businessFiltered = $business->reject(function($value, $key) { 
       
              if(!isset($value->distance) && $value->numOrders > 0 ) { 
                  return $value; 
              }  
      }); 
      
       $businessFiltered = $businessFiltered->sortBy('distance');
      
     
      
        $vehicle = $sendenboy[0]->vehicle_id;
        
        $businessFiltered->toArray();
        
     /* $businessFilter =  $businessFiltered->reject(function($value, $key) use($vehicle) {
      
      
      	     if($vehicle == 2 ){
      	       return $value;
      	     } else if($vehicle  ==1 && $value->vehicle_id == 1) {
      	        return $value;
      	     }
      });*/
      
  
      
     /* $sendenboy[0]->vehicle_id =1;
      $businessFiltered[0]->vehicle_id = 2;*/
       foreach($businessFiltered as $b) {
       	    if($sendenboy[0]->vehicle_id == 2) {
       	        
       	    } else {
       	    	 unset($b); 
       	    }
       }
      
      
      //$products = $this->getBusinessProduct();
      
     
      
     /* foreach($businessFiltered as $b){
         foreach($products as $p){
             if($b->id == $p->business_id){
                $b->products[] = $p;
             }      
         }    
      } */
      
    return response()->json($businessFiltered ); 
 } 
 
  private function getBusinessProduct()
  {
       $products =  DB::table('products')
         ->join('order_details', 'products.id', '=', 'order_details.product_id')
         ->get();  
         
    return $products;
  }
 
  
  
  public function qualifySendenBoy(Request $req) 
  {
  
    DB::table('order_has_user')
    //->where('user_id', $req->input("id"))
    ->where('order_id', $req->input("idOrder"))
    ->update(['qualification' => $req->input("qualification")]);
    
    $infoSendenBoy = DB::select("select users.id, users.name, users.photo FROM users
            INNER JOIN order_has_user ON users.id = order_has_user.sendenboy_id  
            where order_has_user.order_id = ".$req->input("idOrder")."  
    ");
        
    
    
    
    
    return response()->json($infoSendenBoy);
  }
  
  
  public function qualifyUser(Request $req)
  {
    
    DB::table('order_has_user')
    //->where('sendenboy_id', $req->input("id"))
    ->where('order_id', $req->input("idOrder"))
    ->update(['qualification_user' => $req->input("qualification")]);
    
    
    $infoUser = DB::select("select users.name, users.photo FROM users
            INNER JOIN order_has_user ON users.id = order_has_user.user_id       
            where order_has_user.order_id = ".$req->input("idOrder")."      
    ");
    
 
    return response()->json($infoUser);
    
  }
  
  
   public function getPersons(Request $req) { 
         
      $persons = DB::select("
      SELECT  orders.id AS idOrder, users.id, users.name, users.surname AS surname, users.street AS address, users.photo, order_has_user.latitude_user, order_has_user.longitude_user, orders.deliveryAddress, orders.created_at
      FROM order_has_user
      INNER JOIN orders ON order_has_user.order_id = orders.id
      INNER JOIN users ON order_has_user.user_id = users.id
      INNER JOIN businesses ON orders.business_id = businesses.id
      WHERE businesses.id = ".$req->input("businessId")." AND orders.status_id = 1
      GROUP BY orders.id
       ");
      return response()->json($persons); 
    
   } 
    
   public function getOrderDetails(Request $req) { 
   
        $orderDetails = DB::select("
        SELECT order_details.price,subtotal,total,quantity, products.name
        FROM order_details
        INNER JOIN products ON products.id = order_details.product_id
        WHERE order_details.order_id = ".$req->input("orderId")."
        ");

       return response()->json($orderDetails);     
   } 
    
    
    
   public function getBusinessPosition() {  //check 
      $bPosition = DB::table('businesses') 
       ->select(DB::raw("latitude, longitude"))
       ->get(); 

       return response()->json($bPosition); 
   }  
    
    
   public function getDeliveriesId() { 
       $deliveriesIds = DB::table('order') 
       ->select(DB::raw('order.id AS orderId, user.id AS userId, person.name,person.id AS personId, person.surname, person.address AS personAddress, order.status AS status'))
       ->join('order_has_user', 'order.id', '=', 'order_has_user.order_id') 
       ->join('user', 'order_has_user.user_id', '=', 'user.id') 
       ->join('person', 'user.id', '=', 'person.user_id') 
       ->where('order.status', '3') 
       ->orWhere('order.status', '4') 
       ->get(); 

       return response()->json($deliveriesIds); 
   }  
    
    
   public function getOrderStatus(Request $req) { 
   
        $status = DB::table('orders')->select('status_id AS status')
        ->where('id', $req->input("idOrder"))->get();
        
       /* $info = DB::table("person")->select("order_has_user.oder_id, person.photo, person.name, person.surname")
        ->join("user", "person.user_id", "=", "user.id")
        ->join("order_has_user", "order_has_user.user_id", "=", "user.id")
        ->where("order_has_user.order_id", $req->input("idOrder"))->get(); */
        
        $idSendenBoy = DB::select("
        	SELECT sendenboys.id 
        	FROM sendenboys
        	INNER JOIN order_has_user ON sendenboys.id = order_has_user.sendenboy_id
        	INNER JOIN orders ON order_has_user.order_id = orders.id
        	WHERE orders.id = ".$req->input("idOrder")."
        ");
        
            
        
       
        
       	if(empty($idSendenBoy)){
       	    return response()->json($status);
       	}
       
       
       
          
        /* $info = DB::select("
          SELECT  tkey.akey AS numOrder, order_has_user.sendenboy_id,sendenboys.id AS sendenboyId, users.photo, users.name
          FROM users
          INNER JOIN order_has_user ON order_has_user.sendenboy_id = users.id
          INNER JOIN tkey ON order_has_user.order_id = tkey.order_id	
          INNER JOIN sendenboys ON order_has_user.sendenboy_id = sendenboys.id
          WHERE sendenboys.id = ".$idSendenBoy."
          WHERE order_has_user.order_id = ".$req->input("idOrder")."
         
         ");*/
         
         
         $info = DB::select("
          SELECT  tkey.akey AS numOrder, order_has_user.sendenboy_id,sendenboys.id AS sendenboyId, sendenboys.driver_photo AS photo, users.name, users.surname
          FROM tkey
          INNER JOIN order_has_user ON order_has_user.order_id= tkey.order_id
          INNER JOIN sendenboys ON order_has_user.sendenboy_id = sendenboys.id
          INNER JOIN users ON sendenboys.user_id= users.id
          WHERE sendenboys.id = ".$idSendenBoy[0]->id." AND order_has_user.order_id = ".$req->input("idOrder")."
          
         
         ");
         
         
       
          
          $status[] = $info;    
          
         
          
        /*  SELECT order_has_user.order_id, person.photo, person.name, person.surname
      FROM person
      INNER JOIN user ON person.user_id = user.id
      INNER JOIN order_has_user ON order_has_user.user_id = user.id
      WHERE order_has_user.order_id =21 */
   

        return response()->json($status); 
   } 
    

  public function statusSenden(Request $req) { 
  
  
  	
  	
  	
  	
  
    if($req->input("status")["checked"] == "true")  
      $res = DB::table('sendenboys')->where('id', $req->input("id"))->update(['inLine' => 1 ]);  
    else  
       $res = DB::table('sendenboys')->where('id', $req->input("id"))->update(['inLine' => 0 ]);  

     return response()->json($res);  
  } 
  
  
  
  public function placeOrder(Request $req) 
  {
     date_default_timezone_set('America/Mexico_City');//Pone la fecha y hora acorde al horario de México
     $date = date("Y-m-d H:i:s", strtotime('+3 hours'));
    
      $date_created_at =  date("Y-m-d H:i:s");
      
      $date_created_at = $date_created_at ."-05:00";
      
     
    
     $products = $req->input("products");
     
     $total = $this->calculateTotal($products, $req->input("idBusiness"));
  
     $dues = DB::table('dues')->get();
     
     $totalWithTaxes = $this->addTaxes($total, $dues, $req->input("distance"));
        
     $idOrder = DB::table('orders')->insertGetId([
       //  'total' => $req->input("total"),
         'total' => $totalWithTaxes["totalWithTaxes"],
         'business_id' => $req->input("idBusiness"),
         'deliveryAddress' => $req->input("deliveryAddress"),
         //'kmFee' =>  $req->input("kmFee"),
         'kmFee' => $totalWithTaxes["kmFee"],
         'initialFee' => $dues[1]->value,
         'insuranceFee' => $dues[2]->value,
         //'initialFee' =>  $req->input("initialFee"),
         //'insuranceFee' => $req->input("insuranceFee"),
         'distance' => $req->input("distance"),
         //'created_at' => date("Y-m-d H:i:sO"),
         'created_at' => $date_created_at,
         'real_time' => $date,
         //'detail' => $req->input("detail"),
         'comment' => $req->input("detail"),
         'status_id' => 1      
      ]);
      
      
      DB::table('order_has_user')->insert([
        'user_id' => $req->input("id"),
        'order_id' => $idOrder,
        'latitude_user' => $req->input("latitude_user"),
        'longitude_user' => $req->input("longitude_user")
      ]);
      
  	 
       DB::table('orders')
        ->where('orders.id', $idOrder )
        ->update(["user_id" => $req->input("id") ]);  
      
      
      foreach($products as $p) {
      
      	$price = DB::table('products')->select("price")->where('id', $p["id"])->first();
      	 	
      
      
        
          DB::table('order_details')->insert([
             'quantity' => $p["amount"],
             'product_id' => $p["id"],
             'order_id' => $idOrder,
             'price' => $price->price,  
             'total' => $totalWithTaxes["totalWithTaxes"],  // sacar de db
             'subtotal' => $total  // sacar de db
          ]);   
      }

      $this->sendNotificationNewOrder();
      
      return response()->json($idOrder);
       
  }
  
  
    
  private function calculateTotal($products, $businessId) 
  {
    $total = 0;
  
       foreach($products as $p) {
            
          $product = DB::table('products')
          ->where('business_id', $businessId)
          ->where('id', $p['id'])
          ->first();
       
         $total = $total + ($product->price * $p["amount"]); 
            
       }
       
      return $total;    
    
  }
  
  
  private function addTaxes($total,$dues, $distance)
  {
       
    $kilometers = $distance/1000;
    
    
    $kmFee = $dues[0]->value;   
    
    if($kilometers > 1) {
        $kmFee = $kilometers * $dues[0]->value;
    }
    
    $totalWithTaxes = $total + $dues[1]->value + $dues[2]->value + $kmFee;
    
    $res = array(
      "totalWithTaxes" => $totalWithTaxes,
      "kmFee" => $kmFee 
    );
        
    return $res;
   
  }
  
  
  public function getDues()
  {
     $tax = DB::table('dues')->get();
     
    
     
     return response()->json($tax);
  }
  
  
  
  public function getOrderInfo(Request $req)
  {
 
    $order = DB::select("SELECT users.*, person.* FROM sistemas_senden.orders
           INNER JOIN order_has_user ON orders.id = order_has_user.order_id
           INNER JOIN users ON order_has_user.user_id = user.id
               INNER JOIN businesses ON order.business_id = businesses.id
               WHERE businesses.id = ".$req->input('id')."
               ");
    
    return response()->json($order);
  }
  
  
  public function getHistoryOrder(Request $req)
  {
    $history = DB::table('order_has_user')
    ->join('orders', 'order_has_user.order_id', '=', 'order.id')
    ->where('order_has_user.user_id', $req->input("id"))
    ->get();
    
    return response()->json($history);
  }
  
  public function getSendenboyCoordinates(Request $req)
  {
    $coords = DB::table('order_has_user')->select('latitude_sendenboy', 'longitude_sendenboy')
    ->where('order_id', $req->input("idOrder"))
    ->get();
    
    return response()->json($coords);
  }
  
  public function setSendenCoordinates(Request $req)
  {
  	
  	  $id_sendenBoy = DB::table("sendenboys")->select("id")
        		->where("user_id", $req->input("id"))->get();
  
    $res = DB::table('order_has_user')
    ->where('sendenboy_id', $id_sendenBoy[0]->id)
    ->update(['latitude_sendenboy' => $req->input("latitude"), 'longitude_sendenboy'=> $req->input("longitude")]);
    
    return response()->json($res);
  }
  
  public function acceptDelivery(Request $req) 
  {
    
    
    
    $status = DB::table('orders')->select('status_id')
    ->where('id', $req->input('idOrder'))
    ->get();
    
        if($status[0]->status_id == 4){
           return response()->json(false);
        }
        
        $id_sendenBoy = DB::table("sendenboys")->select("id")
        		->where("user_id", $req->input("id"))->lockForUpdate()->get();	
        
        
        DB::table("order_has_user")
        ->where("order_id", $req->input("idOrder"))
        ->update(["sendenboy_id" => $id_sendenBoy[0]->id ]);
        
        DB::table('orders')
        ->where('orders.id',$req->input("idOrder") )
        ->update(["sendenboy_id" => $id_sendenBoy[0]->id ]);         
    
    DB::table('orders')  // cambia el estatus de la orden a located
    ->where('orders.id', $req->input("idOrder"))
    ->update(['orders.status_id' => 2]);
    
    
    $code = rand(100, 1000);
    
    DB::table('tkey')->where('order_id',$req->input("idOrder"))->delete();	
    
    $info = DB::table('tkey')  // regresa el codigo
     ->insert(['akey' => $code, 'order_id' =>  $req->input("idOrder") ]);
    
    
    return response()->json($code);
  }
  
  
  public function startDelivery(Request $req)
  {
    $res = DB::table('orders')
    ->where('id', $req->input("idOrder"))
    ->update(['status_id' => 4]);
    
    $this->sendNotificationStartOrder($req->input("idOrder"));
    return response()->json($res);
  }
  
  
  public function login(Request $request)
  {
    $userRecord = DB::table('users')    
       ->select('users.id', 'username', 'phoneNumber', 'name', 'surname', 'email', 'photo', 'colony AS neighborhood', 'int_number AS intNumber', 'ext_number AS extNumber','postal_code AS cp', 'municipality AS city', 'state', 'street AS address')
       ->where('username', $request->input('username'))
       ->where('user_password', $request->input('password'))
       ->where('user_type_id', 5) 
       ->first();
      
    if (empty($userRecord)) {      
        return response()->json(false); 
    }

    return response()->json($userRecord);
  }
  
  
  
  public function login_sendenboy(Request $req)
  {
  	$userRecord = DB::table('users')    
   	->select('users.id AS id','sendenboys.id AS sendenboyId', 'username' ,'name', 'surname', 'email', 'phoneNumber', 'sendenboys.driver_photo AS photo', 'colony', 'int_number', 'ext_number', 'postal_code', 'state', 'municipality', 'street AS address')
   	->join('sendenboys', 'users.id', '=', 'sendenboys.user_id')
   	->where('username', $req->input('username'))
   	->where('user_password', $req->input('password'))
   	->where('user_type_id', 2)//Check if is a sendenboy user
   	->first();       
               
         if(empty($userRecord)) {
         	return response()->json(false); 
         }
 
        return response()->json($userRecord);
  }
  
  
  
  public function rejectOrder(Request $req)
  {
    $res = DB::table('orders')->where('id', $req->input("idOrder"))
    ->update(['deciding' => 0]);
    
    return response()->json($res);
  }
  
  
  public function deciding(Request $req)
  {
  
      //$deciding = DB::table('order')->select('deciding')->where('id', $req->input("idOrder"))->get();
    
    //if($deciding[0]->deciding == 1){
       DB::table('orders')
         ->where('id', $req->input("idOrder"))
         ->update(['deciding' => 1]);
         
         sleep(60);
         
  //    } else {
        DB::table('orders')
             ->where('id', $req->input("idOrder"))
             ->update(['deciding' => 0]);
  //    }
    
    
    
    
  }
  
  
  
  
  public function finishDelivery(Request $req)
  {
  
      if($req->input("code") == 333){
      	  return response()->json(false);
      }	
  
    $exist = DB::table('tkey')->where('akey_user', $req->input("code"))->first();
    
    if($exist == NULL){
         return response()->json(false);    
    } else{
    
           DB::table('orders')
           ->where('id', $req->input("idOrder"))
           ->update(['status_id' => 5]);       
    
    
        return response()->json(true);
    }   
    
  }
  
  
  public function cancelOrder(Request $req)
  {
     DB::table('orders')
     ->where('id', $req->input("idOrder"))
     ->update(['status_id' => 6]);
     
     return response()->json(true);
  }
  
  
  public function getUserHistoryOrder(Request $req)
  {
    
    $history = DB::select("
    SELECT sistemas_senden.order. * ,users.* , businesses.name AS businessName, businesses.logotype
    FROM sistemas_senden.orders
    INNER JOIN order_has_user ON orders.id = order_has_user.order_id
    INNER JOIN users ON user.id = order_has_user.sendenboy_id
    INNER JOIN businesses ON business.id = orders.business_id
    WHERE sistemas_senden.orders.status_id =5

    ");
    
    
      $products = $this->getBusinessProduct();
      
     
      
      foreach($history as $b){
         foreach($products as $p){
             if($b->businessId == $p->business_id){
                $b->products[] = $p;
             }      
         }    
      }  
    
    
    return response()->json($history);
    
  }
  
  
  
  public function getHistory_user(Request $req)
  {
    $history = DB::select("
    SELECT order_has_user.order_id AS id, orders. * , businesses.id AS businessId, users.id AS personId, users.name AS personName, users.surname AS personSurname,users.photo AS photo, businesses.name AS businessName, businesses.logo AS logotype, CONCAT( businesses.street,  ' ', businesses.colony ) AS businessAddress, qualification AS sendenboyQualification, qualification_user, orders.created_at AS createdAt
    FROM orders
    INNER JOIN order_has_user ON orders.id = order_has_user.order_id
    INNER JOIN sendenboys ON order_has_user.sendenboy_id = sendenboys.id
    INNER JOIN users ON sendenboys.user_id = users.id#INNER JOIN users ON users.id = order_has_user.sendenboy_id

    INNER JOIN businesses ON businesses.id = orders.business_id
    WHERE orders.status_id =5
    AND order_has_user.user_id =  ".$req->input("id")."

    ");
    
    
    
    
      $products = $this->getBusinessProduct();
      
     
      
      
      foreach($history as $b){
         foreach($products as $p){
             if($b->businessId == $p->business_id && $b->id == $p->order_id){
                $b->products[] = $p;
             }      
         }    
      }  
     	
     
        return response()->json($history);
     
  }
  
  
  public function getSendenboyHistory(Request $req)
  {
    $history = DB::select("
        SELECT orders. * , users.id AS personId, users.photo, users.name AS personName, users.surname AS personSurname, businesses.id AS businessId, businesses.name AS businessName, businesses.logo AS logotype, businesses.colony AS businessAddress, qualification AS sendenboyQualification, qualification_user, orders.created_at AS createdAt
        FROM orders
        INNER JOIN order_has_user ON orders.id = order_has_user.order_id
        INNER JOIN users ON users.id = order_has_user.user_id
        INNER JOIN businesses ON businesses.id = orders.business_id
    
        WHERE orders.status_id =5 
        AND order_has_user.sendenboy_id = ".$req->input("id")."
    ");
    
    
  //  return $history;
    
      $products = $this->getBusinessProduct();
      
     
      
     foreach($history as $b){
         foreach($products as $p){
             if($b->businessId == $p->business_id && $b->id == $p->order_id){
                $b->products[] = $p;
             }      
         }    
      }  
     
    
    return response()->json($history);
    
  
  }
  
  
  
 
   
   
  /* 
  *  Funcion conekta para crear customer  
  * 
  */ 
   public function create_customer($idUser) 
   { 
        
        // $token = $req->input("token"); 
        // $cardDigits = $req->input("last4Digits"); 

         $person = DB::table('users') 
         ->select(DB::raw('users.name, users.surname, users.email, users.phoneNumber')) 
         ->where('users.id', $idUser) 
         ->get();
         
         $creditCards = DB::table('user_card')->select('token')
         ->where('id_user', $idUser)->get();
         
      
         
         foreach($person as $p){
            $person_info = array(
                "name" => $p->name.' '.$p->surname, 
                "email" => $p->email, 
                "phone" => "+52".$p->phoneNumber
            );
         }
         
         
         foreach($creditCards as $c){
             $payment_sources[] = array(
                "token_id" => $c->token,
                "type" => "card"
             );
         }
         
          $person_info["payment_sources"] = $payment_sources;
          
         
          
              
    $customer_conekta =  \Conekta\Customer::create($person_info); 
      
      DB::table('users')->where('id', $idUser)
      ->update(['id_conekta' => $customer_conekta->id]);
     
	
     		
	
      return $customer_conekta; 
   } 
   
   
   /*
   * Realizacion de pago con conekta
   *
   */
   
   public function makePayment(Request $req)
   {
   	
   	set_time_limit(60);
   	
      $statusOrder = DB::table('orders')->where('id', $req->input("orderId"))->first();
      
    
      
      if($statusOrder->status_id == 6){
        return response()->json("pedido cancelado");
      }
      
      $taxes = ($statusOrder->initialFee + $statusOrder->kmFee + $statusOrder->insuranceFee)  * 100;
      
      
      
     
      
      
        
      
       $tokenCard = DB::table('user_card')->select('token','last_digits')
       ->where('id', $req->input("cardId"))->get();
       
       
      /* $user = DB::table('user')->select('user.email','person.phoneNumber','person.name','person.surname')
       ->join('person', 'user.id', '=', 'person.user_id')
       ->where('user.id', $req->input("id"))->get();  */
       
       $order = DB::table('products')->select('products.name', 'products.description','products.price AS unit_price', 'order_details.quantity')
        //->join('product_has_order', 'product.id', '=', 'product_has_order.product_id')
        ->join('order_details', 'products.id' , '=', 'order_details.product_id')
        ->join('orders', 'orders.id' ,'=', 'order_details.order_id' )
        ->where('order_details.order_id', $req->input("orderId"))->get();   
       
        
       $isCreatedConektaUser = DB::table('users')->select('id_conekta')->where('id', $req->input("id"))->get(); 
       
      if($isCreatedConektaUser[0]->id_conekta == NULL){
        $customer_conekta = $this->create_customer($req->input("id"));
       }
        
       $isCreatedConektaUser = DB::table('users')->where('id', $req->input("id"))->first(); 
            
         
         // $person_info = DB::table('person')->where('user_id', $req->input("id"))->get(); 
          $person_info = DB::table('users')->where('id', $req->input("id"))->get();   
         
         
        foreach($person_info as $p){
            $shipping_contact = array(
             'phone'=> "+52".$p->phoneNumber,
             'receiver' => $p->name." ".$p->name,
              'address' => array(
                  'street1' => $p->street,
                  'city' => $p->municipality,
                  'state' => $p->state,
                    "country" => "MX",
                    'postal_code' => $p->postal_code,
                    "residential" => true                           
                )
            );
        }   
        
            
           
            
            $order_line = $order->toArray();
            
            $line = array();    
            
            foreach($order_line as $o){
               $o->unit_price = $o->unit_price * 100;
               $line[] = (array)$o;
            }
            
          $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);
       
          
       
           
	/* if (count($customer['payment_sources'])) {//Si tiene algún método de pago extra, entonces que se elimine y se crea uno nuevo
                $customer->payment_sources[0]->delete();
            }*/
            
             
         
            
            $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);//Se tiene que volver a buscar
          
           
          
          
            foreach($customer->payment_sources as $c) {
                    if($tokenCard[0]->last_digits == $c->last4 ){
                         $payment_source_conekta = $c; 	
                    } 
            }
            
            if(!isset($payment_source_conekta)) {
            	 $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);
            	 $source = $customer->createPaymentSource(array('token_id' =>  $tokenCard[0]->token, 'type' => 'card'));	   
            	 
            	foreach($customer->payment_sources as $c) {
                    if($tokenCard[0]->last_digits == $c->last4 ){
                         $payment_source_conekta = $c; 	
                    } 
                 }
            	 	
            	 
            } /*else {
            	 foreach($customer->payment_sources as $c) {
                    if($tokenCard[0]->last_digits == $c->last4 ){
                         $payment_source_conekta = $c; 	
                     } 
                  }
            } */
            
          
        
            
            /* $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);
           
            $source =  $customer->payment_sources->data[0]->update(array('default' => true));
            
            $customer = \Conekta\Customer::find($isCreatedConektaUser->id_conekta);  
              return $customer->payment_sources->data[0];*/
          	
          
          
  
            
            //return  $payment_source_conekta;
            
            /*  $source = $customer->createPaymentSource(array(
                'token_id' =>  $tokenCard[0]->token ,
                'type'     => 'card'
            ));*/ 
            
            
           
            
        
            
            
     try{
     
    
        
     $order =  \Conekta\Order::create(array(
               'currency' => 'MXN',
              'customer_info' => array(
                   'customer_id' => $isCreatedConektaUser->id_conekta
             ),
                'line_items' => $line,
                 "shipping_contact" => $shipping_contact,
                    
                     "shipping_lines" => array(
                    array(
                  "amount" => $taxes,
                   "carrier" => "senden"
                   )
                  ), //shipping_lines
                
            'charges' => array(
              array(
                 'payment_method' => array(
                 "payment_source_id" => $payment_source_conekta->id ,
                  'type'     => 'card'			
                 //"type" => "default"
                  )
                 )
                    )
                 )); 
     
     
    // echo $order;
     
     /* DB::table('orders')->insert([
      	"conekta_order_id" => $order->id
      ])->where('id', $req->input("orderId")); */   
     
    /*  DB::table('pedido_conekta')->insert([
        "conekta_order_id" => $order->id,
        "business_id" => 
      ]) 
        
     
        $pedido->conekta_order_id = $order->id;
            $pedido->empresa_id = $request->empresa_id;
            $pedido->customer_id_conekta = $customer_id_conekta;
            $pedido->save(); */
     
     
     
     
     
    
     
     
     }catch(\Conekta\ErrorList $errorList){
         $msg_errors = '';
        
          foreach ($errorList->details as &$errorDetail) {
                   $msg_errors .= $errorDetail->getMessage();
            }
                    //echo $errorDetail->getMessage();
	 return ['msg' => 'Datos del cliente incorrectos: '.$msg_errors];
     }
     
      $code = rand(100, 1000);
         
         	
         
         DB::table("tkey")->where("order_id", $req->input("orderId"))
         ->update(["akey_user" => $code]);
         
         DB::table("orders")->where("id", $req->input("orderId"))
         ->update(["status_id" => 3]);
         
         DB::table('orders')->where('id', $req->input("orderId"))
         ->update(["conekta_order_id" => $order->id]);  
         
            return response()->json($code);
    
   }        
    

  
   
  

    public function saveTokenDevice(Request $request)
    {
        $tokens = DB::table('token_user')
        ->where('token', '=', $request->input('token'))
        ->get();  

        if (count($tokens) > 0) { //Si el token device ya existe no se actualiza
            return 0; 
        } 

        /*DB::table("tkey")->where("user_id", $req->input("user_id"))
        ->update(["token" => $request->input('token')]);*/

        $row_id = DB::table('token_user')->insertGetId(  
            ['token' => $request->input('token'),  
             'user_id' => $request->input('user_id'),
             'platform' => $request->input('platform'),
             'created_at' => date("Y-m-d H:i:s")
            ]
        );
        return $row_id;
    }

    private function saveNotification($user_id, $platform, $message)
    {
        $row_id = DB::table('notifications')->insertGetId(
            ['user_id' => $user_id,
             'platform' => $platform,
             'message' => $message,
             'created_at' => date("Y-m-d H:i:s")
            ]
        );
        return $row_id;
    }

    public function getUserNotifications(Request $request)
    {
        $notifications = DB::table('notifications')
        ->where('user_id', '=', $request->input('user_id'))
        ->orderBy('id', 'desc')
        ->get();

        return $notifications;
    }

    /** 
     * Envía notificaciones a los sendenboy para que sepan que hay una nueva orden. 
     * 
     * @return json_encode($output)
     */
    private function sendNotificationNewOrder()
    {
        $array_tokens = array();
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI1NGY1ZWNhZi0zM2RkLTQwNDMtOGJiYy00ODcxNGU4YTc1N2IifQ.7Z-jomTuRA9YH4Su4MbWx_sWXHHa62hg1sRdh3z1kPg";
        $rows = DB::table('token_user')->get();
        foreach ($rows as $row) { array_push($array_tokens, $row->token); }

        $data = array('tokens' => $array_tokens, 'profile' => "prod", 'notification' => array('message' => '¡Hay un nuevo pedido esperando!', 'title' => 'Pedido cerca', 'ios' => array ('sound' => 'default')));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.ionic.io/push/notifications');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);

        //return json_encode($output);
    }

    /** 
     * Envía notificaciones a los sendenshop para que sepan que su pedido ha sido recogido y va en camino. 
     * 
     */
    private function sendNotificationStartOrder($orderId)
    {
        $api_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJhMzZmMGU5ZS1jMTgzLTRkOTgtYjBjZi0zM2ZlOTM2YWUzMDUifQ.olFcPZkZZsk1YxyMdAAWGpszUsALUpA0uadgXxTJD50";
        $array_tokens = array();
        $usuario = DB::table('order_has_user')
        ->select(DB::raw('order_has_user.*'))
        ->leftJoin('orders', 'order_has_user.order_id', '=', 'orders.id')
        ->where('orders.id', $orderId)
        ->first();

        $tokens_usuario = DB::table('token_user')->where('user_id', $usuario->user_id)->get();
        foreach ($tokens_usuario as $token) { array_push($array_tokens, $token->token); }

        $data = array('tokens' => $array_tokens, 'profile' => "prod", 'notification' => array('message' => '¡Tu pedido ha sido recogido y ya está en camino!', 'title' => 'Pedido tomado', 'ios' => array ('sound' => 'default', 'badge' => 1)));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.ionic.io/push/notifications');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $api_token",
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);

        foreach ($tokens_usuario as $row) { //Guarda las notificaciones de los usuarios
            $this->saveNotification($row->user_id, $row->platform, '¡Tu pedido ha sido recogido y ya está en camino!');
        }
        //return json_encode($output);
    }

    /** 
     * Envía notificaciones a los sendenshop para que sepan que su pedido se encuentra cerca de ellos. 
     * 
     */
    public function sendNotificationOrderArriving(Request $request)
    {
        $api_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJhMzZmMGU5ZS1jMTgzLTRkOTgtYjBjZi0zM2ZlOTM2YWUzMDUifQ.olFcPZkZZsk1YxyMdAAWGpszUsALUpA0uadgXxTJD50";
        $array_tokens = array();
        $usuario = DB::table('order_has_user')
        ->select(DB::raw('order_has_user.*'))
        ->leftJoin('orders', 'order_has_user.order_id', '=', 'orders.id')
        ->where('orders.id', $request->input('orderId'))
        ->first();
        if (!$usuario) {//Si no existe la orden, o el usuario entonces no regresa nada
            return 0;
        }

        $tokens_usuario = DB::table('token_user')->where('user_id', $usuario->user_id)->get();
        foreach ($tokens_usuario as $token) { array_push($array_tokens, $token->token); }

        $data = array('tokens' => $array_tokens, 'profile' => "prod", 'notification' => array('message' => '¡Tu pedido ya está cerca de ti!', 'title' => 'Pedido llegando', 'ios' => array ('sound' => 'default', 'badge' => 1)));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.ionic.io/push/notifications');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $api_token",
            "Content-Type: application/json"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $output = curl_exec($ch);

        foreach ($tokens_usuario as $row) { //Guarda las notificaciones de los usuarios
            $this->saveNotification($row->user_id, $row->platform, '¡Tu pedido ya está cerca de ti!');
        }
        return 1;
    }

     
     
} // end of controller