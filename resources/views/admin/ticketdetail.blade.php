@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
        <div class="pb-2 justify-content-end d-print-none" style="display:flex;flex-wrap:wrap;">
            <a href="" @click.prevent="printme" target="_blank" class="btn btn-secondary">Print</a>
        </div>
        <div class="card mb-2" 
        style="letter-spacing:2px;
        border:2px solid #808080;
        border-radius:20px;
        background-image:url('/images/resources_images/logo_real.png');
        background-repeat:no-repeat;
        background-size:200px;
        background-position:center;
        background-color:whitesmoke;">
                <div class="card-header" style="opacity:none">
                    <h5 class="text-muted">Parking Details</h5>
                </div>
                <div class="card-body">
                        <h5>
                            Ticket Count:<b>1-{{$parking->ticket_count}}</b>
                        </h5>
                        <h5>
                            Date:<b>{{$parking->ddate}}</b>
                        </h5>
                        <h5>
                            Time In:<b>{{$parking->ttime}}</b>
                        </h5>
                        <h5>
                            Time Out:<b>{{($parking->updated_at)->format('h:i')}} </b>
                        </h5>
                        <h5>
                            Ticket Printed:<b>{{$parking->ticket_count}}</b>
                        </h5>
                        <h5>
                            Ticket Sold:<b>{{$parking->ticket_sold/10}} </b>
                        </h5>
                        <h5>
                            Remaining Ticket:<b>{{$parking->ticket_count-($parking->ticket_sold/10)}} </b>
                        </h5>
                        <h5>
                            Total Cash:<b>{{$parking->ticket_sold}} </b>
                        </h5>
                        <h5>
                            Admin Name:<b>{{$parking->admin_name}}</b>
                        </h5>
                </div>
            </div>
        
    </div>
    @endsection
</div>
    