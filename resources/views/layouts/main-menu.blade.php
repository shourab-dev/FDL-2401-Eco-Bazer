<!-- Dashboards -->
<li class="menu-item {{ request()->routeIs('dashboard') ? 'active open' : '' }}">
    <a href="{{ route('dashboard') }}" class="menu-link ">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate" data-i18n="Dashboards">Dashboards </div>
    </a>

</li>
<!-- Categories -->
<li class="menu-item {{ request()->routeIs('category.*') ? 'active open' : '' }} ">
    <a href="{{ route('category.index') }}" class="menu-link ">
        <i class='menu-icon bx bx-category'></i>
        <div class="text-truncate" data-i18n="Dashboards">Manage Categories</div>
    </a>

</li>
<!-- Brand -->
<li class="menu-item {{ request()->routeIs('brand.*') ? 'active open' : '' }} ">
    <a href="{{ route('brand.index') }}" class="menu-link ">
        <i class='bx bxl-shopify menu-icon'></i>
        <div class="text-truncate" data-i18n="Dashboards">Manage Brands</div>
    </a>

</li>

<li class="menu-item {{ request()->routeIs('products.*') ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">

        <i class='menu-icon bx bx-package'></i>
        <div class="text-truncate" data-i18n="Layouts">Products</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item">
            <a href="{{ route('products.create') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Without menu">Add Product</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('products.index') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Without menu">All Products</div>
            </a>
        </li>
       
    </ul>
    <li class="menu-item {{request()->routeIs('contact.*') ? 'active open' : ''}} ">
              <a href="{{route('contactMessage')}}" class="menu-link">
              <i class='menu-icon  bx bx-phone'></i>
            <div data-i18n="Analytics">Contact Us</div>
              </a>
    </li>
</li>