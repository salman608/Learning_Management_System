@extends('instructor.instructor_dashboard')
@section('instructor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Courses</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Course</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.course') }}" class="btn btn-primary">+ Add Course</a>
                </div>
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
                                <th>Course Image</th>
                                <th>Course Name</th>
                                <th>Ctegory</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($item->course_image) }}" alt="" width="70"
                                            height="50">
                                    </td>
                                    <td>{{ $item->course_name }}</td>
                                    <td>{{ $item['category']['category_name'] }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->discount_price }}</td>
                                    <td>
                                        <a href="{{ route('edit.course', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('delete.course', $item->id) }}" class="btn btn-sm btn-danger"
                                            id="delete">Delete</a>
                                    </td>

                                </tr>
                            @endforeach


                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
