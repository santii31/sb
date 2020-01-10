<body class="dashboard">
    <!-- Navbar -->            
    <div class="navbar-fixed">
        <ul id="dropdown1" class="dropdown-content">
            <li>
                <a href="<?= FRONT_ROOT ?>admin/logout">Desconectarse</a>
            </li>
        </ul>        
        <nav>
            <div class="nav-wrapper">
                <!-- Hamburg menu icon -->
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                
                <a href="<?= FRONT_ROOT ?>admin/dashboard" class="brand-logo">
                    <i class="material-icons">beach_access</i>
                    South Beach
                </a>
                <ul class="right hide-on-med-and-down">                    
                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                            <?= $admin->getEmail(); ?>
                            <i class="material-icons right">arrow_drop_down</i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>                
    
    <!-- ARREGLAR - DESACTUALIZADO - BARRA MOVIL -->
    <!-- Links mobile/table -->
    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background"></div>                                
                <a href="#email">
                    <span class="white-text email">                          
                        <?= $admin->getEmail(); ?>
                    </span>
                </a>
            </div>
        </li>
        <li><a href="<?= FRONT_ROOT ?>admin/logout"><i class="material-icons">keyboard_backspace</i>Desconectarse</a></li>        
        <li><div class="divider"></div></li>                
        <ul>
            <!-- aca empiezan los links -->
            <li>
                <a href="<?= FRONT_ROOT ?>admin/dashboard" class="valign-wrapper waves-effect">
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
                                <a href="<?= FRONT_ROOT ?>beachTent/addReservePath" class="valign-wrapper waves-effect">
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
                                <a href="<?= FRONT_ROOT ?>parking/addParkingPath" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">add_circle_outline</i>
                                    Añadir reserva
                                </a>
                            </li>                                     
                            <li>
                                <a href="<?= FRONT_ROOT ?>parking/parkingMap" class="valign-wrapper waves-effect">
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
                                <a href="<?= FRONT_ROOT ?>" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">person_add</i>
                                    Añadir producto
                                </a>
                            </li>
                            <li>
                                <a href="<?= FRONT_ROOT ?>" class="valign-wrapper waves-effect">
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
                                <a href="<?= FRONT_ROOT ?>provider/addProviderPath" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">person_add</i>
                                    Añadir proveedor
                                </a>
                            </li>
                            <li>
                                <a href="<?= FRONT_ROOT ?>provider/listProviderPath" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">format_list_numbered</i>
                                    Listar/Modificar proveedores
                                </a>
                            </li>                                
                        </ul>
                    </div>
                </li>                    
            </ul>

            <li>
                <a href="<?= FRONT_ROOT ?>" class="valign-wrapper waves-effect">
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
                                <a href="<?= FRONT_ROOT ?>client/listPotentialClientPath" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">person_add</i>
                                    Añadir cliente potencial
                                </a>
                            </li>
                            <li>
                                <a href="<?= FRONT_ROOT ?>client/addPotentialClientPath" class="valign-wrapper waves-effect">
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
                                <a href="<?= FRONT_ROOT ?>admin/addAdminPath" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">person_add</i>
                                    Añadir administrador
                                </a>
                            </li>
                            <li>
                                <a href="<?= FRONT_ROOT ?>admin/listAdminPath" class="valign-wrapper waves-effect">
                                    <i class="material-icons left">format_list_numbered</i>
                                    Listar/Modificar administradores
                                </a>
                            </li>                                
                        </ul>
                    </div>
                </li>                    
            </ul>                                       

        </ul> 
    </ul>
            	
    <div class="row">
        <!-- Links desktop -->
        <div class="col s12 m4 l2 menu-container hide-on-med-and-down">
            <div class="sidenav-container">
                <ul>

                    <!-- <li>
                        <a href="<?= FRONT_ROOT ?>admin/dashboard" class="valign-wrapper waves-effect">
                            <i class="material-icons left">dashboard</i>
                            Dashboard
                        </a>
                    </li> -->

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">beach_access</i>Carpas</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>beachTent/showMap" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">add_circle</i>
                                            Ver mapa de reservas
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
                                        <a href="<?= FRONT_ROOT ?>parking/parkingMap" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">map</i>
                                            Ver mapa de reservas
                                        </a>
                                    </li>                                                                              
                                </ul>
                            </div>
                        </li>                    
                    </ul>                                                      

                    <li>
                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper waves-effect">
                            <i class="material-icons left">attach_money</i>
                            Contabilidad
                        </a>
                    </li>

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">insert_chart</i>Stock</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>product/addProductPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">add_circle_outline</i>
                                            Añadir producto
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>stock/listStockPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar stock
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
                                        <a href="<?= FRONT_ROOT ?>provider/addProviderPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">person_add</i>
                                            Añadir proveedor
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar proveedores
                                        </a>
                                    </li>                                
                                </ul>
                            </div>
                        </li>                    
                    </ul>

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">room_service</i>Servicio adicional</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>additionalService/addServicePath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">add_circle</i>
                                            Añadir servicio
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>additionalService/listServicePath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar servicios
                                        </a>
                                    </li>                                
                                </ul>
                            </div>
                        </li>                    
                    </ul>                    

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">directions_walk</i>Clientes</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>clientPotential/addPotentialClientPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">person_add</i>
                                            Añadir cliente potencial
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>clientPotential/listPotentialClientPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar clientes potenciales
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">email</i>
                                            Enviar correo
                                        </a>
                                    </li>                                                                    
                                </ul>
                            </div>
                        </li>                    
                    </ul>  

                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">group</i>Personal</div>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>staff/addStaffPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">person_add</i>
                                            Añadir personal
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>staff/listStaffPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">format_list_numbered</i>
                                            Listar/Modificar personal
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
                                        <a href="<?= FRONT_ROOT ?>admin/addAdminPath" class="valign-wrapper waves-effect">
                                            <i class="material-icons left">person_add</i>
                                            Añadir administrador
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= FRONT_ROOT ?>admin/listAdminPath" class="valign-wrapper waves-effect">
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