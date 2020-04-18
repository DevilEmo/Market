@extends('layouts.app')

@section('content')
    <div class="d-print-none row pb-3" style="display:flex;justify-content:flex-end">
        <a href="" @click.prevent="printme" target="_blank" class="btn btn-secondary">Print</a>
    </div>
    <div class="d-print-inline-flex row">
        @for ($i = 0; $i < $parking->ticket_count; $i++)
            <div class="card col-3" style="border:1px solid black;border-style: dashed;">
                <div class="card-body" style="display:flex;flex-direction:column">
                    <p><b>Ticket no.{{$i+1}}</b></p>
                    <img class="m-auto p-2 mb-2" src="/images/resources_images/logo_real.png" alt="logo" width="150" height="150">
                    <h5 class="pt-2">Date: {{$parking->ddate}}</h5>
                    <h5>Price: Php 10.00</h5>
                </div>
            </div>
        @endfor
@endsection
</div>
