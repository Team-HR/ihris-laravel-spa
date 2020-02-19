@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white font-weight-bolder"><a class="text-warning" href="javascript:void(0)" onclick="window.history.back();"><i class="fas fa-arrow-alt-circle-left"></i> BACK</a>  <i class="fas fa-user-tie ml-4 mr-1"></i> {{$employee->full_name}}</div>   

                <div class="card-body">

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="appointment-tab" data-toggle="tab" href="#appointment" role="tab" aria-controls="appointment" aria-selected="true">Appointment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pds-tab" data-toggle="tab" href="#PDS" role="tab" aria-controls="pds" aria-selected="false">PDS</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
      <div class="card my-2">
          <div class="card-body">
              <table class="table small compact striped">
                  <thead>
                      <tr>
                          <th>No.</th>
                          <th>Edit</th>
                          <th>Employment Status</th>
                          <th>Position Title</th>
                          <th>SG</th>
                          <th>Daily Wage</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Nature of Appointment</th>
                          <th>Office</th>
                      </tr>
                  </thead>
                  <tbody>
@if(count($appointments)>0)
    @foreach($appointments as $no => $appointment)

        <tr>
            <td>{{$no+1}}.)</td>
            <td><a href="javascript:void(0)" onclick="editFunction({{$appointment['id']}})" class="">Edit</a></td>
            <td>{{$appointment['employment_status']}}</td>
            <td>{{$appointment['position_title']}}</td>
            <td>{{$appointment['sg']}}</td>
            <td>{{$appointment['daily_wage']}}</td>
            <td>{{$appointment['from_date']}}</td>
            <td>{{$appointment['to_date']}}</td>
            <td>{{$appointment['nature_of_appointment']}}</td>
            <td>{{$appointment['department']}}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="9" class="text-center">
            NOT Appointed!
        </td>
    </tr>
@endif
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="tab-pane" id="PDS" role="tabpanel" aria-labelledby="profile-tab">Personal Data Sheet direy puhooooooon......
  </div>
</div>





                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="editAppointmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAppointmentModalLabel">Update Appointment Entry</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body">
        <form id="editAppointmentForm" novalidate>
          @method('PUT')
          <input type="text" name="id" id="id" hidden="">
          <div class="form-row">
            <div class="form-group col-6">
              <label for="employment_status" class="col-form-label">Employement Status:</label>
              <input type="text" class="form-control" id="employment_status" name="employment_status">
            </div>
            <div class="form-group col-6">
              <label for="position_title" class="col-form-label">Position Title:</label>
              <input type="text" class="form-control" id="position_title" name="position_title">
            </div>  
          </div>
          <div class="form-row">
            <div class="form-group col-6">
              <label for="sg" class="col-form-label">Salary Grade:</label>
              <input type="text" class="form-control" id="sg" name="sg">
            </div>
            <div class="form-group col-6">
              <label for="daily_wage" class="col-form-label">Daily Wage:</label>
              <input type="text" class="form-control" id="daily_wage" name="daily_wage">
            </div>  
          </div>
          <div class="form-row">
            <div class="form-group col-6">
              <label for="from_date" class="col-form-label">From:</label>
              <input type="date" class="form-control" id="from_date" name="from_date">
            </div>
            <div class="form-group col-6">
              <label for="to_date" class="col-form-label">To:</label>
              <input type="date" class="form-control" id="to_date" name="to_date">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-6">
              <label for="nature_of_appointment" class="col-form-label">Nature of Appointment:</label>
              <input type="text" class="form-control" id="nature_of_appointment" name="nature_of_appointment">
            </div>
            <div class="form-group col-6">
              <label for="department_id" class="col-form-label">Department:</label>
              {{-- <input type="date" class="form-control" id="to_date"> --}}
              <select class="form-control" id="department_id" name="department_id">
                @foreach($departments as $department)
                  <option value="{{$department['id']}}">{{$department['name']}}</option>
                @endforeach
              </select>

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button form="editAppointmentForm" type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button form="editAppointmentForm" type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-script')
<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

          $("#editAppointmentForm").submit(function(event) {
            event.preventDefault();
            var serial = $(this).serialize(); 
            var appointment_id = $('#id').val();
            console.log(serial);

            $.ajax({
                url: '../appointment/'+appointment_id+'/updatePerEmployee',
                type: 'POST',
                dataType: 'json',
                data: $("#editAppointmentForm").serialize(),
                success: function (data){
                  // console.log(data);
                  $('#editAppointmentModal').modal('hide');
                  window.location.reload();
                }
              });


          });


    });

    function editFunction(id){
      $.get('../appointment/'+id+'/edit', function(data, textStatus, xhr) {
        /*optional stuff to do after success */
        console.log(data);
        $('#id').val(data.id);
        $('#employment_status').val(data.employment_status);
        $('#position_title').val(data.position_title);
        $('#sg').val(data.sg);  
        $('#daily_wage').val(data.daily_wage);
        $('#from_date').val(data.from_date);
        $('#to_date').val(data.to_date);
        $('#nature_of_appointment').val(data.nature_of_appointment);
        $('#department_id').val(data.department_id);
      });
      $('#editAppointmentModal').modal('show');
    }

</script>


@endsection
