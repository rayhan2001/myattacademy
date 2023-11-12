@extends('layouts.admin_app')
@section('title')
    Courses
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Course Lists</h4>
                        </div>
                        <div class="card-body">
                            <div id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{route('course.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add</a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                        <tr class="text-center">
                                            <th class="sort" data-sort="course_name">Course Name</th>
                                            <th class="sort" data-sort="instructor_name">Instructor Name</th>
                                            <th class="sort" data-sort="price">Price</th>
                                            <th class="sort" data-sort="difficulties">Difficulties</th>
                                            <th class="sort" data-sort="language">Language</th>
                                            <th class="sort" data-sort="course_type">Course Type</th>
                                            <th class="sort" data-sort="grade">Grade</th>
                                            <th class="sort" data-sort="intro_video">Intro Video</th>
                                            <th class="sort" data-sort="course_status">Course Status</th>
                                            <th class="sort" data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($courses as $course)
                                            <tr class="text-center">
                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                <td class="course_name">{{$course->course_name}}</td>
                                                <td class="instructor_name">{{$course->instructor_name}}</td>
                                                <td class="price">{{$course->price}}</td>
                                                <td class="difficulties">{{$course->difficulties}}</td>
                                                <td class="language">{{$course->language->name}}</td>
                                                <td class="course_type">{{$course->course_type}}</td>
                                                <td class="grade">{{$course->grade->name}}</td>
                                                <td class="intro_video">
                                                    @if($course->intro_video ==1)
                                                        <span>Yes</span>
                                                    @else
                                                        <span>No</span>
                                                    @endif
                                                </td>
                                                <td class="course_status">
                                                    @if($course->course_status ==1)
                                                        <span>Yes</span>
                                                    @else
                                                        <span>No</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <div class="show">
                                                            <a href="{{route('course.show',$course->id)}}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Unit"><i class="fa-regular fa-eye"></i></a>
                                                        </div>
                                                        <div class="edit">
                                                            <a href="{{route('course.edit',$course->id)}}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                                        </div>
                                                        <div class="remove">
                                                            <a href="#" class="btn btn-sm btn-danger remove-course-btn" data-id="{{ $course->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fa-regular fa-trash-can"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.remove-course-btn').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = '{{ route("course.destroy", ":id") }}';
            url = url.replace(':id', id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id':id,
                        },
                        success: function(response) {
                            if(response.status==200){
                                swal.fire({
                                    title: 'Deleted!',
                                    text: 'The item has been deleted successfully.',
                                    icon: 'success',
                                }).then(function () {
                                    $(`.remove-course-btn[data-id="${id}"]`).closest('tr').remove();
                                });
                            }
                        },
                        error: function(response) {
                            swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting the item.',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
