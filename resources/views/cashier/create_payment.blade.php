@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto pb-5">
        <form action="/payment" onsubmit="return checkForm(this);" class="pb-2 justify-content-end no-print" style="display:flex">
          @method('post')
          @csrf
          <input type="hidden" name="payment_number" value="{{$prev->payment_number+1}}">
          @if ($prev->payment_number <= 11)
            <input type="hidden" name="good_will_money" value="{{$goodwill}}">
          @endif
          <input type="hidden" name="rental_fee" value="{{$rentalfee}}">
          <input type="hidden" name="garbage_fee" value="50">
          <input type="hidden" name="total_amount" id="total_value" value="{{$total_amount}}">
          <input type="hidden" name="duedate" value="{{$duedate}}">
          <input type="hidden" name="stallowner_id" value="{{$stallowner->id}}">
          <input type="hidden" name="penalty" id="penalty_value">
          <input type="hidden" name="cashier_name" value="{{Auth::user()->email}}">
          <input type="submit" value="Pay" name="myButton" class="btn btn-outline-success mr-2">
          <a href="" @click.prevent="printme" target="_blank" class="btn btn-secondary">Print</a>
        </form>
      <div class="card">
        <div class="card-body">
            <div style="border:2px solid black;border-style:dashed;text-align:center;margin-bottom:20px; padding:8px;border-color:#808080;">
                <h5 style="font-weight:bolder" class="text-muted">
                    <i>San Luis Market Rental Payment</i>
                </h5>
            </div>
            <div class="info pb-3" style="display:flex;justify-content:space-between">
                <div class="stallownerinfo">
                    <h5><span class="text-secondary">Stall Owner: </span>{{$stallowner->name}}</h5>
                    <h5><span class="text-secondary">Stall Number: </span>{{$stallowner->stall_number}}</h5>
                    <h5><span class="text-secondary">Class: </span>{{$stallowner->class}}</h5>
                    <h5><span class="text-secondary">Area: </span>{{$stallowner->area}}</h5>
                </div>
                <div class="paymentinfo">
                    <h5><span class="text-secondary">Date: </span>{{date('M d Y')}}</h5>
                    <h5><span class="text-secondary">Payment Number: </span>{{$prev->payment_number+1}}/60</h5>
                    <h5 style="display:flex;">
                      <span class="text-secondary mr-2">Penalty: </span>
                      <input onchange="penalty(this.value)" style="width:5vw;font-weight:bold;" type="number" name="penalty" id="penalty" value="0" class="form-control form-control-sm"></h5>
                    </h5>
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
                      <td>Penalty</td>
                      <td><span id="penalty_fee"></span></td>
                    </tr>
                  <tr>
                    <td>Total Amount</td>
                    <td>Php <span id="total_amount">{{$total_amount}}</span></td>
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
@endsection
</div>
  
<script type="text/javascript">
 
  function penalty(value){
    let total_amount = {total_amount :"{{$total_amount}}"};
    let rentalfee = {rentalfee :"{{$rentalfee}}"};
    
    penalty_fee = parseFloat((rentalfee.rentalfee*.10)*value);
    total = parseFloat(total_amount.total_amount) + parseFloat(penalty_fee);
    document.getElementById('total_amount').innerHTML = total;
    document.getElementById('penalty_fee').innerHTML = "Php "+penalty_fee;
    
    document.getElementById('total_value').value = total;
    document.getElementById('penalty_value').value = penalty_fee;
    }
</script>
