@extends('layouts.app')

@section('content')

{{-- <div id='example'></div> --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary font-weight-bolder"><i class="fas fa-university"></i> DEPARTMENTS</div>

                <div class="card-body">
                    
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
            <button type="button" class="btn btn-primary" id="btn-create"><i class="fas fa-plus-circle"></i> Add Department</button>
            <br>
            <br>

        <div class="panel panel-default">
            <div class="panel-heading">
                {{-- Employees --}}
            </div>

            <div class="panel-body">

@if (count($departments) > 0)
@foreach ($departments as $no => $department)

<div id="row_id_{{ $department->id }}" class="card mb-2">
  <h5 class="card-header">{{ ($department->short_name?$department->short_name.' - ':'').$department->name }}</h5>
  <div class="card-body">
    <h5 class="card-title">Sections:</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div> 

@endforeach
@endif


               {{--  <table class="table table-striped task-table table-sm table-bordered p-sm-0 m-sm-0">

                    <thead class="text-primary">
                        <tr>
                            <td></td>
                            <th width="100">Options</th>
                            <th width="100">ID</th>
                            <th width="100">Alias</th>
                            <th>Department</th>
                            <th width="50"></th>
                        </tr>
                    </thead>

                    <tbody id="table-body">

@if (count($departments) > 0)
                        @foreach ($departments as $no => $department)
                            
                            <tr id="row_id_{{ $department->id }}">

                                <td>{{$no+1}}</td>
                                <td class="text-center">
                                        <a class="mr-2" title="Open"><i class="fas fa-folder-open text-primary"></i></a>
                                        <a id="btn-update" title="Edit" data-id="{{ $department->id }}"><i class="fas fa-edit text-primary"></i></a>
                                </td>
                                <td>
                                    {{ $department->id }}
                                </td>
                                <td class="table-text">
                                    {{ $department->short_name }}
                                </td>
                                <td class="table-text">
                                    {{ $department->name }}
                                </td>
 
                                <td class="text-center">
                                    <a title="Delete" id="btn-delete" data-id="{{ $department->id }}"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            <tr class="text-primary font-weight-bold">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2" class="">Sections</t    d>
                            </tr>
                            @for($i=0; $i!=10; $i++)
                                <tr class="table-text">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2">
                                            Section {{$i}}
                                    </td>
                                </tr>
                            @endfor   
                        @endforeach
@else
<tr id="row_empty">
    <td colspan="5" class="text-center">No Records of Departments</td>
</tr>
@endif



                    </tbody>
                </table> --}}
            </div>
        </div>

        
    

                    
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="userCrudModal"></h5>
        </div>
        <div class="modal-body">
<!-- form start -->
<form id="createOrUpdateForm" name="createOrUpdateForm" class="form-horizontal">
<input type="hidden" name="object_id" id="object_id">
<div class="form-row">
    <div class="form-group col-sm-12">
        <label for="name">Department Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter department name">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-6">
        <label for="short_name">Short Name:</label>
        <input autofocus type="text" class="form-control" id="short_name" name="short_name" placeholder="e.g: CTO, CAO, CBO, etc.">
    </div>
</div>
</form>
<!-- form end -->
</div>
        <div class="modal-footer">
            <button type="cancel" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel
            </button>
            <button form="createOrUpdateForm" type="submit" class="btn btn-primary" id="btn-save"><i class="fas fa-save"></i> Save
            </button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-delete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id=""></h5>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this department?</p>
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
    /*  When user click add employee button */
    $('body').on('click', '#btn-create', function(event) {
        // event.preventDefault();
        $('#btn-save').val("create");
        $('#btn-save').removeAttr('disabled');
        $('#object_id').val("");
        $('#createOrUpdateForm').trigger("reset");
        $('#ajax-crud-modal').modal('show');

    });


   /* When click edit employee */
    $('body').on('click', '#btn-update', function () {
        $('#createOrUpdateForm').trigger("reset")
        $('#btn-save').val("update");
        $('#btn-save').removeAttr('disabled');
      var object_id = $(this).data('id');
      // console.log(object_id);
      $.get('{{url('admin/department')}}/' + object_id +'/edit', function (data) {
        console.log(data);
          $('#btn-save').val("update");
          $('#ajax-crud-modal').modal('show');
          $('#object_id').val(data.id);
          $('#name').val(data.name);
          $('#short_name').val(data.short_name);
      })
   });


    var row_empty = '<tr id="row_empty"><td colspan="5" class="text-center">No Records of Departments</td></tr>';

/*  When click delete   */
    $('body').on('click', '#btn-delete', function () {
        var object_id = $(this).data("id");
        $('#modal-delete').modal('show').on('click', '#btn-confirm-delete', function(event) {
            event.preventDefault();
            console.log(object_id);
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/department')}}"+'/'+object_id,
                success: function (data) {
                    $('#modal-delete').modal('hide');
                    $("#row_id_" + object_id).remove();
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



/*   The add/edit form  */
        $("#createOrUpdateForm").submit(function(event) {
            /* Act on the event */
            event.preventDefault();
            var actionType = $('#btn-save').val();
            console.log('actionType: ',actionType);
            console.log('Employee_id: ',$('#object_id').val());
            $('#btn-save').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...');
            $('#btn-save').attr('disabled', 'true');
            // $('#ajax-crud-modal').modal('hide');
            console.log($('#createOrUpdateForm').serialize());   

        $.ajax({
                url: '{{ url('admin/department') }}',
                type: 'POST',
                dataType: 'json',
                data: $('#createOrUpdateForm').serialize(),
                success: function (data){
                    console.log(data);

                    $('#createOrUpdateForm').trigger("reset");
                    // 
                    if (!data.error) {
                        $('#ajax-crud-modal').modal('hide');


var table_row = '<tr id="row_id_'+data.id+'"><td><div class="btn-group  btn-group-sm" role="group" aria-label="Basic example"><button type="button" class="btn text-primary" title="Open" id="btn-show"><i class="fas fa-folder-open"></i></button><button type="button" id="btn-update" class="btn text-primary" title="Edit" data-id="'+data.id+'"><i class="fas fa-edit"></i></a></div></td><td><div>'+data.id+'</div></td><td class="table-text"><div>'+(data.short_name=='null'?'':data.short_name)+'</div></td></td><td class="table-text"><div>'+data.name+'</div></td><td class="text-right"> <div class="btn-group  btn-group-sm" role="group" aria-label="Basic example"><button type="button" class="btn" title="Delete" id="btn-delete" data-id="'+data.id+'"><i class="fas fa-times"></i></button></div></td></tr>';

                        if (actionType == "create") {
                            $('#table-body').prepend(table_row);
                        } else {
                            $("#row_id_" + data.id).replaceWith(table_row);
                        }
                
                        if (data.count == 0) {
                            $('#table-body').prepend(row_empty  );
                        } else {
                            $("#row_empty").remove();   
                        }


                    } else {
                        $('#btn-save').removeAttr('disabled');
                    }
                    
                    $('#btn-save').html('<i class="fas fa-save"></i> Save');

                },
                error: function (data){
                    console.log('error: ', data);
                    // $('#btn-save').html('Save');
                }
            });


        });
    });

</script>


@endsection
