@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card pb-3">
                <div class="card-body">
                    <div class="m-2" style="display:flex;justify-content:center;align-items:center">
                        <img class="p-3" src="../images/resources_images/logo_real.png" width="200" height="200">
                        <div class="user">
                            <h5 class="display-4"><i>Welcome !</i></h5>
                            <h5>{{Auth::user()->name}}!</h5>
                            <small class="text-muted">Your now {{Auth::user()->account_type}} of San Luis Market Management!</small><br><br>
                            @if (Auth::user()->account_type === 'admin')
                                <a href="/admin/create_stall_owner" class="btn btn-primary">Create Stall Owner</a>
                            @else
                                <a href="/cashier/rent_payment" class="btn btn-primary">@if (Auth::user()->account_type === 'admin')
                                    Create Stall Owner
                                @else
                                    List of Stall Owners
                                @endif </a>
                            @endif
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
</div>