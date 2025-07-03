<!-- Dashboards -->
<li class="menu-item {{ request()->routeIs('dashboard') ? 'active open' : '' }}">
    <a href="{{ route('dashboard') }}" class="menu-link ">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate" data-i18n="Dashboards">Dashboards </div>
    </a>

</li>
<!-- Categories -->
@can('show-category')
<li class="menu-item {{ request()->routeIs('category.*') ? 'active open' : '' }} ">
    <a href="{{ route('category.index') }}" class="menu-link ">
        <i class='menu-icon bx bx-category'></i>
        <div class="text-truncate" data-i18n="Dashboards">Manage Categories</div>
    </a>

</li>
@endcan
@can('show-brand')


<!-- Brand -->
<li class="menu-item {{ request()->routeIs('brand.*') ? 'active open' : '' }} ">
    <a href="{{ route('brand.index') }}" class="menu-link ">
        <i class='bx bxl-shopify menu-icon'></i>
        <div class="text-truncate" data-i18n="Dashboards">Manage Brands</div>
    </a>

</li>
@endcan
@canany(['show-product', 'create-product'])
<li class="menu-item {{ request()->routeIs('products.*') ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">

        <i class='menu-icon bx bx-package'></i>
        <div class="text-truncate" data-i18n="Layouts">Products</div>
    </a>

    <ul class="menu-sub">
        @can('create-product')
        <li class="menu-item">
            <a href="{{ route('products.create') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Without menu">Add Product</div>
            </a>
        </li>
        @endcan
        <li class="menu-item">
            <a href="{{ route('products.index') }}" class="menu-link">
                <div class="text-truncate" data-i18n="Without menu">All Products</div>
            </a>
        </li>

    </ul>
</li>
@endcanany

{{-- Banner --}}

<li class="menu-item {{ request()->routeIs('banner.*') ? 'active open' : '' }}">
    <a href="{{ route('banner.index') }}" class="menu-link ">
        <i class='menu-icon bx bx-image'></i>
        <div class="text-truncate" data-i18n="Banners">Manage Banners</div>
    </a>
</li>