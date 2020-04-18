@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
        <form action="/payment"  onsubmit="return checkForm(this);" class="pb-2 justify-content-end d-print-none" style="display:flex">
          @method('post')
          @csrf
          <input type="hidden" name="payment_number" value="1">
          <input type="hidden" name="good_will_money" value="{{$goodwill}}">
          <input type="hidden" name="rental_fee" value="{{$rentalfee}}">
          <input type="hidden" name="garbage_fee" value="50">
          <input type="hidden" name="total_amount" value="{{$goodwill+$rentalfee+50}}">
          <input type="hidden" name="duedate" value="{{$duedate}}">
          <input type="hidden" name="stallowner_id" value="{{$stallowner->id}}">
          <input type="hidden" name="cashier_name" value="{{Auth::user()->email}}">
          <input type="submit" name="myButton" value="Pay" class="btn btn-outline-success mr-2">
          <a href="" @click.prevent="printme" target="_blank" class="btn btn-secondary">Print</a>
        </form>
      <div class="card" style="padding:50px;">
        <div class="card-body">
            <div style="border:2px solid black;border-style:dashed;text-align:center;margin-bottom:20px; padding:8px;border-color:#808080;">
                <h1 style="font-weight:bolder" class="text-muted">
                    San Luis Market Rental Payment
                </h1>
            </div>
            <div class="info pb-3" style="display:flex;justify-content:space-between">
                <div class="stallownerinfo">
                    <p><span class="text-secondary">Stall Owner: </span>{{$stallowner->name}}<br>
                    <span class="text-secondary">Stall Number: </span>{{$stallowner->stall_number}} <br>
                    <span class="text-secondary">Class: </span>{{$stallowner->class}} <br>
                    <span class="text-secondary">Area: </span>{{$stallowner->area}}</p>
                </div>
                <div class="paymentinfo">
                    <p><span class="text-secondary">Date: </span>{{date('M d Y')}} <br>
                    <span class="text-secondary">Payment Number: </span>1/60</p>
                </div>
            </div>
            <table class="table table-md" style="font-size:small">
              <thead class="thead-light">
                <tr>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>Good Will Money</td>
                    <td>Php {{$goodwill}}</td>
                  </tr>
                  <tr>
                    <td>Rental Fee</td>
                    <td>Php {{$rentalfee}}</td>
                  </tr>
                  <tr>
                    <td>Garbage Fee</td>
                    <td>Php 50.00</td>
                  </tr>
                  <tr>
                    <td>Total Amount</td>
                    <td>Php {{$goodwill+$rentalfee+50}}</td>
                  </tr>
                  <tr>
                    <td><span class="text-secondary">Cashier Name: </span>{{Auth::user()->name}}</td>
                  </tr>
              </tbody>
            </table>            
          </div>
            
           
        </div>
      </div>
    </div>
  </div>
  @endsection
