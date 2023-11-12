@extends('layouts.admin_app')
@section('title')
    Edit Language
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit a Language</h4>
                        </div>
                        <div class="card-body">
                            <form id="edit-language" data-url="{{ route('language.update', $language->id) }}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{$language->name}}" placeholder="Enter Name" />
                                    <span id="name_error" class="text-danger"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{$language->slug}}" placeholder="Enter Slug" />
                                    <span id="slug_error" class="text-danger"></span>
                                </div>
                                <button id="edit-language-btn" type="submit" class="btn btn-success">
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
        $('#edit-language').submit(function(e) {
            e.preventDefault();
            $('#edit-language-btn').attr("disabled", true);
            $('#edit-language-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
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
                        toastr.success('Language updated successfully.');
                        $(location).prop('href', '{{route('language.index')}}');
                        $('#edit-language-btn').attr("disabled", false);
                        $('#edit-language-btn').html("Update");
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
                    $('#edit-grade-btn').attr("disabled", false);
                    $('#edit-grade-btn').html("Update");
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
