@extends('admin.admin_dashboard')
@section('admin_content')
    <style>
        .large-checkbox {
            transform: scale(1.5);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Course</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Courses</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>course Name</th>
                                <th>Instructor Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($item->course_image) }}" alt="" width="70"
                                            height="40">
                                    </td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item['user']['name'] }}</td>
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    <td>{{ $item->selling_price }}</td>

                                    <td>
                                        <a href="{{ route('edit.category', $item->id) }}" class="btn btn-sm btn-info"><i
                                                class="lni lni-eye"></i></a>

                                    </td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                                id="flexSwitchCheckChecked" data-course-id="{{ $item->id }}"
                                                {{ $item->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                var courseId = $(this).data('course-id');
                var isChecked = $(this).is(':checked');

                //send an ajax request
                $.ajax({
                    url: "{{ route('update.course.status') }}",
                    method: "POST",
                    data: {
                        course_id: courseId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },

                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function() {

                    }
                });
            })
        })
    </script>
@endsection
