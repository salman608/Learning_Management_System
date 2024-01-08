@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Lecture</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.course.lecture', ['id' => $clecture->course_id]) }}"
                        class="btn btn-primary">Back</a>
                </div>
            </div>

        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body p-4">

                <form id="myForm" action="{{ route('update.course.lecture') }}" method="POST"
                    enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $clecture->id }}">
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Lecture Title</label>
                        <input type="text" name="lecture_title" class="form-control" id="lecture_title"
                            value="{{ $clecture->lecture_title }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Lecture Video Url</label>
                        <input type="text" name="url" class="form-control" id="category_name"
                            value="{{ $clecture->url }}">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Lecture Content</label>

                        <textarea name="content" class="form-control">{!! $clecture->content !!}</textarea>
                    </div>



                    <div class="col-md-12 mt-1">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
