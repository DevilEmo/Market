@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
      <div class="card mb-4" style="padding:50px">
        <div class="card-body">
          <form action="/admin/stall_owner"  onsubmit="return checkForm(this);" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div style="text-align:center;margin-bottom:20px; padding:8px;border-color:#808080;"><h3 style="font-weight:bolder" class="text-muted"><b>Stall Owner Info</b></h3></div>
            <div class="form-group">
              <label for="name" class="label">Name:</label>
              <input type="text" class="form-control" name="name" placeholder="San Luis" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" placeholder="sanluis123@gmail.com">
            </div>
            <div class="form-group">
              <label for="birthday">Birthday:</label>
              <input type="date" class="form-control" name="birthday" required>
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" name="address" placeholder="San Luis Batangas" required>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" name="profile_image" class="form-control">
            </div>


            <div style="text-align:center;margin:20px; padding:8px;border-color:#808080;">
              <h3 style="font-weight:bolder" class="text-muted">
              <b>Contract Info</b>
              </h3>
            </div>
            <div class="form-group">
                <label for="profile_image">Stall Number:</label>
                <input type="number" name="stall_number" placeholder="0" class="form-control">
            </div>  
          <div class="form-group">
              <label for="class">Class:</label>
              <select name="class" class="form-control">
                  <option>Select</option>
                  <option value="A">Class A</option>
                  <option value="B">Class B</option>
                  <option value="C">Class C</option>
                  <option value="D">Class D</option>
                  <option value="meatshop">Meat Shop</option>
                  <option value="fishshop">Fish Shop</option>
              </select>
          </div>  
          <div class="form-group">
              <label for="class">Area:</label>
              <input type="text" name="area" class="form-control" placeholder="sqm">
          </div>
          <div class="form-group">
            <label for="class">Contract Date:</label>
            <input type="date" name="contract_date" class="form-control">
          </div>
          <div class="form-group" style="display:flex;justify-content:flex-end">
            <input type="submit" name="myButton" class="btn btn-primary" value="Save">
          </div>
        </form>
        </div>
      </div>
    </div>
  @endsection

</div>