<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;background-color: #EDEDED !important">
            <a href="{{ route('admin.dashboard') }}" class="site_title"><img src="{{ asset('customer/img/logo.png') }}" alt=""></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset(Auth::user()->avatar) }}" alt="..." class="img-circle profile_img" />
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li>
                        <a><i class="fa fa-list-alt"></i> Category <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('categories.index') }}"> List item</a></li>
                            <li><a href="{{ route('categories.create') }}">Create item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-google-wallet"></i> Brand <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('brands.index') }}"> List item</a></li>
                            <li><a href="{{ route('brands.create') }}">Create item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-flag"></i> Nation <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('nations.index') }}"> List item</a></li>
                            <li><a href="{{ route('nations.create') }}">Create item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-gears"></i> Product <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('products.index') }}"> List item</a></li>
                            <li><a href="{{ route('products.create') }}">Create item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-shopping-cart"></i> Order <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('orders.index') }}"> List item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-credit-card"></i> Payment <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('payments.index') }}"> List item</a></li>
                            <li><a href="{{ route('payments.create') }}"> Create item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-comment"></i> Comment <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('comments.index') }}"> List item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-star-half-full"></i> Rate <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('rates.index') }}"> List item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-globe"></i> Role <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('roles.index') }}"> List item</a></li>
                            <li><a href="{{ route('roles.create') }}">Create item</a></li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-users"></i> User <span class="fa fa-plus"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('users.index') }}"> List item</a></li>
                            <li><a href="{{ route('users.create') }}">Create item</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="e_commerce.html">E-commerce</a></li>
                            <li><a href="projects.html">Projects</a></li>
                            <li><a href="project_detail.html">Project Detail</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="profile.html">Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="page_403.html">403 Error</a></li>
                            <li><a href="page_404.html">404 Error</a></li>
                            <li><a href="page_500.html">500 Error</a></li>
                            <li><a href="plain_page.html">Plain Page</a></li>
                            <li><a href="login.html">Login Page</a></li>
                            <li><a href="pricing_tables.html">Pricing Tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#level1_1">Level One</a></li>
                            <li>
                                <a>Level One<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="level2.html">Level Two</a></li>
                                    <li><a href="#level2_1">Level Two</a></li>
                                    <li><a href="#level2_2">Level Two</a></li>
                                </ul>
                            </li>
                            <li><a href="#level1_2">Level One</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
