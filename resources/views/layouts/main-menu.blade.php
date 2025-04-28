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




<!-- Layouts -->
{{-- <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div class="text-truncate" data-i18n="Layouts">Layouts</div>
    </a>

    <ul class="menu-sub">
        <li class="menu-item">
            <a href="layouts-without-menu.html" class="menu-link">
                <div class="text-truncate" data-i18n="Without menu">Without menu</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-without-navbar.html" class="menu-link">
                <div class="text-truncate" data-i18n="Without navbar">Without navbar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-fluid.html" class="menu-link">
                <div class="text-truncate" data-i18n="Fluid">Fluid</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-container.html" class="menu-link">
                <div class="text-truncate" data-i18n="Container">Container</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="layouts-blank.html" class="menu-link">
                <div class="text-truncate" data-i18n="Blank">Blank</div>
            </a>
        </li>
    </ul>
</li> --}}