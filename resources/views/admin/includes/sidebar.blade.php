<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Str::ucfirst(auth()->user()->name) }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      @if(auth()->user()->role == 'admin')
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('add.product')}}" class="nav-link">
            <p>Add Product</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('view.product')}}" class="nav-link">
            <p>View Product</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('add.blog')}}" class="nav-link">
            <p>Add Blogs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('view.blog')}}" class="nav-link">
            <p>View Blogs</p>
          </a>
        </li>
      </ul>
      @endif

      <!-- user -->
      @if(auth()->user()->role == 'user')
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('view.cart')}}" class="nav-link">
            <p>View Cart</p>
          </a>
        </li>
      </ul>
      @endif
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>