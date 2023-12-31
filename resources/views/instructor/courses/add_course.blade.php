@extends('instructor.instructor_dashboard')
@section('instructor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Course</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.course') }}" class="btn btn-primary">+ All Course</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="card-body p-4">

                <form id="myForm" action="{{ route('store.course') }}" method="POST" enctype="multipart/form-data"
                    class="row g-3">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" placeholder="Category Name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Title</label>
                        <input type="text" name="course_title" class="form-control" placeholder="course title">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="image" class="form-label">Course Image</label>
                        <input type="file" name="course_image" class="form-control" id="image" </div>
                    </div>
                    <div class="col-md-2">
                        <label for="input2" class="form-label"></label>
                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" class="p-1 bg-dark"
                            width="100">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Course Intro Video</label>
                        <input type="file" name="video" class="form-control" accept="video/mp4,v ideo/webm">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input19" class="form-label">Course Category</label>
                        <select id="input19" class="form-select" name="category_id">
                            <option selected="" disabled>Choose Category...</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input19" class="form-label">Course SubCategory</label>
                        <select id="input19" class="form-select" name="subcategory_id">
                            <option></option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input19" class="form-label">Certificate Available</label>
                        <select id="input19" class="form-select" name="cirtificate">
                            <option selected="" disabled>Choose Course Certificate...</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input19" class="form-label">Course Label</label>
                        <select id="input19" class="form-select" name="lavel">
                            <option selected="" disabled>Choose Course Label...</option>
                            <option value="Begginer">Begginer</option>
                            <option value="Middle">Middle</option>
                            <option value="Advance">Advance</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Course Price</label>
                        <input type="text" name="selling_price" class="form-control" placeholder="Course Price">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Course Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" placeholder="Course Discount">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Course duration</label>
                        <input type="text" name="duration" class="form-control" placeholder="Course duration">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Course Resources</label>
                        <input type="text" name="resources" class="form-control" placeholder="Course resources">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Prerequisites</label>
                        <textarea type="text" name="prerequisites" class="form-control" placeholder="Course Prerequisites"
                            rows="3"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Description</label>
                        <textarea type="text" name="description" class="form-control" id="myeditorinstance" rows="3"></textarea>
                    </div>
                    <p>Course Goal</p>
                    <!--   //////////// Goal Option /////////////// -->
                    <div class="row add_item">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="goals" class="form-label"> Goals </label>
                                <input type="text" name="course_goals[]" id="goals" class="form-control"
                                    placeholder="Goals ">
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 30px;">
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                        </div>
                    </div> <!---end row-->
                    <!--   //////////// Goal Option end/////////////// -->
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="bestseller"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Best Seller</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="featured"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="highestrated"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Highest Rated</label>
                            </div>
                        </div>
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

    {{-- Category by Subctegory show --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">


                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                placeholder="Goals  ">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    course_name: {
                        required: true,
                    },
                    course_title: {
                        required: true,
                    },

                    course_image: {
                        required: true,
                    },
                    // video: {
                    //     required: true,
                    // },
                    category_id: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    discount_price: {
                        required: true,
                    },
                    duration: {
                        required: true,
                    },
                    resources: {
                        required: true,
                    },
                    prerequisites: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    cirtificate: {
                        required: true,
                    },
                    lavel: {
                        required: true,
                    },


                },
                messages: {
                    course_name: {
                        required: 'Please Enter Course Name',
                    },
                    course_title: {
                        required: 'Please Enter Course Title',
                    },
                    course_image: {
                        required: 'Please Enter Course Image',
                    },

                    // video: {
                    //     required: 'Please Upload Course video',
                    // },
                    category_id: {
                        required: 'Please select category',
                    },
                    selling_price: {
                        required: 'Please Enter Course Price',
                    },
                    discount_price: {
                        required: 'Please Enter Course Discount',
                    },
                    duration: {
                        required: 'Please Enter Course Duration',
                    },
                    resources: {
                        required: 'Please Enter Course Resources',
                    },
                    prerequisites: {
                        required: 'Please Enter Course Pre require',
                    },
                    description: {
                        required: 'Please Enter Course Description',
                    },
                    cirtificate: {
                        required: 'Please Enter Course Certificate',
                    },
                    lavel: {
                        required: 'Please Enter Course Level',
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