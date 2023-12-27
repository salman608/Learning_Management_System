@php
    $id = Auth::user()->id;
    $instructorId = App\Models\User::find($id);

    $status = $instructorId->status;
@endphp





<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if ($status === '1')
            <li class="menu-label">UI Elements</li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">eCommerce</div>
                </a>
                <ul>
                    <li> <a href="ecommerce-products.html"><i class='bx bx-radio-circle'></i>Products</a>
                    </li>
                    <li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Product
                            Details</a>
                    </li>
                    <li> <a href="ecommerce-add-new-products.html"><i class='bx bx-radio-circle'></i>Add New
                            Products</a>
                    </li>
                    <li> <a href="ecommerce-orders.html"><i class='bx bx-radio-circle'></i>Orders</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Components</div>
                </a>
                <ul>
                    <li> <a href="component-alerts.html"><i class='bx bx-radio-circle'></i>Alerts</a>
                    </li>
                    <li> <a href="component-accordions.html"><i class='bx bx-radio-circle'></i>Accordions</a>
                    </li>

                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-repeat"></i>
                    </div>
                    <div class="menu-title">Content</div>
                </a>
                <ul>
                    <li> <a href="content-grid-system.html"><i class='bx bx-radio-circle'></i>Grid System</a>
                    </li>
                    <li> <a href="content-typography.html"><i class='bx bx-radio-circle'></i>Typography</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="user-profile.html">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">User Profile</div>
                </a>
            </li>

            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-error"></i>
                    </div>
                    <div class="menu-title">Errors</div>
                </a>
                <ul>
                    <li> <a href="errors-404-error.html" target="_blank"><i class='bx bx-radio-circle'></i>404
                            Error</a>
                    </li>
                    <li> <a href="errors-500-error.html" target="_blank"><i class='bx bx-radio-circle'></i>500
                            Error</a>
                    </li>
                    <li> <a href="errors-coming-soon.html" target="_blank"><i class='bx bx-radio-circle'></i>Coming
                            Soon</a>
                    </li>
                    <li> <a href="error-blank-page.html" target="_blank"><i class='bx bx-radio-circle'></i>Blank
                            Page</a>
                    </li>
                </ul>
            </li>
        @else
        @endif




    </ul>
    <!--end navigation-->
</div>
