@extends('layouts.app')

@section('content')
<div class="container-fluid">
  {{-- <h1>{{$employee_id}}</h1>   --}}
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
  {{-- <li class="nav-item">
    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
  </li> --}}
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
      <div class="card my-2">
          <div class="card-body">
              <table class="table small compact striped">
                  <thead>
                      <tr>
                        <th>No.</th>
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
@endsection

@section('page-script')
<script>

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

</script>


@endsection
