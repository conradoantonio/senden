<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;

class FaqsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Faqs';
        $menu = 'Configuraciones';
        $faqs = Faq::all();
        return view('admin.faqs.index', ['menu' => $menu, 'title' => $title, 'faqs' => $faqs]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pregunta' => 'required|min:3',
            'respuesta' => 'required|min:3',
            'imagen' => 'image',
        ]);
        $faq = new Faq();
        $faq->question = $request->pregunta;
        $faq->answer = $request->respuesta;
        $img = $request->file('imagen');
        $name = time().'.'.$img->getClientOriginalExtension();
        $img->move('faqs', $name);
        $faq->image = 'faqs/'.$name;
        $faq->save();
        return $faq;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $this->validate($request, [
            'pregunta' => 'required|min:3',
            'respuesta' => 'required|min:3',
        ]);
        $extensions = ['jpeg', 'jpg', 'png', 'gif'];
        $file = $request->file('imagen');

        if ( $file && $file instanceof UploadedFile) {
            if (!array_search($file->getClientOriginalExtension(), $extensions)) {
                return 'error';
            }
        }

        $faq->question = $request->pregunta;
        $faq->answer = $request->respuesta;
        if ($request->file('imagen')) {
            $img = $request->file('imagen');
            $name = time().'.'.$img->getClientOriginalExtension();
            $img->move('faqs', $name);
            $path = 'faqs/'.$name;
            $faq->image = $path;
        }

        $faq->image = isset($path) ? $path : $request->imagen;

        $faq->save();
        return $faq;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return $faq;
    }


    /**
     * Destroy multiple faqs.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('faqs')
        ->whereIn('id', $req->ids)
        ->delete();
    }
}
