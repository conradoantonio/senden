<?php

namespace App\Http\Controllers;

use App\BusinessHoliday;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DB;

class BusinessHolidaysController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = BusinessHoliday::all();
        return view('admin.holidays.index', ['holidays' => $holidays]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date',
        ]);
        $holiday = new BusinessHoliday();

        $holiday->business_id = auth()->user()->business_id;
        $holiday->start_date = $request->FechaInicio;
        $holiday->end_date = $request->FechaFin;

        $holiday->save();

        return $holiday;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessHoliday $holiday)
    {
        $this->validate($request, [
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date',
        ]);

        $holiday->start_date = $request->FechaInicio;
        $holiday->end_date = $request->FechaFin;

        $holiday->save();
        return $holiday;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessHoliday $holiday)
    {
        $holiday->delete();

        return $holiday;
    }


    /**
     * Destroy multiple holidays.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSelections(Request $req)
    {
        return DB::table('business_holidays')
        ->whereIn('id', $req->ids)
        ->delete();
    }
}
