<body class="dashboard">

    <!-- Navbar -->
    <section>
        <div class="navbar-fixed">
            <ul id="dropdown1" class="dropdown-content">
                <li>
                    <a href="<?= FRONT_ROOT ?>">Desconectarse</a>
                </li>
            </ul>        
            <nav>
                <div class="nav-wrapper">
                    <a href="<?= FRONT_ROOT ?>admin/dashboard" class="brand-logo">
                        <i class="material-icons">beach_access</i>
                        South Beach
                    </a>
                    <ul class="right hide-on-med-and-down">                    
                        <li>
                            <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                                user@user.com
                                <i class="material-icons right">arrow_drop_down</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

	<!-- Page Layout here -->
	<div class="row">
        <!-- Links -->
        <div class="col s12 m4 l2 menu-container">
            <div class="sidenav-container">
                <ul>

                    <li>
                        <a href="<?= FRONT_ROOT ?>admin/dashboard" class="valign-wrapper">
                            <i class="material-icons left">dashboard</i>
                            Dashboard
                        </a>
                    </li>

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">beach_access</i>Carpas</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>beachTent/addReservePath" class="valign-wrapper">
                                            <i class="material-icons left">add_circle</i>
                                            Añadir reserva
                                        </a>
                                    </li>                                           
                                </ul>
                            </div>
                        </li>                    
                    </ul>  

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">directions_car</i>Estacionamiento</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>parking/addParkingPath" class="valign-wrapper">
                                            <i class="material-icons left">add_circle_outline</i>
                                            Añadir reserva
                                        </a>
                                    </li>                                     
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>parking/showParkingPath" class="valign-wrapper">
                                            <i class="material-icons left">map</i>
                                            Ver mapa de reservas
                                        </a>
                                    </li>                                                                              
                                </ul>
                            </div>
                        </li>                    
                    </ul>                                                      

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">insert_chart</i>Stock</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper">
                                            <i class="material-icons left">person_add</i>
                                            Añadir producto
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar productos
                                        </a>
                                    </li>                                
                                </ul>
                            </div>
                        </li>                    
                    </ul>                    

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">content_paste</i>Proveedores</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>provider/addProviderPath" class="valign-wrapper">
                                            <i class="material-icons left">person_add</i>
                                            Añadir proveedor
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath" class="valign-wrapper">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar proveedores
                                        </a>
                                    </li>                                
                                </ul>
                            </div>
                        </li>                    
                    </ul>

                    <li>
                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper">
                            <i class="material-icons left">attach_money</i>
                            Contabilidad
                        </a>
                    </li>

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">directions_walk</i>Clientes</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper">
                                            <i class="material-icons left">person_add</i>
                                            Añadir cliente potencial
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar clientes potenciales
                                        </a>
                                    </li>                                
                                </ul>
                            </div>
                        </li>                    
                    </ul>  

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">person_pin</i>Administradores</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>admin/addAdminPath" class="valign-wrapper">
                                            <i class="material-icons left">person_add</i>
                                            Añadir administrador
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>admin/listAdminPath" class="valign-wrapper">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar administradores
                                        </a>
                                    </li>                                
                                </ul>
                            </div>
                        </li>                    
                    </ul>                                       

                </ul>                
            </div>
        </div>