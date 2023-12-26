@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
            <form method="post" action="" class="row">
                <div class="input-box col-lg-4">
                    <label class="label-text">Old Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('old_password') @enderror" type="password"
                            name="old_password" id="old_password" placeholder="Old Password">
                        <span class="la la-lock input-icon"></span>
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('new_password') @enderror" type="password"
                            name="new_password" id ="new_password" placeholder="New Password">
                        <span class="la la-lock input-icon"></span>
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">Confirm New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="password" name="new_password_confirmation"
                            id="new_password_confirmation" placeholder="Confirm New Password">
                        <span class="la la-lock input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 py-2">
                    <button class="btn theme-btn">Change Password</button>
                </div><!-- end input-box -->
            </form>
            <form method="post" class="pt-5 mt-5 border-top border-top-gray">
                <h3 class="fs-17 font-weight-semi-bold pb-1">Forgot Password then Recover Password</h3>
                <p class="pb-4">Enter the email of your account to reset password. Then you will receive a link to email
                    to reset the password. If you have any issue about reset password
                    <a href="contact.html" class="text-color">contact us</a>
                </p>
                <div class="input-box">
                    <label class="label-text">Email Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email"
                            placeholder="Enter email address">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box py-2">
                    <button class="btn theme-btn">Recover Password</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
@endsection
