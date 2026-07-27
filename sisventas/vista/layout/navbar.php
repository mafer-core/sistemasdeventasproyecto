<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/sisventas/vista/producto/listado.php">
            <i class="fas fa-store"></i> SisVentas
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <!-- 1. ARCHIVOS (Mantenimientos CRUD) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropArchivos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-folder"></i> Archivos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropArchivos">
                        <li><a class="dropdown-item" href="/sisventas/vista/producto/listado.php"><i class="fas fa-boxes"></i> Productos</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/cliente/listado.php"><i class="fas fa-users"></i> Clientes</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/proveedor/listado.php"><i class="fas fa-truck"></i> Proveedores</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/categoria/listado.php"><i class="fas fa-tags"></i> Categorías</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/usuario/listado.php"><i class="fas fa-user-shield"></i> Usuarios</a></li>
                    </ul>
                </li>

                <!-- 2. PROCESOS (Transacciones) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropProcesos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cash-register"></i> Procesos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropProcesos">
                        <li><a class="dropdown-item" href="/sisventas/vista/venta/crear.php"><i class="fas fa-cart-plus"></i> Registrar Ventas</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/venta/listado.php"><i class="fas fa-history"></i> Historial de Ventas</a></li>
                    </ul>
                </li>

                <!-- 3. CONSULTAS (Reportes y Filtros) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropConsultas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-chart-line"></i> Consultas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropConsultas">
                        <li><a class="dropdown-item" href="/sisventas/vista/consultas/stock_productos.php"><i class="fas fa-cubes"></i> Stock productos</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/consultas/ventas_fecha.php"><i class="fas fa-calendar-day"></i> Ventas por día / fecha</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/consultas/venta_cliente.php"><i class="fas fa-user-tag"></i> Venta por Cliente</a></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/consultas/venta_producto.php"><i class="fas fa-box-open"></i> Venta por producto</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/sisventas/vista/consultas/ranking_ventas.php"><i class="fas fa-trophy"></i> Ranking ventas</a></li>
                    </ul>
                </li>

                <!-- 4. HERRAMIENTAS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropHerramientas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tools"></i> Herramientas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropHerramientas">
                        <li><a class="dropdown-item" href="/sisventas/vista/usuario/cambiar_password.php"><i class="fas fa-key"></i> Cambiar Password</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>