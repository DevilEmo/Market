@extends('layouts.app')

@section('content')
    <div class="stallowners row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto pb-4">
                <div class="row">
                        <div class="col-12">
                            <h2>Manage <b>Ticketing</b></h2>
                        </div>
                        <form action="/admin/parking_records" class="col-12" method="POST">
                            @csrf
                            @method('GET')
                        <div class="row">
                            <div class="form-group col-6">
                                <input type="text" name="ddate" class="form-control" placeholder="Search date">
                            </div>
                            <div class="form-group">
                                <input type='submit' value="Search" class="btn btn-outline-primary">
                            </div>
                        </form>
                            <div class="form-group ml-auto pr-3">
                                <a href="#addparking" class="btn btn-primary" data-toggle="modal">Add</a>

                                <div id="addparking" class="modal fade">
                                        <div class="modal-dialog" style="opacity:1;">
                                            <div class="modal-content">
                                                <form action="/admin/parking_records/add"  onsubmit="return checkForm(this);" method="POST">
                                                    @method('post')
                                                    @csrf
                                                    <div class="modal-header">						
                                                        <h4 class="modal-title">Add Ticket</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">					
                                                        <div class="form-group">
                                                            <h5>Ticket Number: 1- <span id="firstcount"></span></h5>
                                                            <h5>Date: {{date('M d, Y')}}</h5>
                                                            <h5>Time: {{date('h:i')}}</h5>
                                                            <h5>Admin Name: {{Auth::user()->name}}</h5>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Print</label>
                                                            <input type="hidden" name="prevcount" value="@if(count($parking)=== 0) 0 @else {{$prev->ticket_number}} @endif">
                                                            <input type="hidden" name="ddate" value="{{date('Y-m-d')}}">
                                                            <input type="hidden" name="ttime" value="{{date('h:i')}}">
                                                            <input type="hidden" name="cash" id="cash">
                                                            <input type="hidden" name="admin_name" value="{{Auth::user()->email}}">
                                                            <input type="number" onkeyup="firstcount(this.value)" name="ticket_count" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                        <input type="submit" name="myButton" class="btn btn-success" value="Add">
                                                    </div>
        
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
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
                            {{-- <th>Time in</th>
                            <th>Time out</th> --}}
                            <th>Ticket printed</th>
                            {{-- <th>Ticket Price</th> --}}
                            <th>Admin Name</th>
                            {{-- <th>No. Ticket Sold</th> --}}
                            {{-- <th>Sold Ticket</th> --}}
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parking as $park)
                        <tr>
                            {{-- <td>{{$park->ticket_number1+1}}-{{$park->ticket_number}}</td> --}}
                            <td>1-{{$park->ticket_count}}</td>
                            <td>{{$park->ddate}}</td>
                            {{-- <td>{{$park->ttime}}</td>
                            <td>{{($park->updated_at)->format('h:i')}}</td> --}}
                            <td>{{$park->ticket_count}}</td>
                            {{-- <td>Php {{$park->cash}}</td> --}}
                            <td>{{$park->admin_name}}</td>
                            {{-- <td>{{$park->ticket_sold/50}}</td> --}}
                            {{-- <td>Php {{$park->ticket_sold}}</td> --}}
                            
                            <td class="d-flex">
                                <a class="btn btn-primary btn-sm mr-1" href="/admin/parking_records/printdetail/{{$park->id}}">Detail</a>
                                <a class="btn btn-secondary btn-sm" href="/admin/parking_records/{{$park->id}}/view">view</a>
                            </td>
                            
                        </tr>
                        @endforeach
                        <tr>{{$parking->links()}}</tr>
                    </tbody>
                    @endif
                </table>
            </div>
@endsection

</div>
<script type="text/javascript">
    function firstcount(value){
        document.getElementById("firstcount").innerHTML = value;
    }
</script>
  
