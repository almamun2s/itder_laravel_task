<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('admin/images/myPhoto2.jpg') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ auth()->user()->name }}</h4>
                {{-- <span class="text-muted">{{ auth()->user()->getRoleNames()->first() }}</span> --}}
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="{{ request()->routeIs('admin.dashboard.index') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
                        <i class="fa-solid fa-table-columns"></i><span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="
                        @if (request()->routeIs('admin.category.index') ||
                                request()->routeIs('admin.category.edit') ||
                                request()->routeIs('admin.category.create')) mm-active @endif
                        ">
                    <a href="#" class="waves-effect">
                        <i class="fa-solid fa-list"></i><span>Category</span>
                    </a>
                </li>

                <li class="
                    @if (request()->routeIs('admin.product.index') ||
                            request()->routeIs('admin.product.edit') ||
                            request()->routeIs('admin.product.create')) mm-active @endif
                ">
                    <a href="#" class="waves-effect">
                        <i class="fa-solid fa-shirt"></i><span>Product</span>
                    </a>
                </li>

                <li
                    class="
                        @if (request()->routeIs('admin.order.index') || request()->routeIs('admin.order.show')) mm-active @endif
                    ">
                    <a href="#" class="waves-effect">
                        <i class="fa-solid fa-bag-shopping"></i>
                        {{-- @php
                            $orders = App\Models\Order::where('status', App\Enum\OrderStatus::PENDING->value)->get();
                        @endphp --}}
                        {{-- @if ($orders->count() > 0)
                            <span
                                class="badge rounded-pill bg-warning text-black float-end">{{ $orders->count() }}</span>
                        @endif --}}
                        <span>Orders</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);">
                        <i class="fa-solid fa-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Customers</a></li>
                        <li><a href="#">Admins</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
