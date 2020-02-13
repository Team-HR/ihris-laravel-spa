@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">s
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary font-weight-bolder"><i class="fas fa-users"></i> EMPLOYEES</div>   

                <div class="card-body bg-light">
                    
                    @if (session('error'))
                        <div class="alert alwwert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
            <button type="button" class="btn btn-primary" id="add-new-employee"><i class="fas fa-user-plus"></i> Add Employee</button>

{{-- <button type="button" class="btn btn-primary float-right" id="view-report"><i class="fas fa-chart-pie"></i> View Report</button> --}}

            <br>
            <br>

        <div class="panel panel-default">
            <div class="panel-heading">
                {{-- Employees --}}
            </div>
            
            <div class="panel-body">
              {{-- <p>Count: {{count($employees)}}</p> --}}

<form id="form-search" class="form-inline mb-2" novalidate>
  {{-- <div class="form-group"> --}}
    <div class="input-group mb-2" style="width: 500px;">
      <div class="input-group-prepend">
        <button class="btn btn-primary" style="width: 125px;" type="submit" id="button-addon2"><i class="fas fa-search"></i> Search</button>
      </div>
      <input type="text" class="form-control" placeholder="Search employee" aria-label="Employee's name" aria-describedby="button-addon2" id="table-search">
    </div>

    {{-- <button class="btn btn-green">Filter</button> --}}

  {{-- </div> --}}
</form>
                <table id="page-table" class="table bg-light table-striped task-table table-sm table-bordered p-sm-0 m-sm-0">

                    <!-- Table Headings -->
                    <thead class="text-primary">
                        <tr>
                            <th rowspan="0" width="100" class="text-center align-middle">Options</th>
                            <th rowspan="0" width="60" class="text-center align-middle">ID</th>
                            {{-- <th width="60" class="text-center">Status</th> --}}
                            <th rowspan="0" class="">Name</th>
                            {{-- <th class="text-center" width="50">Gender</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Assignment</th> --}}
                            <th rowspan="0" class="text-center" width="40"></th>
                        </tr>
                    </thead> 
                    <tbody id="table-body">
@if(count($employees)>0)
  @foreach($employees as $employee) 
    <tr>
      <td class="text-center"><a href="{{url('/employee/'.$employee['id'])}}"><i class="fas fa-folder"></i></a></td>
      <td>{{$employee['id']}}</td>
      {{-- <td></td> --}}
      <td>{{$employee['full_name']}}</td>
      <td></td>
    </tr>
  @endforeach
@else
  <tr>
    <td colspan="9" class="text-center">No employees found!</td>
  </tr>
@endif

                    </tbody>
                </table>
            </div>
        </div>

                </div>
            </div>
        </div>
    </div>
</div>

 <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header text-white ">
            <h5 class="modal-title" id="userCrudModal">
              {{-- <i class="fas fa-user-plus"></i> Add Employee</h5> --}}
        </div>
        <div class="modal-body">
<!-- form start -->
<form id="employee-form" name="employee-form" class="form-horizontal employee-form" novalidate>
<input type="hidden" name="employee_id" id="employee_id">
<div class="form-row m-0">
    <div class="form-group col-sm-3">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
        <div class="invalid-feedback" id="invalid-feedback-last_name">
        </div>
    </div>
    <div class="form-group col-sm-4">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
        <div class="invalid-feedback" id="invalid-feedback-first_name">
          Please provide the first name.
        </div>
    </div>
    <div class="form-group col-sm-3">
      <label for="middle_name">Middle Name:</label>
      <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter middle name">
    </div>
    <div class="form-group col-sm-2">
      <label for="ext_name">Name ext:</label>
      <input type="text" class="form-control" id="ext_name" name="ext_name" placeholder="e.g. Jr/Sr">
    </div>

</div>
</form>
<!-- form end -->
</div>
        <div class="modal-footer">
            <button type="cancel" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel
            </button>
            <button form="employee-form" type="submit" class="btn btn-primary" id="btn-save"><i class="fas fa-save"></i> Save
            </button>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-delete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header  text-white">
            <h5 class="modal-title" id=""></h5>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this employee?</p>
        </div>
        <div class="modal-footer">
            <button type="cancel" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel
            </button>
            <button type="button" class="btn btn-primary" id="btn-confirm-delete"><i class="fas fa-check"></i> Confirm
            </button>
        </div>
    </div>
  </div>
</div>




@endsection



@section('page-script')

</script>


@endsection
