<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    {{-- <div class="app-sidebar__user"><img width="40 px" class="app-sidebar__user-avatar"
            src="{{ asset('images/user/' . Auth::user()->image) }}" alt="User Image">

        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->fullname }}</p>
        </div>
    </div> --}}
    <ul class="app-menu">
        <li><a class="app-menu__item {{ request()->is('/') ? 'active' : '' }}" href="/"><i
                    class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">لوحة التحكم</span></a></li>

        @can('category-list')
            <li class="treeview "><a class="app-menu__item {{ request()->is('category*') ? 'active' : '' }}" href="#"
                                     data-toggle="treeview"><i class="app-menu__icon fa fa-th"></i><span
                        class="app-menu__label">التصنيفات</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('category-create')
                        <li><a class="treeview-item " href="{{ route('category.create') }}"><i
                                    class="icon fa fa-plus"></i>أضف
                                تصنيف جديد </a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('category.index') }}"><i class="icon fa fa-edit"></i>كل
                            التصنيفات </a></li>
                </ul>
            </li>
        @endcan

        @can('product-list')
            <li class="treeview"><a class="app-menu__item {{ request()->is('product*') ? 'active' : '' }}" href="#"
                                    data-toggle="treeview"><i class="app-menu__icon fa fa-cube"></i><span
                        class="app-menu__label">المنتجات</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('product-create')
                        <li><a class="treeview-item" href="{{ route('product.create') }}"><i
                                    class="icon fa fa-circle-o"></i>أضف
                                منتوج جديد </a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('product.index') }}"><i class="icon fa fa-circle-o"></i>كل
                            المنتجات </a></li>
                </ul>
            </li>
        @endcan

        @can('store-list')
            <li class="treeview"><a class="app-menu__item {{ request()->is('store*') ? 'active' : '' }}" href="#"
                                    data-toggle="treeview"><i class="app-menu__icon fa fa-archive"></i><span
                        class="app-menu__label">المخازن</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('store-create')
                        <li><a class="treeview-item" href="{{ route('store.create') }}"><i
                                    class="icon fa fa-circle-o"></i>أضف
                                مخزن جديدة</a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('store.index') }}"><i class="icon fa fa-circle-o"></i>كل
                            المخازن </a></li>
                </ul>
            </li>
        @endcan

        @can('purchase-list')
            <li class="treeview"><a class="app-menu__item {{ request()->is('purchase*') ? 'active' : '' }}" href="#"
                                    data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span
                        class="app-menu__label">المشتريات</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('purchase-create')
                        <li><a class="treeview-item" href="{{ route('purchase.create') }}"><i
                                    class="icon fa fa-circle-o"></i>شراء</a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('purchase.index') }}"><i
                                class="icon fa fa-circle-o"></i>كل
                            المشتريات </a></li>
                </ul>
            </li>
        @endcan

        @can('invoice-list')
            <li class="treeview "><a class="app-menu__item {{ request()->is('invoice*') ? 'active' : '' }}" href="#"
                                     data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span
                        class="app-menu__label">الفواتير</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('invoice-create')
                        <li><a class="treeview-item " href="{{ route('invoice.create') }}"><i
                                    class="icon fa fa-plus"></i>أضف
                                فاتورة جديدة </a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('invoice.index') }}"><i class="icon fa fa-edit"></i>كل
                            الفواتير </a></li>
                </ul>
            </li>
        @endcan

        @can('sales-list')
            <li><a class="app-menu__item {{ request()->is('sales') ? 'active' : '' }}" href="/sales"><i
                        class="app-menu__icon fa fa-dollar"></i><span class="app-menu__label">المبيعات</span></a></li>

            <li class="treeview"><a class="app-menu__item {{ request()->is('supplier*') ? 'active' : '' }}" href="#"
                                    data-toggle="treeview"><i class="app-menu__icon fa fa-truck"></i><span
                        class="app-menu__label">الموردين</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('supplier-create')
                        <li><a class="treeview-item" href="{{ route('supplier.create') }}"><i
                                    class="icon fa fa-circle-o"></i>أضف مورد جديد </a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('supplier.index') }}"><i
                                class="icon fa fa-circle-o"></i>كل
                            الموردين </a></li>
                </ul>
            </li>
        @endcan

        <!-- <li class="treeview "><a class="app-menu__item {{ request()->is('purchase*') ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Purchase</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{ route('purchase.create') }}"><i class="icon fa fa-plus"></i>Purchase Product </a></li>
                <li><a class="treeview-item" href="{{ route('purchase.index') }}"><i class="icon fa fa-edit"></i>Manage Purchase</a></li>
            </ul>
        </li> -->

        @can('customer-list')
            <li class="treeview"><a class="app-menu__item {{ request()->is('customer*') ? 'active' : '' }}"
                                    href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span
                        class="app-menu__label">الزبائن</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('customer-create')
                        <li><a class="treeview-item" href="{{ route('customer.create') }}"><i
                                    class="icon fa fa-circle-o"></i>زبون جديد </a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('customer.index') }}"><i
                                class="icon fa fa-circle-o"></i>كل الزبائن </a></li>
                </ul>
            </li>
        @endcan

        @can('user-list')
            <li class="treeview"><a class="app-menu__item {{ request()->is('user*') ? 'active' : '' }}"
                                    href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span
                        class="app-menu__label">المستخدمين</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('user-create')
                        <li><a class="treeview-item" href="{{ route('user.create') }}"><i
                                    class="icon fa fa-circle-o"></i>مستخدم جديد </a></li>
                    @endcan
                    <li><a class="treeview-item" href="{{ route('user.index') }}"><i
                                class="icon fa fa-circle-o"></i>كل المستخدمين </a></li>
                </ul>
            </li>
        @endcan
        @can('settings')
            <li class="treeview"><a class="app-menu__item {{ request()->is('setting.settings') ? 'active' : '' }}"
                                    href="{{ route('setting.settings')  }}"><i
                        class="app-menu__icon fa fa-cog"></i><span
                        class="app-menu__label">الإعدادات</span></a>
            </li>
        @endcan
    </ul>
</aside>
