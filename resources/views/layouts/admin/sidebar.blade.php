<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{route('admin.home')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    
    <li class="nav-item {{ Request::is('admin/category*') || Request::is('admin/subcategory') || Request::is('admin/childcategory') || Request::is('admin/brand*') ? 'menu-open':'' }}">
      <a href="#" class="nav-link {{ Request::is('admin/category*') || Request::is('admin/subcategory') || Request::is('admin/childcategory') || Request::is('admin/brand*') ?  'active':'' }}">
        <i class="nav-icon fa fa-list" aria-hidden="true"></i>

        <p>
          Category
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('category.index')}}" class="nav-link {{ Request::is('admin/category*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('subcategory.index')}}" class="nav-link {{ Request::is('admin/subcategory*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Sub Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('childcategory.index') }}" class="nav-link {{ Request::is('admin/childcategory*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Child Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('brand.index')}}" class="nav-link {{ Request::is('admin/brand*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Brand</p>
          </a>
        </li> 
      </ul>
    </li>

    <li class="nav-item {{ Request::is('admin/setting*') || Request::is('admin/smtp*')  ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ Request::is('admin/setting*') ? 'active' :'' }} ">
        <i class="fa fa-cog nav-icon" aria-hidden="true"></i>
        <p>
          Setting
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('setting.seo')}}" class="nav-link {{ Request::is('admin/setting/seo*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>SEO Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('subcategory.index')}}" class="nav-link {{ Request::is('admin/subcategory*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Website Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('childcategory.index') }}" class="nav-link {{ Request::is('admin/childcategory*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Page Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('page.index')}}" class="nav-link  {{ Request::is('admin/setting/page*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Page Create</p>
          </a>
        </li> 
         <li class="nav-item">
          <a href="{{route('smtp.setting')}}" class="nav-link  {{ Request::is('admin/setting/smtp*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>SMTP Setting</p>
          </a>
        </li> 
         <li class="nav-item">
          <a href="{{route('brand.index')}}" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
            <p>Payment Gateway</p>
          </a>
        </li> 
      </ul>
    </li>
     
  </ul>
</nav>