@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-primary font-weight-bolder"><i class="fas fa-university"></i> POSITIONS</div>

                <div class="card-body">
                    
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
            <button type="button" class="btn btn-primary" id="btn-create"><i class="fas fa-plus-circle"></i> Add Position</button>
            <br>
            <br>

        <div class="panel panel-default">
            <div class="panel-heading">
                {{-- Employees --}}
            </div>

            <div class="panel-body">

                <table id="page-table" class="table table-striped task-table table-sm table-bordered p-sm-0 m-sm-0">

                    <!-- Table Headings -->
                    <thead class="text-primary">
                        <tr>
                            <th width="50">Options</th>
                            <th width="100">ID</th>
                            <th>Position</th>
                            <th>Function</th>
                            <th class="text-center">Level</th>
                            <th>Category</th>
                            <th width="80">Salary Grade</th>
                            <th width="50"></th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody id="table-body">

@if (count($positions) > 0)

                        @foreach ($positions as $position)
                            <tr id="row_id_{{ $position->id }}">
                                <!-- Task Name -->
                                <td class="text-center">
                                    <a href="javascript:void(0)" id="btn-update" title="Edit" data-id="{{ $position->id }}"><i class="fas fa-edit text-primary"></i></a>
                                </td>
                                <td>
                                    <div>{{ $position->id }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $position->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $position->function }}</div>
                                </td>
                                <td class="table-text text-center">
                                    <div>{{ $position->level }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $position->category }}</div>
                                </td>
                                <td class="table-text text-center">
                                    <div>{{ $position->sg }}</div>
                                </td>
                                <td class="text-right">
                                    <a href="javascript:void(0)" title="Delete" id="btn-delete" data-id="{{ $position->id }}"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach

@else
<tr id="row_empty">
    <td colspan="8" class="text-center">No Records of Positions.</td>
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
  <div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                {{-- <h5 class="modal-title" id="userCrudModal"></h5> --}}
            </div>
        <div class="modal-body">
<!-- form start -->
<form id="createOrUpdateForm" name="createOrUpdateForm" class="form-horizontal">
<input type="hidden" name="object_id" id="object_id">
<div class="form-row">
    <div class="form-group col-sm-12">
        <label for="name">Position:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter position">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-12">
        <label for="function">Function:</label>
        <input type="text" class="form-control" id="function" name="function" placeholder="Enter function">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-sm-3">
      <label for="level">Level:</label>
      <select id="level" name="level" class="custom-select">
        <option disabled selected>Select level</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>
    <div class="form-group col-sm-6">
      <label for="category">Category:</label>
      <select id="category" name="category" class="custom-select">
        <option disabled selected>Select category</option>
        <option value="TECHNICAL">Technical</option>
        <option value="ADMINISTRATIVE">Administrative</option>
        <option value="KEY POSITION">Key Position</option>
      </select>
    </div>
    <div class="form-group col-sm-3">
      <label for="sg">Salary Grade:</label>
      <input type="number" min="1" id="sg" name="sg" class="form-control" placeholder="Enter SG">
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
            <p>Are you sure you want to delete this position?</p>
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
      $.get('{{url('admin/position')}}/' + object_id +'/edit', function (data) {
        console.log(data);
          $('#btn-save').val("update");
          $('#ajax-crud-modal').modal('show');
          $('#object_id').val(data.id);
          $('#name').val(data.name);
          $('#function').val(data.function);
          $('#level').val(data.level);
          $('#category').val(data.category);
          $('#sg').val(data.sg);
      })
   });


    var row_empty = '<tr id="row_empty"><td colspan="8" class="text-center">No Records of Positions</td></tr>';

/*  When click delete   */
    $('body').on('click', '#btn-delete', function () {
        var object_id = $(this).data("id");
        $('#modal-delete').modal('show').on('click', '#btn-confirm-delete', function(event) {
            event.preventDefault();
            console.log(object_id);
            $.ajax({
                type: "DELETE",
                url: "{{ url('admin/position')}}"+'/'+object_id,
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
            $('#btn-save').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Saving...');
            $('#btn-save').attr('disabled', 'true');
            // $('#ajax-crud-modal').modal('hide');
            console.log($('#createOrUpdateForm').serialize());   

        $.ajax({
                url: '{{ url('admin/position') }}',
                type: 'POST',
                dataType: 'json',
                data: $('#createOrUpdateForm').serialize(),
                success: function (data){
                    console.log(data);

                    $('#createOrUpdateForm').trigger("reset");
                    // 
                    if (!data.error) {
                        $('#ajax-crud-modal').modal('hide');


var table_row = 
    '<tr id="row_id_'+data.id+'">'+
        '<td class="text-center">'+
            '<a href="javascript:void(0)" id="btn-update" title="Edit" data-id="'+data.id+'"><i class="fas fa-edit text-primary"></i></a>'+
        '</td>'+
        '<td>'+
            '<div>'+data.id+'</div>'+
        '</td>'+
        '<td class="table-text">'+
            '<div>'+data.name+'</div>'+
        '</td>'+
        '<td class="table-text">'+
            '<div>'+(data.function!=null?data.function:'')+'</div>'+
        '</td>'+
        '<td class="table-text text-center">'+
            '<div>'+(data.level!=null?data.level:'')+'</div>'+
        '</td>'+
        '<td class="table-text">'+
            '<div>'+(data.category!=null?data.category:'')+'</div>'+
        '</td>'+
        '<td class="table-text text-center">'+
            '<div>'+(data.sg!=null?data.sg:'')+'</div>'+
        '</td>'+
        '<td class="text-right">'+
            '<a href="javascript:void(0)" title="Delete" id="btn-delete" data-id="'+data.id+'"><i class="fas fa-times"></i></a>'+
        '</td>'+
    '</tr>';

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
