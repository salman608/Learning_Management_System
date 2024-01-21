@extends('admin.admin_dashboard')
@section('admin_content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Coupon</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.all.coupon') }}" class="btn btn-primary">+ All Coupon</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body p-4">

                <form id="myForm" action="{{ route('admin.store.coupon') }}" method="POST" enctype="multipart/form-data"
                    class="row g-3">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="coupon_name" class="form-label">Coupon Name</label>
                        <input type="text" name="coupon_name" class="form-control" id="coupon_name"
                            placeholder="Coupon Name">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="coupon_discount" class="form-label">Coupon Discount</label>
                        <input type="text" name="coupon_discount" class="form-control" id="coupon_discount"
                            placeholder="Coupon discount">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="coupon_validity" class="form-label">Coupon Validity</label>
                        <input type="date" name="coupon_validity" class="form-control" id="coupon_validity"
                            placeholder="Coupon validity" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>



                    <div class="col-md-12 mt-1">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Change</button>

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
                    coupon_name: {
                        required: true,
                    },

                    coupon_discount: {
                        required: true,
                    },

                    coupon_validity: {
                        required: true,
                    },

                },
                messages: {
                    coupon_name: {
                        required: 'Please Enter Coupon Name',
                    },
                    coupon_discount: {
                        required: 'Please Enter Coupon Discount',
                    },
                    coupon_validity: {
                        required: 'Please Enter Coupon validity',
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
@endsection
