@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
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
                            <th width="60" class="text-center">Status</th>
                            <th rowspan="0" class="text-center align-middle">Name</th>
                            <th class="text-center" width="50">Gender</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Assignment</th>
                            <th rowspan="0" class="text-center" width="40"></th>
                        </tr>
                        {{-- <tr>

                            <th>
                              <select class="custom-select custom-select-sm" style="width: 80px;">
                                <option disabled selected>---</option>
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                              </select>
                            </th>
                            <th>
                              <select class="custom-select custom-select-sm" style="width: 50px;">
                                <option disabled selected>---</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                              </select>
                            </th>
                            <th>
                              <select class="custom-select custom-select-sm" style="width: 80px;">
@if(count($departments)>0)
    <option disabled selected>Select department...</option>
    @foreach($departments as $department)
        <option value="{{$department->id}}">{{($department->short_name?$department->short_name.' - ':'').$department->name}}</option>        
    @endforeach
@else 
    <option disabled selected>[Empty]Please add departments first...</option>
@endif
                              </select>
                            </th>
                            <th>
                              <select class="custom-select custom-select-sm" style="width: 100%;">
@if(count($positions)>0)
  <option disabled selected>Select section...</option>
@foreach($positions as $position)
  <option value="{{$position->id}}">{{$position->sorted_list}}</option>    
@endforeach
  @else
    <option disabled selected>[Empty]Please add departments first...</option>
@endif
                              </select>
                            </th>
                            <th>
                              <select class="custom-select custom-select-sm" style="width: 100%;">
        <option disabled selected>Select...</option>
        <option value="RANK AND FILE">Rank & File</option>
        <option value="SUPERVISORY">Supervisory</option>
                              </select>
                            </th>
                        </tr> --}}


                    </thead> 
                    <tbody id="table-body"></tbody>
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
<hr class="m-0 p-0">
<div class="form-row">
    <div class="form-group col-sm-3">
      <label for="gender">Gender:</label>
      <select id="gender" name="gender" class="custom-select form-control">
        <option disabled selected>Select...</option>
        <option value="F">Female</option>
        <option value="M">Male</option>
      </select>
      <div class="invalid-feedback">
          Please indicate the gender.
    </div>
    </div>
</div>
<hr class="m-0 p-0">
<div class="form-row">
    <div class="form-group col-sm-3">
      <label for="employment_status">Employment Status:</label>
      <select id="employment_status" name="employment_status" class="custom-select form-control">
        <option disabled selected>Select...</option>
        <option value="CASUAL">Casual</option>
        <option value="PERMANENT">Permanent</option>
        <option value="ELECTIVE">Elective</option>
        <option value="COTERMINUS">Coterminus</option>
      </select>
        <div class="invalid-feedback">
          Please indicated the employment status.
        </div>
    </div>
    <div class="form-group col-sm-3">
      <label for="rank_of_ass">Nature of Assignment:</label>
      <select id="rank_of_ass" name="rank_of_ass" class="custom-select form-control">
        <option disabled selected>Select...</option>
        <option value="RANK AND FILE">Rank & File</option>
        <option value="SUPERVISORY">Supervisory</option>
      </select>
      <div class="invalid-feedback">
          Please indicate the nature of assignment.
        </div>
    </div>
    <div class="form-group col-sm-3">
      <label for="status">Active/Inactive:</label>
      <select id="status" name="status" class="custom-select form-control">
        <option value="ACTIVE" selected>Active</option>
        <option value="INACTIVE">Inactive</option>
      </select>
      <div class="invalid-feedback">
          Please indicate if active/inactive.
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
      <label for="position_id">Position:</label>
      <select id="position_id" name="position_id" class="custom-select form-control">
@if(count($positions)>0)
<option disabled selected>Select section...</option>
@foreach($positions as $position)
    <option value="{{$position->id}}">{{$position->sorted_list}}</option>    
@endforeach
    @else
    <option disabled selected>[Empty]Please add positions first...</option>
@endif
      </select>
      <div class="invalid-feedback">
          Please indicate the position.
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label for="ext_name">Appointed Date:</label>
        <input type="date" class="form-control" id="date_activated" name="date_activated" placeholder="e.g. Jr/Sr">
    </div>    
    <div class="form-group col-sm-3">
        <label for="ext_name">IPCR Starts/Started in:</label>
        <input type="date" class="form-control" id="date_ipcr" name="date_ipcr" placeholder="e.g. Jr/Sr">
    </div>  
</div>
<div class="form-row">
    <div class="form-group col-sm-6">
      <label for="department_id">Department:</label>
      <select id="department_id" name="department_id" class="custom-select form-control">
@if(count($departments)>0)
    <option disabled selected>Select department...</option>
    @foreach($departments as $department)
        <option value="{{$department->id}}">{{($department->short_name?$department->short_name.' - ':'').$department->name}}</option>        
    @endforeach
@else 
    <option disabled selected>[Empty]Please add departments first...</option>
@endif
      </select>
      <div class="invalid-feedback">
          Please indicate the department assigned to.
        </div>
    </div>

<div class="form-group col-sm-6">
      <label for="section_id">Section:</label>
      <select id="section_id" class="custom-select form-control">

      </select>
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
<script>

     var row_empty = '<tr id="row_empty">';
     row_empty += '<td colspan="9" class="text-center text-danger"><i class="fas fa-info-circle"></i> No Employee Found!</td>';
     row_empty += '</tr>';

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  



    $("#form-search").submit(function(event) {
      event.preventDefault();
      var val = $('#table-search').val();
      load_data(val);
    });


    $('#table-search').keyup(function(event) {
      if ($(this).val() == '') {
        load_data('');
      }
    });

  load_data($('#table-search').val());

        
    /*  When user click add employee button */
    $('body').on('click', '#add-new-employee', function(event) {
        resetFormValidation();
        $('#btn-save').val("add-employee");
        $('#btn-save').removeAttr('disabled');
        $('#employee_id').val("");
        $('#employee-form').trigger("reset");
        $('#ajax-crud-modal').modal('show');

    });


   /* When click edit employee */
    $('body').on('click', '#edit-employee', function () {
        resetFormValidation();
        $('#employee-form').trigger("reset")
        $('#btn-save').val("edit-employee");
        $('#btn-save').removeAttr('disabled');
      var employee_id = $(this).data('id');
      // console.log(employee_id);
      $.get('{{url('admin/employee')}}/' + employee_id +'/edit', function (data) {
          $('#btn-save').val("edit-employee");
          $('#ajax-crud-modal').modal('show');
          $('#employee_id').val(data.id);
          $('#last_name').val(data.last_name);
          $('#middle_name').val(data.middle_name);
          $('#first_name').val(data.first_name);
          $('#ext_name').val(data.ext_name);
          $('#gender').val(data.gender);
          $('#status').val(data.status);
          $('#employment_status').val(data.employment_status);
          $('#department_id').val(data.department_id);
          $('#position_id').val(data.position_id);
          $('#rank_of_ass').val(data.rank_of_ass);
          $('#date_activated').val(data.date_activated);
          $('#date_ipcr').val(data.date_ipcr);
      })
   });

    // var row_empty = '<tr id="row_empty"><td colspan="9" class="text-center">Employee records empty.</td></tr>';


/*  When click delete   */
    $('body').on('click', '#delete-employee', function () {
        var employee_id = $(this).data("id");
        $('#modal-delete').modal('show').on('click', '#btn-confirm-delete', function(event) {
            event.preventDefault();
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/employee')}}"+'/'+employee_id,
                success: function (data) {
                    $('#modal-delete').modal('hide');
                    $("#employee_id_" + employee_id).remove();
                    console.log('Success:', data);
                    if (data == 0) {
                        $('#table-body').prepend(row_empty);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });   

/*   submit form  */
        $("#employee-form").submit(function(event) {
            event.preventDefault();

            var actionType = $('#btn-save').val();
            $('#btn-save').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...');
            $('#btn-save').attr('disabled', 'true');
            // $('#ajax-crud-modal').modal('hide');
            console.log($('#employee-form').serialize());   

          $.ajax({
                url: '{{ url('admin/employee') }}',
                type: 'POST',
                dataType: 'json',
                data: $('#employee-form').serialize(),
                success: function (data){
                  console.log(data);
                    // console.log(data.error.last_name[0]);
                    if (!data.error) {
                        $('#ajax-crud-modal').modal('hide');

$('#employee-form').trigger("reset");

var employee = '<tr id="employee_id_'+data.id+'"><td class="text-center">'+'<a href="employee/'+data.id+'" id="open-employee" class="mr-2" title="Open"><i class="fas fa-folder"></i></a> <a href="javascript:void(0)" id="edit-employee" class="" title="Edit" data-id="'+data.id+'"><i class="fas fa-edit"></i></a>'+'</td><td>'+data.padded_id+'</td><td class="text-center">'+(data.status=='ACTIVE'?'<span class="text-primary">ACTIVE</span>':'<span class="text-danger">INACTIVE</span>')+'</td><td>'+data.full_name+'</td><td class="text-center">'+data.gender+'</td><td>'+data.department_short+'</td><td>'+data.position+'</td><td>'+data.rank_of_ass+'</td><td class="text-center">'+'<a href="javascript:void(0)" id="delete-employee" class="" title="Delete" data-id="'+data.id+'"><i class="fas fa-times"></i></a>'+'</td></tr>';

                        if (data.count == 0) {
                            $('#table-body').prepend(row_empty  );
                        } else {

                          if (actionType == "add-employee") {
                              $('#table-body').prepend(employee);
                          } else {
                              $("#employee_id_" + data.id).replaceWith(employee);
                          }

                            $("#row_empty").remove();   
                        }                

                    } else {
                        var err = data.error;
                        $('#btn-save').removeAttr('disabled');

                        resetFormValidation();

                              var msgLastName = 'Please provide the last name.';
                              var msgFirstName = 'Please provide the first name.';

                              if ( data.error.last_name && data.error.last_name[0]=='existing') {
                                msgLastName = 'Employee already existed.';
                                msgFirstName = '';
                                $('#first_name').addClass('is-invalid');
                              }

                              $('#invalid-feedback-last_name').html(msgLastName);
                              $('#invalid-feedback-first_name').html(msgFirstName);

                        $.each(err, function(index, val) {
                           /* iterate through array or object */
                           $('#'+index).addClass('is-invalid');
                        });


                    }
                    
                    $('#btn-save').html('<i class="fas fa-save"></i> Save');

                }
            });



        });
    });


function resetFormValidation()
{
  $.each($('#employee-form .form-control'), function(index, val) {
    $(this).removeClass('is-invalid');
  });
}

 function load_data(full_text_search_query = '')
 {

  var loading_table = '<tr><td colspan="9" class="text-center"><span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span> <span style=""> Loading...</span></tr>';
  $('tbody').html(loading_table);
  var _token = $("input[name=_token]").val();
  $.ajax({
   url:"{{ route('full-text-search.action') }}",
   method:"POST",
   data:{full_text_search_query:full_text_search_query, _token:_token},
   dataType:"json",
   success:function(data)
   {
    var output = '';
    if(data.length > 0)
    {
     for(var count = 0; count < data.length; count++)
     {
      output += '<tr id="employee_id_'+data[count].id+'">';
      output += '<td class="text-center">'+'<a href="employee/'+data[count].id+'" id="open-employee" class="mr-2" title="Open"><i class="fas fa-folder"></i></a> <a href="javascript:void(0)" id="edit-employee" class="" title="Edit" data-id="'+data[count].id+'"><i class="fas fa-edit"></i></a>'+'</td>';
      output += '<td>'+data[count].padded_id+'</td>';
      output += '<td class="text-center">'+(data[count].status=='ACTIVE'?'<span class="text-primary">ACTIVE</span>':'<span class="text-danger">INACTIVE</span>')+'</td>';
      output += '<td>'+data[count].full_name+'</td>';
      output += '<td class="text-center">'+data[count].gender+'</td>';
      output += '<td>'+data[count].department_short+'</td>';
      output += '<td>'+data[count].position+'</td>';
      output += '<td>'+data[count].rank_of_ass+'</td>';
      output += '<td class="text-center">'+'<a href="javascript:void(0)" id="delete-employee" class="" title="Delete" data-id="'+data[count].id+'"><i class="fas fa-times"></i></a>'+'</td>';
      output += '</tr>';
     }
    }
    else
    {

     output = row_empty;
    }
    $('tbody').html(output);
   }
  });
 }

</script>


@endsection
