<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Admin Panel</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet">

</head>
<body class="nav-md">
    <div class="container-fluid body">
        <div class="main_container clearfix">
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                    <a href="{{ route('account') }}">Account</a>

                                      <a href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                          Logout
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                      </form>
                                  </li>
                              </ul>
                          </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <div class="col-md-2 left-col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ route('dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Admin Panel</span></a>
                    </div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ Storage::url('/uploads/avatars/'. Auth::user()->avatar) }}" class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->name}}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a hef="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home </a></li>
                                <li class="open_down"><a><i class="fa fa-edit"></i> Posts <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('admin.posts.create') }}">Add New Post</a></li>
                                        <li><a href="{{ route('admin.posts') }}">Posts list</a></li>
                                        <li><a href="{{ route('category.create') }}">Add new Category</a></li>
                                        <li><a href="{{ route('category.index') }}">Categories</a></li>
                                    </ul>
                                </li>
                                <li class="open_down"><a><i class="fa fa-edit"></i> Films <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('film.create') }}">Add New Films</a></li>
                                        <li><a href="{{ route('film.index') }}">Film list</a></li>
                                        <li><a href="{{ route('genre.create') }}">Add new Genre</a></li>
                                        <li><a href="{{ route('genre.index') }}">Genre list</a></li>
                                        <li><a href="{{ route('actor.create') }}">Add new Actor</a></li>
                                        <li><a href="{{ route('actor.index') }}">Actor list</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('users') }}"><i class="fa fa-users"></i> Users </a></li>
                                <li><a href="{{ route('admin.contact.index') }}"><i class="fa fa-envelope-open-o"></i> Contact Us </a></li>
                                <li class="open_down"><a><i class="fa fa-edit"></i> Products <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('admin.product.create') }}">Add New Product</a></li>
                                        <li><a href="{{ route('admin.product.index') }}">Product list</a></li>
                                        <li><a href="{{ route('shops.create') }}">Add new Shops</a></li>
                                        <li><a href="{{ route('shops.index') }}">Shops</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                </div>
            </div>

            <!-- page content -->
            <div class="col-md-9">
              <div class="right_col" role="main">
                  @yield('content')
              </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer class="col-xs-12">
                <div class="pull-right">

                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>
</body>
</html>
