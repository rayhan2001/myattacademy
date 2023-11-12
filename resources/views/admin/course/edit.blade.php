@extends('layouts.admin_app')
@section('title')
    Edit Course
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit a Course</h4>
                        </div>
                        <div class="card-body">
                            <form id="edit-course" data-url="{{ route('course.update', $course->id) }}">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Course Name</label>
                                        <input type="text" name="course_name" value="{{$course->course_name}}" id="course_name" class="form-control" placeholder="Enter Course Name" />
                                        <span id="name_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" value="{{$course->slug}}" name="slug" class="form-control" placeholder="Enter Slug" />
                                        <span id="slug_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Instructor Name</label>
                                        <input type="text" name="instructor_name" value="{{$course->instructor_name}}" id="instructor_name" class="form-control" placeholder="Enter Name" />
                                        <span id="instructor_name_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Price</label>
                                        <input type="text" id="price" name="price" value="{{$course->price}}" class="form-control" placeholder="Enter Price" />
                                        <span id="price_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Difficulties</label>
                                        <select class="form-control" name="difficulties" id="difficulties">
                                            <option></option>
                                            <option value="Beginner" {{ $course->difficulties == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="Intermediate" {{ $course->difficulties == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="Expert" {{ $course->difficulties == 'Expert' ? 'selected' : '' }}>Expert</option>
                                        </select>
                                        <span id="difficulties_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Language</label>
                                        <select class="form-control" name="language" id="language">
                                            <option></option>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}" {{$course->language_id==$language->id? 'selected':''}}>{{$language->name}}</option>
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
                                            <option value="Free" {{ $course->course_type == 'Free' ? 'selected' : '' }}>Free</option>
                                            <option value="Paid" {{ $course->course_type == 'Paid' ? 'selected' : '' }}>Paid</option>
                                        </select>
                                        <span id="course_type_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Select Grade</label>
                                        <select class="form-control" name="grade" id="grade">
                                            <option></option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" {{$course->grade_id==$grade->id? 'selected':''}}>{{$grade->name}}</option>
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
                                            <option value="1" {{ $course->course_status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $course->course_status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <span id="course_status_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <label for="name" class="form-label">Intro Video</label>
                                        <div class="d-flex justify-content-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="intro_video" id="yes_btn" {{ $course->intro_video == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="yes_btn">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-left: 15px;">
                                                <input class="form-check-input" type="radio" value="0" name="intro_video" id="no_btn" {{ $course->intro_video == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="no_btn">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <span id="intro_video_error" class="text-danger"></span>
                                    </div>
                                    @if($course->intro_video == 1)
                                    <div class="col-md-6" id="videoLink">
                                        <label for="">Link</label>
                                        <input type="url" class="form-control" value="{{$course->video_link}}" name="video_link" id="video_link" placeholder="Enter video link">
                                        <span id="video_link_error"></span>
                                    </div>
                                    @else
                                        <div class="col-md-6" id="videoLink" style="display: none;">
                                            <label for="">Link</label>
                                            <input type="url" class="form-control" name="video_link" id="video_link" placeholder="Enter video link">
                                            <span id="video_link_error"></span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Short Description</label>
                                    <textarea name="short_description" id="short_description" class="form-control">{!! $course->short_description !!}</textarea>
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
                                    <textarea name="long_description" id="long_description" class="form-control">{!! $course->long_description !!}</textarea>
                                    <script>
                                        CKEDITOR.replace('long_description',{
                                            height:150,
                                        });
                                    </script>
                                    <span id="long_description_error" class="text-danger"></span>
                                </div>
                                <button id="edit-course-btn" type="submit" class="btn btn-success">
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
        $('#edit-course').submit(function(e) {
            e.preventDefault();
            $('#edit-course-btn').attr("disabled", true);
            $('#edit-course-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var short_description = CKEDITOR.instances.short_description.getData();
            var long_description = CKEDITOR.instances.long_description.getData();
            var intro_video = $('input[name="intro_video"]:checked').val();
            var url = $(this).data('url');
            var data = new FormData(this);
            data.append('intro_video', intro_video);
            data.append('short_description', short_description);
            data.append('long_description', long_description);

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
                    toastr.success('Course Update Successfully');
                    $(location).prop('href', '{{route('course.index')}}');
                    $('#edit-course-btn').attr("disabled", false);
                    $('#edit-course-btn').html("Update");
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
                    $('#edit-course-btn').attr("disabled", false);
                    $('#edit-course-btn').html("Update");

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
            $('#video_link').val("");
        });
    });
</script>
