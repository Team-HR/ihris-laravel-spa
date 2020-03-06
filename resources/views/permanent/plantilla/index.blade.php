@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary font-weight-bolder"><i class="fas fa-book"></i> PERMANENT PLANTILLA</div>   

                <div class="card-body bg-light">
                    
                    @if (session('error'))
                        <div class="alert alwwert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
            <button type="button" class="btn btn-primary" id="add-new-employee"><i class="fas fa-plus"></i> Add New Plantilla</button>

{{-- <button type="button" class="btn btn-primary float-right" id="view-report"><i class="fas fa-chart-pie"></i> View Report</button> --}}

            <br>
            <br>

        <div class="panel panel-default">
            <div class="panel-heading">
                {{-- Employees --}}
            </div>
            
            <div class="panel-body">
              {{-- <p>Count: {{count($employees)}}</p> --}}

{{-- <form id="form-search" class="form-inline mb-2" novalidate>
    <div class="input-group mb-2" style="width: 500px;">
      <div class="input-group-prepend">
        <button class="btn btn-primary" style="width: 125px;" type="submit" id="button-addon2"><i class="fas fa-search"></i> Search</button>
      </div>
      <input type="text" class="form-control" placeholder="Search employee" aria-label="Employee's name" aria-describedby="button-addon2" id="table-search">
    </div>
</form> --}}
	
	<table id="page-table" class="table table-responsive-sm table-sm">

	<style type="text/css">
		.rotates {
			transform: rotate(270deg);
		}

		table tr td, th {
			border: 1px solid lightgrey;
		}

/*		td {
			padding: 2px !important;
			margin: 0px !important;
		}*/
	</style>
    <thead class="text-light bg-primary">
        <tr>
            <th rowspan="2" class="text-center align-middle">Item No.</th>
            <th rowspan="2" class="text-center align-middle">Position Title</th>
            {{-- <th rowspan="2" class="text-center align-middle">Functional Title</th> --}}
            <th rowspan="2" class="text-center align-middle rotate">SG</th>
            <th colspan="3" class="text-center align-middle">NBC 562 (EO 201)</th>
            <th rowspan="2" class="text-center align-middle rotate">Step</th>
            <th colspan="2" class="text-center align-middle">Area</th>
            <th rowspan="2" class="text-center align-middle rotate">Level</th>
            <th colspan="3" class="text-center align-middle">Name of Incumbent</th>
            <th rowspan="2" class="text-center align-middle rotate">Sex</th>
            <th rowspan="2" class="text-center align-middle">Birthdate</th>
            <th rowspan="2" class="text-center align-middle">TIN</th>
            <th rowspan="2" class="text-center align-middle" width="90">Original Appointment</th>
            <th rowspan="2" class="text-center align-middle" width="90">Last Promotion</th>
            <th rowspan="2" class="text-center align-middle rotate">Status</th>
            <th rowspan="2" class="text-center align-middle" width="120">Civil Service Eligibility</th>
        </tr>
        <tr>
            <th class="text-center align-middle">Authorized <br>Salary</th>
            <th class="text-center align-middle">Annual <br>Salary</th>
            <th class="text-center align-middle">Monthly <br>Salary</th>
            <th class="text-center align-middle rotate">Code</th>
            <th class="text-center align-middle rotate">Type</th>
            <th class="text-center align-middle">Last Name</th>
            <th class="text-center align-middle">First Name</th>
            <th class="text-center align-middle">M.I.</th>
        </tr>
    </thead>
    <tbody id="table-body">

{{-- @if(count($employees)>0)
  @foreach($employees as $employee)  --}}
    <tr class="text-center">
		<td class="align-middle" style="font-size: 12px;">ACC-5</td>
		<td class="align-middle" style="font-size: 12px;">ADMINISTRATIVE ASSISTANT III</td>
		{{-- <td class="align-middle" style="font-size: 12px;">COMPUTER OPERATOR III</td> --}}
		<td class="align-middle" style="font-size: 12px;">9</td>
		<td class="align-middle" style="font-size: 12px;">211,752.00</td>
		<td class="align-middle" style="font-size: 12px;">211,752.00</td>
		<td class="align-middle" style="font-size: 12px;">17,646.00</td>
		<td class="align-middle" style="font-size: 12px;">8</td>
		<td class="align-middle" style="font-size: 12px;">7</td>
		<td class="align-middle" style="font-size: 12px;">A</td>
		<td class="align-middle" style="font-size: 12px;">S</td>
		<td class="align-middle" style="font-size: 12px;">VARGAS</td>
		<td class="align-middle" style="font-size: 12px;">SUSAN</td>
		<td class="align-middle" style="font-size: 12px;">AMBOS</td>
		<td class="align-middle" style="font-size: 12px;">F</td>
		<td class="align-middle" style="font-size: 12px;">1957-08-17</td>
		<td class="align-middle" style="font-size: 12px;">118733461</td>
		<td class="align-middle" style="font-size: 12px;">1977-07-25</td>
		<td class="align-middle" style="font-size: 12px;">2000-02-10</td>
		<td class="align-middle" style="font-size: 12px;">P</td>
		<td class="align-middle" style="font-size: 12px;">SUB-PROFESSIONAL</td>
    </tr>
  {{-- @endforeach
@else
  <tr>
    <td colspan="9" class="text-center">No employees found!</td>
  </tr>
@endif --}}
                    </tbody>
                </table>
            </div>
        </div>

{{-- <div id="app"> --}}
	<example-component></example-component>	
{{-- </div> --}}



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
<div id="app">
	<example-component></example-component>
</div>
@endsection



@section('page-script')

</script>


@endsection
