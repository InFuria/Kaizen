<aside class="bg-dark text-dark header-nav mr-0 shadow-lg collapse width" id="sidebarCollapse" style="height: auto">
    <section class="sidebar" style="min-height: 100%">
        <ul class="nav text-white flex-column nav-pills mt-3" id="accordion" role="tablist" aria-orientation="vertical">

            <li class="nav-item text-white header header-title p-2 ">
                <span>MENU PRINCIPAL</span>
            </li>

            <!-- Dashboard -->
            <li class="nav-item text-white dash">
                <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-tachometer-alt"></i>

                    <span class="ml-1">Dashboard</span>
                </a>
            </li>

            <!-- Cashier -->
            <li class="nav-item text-white dash">
                <a class="nav-link text-white" href="#cashierSubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="cashierSubMenu">
                    <i class="fas fa-cash-register"></i>

                    <span class="ml-1">Caja</span>

                    <span class="float-right"><i class="fa fa-angle-left pull-right"></i></span>
                </a>

                <ul class="collapse list-unstyled" id="cashierSubMenu" data-parent="#accordion">
                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('till.index') }}">
                            <i class="fas fa-balance-scale"></i>

                            <span class="ml-1">Administrar Caja</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('sales.index') }}">
                            <i class="fas fa-hand-holding-usd"></i>

                            <span class="ml-1">Registrar Venta</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- StockController -->
            <li class="nav-item text-white">
                <a class="nav-link text-white" href="#stockSubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="stockSubMenu">
                    <i class="fas fa-boxes"></i>

                    <span class="ml-1">Stock</span>

                    <span class="float-right"><i class="fa fa-angle-left pull-right"></i></span>
                </a>

                <ul class="collapse list-unstyled" id="stockSubMenu" data-parent="#accordion">
                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('products.index') }}">
                            <i class="fas fa-clipboard-list"></i>

                            <span class="ml-1">Lista de Productos</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('stock.index') }}">
                            <i class="fas fa-clipboard-list"></i>

                            <span class="ml-1">Listado de Stock</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('stock.charge') }}">
                            <i class="fas fa-dolly-flatbed"></i>

                            <span class="ml-1">Carga de Stock</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('stock.adjustment') }}">
                            <i class="fas fa-wrench"></i>

                            <span class="ml-1">Ajuste de Stock</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('stock.audit') }}">
                            <i class="fas fa-calculator"></i>

                            <span class="ml-1">Arqueo de Productos</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Delivery -->
            <li class="nav-item text-white">
                <a class="nav-link text-white" href="#deliverySubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="deliverySubMenu">
                    <i class="fas fa-motorcycle"></i>

                    <span class="ml-1">Delivery</span>

                    <span class="float-right"><i class="fa fa-angle-left pull-right"></i></span>
                </a>

                <ul class="collapse list-unstyled" id="deliverySubMenu" data-parent="#accordion">
                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                            <i class="fas fa-clipboard-list"></i>

                            <span class="ml-1">Listado de personal delivery</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                            <i class="fas fa-users-cog"></i>

                            <span class="ml-1">Administracion de Delivery</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Administration -->
            <li class="nav-item text-white">
                <a class="nav-link text-white" href="#admSubMenu" data-toggle="collapse" aria-expanded="false" aria-controls="admSubMenu">
                    <i class="fas fa-users-cog"></i>

                    <span class="ml-1">Administracion General</span>

                    <span class="float-right"><i class="fa fa-angle-left pull-right"></i></span>
                </a>

                <ul class="collapse list-unstyled" id="admSubMenu" data-parent="#accordion">
                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('expenses.index') }}">
                            <i class="fas fa-file-invoice"></i>

                            <span class="ml-1">Gastos</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i>

                            <span class="ml-1">Usuarios</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('roles.index') }}">
                            <i class="fas fa-user-tag"></i>

                            <span class="ml-1">Roles</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('permissions.index') }}">
                            <i class="fas fa-tags"></i>

                            <span class="ml-1">Permisos</span>
                        </a>
                    </li>

                    <li class="ml-3">
                        <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                            <i class="fas fa-ad"></i>

                            <span class="ml-1">Publicidad</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Reports -->
            <li class="nav-item text-white">
                <a class="nav-link text-white" href="{{ route('reports.index') }}">
                    <i class="far fa-clipboard"></i>

                    <span class="ml-1">Reportes</span>
                </a>
            </li>

            <!-- Support -->
            <li class="nav-item text-white dash">
                <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-headset"></i>

                    <span class="ml-1">Soporte</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item text-white dash">
                <a class="nav-link text-white" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>

                    <span class="ml-1">Cerrar Sesion</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </section>
</aside>


