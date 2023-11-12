@extends('layouts.admin_app')
@section('title')
    Edit Resource
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Resourcee</h4>
                        </div>
                        <div class="card-body">
                            <form id="edit-resource" data-url="{{ route('resource.update', $resource->id) }}">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="image" class="form-label">File</label>
                                        <input type="file" id="file" name="file" class="form-control" />
                                        <img id="resourceFile" src="{{asset($resource->file)}}" alt="" width="100" class="img-thumbnail mt-2">
                                        <span id="file_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <select class="form-control mb-3" name="status" id="is_status">
                                            <option value="1" {{$resource->status==1? 'selected':''}}>Active</option>
                                            <option value="0" {{$resource->status==0? 'selected':''}}>Inactive</option>
                                        </select>
                                        <span id="status_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <button id="edit-resource-btn" type="submit" class="btn btn-success mt-3">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#edit-resource').submit(function(e) {
            e.preventDefault();
            $('#edit-resource-btn').attr("disabled", true);
            $('#edit-resource-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
            var url = $(this).data('url');
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status==200){
                        toastr.success('Resource updated successfully.');
                        $(location).prop('href', '{{route('resource.index')}}');
                        $('#edit-resource-btn').attr("disabled", false);
                        $('#edit-resource-btn').html("Update");
                    }
                },
                error: function(error) {
                    if (error.responseJSON.errors) {
                        if (error.responseJSON.errors.file) {
                            $('#file_error').text(error.responseJSON.errors.file[0]);
                        } else {
                            $('#file_error').text('');
                        }
                        if (error.responseJSON.errors.status) {
                            $('#status_error').text(error.responseJSON.errors.status[0]);
                        } else {
                            $('#status_error').text('');
                        }
                    }
                    $('#add-resource-btn').attr("disabled", false);
                    $('#add-resource-btn').html("Add Resource");
                }
            });

            // Update the image URL
            var fileInput = document.getElementById('file');
            var file = fileInput.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#resourceFile').attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
