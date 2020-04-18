@extends('layouts.app')

@section('content')
    <div class="stallowners row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
                <div class="row d-print-none">
                        <div class="col-12">
                            <h2>Stall <b>Owners</b></h2>
                        </div>
                        <form action="/cashier/rent_payment" class="col-12" method="POST">
                            @csrf
                            @method('GET')
                            <div class="row">
                                <div class="form-group col-6">
                                    <input type="text" name="name" class="form-control" placeholder="Search Name">
                                </div>
                                <div class="form-check-inline form-group">
                                    <input type="checkbox" onchange="paidcheckbox(this)" id="paid" name="paid" value="paid" class="form-check-input">
                                    <label for="paid" class="form-check-label">Paid</label>
                                </div>
                                <div class="form-check-inline form-group">
                                    <input type="checkbox" onchange="unpaidcheckbox(this)"  id="unpaid" name="unpaid" value="unpaid" class="form-check-input">
                                    <label for="unpaid" class="form-check-label">Unpaid</label>
                                </div>
                                <div class="form-group">
                                    <input type='submit' value="Search" class="btn btn-outline-primary">
                                </div>
                                <div class="form-group ml-auto pr-3">
                                    <a href="" @click.prevent="printme" target="_blank" class="btn btn-sm btn-secondary">Print</a>
                                </div>
                            </div>
                        </form>
                    </div>
                
               <table class="table table-striped table-sm" style="font-size:small">
                    @if(count($data)=="0")
                        <div class="col-12 col-md-12 m-auto">
                            <h1 style="text-align:center" class="display-3 text-muted">No stall owner matched</h1>
                            <h1 style="text-align:center"><a href="/cashier/rent_payment" class="btn btn-lg btn-outline-primary">go back</a></h1>
                        </div>
                    @else
                    <thead class="thead-dark">
                        <tr>
                            <th>Stall Number</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Area</th>
                            <th>Date of Contract</th>
                            <th>Expiration Date</th>
                            <th class="d-print-none"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $stallowner)
                        <tr class="{{$stallowner->payment}}">
                            <td>{{$stallowner->stall_number}}</td>
                            <td>{{$stallowner->name}}</td>
                            <td>{{$stallowner->class}}</td>
                            <td>{{$stallowner->area}}</td>
                            <td>{{$stallowner->created_at}}</td>
                            <td>{{$stallowner->expiration_date}}</td>
                            <td class="d-print-none">
                                <a href="/cashier/stall_owner/{{$stallowner->id}}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
                
            </div>
@endsection
</div>

<script type="text/javascript">
    function paidcheckbox(check){
        document.getElementById("unpaid").checked = false;
    }
    function unpaidcheckbox(check){
        document.getElementById("paid").checked = false;
    }
</script>
  