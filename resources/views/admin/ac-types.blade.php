@extends('layouts.admin')
@section('content')
<div class="card">
    {{-- <div class="card-header">Manage Air Conditioning Types</div> --}}
    <div class="card-body">
        <div class="pb-4 text-end">
            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addRecordModal"><i class="fa-solid fa-plus"></i> Add New</a>
        </div>
        <table class="table table-striped table-bordered nowrap datatable">
            <thead>
                <tr>
                    <th width="30px" class="text-center">Sr.</th>
                    <th>Title</th>
                    <th width="200px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counties as $county)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td><div style="white-space: normal;">{{$county->name}}</div></td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" onclick="editRecord(this);" data-action="{{route('admin.airConditioningTypes.update', $county->id)}}" data-name="{{$county->name}}" ><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a class="btn btn-danger btn-sm" onclick="deleteRecord(this);" data-action="{{route('admin.airConditioningTypes.destroy', $county->id)}}"><i class="fa-solid fa-trash-can"></i> Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function editRecord(f) {
        var action = $(f).data('action');
        var name = $(f).data('name');
        $('.edit-Record-form').attr('action', action);
        $('#edit_name').val(name);
        $('#editRecordModal').modal('show');
    }

    function deleteRecord(f) {
        Swal.fire({
                    title: 'Are you sure you want to delete this?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: `No`,
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'btn btn-danger',
                        confirmButton: 'btn btn-primary',
                        // denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var action = $(f).data('action');
                        $('.delete-Record-form').attr('action', action);
                        $('.delete-Record-form').submit();
                    }
                })
    }
$(function () {
    $("#editRecordModal").on("hidden.bs.modal", function () {
        // alert('hidden');
        $('.edit-Record-form').trigger('reset');
        $('.edit-Record-form').attr('action', '');
        // $('#edit_name').val(name);
    });
});
</script>

<form action="" method="POST" class="delete-Record-form">
    @method('delete')
    @csrf
</form>

{{-- Modals --}}
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('admin.airConditioningTypes.store')}}" method="POST">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="addRecordModalLabel">Add Air Conditioning Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required >
                                @if($errors->has('name'))
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>




  <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST" class="edit-Record-form">
            @csrf
            @method('put')
            <div class="modal-header">
            <h5 class="modal-title" id="editRecordModalLabel">Edit Air Conditioning Type</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="edit_name" required >
                                @if($errors->has('name'))
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- End Modals --}}
@endpush
