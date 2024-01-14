@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp


    <div class="container-fluid">


        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">My Bookmarks</h3>
        </div>
        <div class="row" id="wishlist">



        </div><!-- end row -->

    </div><!-- end container-fluid -->
@endsection
