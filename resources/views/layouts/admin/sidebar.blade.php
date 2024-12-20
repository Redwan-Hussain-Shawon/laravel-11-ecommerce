

<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{route('admin.home')}}" class="nav-link {{ Request::is('admin/home*') ? 'active':'' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    
    <li class="nav-item {{ Request::is('admin/category*') || Request::is('admin/subcategory') || Request::is('admin/childcategory') || Request::is('admin/brand*') || Request::is('admin/warehouse*') ? 'menu-open':'' }}">
      <a href="#" class="nav-link {{ Request::is('admin/category*') || Request::is('admin/subcategory') || Request::is('admin/childcategory') || Request::is('admin/brand*') || Request::is('admin/warehouse*') ?  'active':'' }}">
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
         <li class="nav-item">
          <a href="{{route('warehouse.index')}}" class="nav-link {{ Request::is('admin/warehouse*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Warehouse</p>
          </a>
        </li> 
      </ul>
    </li>
    <li class="nav-item {{ Request::is('admin/product*') ? 'menu-open' :'' }}">
      <a href="#" class="nav-link  {{ Request::is('admin/product*') ? 'active' :'' }}">
        <i class="fab fa-product-hunt nav-icon"></i>
        <p>
          Product
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('product.create')}}" class="nav-link {{ Request::is('admin/product/create*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>New Product</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('product.index')}}" class="nav-link {{ Request::is('admin/setting/website*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Manage Product</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item {{ Request::is('admin/coupon*') ? 'menu-open' :'' }}">
      <a href="#" class="nav-link  {{ Request::is('admin/coupon*') ? 'active' :'' }}">
        <i class="fa fa-gift nav-icon" aria-hidden="true"></i>
        <p>
          Offer
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('coupon.index')}}" class="nav-link {{ Request::is('admin/coupon*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Coupon</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('website.setting')}}" class="nav-link {{ Request::is('admin/setting/website*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>E Campaign</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item {{ Request::is('admin/pickup-point*') ? 'menu-open' :'' }}">
      <a href="#" class="nav-link  {{ Request::is('admin/pickup-point*') ? 'active' :'' }}">
        <i class="fa fa-truck nav-icon" aria-hidden="true"></i>
        <p>
          Pickup Point
          <i class="right fas fa-angle-left nav-icon"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('pickuppoint.index')}}" class="nav-link {{ Request::is('admin/pickup-point*') ? 'active':''}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Pickup Point</p>
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
          <a href="{{route('website.setting')}}" class="nav-link {{ Request::is('admin/setting/website*') ? 'active':''}}">
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