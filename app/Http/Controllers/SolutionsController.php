<?php

namespace App\Http\Controllers;

use App\Solution;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;

class SolutionsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solutions = Solution::all();
        return view('admin.solutions.index', ['solutions' => $solutions]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|min:3',
        ]);
        $solution = new Solution();
        $solution->name = $request->nombre;
        $solution->save();
        return $solution;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solution $solution)
    {
        $this->validate($request, [
            'nombre' => 'required|min:3',
        ]);

        $solution->name = $request->nombre;

        $solution->save();
        return $solution;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution)
    {
        $solution->delete();

        return $solution;
    }


    /**
     * Destroy multiple solutions.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('solutions')
        ->whereIn('id', $req->ids)
        ->delete();
    }
}
