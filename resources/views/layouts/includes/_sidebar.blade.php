<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboard</li>
                <li>
                    <a href="{{route('home')}}" class="{{(request()->is('home')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Modulos</li>
                <li>
                    <a href="#" class="{{(request()->is('users/*')) ? 'mm-active' : ''}} {{(request()->is('users')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Usuarios
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="{{(request()->is('users/*')) ? 'mm-collapse mm-show' : ''}} {{(request()->is('users')) ? 'mm-collapse mm-show' : ''}}">
                        <li>
                        <a href="{{route('users-list')}}" class="{{(request()->is('users')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon">
                                </i>Listar usuarios
                            </a>
                        </li>
                        <li>
                            <a href="{{route('users-insert')}}" class="{{(request()->is('users/form')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon">
                                </i>Crear usuario
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="{{(request()->is('invoices/*')) ? 'mm-active' : ''}} {{(request()->is('invoices')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Facturas
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="{{(request()->is('invoices/*')) ? 'mm-collapse mm-show' : ''}} {{(request()->is('invoices')) ? 'mm-collapse mm-show' : ''}}">
                        <li>
                            <a href="{{route('invoices-list')}}" class="{{(request()->is('invoices')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon">
                                </i>Listar facturas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('invoices-insert')}}" class="{{(request()->is('invoices/form')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon">
                                </i>Crear factura
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="{{(request()->is('products/*')) ? 'mm-active' : ''}} {{(request()->is('products')) ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-box1"></i>
                        Productos
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul class="{{(request()->is('products/*')) ? 'mm-collapse mm-show' : ''}} {{(request()->is('products')) ? 'mm-collapse mm-show' : ''}}">
                        <li>
                            <a href="{{route('products-list')}}" class="{{(request()->is('products')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon">
                                </i>Listar productos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('products-insert')}}" class="{{(request()->is('products/form')) ? 'mm-active' : ''}}">
                                <i class="metismenu-icon">
                                </i>Crear producto
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="tables-regular.html">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Prueba
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
