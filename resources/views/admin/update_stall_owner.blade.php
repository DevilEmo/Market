@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto pb-4">
      <div class="card p-5" style="font-size:smaller">
        <div class="card-body">
          <div style="text-align:center;margin-bottom:20px; padding:8px;border-color:#808080;"><h3 style="font-weight:bolder" class="text-muted"><i>Stall Owner Info Update</i></h3></div>
        
          <form action="/admin/stall_owner/{{$stallowner->id}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div style="display:flex;align-items:center;flex-direction:column;" class="mb-4">
              <img src="/images/profile_images/{{$stallowner->profile_image}}" class="mb-3" height="200px" width="200px"  alt="profile Image"
              style="border-radius:50%;">
              <div class="form-group">
                <input type="file" name="profile_image">
              </div>
            </div>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" value="{{$stallowner->name}}" name="name" placeholder="Cardo Dalisay" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" value="{{$stallowner->email}}" name="email" placeholder="cardodalisay@gmail.com">
            </div>
            <div class="form-group">
              <label for="birthday">Birthday:</label>
              <input type="date" class="form-control" value="{{$stallowner->birthday}}" name="birthday" required>
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" value="{{$stallowner->address}}" name="address" placeholder="Address" required>
            </div>
            <div style="text-align:center;margin:20px; padding:8px;border-color:#808080;">
              <h3 style="font-weight:bolder" class="text-muted">
              <i>Contract Info Update</i>
              </h3>
            </div>
            <div class="form-group">
                <label for="profile_image">Stall Number:</label>
                <input type="number" value="{{$stallowner->stall_number}}" name="stall_number" placeholder="0" class="form-control">
            </div>  
          <div class="form-group">
              <label for="class">Class:</label>
              <select name="class" class="form-control">
                  <option value="{{$stallowner->class}}">{{$stallowner->class}}</option>
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
              <input type="text" value="{{$stallowner->area}}" name="area" class="form-control" placeholder="sqm">
          </div>
          <div class="form-group" style="display:flex;justify-content:flex-end">
            <input type="submit" class="btn btn-primary" value="Save">
          </div>
        </form>
        </div>
      </div>
    </div>
    
@endsection
</div>