@extends('layouts.admin_app')
@section('title')
    Add Grade
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add a Grade</h4>
                        </div>
                        <div class="card-body">
                            <form class="tablelist-form" autocomplete="off" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" />
                                    <span id="name_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" placeholder="Enter Slug" />
                                    <span id="slug_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" id="image" name="image" class="form-control" />
                                    <span id="image_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <select class="form-control mb-3" name="status" id="is_status">
                                        <option ></option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span id="status_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="form-check d-flex">
                                        <input class="form-check-input" type="checkbox" value="1" id="is_feature" name="is_feature">
                                        <label class="form-check-label" for="is_feature" style="margin-left: 10px;">
                                            Is Feature
                                        </label>
                                        <span id="is_feature_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <button id="add-grade-btn" type="submit" class="btn btn-success">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Add Grade
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
        $('#add-grade-btn').click(function (e) {
            e.preventDefault();
            $('#add-grade-btn').attr("disabled", true);
            $('#add-grade-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var data = new FormData();
            data.append('_token', "{{ csrf_token() }}");
            data.append('name', document.getElementById("name").value);
            data.append('slug', document.getElementById("slug").value);
            data.append('image', $('input[type=file]')[0].files[0]);
            data.append('status', document.getElementById("is_status").value);
            data.append('is_feature', document.getElementById("is_feature").value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('grade.store')}}",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#store-grade').trigger("reset");
                    toastr.success('Grade Added Successfully');
                    $(location).prop('href', '{{route('grade.index')}}');
                    $('#add-grade-btn').attr("disabled", false);
                    $('#add-grade-btn').html("Add Grade");
                },
                error: function(error) {
                    if(error.responseJSON.errors.name){
                        $('#name_error').text(error.responseJSON.errors.name);
                    }else{
                        $('#name_error').text('');
                    }
                    if(error.responseJSON.errors.slug){
                        $('#slug_error').text(error.responseJSON.errors.slug);
                    }else{
                        $('#slug_error').text('');
                    }
                    if(error.responseJSON.errors && error.responseJSON.errors.status){
                        $('#status_error').text(error.responseJSON.errors.status);
                    }else{
                        $('#status_error').text('');
                    }
                    $('#add-grade-btn').attr("disabled", false);
                    $('#add-grade-btn').html("Add Grade");

                }
            });
        });
    });

    // AUTO SLUG GENERATE
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        slugInput.setAttribute('readonly', true);

        nameInput.addEventListener('input', function () {
            const name = nameInput.value.trim();
            const slug = generateSlug(name);
            slugInput.value = slug;
        });

        function generateSlug(name) {
            return name
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });
</script>
