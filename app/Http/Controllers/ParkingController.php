<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\parking;
use App\Http\Resources\parking as parkingResources;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $parkings = parking::orderBy('created_at','desc')->get();
        return parkingResources::collection($parkings);
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
        $this->validate($request,[
            'ddate' => 'required',
            'ttime' => 'required',
            'ticket_count' => 'required',
        ]);

        $parking = new parking;
        $prevcount = $request->input('prevcount');
        $prescount = $request->input('ticket_count');
        
        $parking->ticket_number = $prescount+$prevcount;
        $parking->ticket_number1 = $prevcount;
        $parking->ddate = $request->input('ddate');
        $parking->ttime = $request->input('ttime');
        $parking->ticket_count = $request->input('ticket_count');
        $parking->admin_name = $request->input('admin_name');
        $parking->cash = $prescount*50;
        
        $parking->save();
        return redirect('/admin/parking_records')->with('success','Parking records created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //get parkings
       $parking = parking::findOrFail($id);
        //return single parking as a resources
        return new parkingResources($parking);
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
        $this->validate($request,[
            'ticket_sold' => 'required'
        ]);

        $parking = parking::find($id);
        $ticket_sold = $request->input('ticket_sold');
        $parking->ticket_sold = $ticket_sold*10;
        if ($parking->ticket_count < $ticket_sold) {
            return redirect('/cashier/parking_payment')->with('error','sold ticket is higher than ticket printed');
        }else{
            $parking->save();
            return redirect('/cashier/parking_payment')->with('success','ticket sold updated');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
         //get parkings
       $parking = parking::findOrFail($id);
       if($parking->delete()){
       return new parkingResources($parking);
        }
    }
}
