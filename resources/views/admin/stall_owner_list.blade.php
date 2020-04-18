@extends('layouts.app')

@section('content')
    <div class="stallowners row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 m-auto">
                    <div class="row d-print-none">
                        <div class="col-12">
                            <h2>Manage <b>Stall Owners</b></h2>
                        </div>
                        <form action="/admin/stall_owner_list" class="col-12" method="POST">
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
                                <a href="" @click.prevent="printme" target="_blank" class="btn btn-secondary">Print</a>
                            </div>
                        </div>
                        </form>
                    </div>
                
                <table class="table table-striped table-md" style="font-size:small">
                    @if(count($data)=="0")
                        <div class="col-12 col-md-10 m-auto">
                            <h1 style="text-align:center" class="display-3 text-muted">No stall owner matched</h1>
                            <h1 style="text-align:center"><a href="/admin/stall_owner_list" class="btn btn-lg btn-outline-primary">go back</a></h1>
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
                        <tr>
                            <td>{{$stallowner->stall_number}}</td>
                            <td>{{$stallowner->name}}</td>
                            <td>{{$stallowner->class}}</td>
                            <td>{{$stallowner->area}} sqm</td>
                            <td>{{$stallowner->contract_date}}</td>
                            <td>{{$stallowner->expiration_date}}</td>
                            <td class="d-print-none">
                                <a href="/admin/stall_owner/{{$stallowner->id}}" style="color:black" class="pr-2 btn btn-primary btn-sm">View</a>
                                <a href="/admin/update_stall_owner/{{$stallowner->id}}" style="color:black" class="btn btn-secondary btn-sm">Edit</a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteConfirm{{$stallowner->id}}">
                                    Delete
                                </a>
                                  <!-- Modal HTML -->
                                  <div class="modal fade" id="deleteConfirm{{$stallowner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content" style="border:1px solid red">
                                        <div class="modal-header" style="background-color:red">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure?
                                            Do you really want to delete these records? This process cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                                <form action="/admin/delete/{{$stallowner->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Confirm delete</button>
                                                </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
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
  