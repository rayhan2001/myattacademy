@extends('layouts.admin_app')
@section('title')
    Edit Unit
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit a Unit</h4>
                        </div>
                        <div class="card-body">
                            <form id="edit-unit" data-url="{{ route('unit.update', $unit->id) }}">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Title</label>
                                        <input type="text" name="title" value="{{$unit->title}}" id="title" class="form-control" placeholder="Enter Course Name" />
                                        <span id="title_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" value="{{$unit->slug}}" name="slug" class="form-control" placeholder="Enter Slug" />
                                        <span id="slug_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Sub Title</label>
                                        <input type="text" name="sub_title" value="{{$unit->sub_title}}" id="sub_title" class="form-control" placeholder="Enter Name" />
                                        <span id="sub_title_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Status</label>
                                        <select class="form-control" name="status" id="unit_status">
                                            <option></option>
                                            <option value="1" {{ $unit->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $unit->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <span id="status_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control">{!! $unit->description !!}</textarea>
                                    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
                                    <script>
                                        CKEDITOR.replace('description',{
                                            height:150,
                                        });
                                    </script>
                                    <span id="description_error" class="text-danger"></span>
                                </div>
                                <button id="edit-unit-btn" type="submit" class="btn btn-success">
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
        $('#edit-unit').submit(function(e) {
            e.preventDefault();
            $('#edit-unit-btn').attr("disabled", true);
            $('#edit-unit-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var description = CKEDITOR.instances.description.getData();
            var url = $(this).data('url');
            var data = new FormData(this);
            data.append('description', description);
            data.append('course_id', {{$unit->course_id}});
            data.append('grade_id', {{$unit->grade_id}});

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success('Unit Update Successfully');
                    $(location).prop('href', '{{route('course.show',$unit->course_id)}}');
                    $('#edit-unit-btn').attr("disabled", false);
                    $('#edit-unit-btn').html("Update");
                },
                error: function(error) {
                    if(error.responseJSON.errors.title){
                        $('#title_error').text(error.responseJSON.errors.title);
                    }else{
                        $('#title_error').text('');
                    }
                    if(error.responseJSON.errors.slug){
                        $('#slug_error').text(error.responseJSON.errors.slug);
                    }else{
                        $('#slug_error').text('');
                    }
                    if(error.responseJSON.errors.sub_title){
                        $('#sub_title_error').text(error.responseJSON.errors.sub_title);
                    }else{
                        $('#sub_title_error').text('');
                    }
                    if(error.responseJSON.errors.description){
                        $('#description_error').text(error.responseJSON.errors.description);
                    }else{
                        $('#description_error').text('');
                    }
                    $('#edit-unit-btn').attr("disabled", false);
                    $('#edit-unit-btn').html("Update");

                }
            });
        });
    });

    // AUTO SLUG GENERATE
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        slugInput.setAttribute('readonly', true);

        titleInput.addEventListener('input', function () {
            const title = titleInput.value.trim();
            const slug = generateSlug(title);
            slugInput.value = slug;
        });

        function generateSlug(title) {
            return title
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });
</script>
