<?php

namespace App\Http\Controllers;

use App\BusinessServiceDate;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;

class BusinessDatesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessDates = BusinessServiceDate::all();
        return view('admin.businessDates.index', ['businessDates' => $businessDates]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'FechaDeServicio' => 'required|numeric',
            'IniciarServicio' => 'required',
            'TerminarServicio' => 'required',
            'IniciarDescanso' => 'nullable',
            'TerminarDescanso' => 'nullable',
        ]);
        $businessDate = new BusinessServiceDate();

        $businessDate->business_id = auth()->user()->business_id;
        $businessDate->service_date_id = $request->FechaDeServicio;
        $businessDate->start_service = $request->IniciarServicio;
        $businessDate->end_service = $request->TerminarServicio;
        $businessDate->start_break = $request->IniciarDescanso;
        $businessDate->end_break = $request->TerminarDescanso;

        $businessDate->save();
        return $businessDate;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessServiceDate $businessDate)
    {
        $this->validate($request, [
            'FechaDeServicio' => 'required|numeric',
            'IniciarServicio' => 'required',
            'TerminarServicio' => 'required',
            'IniciarDescanso' => 'nullable',
            'TerminarDescanso' => 'nullable',
        ]);

        $businessDate->service_date_id = $request->FechaDeServicio;
        $businessDate->start_service = $request->IniciarServicio;
        $businessDate->end_service = $request->TerminarServicio;
        $businessDate->start_break = $request->IniciarDescanso;
        $businessDate->end_break = $request->TerminarDescanso;

        $businessDate->save();
        return $businessDate;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessServiceDate $businessDate)
    {
        $businessDate->delete();

        return $businessDate;
    }


    /**
     * Destroy multiple businessDates.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('business_service_dates')
        ->whereIn('id', $req->ids)
        ->delete();
    }
}
