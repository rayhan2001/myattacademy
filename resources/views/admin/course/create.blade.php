@extends('layouts.admin_app')
@section('title')
    Add Course
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add a Course</h4>
                        </div>
                        <div class="card-body">
                            <form class="tablelist-form" autocomplete="off" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Course Name</label>
                                        <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Enter Course Name" />
                                        <span id="name_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Enter Slug" />
                                        <span id="slug_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Instructor Name</label>
                                        <input type="text" name="instructor_name" id="instructor_name" class="form-control" placeholder="Enter Name" />
                                        <span id="instructor_name_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Price</label>
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter Price" />
                                        <span id="price_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Difficulties</label>
                                        <select class="form-control" name="difficulties" id="difficulties">
                                            <option></option>
                                            <option value="Beginner">Beginner</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Expert">Expert</option>
                                        </select>
                                        <span id="difficulties_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Language</label>
                                        <select class="form-control" name="language" id="language">
                                            <option></option>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                        <span id="language_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Course Type</label>
                                        <select class="form-control" name="course_type" id="course_type">
                                            <option></option>
                                            <option value="Free">Free</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                        <span id="course_type_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Select Grade</label>
                                        <select class="form-control" name="grade" id="grade">
                                            <option></option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                        <span id="grade_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label">Course Status</label>
                                        <select class="form-control" name="course_status" id="course_status">
                                            <option></option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <span id="course_status_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <label for="name" class="form-label">Intro Video</label>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="intro_video" id="yes_btn">
                                                <label class="form-check-label" for="yes_btn">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-left: 15px;">
                                                <input class="form-check-input" type="radio" value="0" name="intro_video" id="no_btn">
                                                <label class="form-check-label" for="no_btn">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <span id="intro_video_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6" id="videoLink" style="display: none">
                                        <label for="">Link</label>
                                        <input type="url" class="form-control" name="video_link" id="video_link" placeholder="Enter video link">
                                        <span id="video_link_error"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Short Description</label>
                                    <textarea name="short_description" id="short_description" class="form-control"></textarea>
                                    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
                                    <script>
                                        CKEDITOR.replace('short_description',{
                                            height:100,
                                        });
                                    </script>
                                    <span id="short_description_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Long Description</label>
                                    <textarea name="long_description" id="long_description" class="form-control"></textarea>
                                    <script>
                                        CKEDITOR.replace('long_description',{
                                            height:150,
                                        });
                                    </script>
                                    <span id="long_description_error" class="text-danger"></span>
                                </div>
                                <button id="add-course-btn" type="submit" class="btn btn-success">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Add Course
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
        $('#add-course-btn').click(function (e) {
            e.preventDefault();
            $('#add-course-btn').attr("disabled", true);
            $('#add-course-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var short_description = CKEDITOR.instances.short_description.getData();
            var long_description = CKEDITOR.instances.long_description.getData();
            var intro_video = $('input[name="intro_video"]:checked').val();
            var data = new FormData();
            data.append('_token', "{{ csrf_token() }}");
            data.append('course_name', document.getElementById("course_name").value);
            data.append('slug', document.getElementById("slug").value);
            data.append('instructor_name', document.getElementById("instructor_name").value);
            data.append('price', document.getElementById("price").value);
            data.append('difficulties', document.getElementById("difficulties").value);
            data.append('language', document.getElementById("language").value);
            data.append('course_type', document.getElementById("course_type").value);
            data.append('grade', document.getElementById("grade").value);
            data.append('course_status', document.getElementById("course_status").value);
            data.append('intro_video', intro_video);
            data.append('video_link', document.getElementById("video_link").value);
            data.append('short_description', short_description);
            data.append('long_description', long_description);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('course.store')}}",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success('Course Added Successfully');
                    $(location).prop('href', '{{route('course.index')}}');
                    $('#add-course-btn').attr("disabled", false);
                    $('#add-course-btn').html("Add Course");
                },
                error: function(error) {
                    if(error.responseJSON.errors.course_name){
                        $('#name_error').text(error.responseJSON.errors.course_name);
                    }else{
                        $('#name_error').text('');
                    }
                    if(error.responseJSON.errors.slug){
                        $('#slug_error').text(error.responseJSON.errors.slug);
                    }else{
                        $('#slug_error').text('');
                    }
                    if(error.responseJSON.errors.instructor_name){
                        $('#instructor_name_error').text(error.responseJSON.errors.instructor_name);
                    }else{
                        $('#instructor_name_error').text('');
                    }
                    if(error.responseJSON.errors.price){
                        $('#price_error').text(error.responseJSON.errors.price);
                    }else{
                        $('#price_error').text('');
                    }
                    if(error.responseJSON.errors && error.responseJSON.errors.difficulties){
                        $('#difficulties_error').text(error.responseJSON.errors.difficulties);
                    }else{
                        $('#difficulties_error').text('');
                    }
                    if(error.responseJSON.errors && error.responseJSON.errors.language){
                        $('#language_error').text(error.responseJSON.errors.language);
                    }else{
                        $('#language_error').text('');
                    }
                    if(error.responseJSON.errors && error.responseJSON.errors.course_type){
                        $('#course_type_error').text(error.responseJSON.errors.course_type);
                    }else{
                        $('#course_type_error').text('');
                    }
                    if(error.responseJSON.errors && error.responseJSON.errors.grade){
                        $('#grade_error').text(error.responseJSON.errors.grade);
                    }else{
                        $('#grade_error').text('');
                    }
                    if(error.responseJSON.errors && error.responseJSON.errors.course_status){
                        $('#course_status_error').text(error.responseJSON.errors.course_status);
                    }else{
                        $('#course_status_error').text('');
                    }
                    if(error.responseJSON.errors.intro_video){
                        $('#intro_video_error').text(error.responseJSON.errors.intro_video);
                    }else{
                        $('#intro_video_error').text('');
                    }
                    if(error.responseJSON.errors.video_link){
                        $('#video_link_error').text(error.responseJSON.errors.video_link);
                    }else{
                        $('#video_link_error').text('');
                    }
                    if(error.responseJSON.errors.short_description){
                        $('#short_description_error').text(error.responseJSON.errors.short_description);
                    }else{
                        $('#short_description_error').text('');
                    }
                    if(error.responseJSON.errors.long_description){
                        $('#long_description_error').text(error.responseJSON.errors.long_description);
                    }else{
                        $('#long_description_error').text('');
                    }
                    $('#add-course-btn').attr("disabled", false);
                    $('#add-course-btn').html("Add Course");

                }
            });
        });
    });

    // AUTO SLUG GENERATE
    document.addEventListener('DOMContentLoaded', function () {
        const course_nameInput = document.getElementById('course_name');
        const slugInput = document.getElementById('slug');

        slugInput.setAttribute('readonly', true);

        course_nameInput.addEventListener('input', function () {
            const course_name = course_nameInput.value.trim();
            const slug = generateSlug(course_name);
            slugInput.value = slug;
        });

        function generateSlug(course_name) {
            return course_name
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });

//    Show video link
    $(document).ready(function() {
        $('#yes_btn').click(function() {
            $('#videoLink').show();
        });

        $('#no_btn').click(function() {
            $('#videoLink').hide();
        });
    });
</script>
