@extends('layouts.admin_app')
@section('title')
    Edit Grade
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit a Grade</h4>
                        </div>
                        <div class="card-body">
                            <form id="edit-grade" data-url="{{ route('grade.update', $grade->id) }}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{$grade->name}}" placeholder="Enter Name" />
                                    <span id="name_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{$grade->slug}}" placeholder="Enter Slug" />
                                    <span id="slug_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" id="image" name="image" class="form-control" />
                                    <img id="gradeImage" src="{{asset($grade->image)}}" alt="" width="100" class="img-thumbnail mt-2">
                                    <span id="image_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <select class="form-control mb-3" name="status" id="is_status">
                                        <option value="1" {{$grade->status==1? 'selected':''}}>Active</option>
                                        <option value="0" {{$grade->status==0? 'selected':''}}>Inactive</option>
                                    </select>
                                    <span id="status_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="form-check d-flex">
                                        <input class="form-check-input" type="checkbox" value="1" id="is_feature" name="is_feature" {{ $grade->is_feature== 1 ? 'checked':'' }}>
                                        <label class="form-check-label" for="is_feature" style="margin-left: 10px;">
                                            Is Feature
                                        </label>
                                        <span id="is_feature_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <button id="edit-grade-btn" type="submit" class="btn btn-success">
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
        $('#edit-grade').submit(function(e) {
            e.preventDefault();
            $('#edit-grade-btn').attr("disabled", true);
            $('#edit-grade-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
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
                        toastr.success('Grade updated successfully.');
                        $(location).prop('href', '{{route('grade.index')}}');
                        $('#edit-grade-btn').attr("disabled", false);
                        $('#edit-grade-btn').html("Update");
                    }
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
                    $('#edit-grade-btn').attr("disabled", false);
                    $('#edit-grade-btn').html("Update");
                }
            });

            // Update the image URL
            var fileInput = document.getElementById('image');
            var file = fileInput.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#gradeImage').attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
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
