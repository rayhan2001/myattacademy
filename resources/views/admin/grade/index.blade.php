@extends('layouts.admin_app')
@section('title')
    Grades
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Grade Lists</h4>
                        </div>
                        <div class="card-body">
                            <div id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{route('grade.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add</a>
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
                                        <tr>
                                            <th class="sort" data-sort="name">Name</th>
                                            <th class="sort" data-sort="slug">Slug</th>
                                            <th class="sort" data-sort="image">Image</th>
                                            <th class="sort" data-sort="status">Status</th>
                                            <th class="sort" data-sort="is_feature">Is Feature</th>
                                            <th class="sort" data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($grades as $grade)
                                        <tr>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="name">{{$grade->name}}</td>
                                            <td class="slug">{{$grade->slug}}</td>
                                            <td class="image">
                                                <div class="align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{$grade->image}}" alt="" class="avatar-xs rounded-circle">
                                                    </div>
                                                </div>
                                            </td>
                                            @if($grade->status == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-primary text-uppercase">Inactive</span></td>
                                            @endif
                                            @if($grade->is_feature == 1)
                                            <td class="is_feature"><span class="badge badge-soft-success text-uppercase">Yes</span></td>
                                            @else
                                                <td class="is_feature"><span class="badge badge-soft-primary text-uppercase">No</span></td>
                                            @endif
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="{{route('grade.edit',$grade->id)}}" class="btn btn-sm btn-success ">Edit</a>
                                                    </div>
                                                    <div class="remove">
                                                        <a href="#" class="btn btn-sm btn-danger remove-grade-btn" data-id="{{ $grade->id }}">Remove</a>
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
        $('.remove-grade-btn').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = '{{ route("grade.destroy", ":id") }}';
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
                                    $(`.remove-grade-btn[data-id="${id}"]`).closest('tr').remove();
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
