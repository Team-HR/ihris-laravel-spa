@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary font-weight-bolder"><i class="fas fa-file-excel"></i> CASUAL PLANTILLA</div>   

                <div class="card-body bg-light">
                    
                    @if (session('error'))
                        <div class="alert alwwert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            
            <div class="panel-body">
                <table id="page-table" class="table bg-light table-striped task-table table-sm table-bordered p-sm-0 m-sm-0">
                    <thead class="text-primary">
                        <tr>
                            <th class="text-center align-middle">No.</th>
                            <th class="text-center align-middle">Generate Report</th>
                            <th class="text-center align-middle">From Date</th>
                            <th class="text-center align-middle">To Date</th>
                            <th class="text-center align-middle">Nature of Appointment</th>
                        </tr>
                    </thead> 
                    <tbody id="table-body">


@if(count($appointments)>0)
  @foreach($appointments as $no => $appointment)
    <tr>
      <td class="text-center">{{$no+1}}</td>
      <td class="text-center text-primary">
        <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="generateReport('{{json_encode($appointment)}}')"><i class="fas fa-file-excel"></i> - Plantilla</a>
        <a class="btn btn-primary btn-sm" href="{{url('/casual/plantilla-generate_ataf?'.implode('&', array_map(
    function ($v, $k) {
        if(is_array($v)){
            return $k.'='.implode('&'.$k.'[]=', $v);
        }else{
            return $k.'='.$v;
        }
    }, 
    $appointment, 
    array_keys($appointment)
)).'&filter=1')}}" target="_blank"><i class="fas fa-file-excel"></i> - ATAF</a>
      </td>
      <td class="text-center">{{$appointment['from_date_str']}}</td>
      <td class="text-center">{{$appointment['to_date_str']}}</td>
      <td class="text-center">{{$appointment['nature_of_appointment']}}</td>
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

 <div class="modal fade" id="generate-report-modal" aria-hidden="true">

  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id=""></h5>
        </div>
        <div class="modal-body">
          <h5>Generate Plantilla</h5>
          <cite class="blockquote-footer" id="period"></cite>
          <cite class="blockquote-footer" id="nature_of_appointment_label"></cite>

<!-- form start -->
<form id="generateReport-form" class="form" novalidate="">
  <input type="hidden" name="from_date" id="from_date">
  <input type="hidden" name="to_date" id="to_date">
  <input type="hidden" name="nature_of_appointment" id="nature_of_appointment">
  <div class="form-row">
      <div class="form-group col-12">
        <label for="filter">for:</label>
        <select id="filter" name="filter" class="custom-select form-control">
          <option value="all" selected>All Employees</option>

      @if(count($departments)>0)
        @foreach($departments as $department)
          <option value="{{$department['id']}}">{{($department['short_name']?$department['short_name'].' - ':'')}}{{$department['name']}}</option>
        @endforeach
      @else
        <option disabled>No Departments</option>
      @endif

        </select>
        <div class="invalid-feedback">
            Please indicate the gender.
      </div>
      </div>
  </div>
  <div class="form-row ml-2">
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="incRAI" style="transform: scale(1);" name="incRAI">
      <label class="form-check-label" for="incRAI"> Include RAI</label>
    </div>
  </div>
</form>

<a id="FooA" hidden href="#Foo" class="btn btn-default" data-toggle="collapse">Toggle Foo</a>
<div id="Foo" class="collapse">
  <div class="alert alert-success" role="alert" id="download-alert">
    Download will begin shortly... <br>
    You may download another...
  </div>
</div>
<!-- form end -->
</div>
        <div class="modal-footer">
            <button form="generateReport-form" type="cancel" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel
            </button>
            <button form="generateReport-form" type="submit" class="btn btn-primary" id="btn-generate"><i class="fas fa-file-excel"></i> Generate
            </button>
        </div>
    </div>
  </div>
</div>

@endsection



@section('page-script')

<script type="text/javascript">
  
  $(document).ready(function() {

    $("#generate-report-modal").on('hide.bs.modal', function(){
      $('#Foo').hide();
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 $("#generateReport-form").submit(function(event) {
            event.preventDefault();
            var serial = $('#generateReport-form').serialize();
            console.log(serial);
            window.location.href="{{url('/casual/plantilla-generate_report')}}"+'?'+serial;
            $('#Foo').show();  
  });


  });

  function generateReport(array){
    arr = $.parseJSON(array);
    var period = arr.from_date_str+(arr.to_date_str?' to '+arr.to_date_str:'');
    $('#from_date').val(arr.from_date);
    $('#to_date').val(arr.to_date);
    $('#nature_of_appointment').val(arr.nature_of_appointment);

    $('#period').html(period);
    $('#nature_of_appointment_label').html(arr.nature_of_appointment);
    $('#generate-report-modal').modal("show");

    
  }





</script>


@endsection
