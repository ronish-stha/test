<div class="sidebar" data-active-color="purple" data-background-color="black"
     data-image="{{URL::asset('img/admin/sidebar-1.jpg') }}">
    <div class="logo">
        <a href="{{ route('index')  }}" class="simple-text">
            Liquor Store
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="" class="simple-text">

        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{URL::asset('img/user.png')}}"/>
            </div>
            <div class="info">
                @php
                    $liClass = Helper::getActiveClass('admin/change-password')
                @endphp
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('password') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.edit') }}">Edit Credentials</a>
                        </li>
                        <form action="{{ route('admin.logout') }}" id="adminLogout">
                            {{ csrf_field() }}
                        </form>
                        <li>
                            <a href="#" onclick="document.getElementById('adminLogout')">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li {{ Helper::getActiveClass('admin/dashboard') }}>
                <a href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/order*') }}>
                <a href="{{ route('order.index') }}">
                    <i class="material-icons">add_shopping_cart</i>
                    <p>Orders</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/sales') }}>
                <a href="{{ route('sales.index') }}">
                    <i class="material-icons">credit_card</i>
                    <p>Sales</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/category') }}>
                <a href="{{ route('category.index') }}">
                    <i class="material-icons">category</i>
                    <p>Categories</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/products*') }}>
                <a href="{{ route('products.index') }}">
                    <i class="material-icons">sports_bar</i>
                    <p>Products</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/seller-product*') }}>
                <a href="{{ route('admin.seller-product.index') }}">
                    <i class="material-icons">sports_bar</i>
                    <p>Seller Products</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/customer*') }}>
                <a href="{{ route('customer.index') }}">
                    <i class="material-icons">person</i>
                    <p>Customers</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/sellers*') }}>
                <a href="{{ route('sellers.index') }}">
                    <i class="material-icons">assignment_ind</i>
                    <p>Seller</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/content*') }}>
                <a href="{{ route('content.index') }}">
                    <i class="material-icons">description</i>
                    <p>Content</p>
                </a>
            </li>
            <li {{ Helper::getActiveClass('admin/banner-ad*') }}>
                <a href="{{ route('banner-ad.index') }}">
                    <i class="material-icons">redeem</i>
                    <p>Banner Ad</p>
                </a>
            </li>
           {{-- @php
                $liClass = Helper::getActiveClass('admin/banner*')
            @endphp
            <li {{ $liClass }}>
                <a data-toggle="collapse" href="#banner-toggle">
                    <i class="material-icons">insert_photo</i>
                    <p>Banners
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="{{ $liClass == '' ? 'collapse' : 'collapse in' }}" id="banner-toggle">
                    <ul class="nav">
                        <li {{ Helper::getActiveClass('admin/banner') }}>
                            <a href="{{ route('banner.index') }}">View</a>
                        </li>
                        <li {{ Helper::getActiveClass('admin/banner/create') }}>
                            <a href="{{ route('banner.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>--}}

            {{--<li {{ Helper::getActiveClass('admin/review*') }}>
                <a href="{{ route('review.index') }}">
                    <i class="material-icons">star_rate</i>
                    <p>Reviews</p>
                </a>
            </li>--}}
            {{--<li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="material-icons">apps</i>
                    <p>Testimonials
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li>
                            <a href="{{  route('testimonial.index') }}">List</a>
                        </li>
                        <li>
                            <a href="{{  route('testimonial.create') }}">Create</a>
                        </li>
                    </ul>
                </div>
            </li>--}}
        </ul>
    </div>
</div>
