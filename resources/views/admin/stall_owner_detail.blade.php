@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
            <div class="pb-2 justify-content-end d-print-none" style="display:flex;flex-wrap:wrap;">
                <a href="" @click.prevent="printme" target="_blank" class="btn btn-secondary">Print</a>
                @if ((count($payments)<1) && (auth()->user()->account_type === 'admin'))
                    <a href="/admin/payment/{{$stallowner->id}}" class="btn btn-outline-success ml-2">Add Payment</a>
                @elseif((auth()->user()->account_type === 'cashier') && (count($payments)>=1) && (count($payments)!=61))
                    <a href="/cashier/payment/{{$stallowner->id}}" class="btn btn-outline-success ml-2">Add Payment</a>
                @endif
            </div>
        <div class="card mb-2" 
        style="letter-spacing:2px;
        border:2px solid #808080;
        border-radius:20px;
        background-image:url('../../images/resources_images/logo_real.png');
        background-repeat:no-repeat;
        background-size:250px;
        background-position:center;background-color:whitesmoke;">
            <div class="card-body text-dark">
                <div class="row" style="justify-content:space-between;padding:20px;">
                    <div>
                        <p class="card-text">
                        Name: <b>{{$stallowner->name}}</b><br>
                        Email: <b>{{$stallowner->email}}</b><br>
                        Address: <b>{{$stallowner->address}}</b><br>
                        Birthday: <b>{{$stallowner->birthday}}</b><br>
                        Stall Number: <b>{{$stallowner->stall_number}}</b><br>
                        Area: <b>{{$stallowner->area}} sqm</b><br>
                        Class: <b>{{$stallowner->class}}</b><br>
                        Date of Contract: <b>{{$stallowner->contract_date}}</b><br>
                        Expiration Date: <b>{{$stallowner->expiration_date}}</b><br>
                        </p>
                    </div>
                    <div>
                        <img src="/images/profile_images/{{$stallowner->profile_image}}" alt="{{$stallowner->profile_image}}" 
                        width="200px" height="200px" style="border-radius:10px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
        @if (count($payments)>0)
        <table class="table table-bordered table-sm" style="font-size:small">
        <thead class="thead-light">
            <tr>
                <th>Payment No</th>
                <th>Paid until</th>
                <th>Paid at</th>
                <th scope="col">Good Will Money</th>
                <th scope="col">Rental Fee</th>
                <th scope="col">Garbage Fee</th>
                <th scope="col">Penalty</th>
                @if (Auth::user()->account_type === 'cashier')
                <th class="d-print-none" scope="col">Update Receipt No.</th>
                @endif
                <th scope="col">Official Receipt No.</th>
                <th scope="col">Cashier</th>
                <th scope="col">Total Per month</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{$payment->payment_number}}</td>
                <td>{{($payment->duedate)}}</td>
                <td>@if($payment->created_at != null){{($payment->created_at)->format('Y-m-d')}}@endif</td>
                <td>@if ($payment->payment_number <= 12)Php {{$payment->good_will_money}}@endif</td>
                {{-- <td>{{$payment->good_will_money}}</td> --}}
                <td>Php {{$payment->rental_fee}}</td>
                <td>Php 50.00</td>
                <td>@if($payment->penalty > 0)Php {{$payment->penalty}}@endif</td>
                @if (Auth::user()->account_type === 'cashier')
                <td class="d-print-none">
                    <form action="/payment/{{$payment->id}}" method="POST" class="d-flex">
                        @method('put')
                        @csrf
                        <input type="text" name="official_receipt_no" class="form-control-sm">
                        <input type="submit" value="save" class="btn btn-sm btn-success">
                    </form>
                </td>    
                @endif
                
                <td>{{$payment->official_receipt_no}}</td>
                <td>{{$payment->cashier_name}}</td>
                <td>Php {{$payment->total_amount}}</td>
            </tr>
            @endforeach
        </tbody>
        @else 
            <tbody>
                <h1>No Payment</h1>
            </tbody>
        </table>
        @endif
    </div>
@endsection

</div>
