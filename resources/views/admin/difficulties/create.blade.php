@extends('layouts.admin_app')
@section('title')
    Add Difficulty
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add a Difficulty</h4>
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
                                <button id="add-difficulty-btn" type="submit" class="btn btn-success">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Add Difficulty
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
        $('#add-difficulty-btn').click(function (e) {
            e.preventDefault();
            $('#add-difficulty-btn').attr("disabled", true);
            $('#add-difficulty-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            var data = new FormData();
            data.append('_token', "{{ csrf_token() }}");
            data.append('name', document.getElementById("name").value);
            data.append('slug', document.getElementById("slug").value);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('difficulties.store')}}",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success('Difficulty Added Successfully');
                    $(location).prop('href', '{{route('difficulties.index')}}');
                    $('#add-difficulty-btn').attr("disabled", false);
                    $('#add-difficulty-btn').html("Add Difficulty");
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
                    $('#add-difficulty-btn').attr("disabled", false);
                    $('#add-difficulty-btn').html("Add Difficulty");

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
