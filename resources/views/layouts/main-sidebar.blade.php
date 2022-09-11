<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item ">


                    <a href="{{route('admin.dashboard')}}" class="nav-link   @if($active==0) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>


                <li class="nav-item">
                    <a href="{{route('admin.orders')}}" class="nav-link   @if($active==1) active @endif">
                        <i class="nav-icon fa fas fa-th"></i>
                        <p>
                            Orders
                        </p>
                        <span class="badge badge-info right">2</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.products')}}" class="nav-link   @if($active==2) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.brands')}}" class="nav-link   @if($active==3) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Brands
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.categories')}}" class="nav-link   @if($active==4) active @endif">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.subCategories')}}" class="nav-link   @if($active==5) active @endif">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>
                            SubCategories
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{route('admin.productTypes')}}" class="nav-link   @if($active==6) active @endif">
                        <i class="nav-icon fas fa-rocket"></i>
                        <p>
                            Product Types
                        </p>

                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
