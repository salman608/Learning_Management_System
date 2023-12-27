@extends('admin.admin_dashboard')
@section('admin_content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.category') }}" class="btn btn-primary">+ All Category</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body p-4">

                <form id="myForm" action="{{ route('update.category') }}" method="POST" enctype="multipart/form-data"
                    class="row g-3">
                    @csrf

                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name"
                            value="{{ $category->category_name }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" name="image" class="form-control" id="image" </div>

                        <div class="col-md-12 mt-1">
                            <label for="input2" class="form-label"></label>
                            <img id="showImage" src="{{ asset($category->image) }}" alt="Admin" class="p-1 bg-dark"
                                width="80">
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



    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
