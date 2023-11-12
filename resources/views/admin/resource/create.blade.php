@extends('layouts.admin_app')
@section('title')
    Add Resource
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add Resource</h4>
                        </div>
                        <div class="card-body">
                            <form class="tablelist-form" autocomplete="off" method="post" enctype="multipart/form-data" id="resourceForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="file" class="form-label">File</label>
                                        <input type="file" id="file" name="file" class="form-control"/>
                                        <span id="file_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <select class="form-control mb-3" name="status" id="is_status">
                                            <option ></option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <span id="status_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <button id="add-resource-btn" type="submit" class="btn btn-success">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Add Resource
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
        $('#add-resource-btn').click(function(e) {
            e.preventDefault();
            $('#add-resource-btn').attr("disabled", true);
            $('#add-resource-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var data = new FormData();
            data.append('_token', "{{ csrf_token() }}");
            var fileInput = $('input[type=file]')[0];
            if (fileInput.files.length > 0) {
                data.append('file', fileInput.files[0]);
            } else {
                data.append('file', null);
            }
            data.append('status', document.getElementById("is_status").value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('resource.store')}}",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success('Resource Added Successfully');
                    $(location).prop('href', '{{route('resource.index')}}');
                    $('#add-resource-btn').attr("disabled", false);
                    $('#add-resource-btn').html("Add Resource");
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
        });
    });
</script>
