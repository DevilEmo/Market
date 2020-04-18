@extends('layouts.app')

@section('content')
    {{-- <stallowner-component></stallowner-component> --}}
    <div class="stallowners row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto pb-4">
            <div class="row ">
                <div class="col-12">
                    <h2>Manage <b>Ticket</b></h2>
                </div>
                <form action="/cashier/stall_owner_list" class="col-12" method="POST">
                    @csrf
                    @method('GET')
                <div class="row">
                    <div class="form-group col-6">
                        <input type="text" name="name" class="form-control" placeholder="Search Name">
                    </div>
                    <div class="form-group">
                        <input type='submit' value="Search" class="btn btn-outline-primary">
                    </div>
                </form>
            </div>
        </div>
                
            <table class="table table-striped" style="font-size:small">
                    @if(count($parking)=="0")
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto pb-4">
                            <h1 style="text-align:center" class="display-3 text-muted">No ticket data</h1>
                            <h1 style="text-align:center"><a href="/admin/parking_records" class="btn btn-outline-primary">go back</a></h1>
                        </div>
                    @else
                    <thead class="thead-dark">
                        <tr>
                            <th>Ticket Number</th>
                            <th>Date</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Ticket printed</th>
                            <th class="">Sold Ticket</th>
                            <th>Total Cash Sold</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parking as $park)
                        <tr>
                            {{-- <td>{{$park->ticket_number1+1}}-{{$park->ticket_number}}</td> --}}
                            <td>1-{{$park->ticket_count}}</td>
                            <td>{{$park->ddate}}</td>
                            <td>{{$park->ttime}}</td>
                            <td>{{($park->updated_at)->format('h:i')}}</td>
                            <td>{{$park->ticket_count}}</td>
                            <td class="">
                                <form style="display:flex" action="/cashier/parking_records/{{$park->id}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="number" name="ticket_sold" id="" class="form-control-sm mr-2">
                                    <input type="submit" value="save" class="btn btn-primary btn-sm">
                                </form>
                            </td>
                            <td>Php {{$park->ticket_sold}}</td>
                        </tr>
                        @endforeach
                        <tr>{{$parking->links()}}</tr>
                    </tbody>
                    @endif
                </table>
                
            </div>
@endsection
</div>
  
