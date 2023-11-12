@extends('layouts.admin_app')
@section('title')
    Add Unit
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add a Unit</h4>
                        </div>
                        <div class="card-body">
                            <form class="tablelist-form" autocomplete="off" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" />
                                        <span id="title_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Enter Slug" />
                                        <span id="slug_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Sub Title</label>
                                        <input type="text" name="sub_title" id="sub_title" class="form-control" placeholder="Enter Sub Title" />
                                        <span id="sub_title_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
                                    <script>
                                        CKEDITOR.replace('description',{
                                            height:150,
                                        });
                                    </script>
                                    <span id="description_error" class="text-danger"></span>
                                </div>
                                <button id="add-unit-btn" type="submit" class="btn btn-success">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Add Unit
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
        $('#add-unit-btn').click(function (e) {
            e.preventDefault();
            $('#add-unit-btn').attr("disabled", true);
            $('#add-unit-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var description = CKEDITOR.instances.description.getData();
            var data= {
                '_token': "{{ csrf_token() }}",
                'title': document.getElementById("title").value,
                'slug': document.getElementById("slug").value,
                'sub_title': document.getElementById("sub_title").value,
                'description': description,
                'course_id': {{$course->id}},
                'grade_id': {{$course->grade_id}},
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('unit.store')}}",
                data: data,
                dataType: "json",
                success: function (response) {
                    toastr.success('Unit Added Successfully');
                    $(location).prop('href', '{{route('course.show',$course->id)}}');
                    $('#add-unit-btn').attr("disabled", false);
                    $('#add-unit-btn').html("Add Unit");
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
                    $('#add-unit-btn').attr("disabled", false);
                    $('#add-unit-btn').html("Add Unit");

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
