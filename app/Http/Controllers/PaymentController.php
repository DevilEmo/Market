<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\payment;
use App\stallowner;
use Carbon\Carbon;

class PaymentController extends Controller
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
        $payment = new payment;
        $payment->payment_number = $request->input('payment_number');
        $payment->good_will_money = $request->input('good_will_money');
        $payment->rental_fee = $request->input('rental_fee');
        $payment->garbage_fee = $request->input('garbage_fee');
        $payment->penalty = $request->input('penalty');
        $payment->total_amount = $request->input('total_amount');
        $payment->duedate = $request->input('duedate');
        $payment->stallowner_id = $request->input('stallowner_id');
        $payment->cashier_name = $request->input('cashier_name');

        $duplicate = payment::where('payment_number',$payment->payment_number)
                        ->where('good_will_money',$payment->good_will_money)
                        ->where('rental_fee',$payment->rental_fee)
                        ->where('garbage_fee',$payment->garbage_fee)
                        ->where('total_amount',$payment->total_amount)
                        ->where('stallowner_id',$payment->total_amount)
                        ->first();
        if ($duplicate) {
            if (auth()->user()->account_type !== 'admin') {
                return redirect('/cashier/rent_payment')->with('error', 'Stall owner already paid');
            }elseif(auth()->user()->account_type === 'admin'){
                return redirect('/admin/stall_owner_list')->with('error','Stall owner already paid');
            }
        }else{
            if (auth()->user()->account_type !== 'admin') {
                $payment->save();
                return redirect('/cashier/rent_payment')->with('success', 'Stall owner paid');
            }elseif(auth()->user()->account_type === 'admin'){
                $payment->save();
                return redirect('/admin/stall_owner_list')->with('success','Stall owner paid');
            }
        }
        

        

        
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
            'official_receipt_no' => 'required',
        ]);
        
        $payment = payment::find($id);
        $payment->official_receipt_no = $request->input('official_receipt_no');
        
        $payment->save();
        return redirect('/admin/stall_owner/'.$payment->stallowner_id)->with('success','Stall official receipt updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $payment = payment::findOrfail(id);
        // if($payment->stallowner_id != 0){
        //     unlink(public_path().$payment->)
        // }
    }
}
