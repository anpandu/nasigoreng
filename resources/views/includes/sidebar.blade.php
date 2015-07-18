<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->picture }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a href="{{ url('/cms/post') }}">
                <i class="fa fa-pencil"></i> <span>Post</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/cms/category') }}">
                <i class="fa fa-sitemap"></i> <span>Category</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/cms/tag') }}">
                <i class="fa fa-tag"></i> <span>Tag</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/cms/image') }}">
                <i class="fa fa-image"></i> <span>Image</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>