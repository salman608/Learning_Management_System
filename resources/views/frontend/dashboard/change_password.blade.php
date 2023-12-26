@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
            <form method="post" action="{{ route('user.password.update') }}" class="row">
                @csrf
                <div class="input-box col-lg-12">
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
                <div class="input-box col-lg-12">
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
                <div class="input-box col-lg-12">
                    <label class="label-text">Confirm New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="password" name="new_password_confirmation"
                            id="new_password_confirmation" placeholder="Confirm New Password">
                        <span class="la la-lock input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 py-2">
                    <button type="submit" class="btn theme-btn">Change Password</button>
                </div><!-- end input-box -->
            </form>

        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
@endsection
