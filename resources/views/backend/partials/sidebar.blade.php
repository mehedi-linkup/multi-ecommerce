<div class="sl-logo"><a href="{{ route('admin.dashboard') }}"><i class="icon ion-android-star-outline"></i> FlipMart</a></div>
<div class="sl-sideleft">
    

    <div class="sl-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @isset(auth()->user()->role->permission['permission']['brand']['list'])
        <a href="{{ route('admin.brands') }}" class="sl-menu-link @yield('brands')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Brand</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @endisset
        
        @isset(auth()->user()->role->permission['permission']['cat']['list'])
        <a href="#" class="sl-menu-link @yield('categories')">
            <div class="sl-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Categories</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.categories') }}" class="nav-link @yield('view-category')">View Category</a></li>
            <li class="nav-item"><a href="{{ route('admin.subcategories') }}" class="nav-link @yield('view-subcategory')">View Sub Category</a></li>
            <li class="nav-item"><a href="{{ route('admin.subsubcategories') }}" class="nav-link @yield('view-subsubcategory')">View Sub Sub-Category</a></li>
        </ul>
        @endisset
        
        @isset(auth()->user()->role->permission['permission']['product']['list'])
        <a href="{{ route('admin.products') }}" class="sl-menu-link @yield('products')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">Products</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @endisset
        
        @isset(auth()->user()->role->permission['permission']['slider']['list'])
        <a href="{{ route('admin.sliders') }}" class="sl-menu-link @yield('slider')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-nutrition-outline tx-24"></i>
                <span class="menu-item-label">Slider</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @endisset
        
        <a href="{{ route('admin.coupons') }}" class="sl-menu-link @yield('coupon')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Coupon</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" class="sl-menu-link @yield('shippings')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Shipping Area</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.divisions') }}" class="nav-link @yield('division')">Division</a></li>
            <li class="nav-item"><a href="{{ route('admin.districts') }}" class="nav-link @yield('district')">District</a></li>
            <li class="nav-item"><a href="{{ route('admin.states') }}" class="nav-link @yield('state')">State</a></li>
        </ul>
        <a href="#" class="sl-menu-link @yield('orders')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i>
                <span class="menu-item-label">Orders</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.pending.orders') }}" class="nav-link @yield('pending')">Pending Order</a></li>
            <li class="nav-item"><a href="{{ route('admin.confirm.order') }}" class="nav-link @yield('confirm')">Confirm Order</a></li>
            <li class="nav-item"><a href="{{ route('admin.processing.order') }}" class="nav-link @yield('processing')">Processing Order</a></li>
            <li class="nav-item"><a href="{{ route('admin.picked.order') }}" class="nav-link @yield('picked')">Picked Order</a></li>
            <li class="nav-item"><a href="{{ route('admin.shipped.order') }}" class="nav-link @yield('shipped')">Shipped Order</a></li>
            <li class="nav-item"><a href="{{ route('admin.delivered.order') }}" class="nav-link @yield('delivered')">Delivered Order</a></li>
            <li class="nav-item"><a href="{{ route('admin.canceled.order') }}" class="nav-link @yield('canceled')">Canceled Order</a></li>
        </ul>
        <a href="{{ route('admin.reports') }}" class="sl-menu-link @yield('report')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                <span class="menu-item-label">Reports</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ route('customer.reviews') }}" class="sl-menu-link @yield('review')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-star-outline tx-24"></i>
                <span class="menu-item-label">Reviews</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="{{ route('product.stock') }}" class="sl-menu-link @yield('stock')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-stopwatch-outline tx-24"></i>
                <span class="menu-item-label">Stock Management</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" class="sl-menu-link @yield('roles')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                <span class="menu-item-label">Role Management</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('role.create') }}" class="nav-link @yield('add-role')">Add Role</a></li>
            <li class="nav-item"><a href="{{ route('role.index') }}" class="nav-link @yield('view-role')">All Role</a></li>
        </ul>
        
        <a href="#" class="sl-menu-link @yield('permissions')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-rose-outline tx-22"></i>
                <span class="menu-item-label">Permission Manage</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('permission.index') }}" class="nav-link @yield('all-permission')">All Permission</a></li>
            <li class="nav-item"><a href="{{ route('permission.create') }}" class="nav-link @yield('add-permission')">Add Permission</a></li>
        </ul>
        
        <a href="#" class="sl-menu-link @yield('subadmins')">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-personadd-outline tx-22"></i>
                <span class="menu-item-label">Subadmin Manage</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('subadmin.index') }}" class="nav-link @yield('all-permission')">All Subadmin</a></li>
            <li class="nav-item"><a href="{{ route('subadmin.create') }}" class="nav-link @yield('add-permission')">Add Subadmin</a></li>
        </ul>
    </div><!-- sl-sideleft-menu -->

    <br>
</div><!-- sl-sideleft -->