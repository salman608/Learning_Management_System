@extends('admin.admin_dashboard')
@section('admin_content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Sub Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add SubCategory</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.subcategory') }}" class="btn btn-primary">+ All SubCategory</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body p-4">

                <form id="myForm" action="{{ route('store.subcategory') }}" method="POST" class="row g-3">
                    @csrf


                    <div class="form-group col-md-12">
                        <label for="input19" class="form-label">Category Name</label>
                        <select id="input19" class="form-select" name="category_id">
                            <option selected="" disabled>Choose Category...</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach


                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Sub Category Name</label>
                        <input type="text" name="subcategory_name" class="form-control" id="category_name"
                            placeholder="Category Name">
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
            $('#myForm').validate({
                rules: {
                    category_id: {
                        required: true,
                    },

                    subcategory_name: {
                        required: true,
                    },

                },
                messages: {
                    category_id: {
                        required: 'Please Enter Category Name',
                    },
                    subcategory_name: {
                        required: 'Please Enter Sub Category Name',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

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
