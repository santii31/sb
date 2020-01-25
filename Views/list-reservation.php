        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content table-container">
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>
                        <?= $title ?>
                    </h2>
                </div>        

                <div class="divider mb-divider"></div>

                <?php if (!isset($adminTemp)): ?>
                    <div class="more-list">
                        <?php if (isset($showDisables)): ?>
                        <a href="<?= FRONT_ROOT ?>reservation/listReservationPath">              
                            <i class="material-icons left">arrow_forward</i>
                            <span>
                                Mostrar solo habilitados
                            </span>    
                        </a>
                        <?php else: ?>                        
                            <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/1/disables">                    
                            <i class="material-icons left">arrow_forward</i>
                            <span>
                                Mostrar deshabilitados
                            </span>    
                        </a>
                        <?php endif; ?>
                    </div>                    
                <?php endif; ?>

                <?php if ($success != null): ?>
                <div class="row">
                    <div class="col s6">
                        <div class="card-panel green lighten-4">
                            <i class="material-icons left">check</i>                            
                            <span class="card-text card-success"> <?= $success; ?> </span>
                        </div>        
                    </div>                    
                </div>    
                <?php endif; ?>        

                <?php if ($alert != null): ?>
                <div class="row">
                    <div class="col s6">
                        <div class="card-panel red lighten-4">
                            <i class="material-icons left">error</i>
                            <span class="card-text card-alert"> <?= $alert; ?> </span>                            
                        </div>        
                    </div>                    
                </div>                
                <?php endif; ?>

                <nav class="search-container">                
                    <div class="nav-wrapper s-color">                    
                        <div class="input-field">
                            <input id="search" type="search" placeholder="Filtrar por nombre...">
                            <label class="label-icon" for="search">
                                <i class="material-icons" >search</i>
                            </label>                            
                        </div>                    
                    </div>
                </nav>                
                
                <div class="row">                    
                    <table class="responsive-table striped centered" id="table-filter">
                        <thead>
                        <tr>                     
                            <th>Estadia</th>       
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Precio</th>
                            <th>Cliente</th>
                            <th>Carpa</th>
                            <th>Servicios</th>                            
                            <th>Añadir</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>                                    
                                    <td> <?= ucfirst( str_replace('_', ' ', $reservation->getStay()) ); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($reservation->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($reservation->getDateEnd())); ?> </td>                                    
                                    <td> $<?= number_format($reservation->getPrice(), 2, ',', '.'); ?> </td>
                                    <td> <?= 
                                            ucfirst($reservation->getClient()->getName()) 
                                            . " " . 
                                            ucfirst($reservation->getClient()->getLastName()); ?> 
                                    </td>
                                    <td> <?= $reservation->getBeachTent()->getNumber(); ?> </td>
                                    
                                    <td>
                                        <?php $service=null; ?>
                                        <?php $lockers=null; ?>
                                        <ul class="collapsible">
                                            <li>
                                                <div class="collapsible-header">
                                                    <i class="material-icons left">arrow_forward</i>Ver
                                                </div>
                                                <div class="collapsible-body">
                                                    <ul>
                                                        <li>
                                                            • Lockers:   
                                                            <?php if ($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())): ?>       
                                                                <?php if ($lockers = $this->servicexlockerDAO->getLockerByService($service->getId())): ?>                             
                                                                    <?php foreach ($lockers as $locker): ?>
                                                                        
                                                                            • <?= $locker->getLockerNumber() . "(" .$locker->getSex() . ")" ; ?> 
                                                                        
                                                                    <?php endforeach; ?>                                                                                              
                                                                <?php else: ?>
                                                                    N/A
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif; ?>                                                        
                                                        </li>
                                                        <li>
                                                            • Sombrillas:  

                                                            <?php if ($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())): ?>
                                                                <?php if ($parasoles = $this->servicexparasolDAO->getParasolByService($service->getId())): ?>
                                                                    <?php foreach ($parasoles as $parasol): ?>
                                                                            • <?= $parasol->getParasolNumber(); ?> 
                                                                    <?php endforeach; ?>                                            
                                                                <?php else: ?>
                                                                    N/A
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif; ?>
                                                        </li>
                                                        <li>
                                                            • Estacionamiento:  
                                                            <?php if ($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())): ?>       
                                                                <?php if ($parkings = $this->servicexparkingDAO->getParkingByService($service->getId())): ?>                          
                                                                    <?php foreach ($parkings as $parking): ?>                                                                        
                                                                        • <?= $parking->getNumber(); ?>                                                                     
                                                                    <?php endforeach; ?>                                                                                              
                                                                <?php else: ?>
                                                                    N/A
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                N/A
                                                            <?php endif; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>                                      
                                    </td>       

                                    <td class="actions">
                                        <a href="<?= FRONT_ROOT ?>additionalService/addLockerPath/<?= $reservation->getId(); ?>" class="waves-effect waves-light btn-small">
                                            <i class="material-icons left"></i>
                                            Locker
                                        </a>
                                        
                                        <a href="<?= FRONT_ROOT ?>additionalService/addParasolPath/<?= $reservation->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left"></i>
                                            Sombrilla
                                        </a>  
                                        <a href="<?= FRONT_ROOT ?>parking/parkingMap/<?= $reservation->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left"></i>
                                            Cochera
                                        </a>                                        
                                    </td>               
                                         
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php if (isset($rsvCount)): ?>
                        <?php if ($rsvCount > MAX_ITEMS_PAGE): ?>
                            <ul class="pagination center-align">     

                                <?php if ($page > 1): ?>                    
                                <li class="waves-effect">
                                    <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/<?= $page - 1; ?>">
                                        <i class="material-icons">chevron_left</i>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li class="disabled">
                                    <a href="#!">
                                        <i class="material-icons">chevron_left</i>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $pages; $i++): ?>
                                    <?php if ($i == $page): ?>
                                        <li class="active">
                                    <?php else: ?>
                                        <li class="waves-effect">
                                    <?php endif; ?>
                                        <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/<?= $i; ?>">
                                            <?php $current = $i; ?>
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?> 

                                <?php if ($page != $current): ?>
                                    <li class="waves-effect">
                                        <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/<?= $page + 1; ?>">
                                            <i class="material-icons">chevron_right</i>
                                        </a>
                                    </li>             
                                <?php else: ?>
                                    <li class="disabled">
                                        <a href="#!">
                                            <i class="material-icons">chevron_right</i>
                                        </a>
                                    </li>                               
                                <?php endif; ?>                                                
                            </ul>                        
                        <?php endif; ?>   

                    <?php elseif (isset($d_rsvCount)): ?>
                        <?php if ($d_rsvCount > MAX_ITEMS_PAGE): ?>                            
                            <ul class="pagination center-align">     

                                <?php if ($page > 1): ?>                    
                                <li class="waves-effect">
                                    <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/<?= $page - 1; ?>/disables">
                                        <i class="material-icons">chevron_left</i>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li class="disabled">
                                    <a href="#!">
                                        <i class="material-icons">chevron_left</i>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $d_pages; $i++): ?>
                                    <?php if ($i == $page): ?>
                                        <li class="active">
                                    <?php else: ?>
                                        <li class="waves-effect">
                                    <?php endif; ?>                                    
                                        <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/<?= $i; ?>/disables">
                                            <?php $d_current = $i; ?>
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?> 

                                <?php if ($page != $d_current): ?>
                                    <li class="waves-effect">                                    
                                        <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/<?= $page + 1; ?>/disables">
                                            <i class="material-icons">chevron_right</i>
                                        </a>
                                    </li>             
                                <?php else: ?>
                                    <li class="disabled">
                                        <a href="#!">
                                            <i class="material-icons">chevron_right</i>
                                        </a>
                                    </li>                               
                                <?php endif; ?>                                                
                            </ul>                        
                        <?php endif; ?>   
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>
<script>

	let outerInput = document.getElementById('search');

    outerInput.addEventListener('keyup', function() {
        let innerInput, filter, table, tr, td, i, txtValue;
        innerInput = document.getElementById('search');
        filter = innerInput.value.toUpperCase();
        table = document.getElementById('table-filter');
        tr = table.getElementsByTagName('tr');
        
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    });

</script>