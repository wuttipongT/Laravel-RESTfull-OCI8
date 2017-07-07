<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QSTORD;
use DB;
class QI1041Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      // $QSTORD = new QSTORD;
      $data = QSTORD::where('QST10_ORDNO', $id)->get(array(
        'QST10_JOBORDER',
        'QST10_ORDNO',
        'QST10_LOTQTY',
        'QST10_BOMVER',
        'QST10_FSDATE',
        'QST10_MODEL'
      ))->toArray();

      return isset($data[0]) ? $data[0] : [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listData($id){

      return DB::table("QSTORD")
      // ->select("QST11_PARTCD", "QST11_REQQTY", "QST22_PARTNM")
      ->leftjoin("QSTORDDET", function ($join) {
          $join->on("QST10_ORDNO", "=", "QST11_ORDNO");
      })
      ->leftjoin("QSTBOMPC", function ($join) {
          $join->on("QST11_PARTCD", "=", "QST22_PARTCD");
      })
      ->where("QST10_ORDNO", $id)
      // ->groupBy(array('QST11_PARTCD','QST11_REQQTY','QST22_PARTNM'))
      ->distinct()
      ->get(['QST11_PARTCD','QST11_REQQTY','QST22_PARTNM', DB::raw("'light' COLOR")])
      ->toArray();

    }

    public function hasPart($order, $part){

      return DB::table("QSTORD")
      // ->select("QST11_PARTCD", "QST11_REQQTY", "QST22_PARTNM")
      ->leftjoin("QSTORDDET", function ($join) {
          $join->on("QST10_ORDNO", "=", "QST11_ORDNO");
      })
      ->leftjoin("QSTBOMPC", function ($join) {
          $join->on("QST11_PARTCD", "=", "QST22_PARTCD");
      })
      ->where("QST10_ORDNO", $order)
      ->where("QST11_PARTCD", $part)
      // ->groupBy(array('QST11_PARTCD','QST11_REQQTY','QST22_PARTNM'))
      ->get(['QST11_PARTCD','QST11_REQQTY','QST22_PARTNM', DB::raw("'light' COLOR")])
      ->toArray();

    }

}
