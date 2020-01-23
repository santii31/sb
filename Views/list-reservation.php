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

                <div class="more-list">
                    <?php if (isset($showAll)): ?>
                    <a href="<?= FRONT_ROOT ?>reservation/listReservationPath">                    
                        <i class="material-icons left">arrow_forward</i>
                        <span>
                            Mostrar solo reservas habilitadas
                        </span>    
                    </a>
                    <?php else: ?>
                        <a href="<?= FRONT_ROOT ?>reservation/listReservationPath/all">                    
                        <i class="material-icons left">arrow_forward</i>
                        <span>
                            Mostrar reservas deshabilitadas
                        </span>    
                    </a>
                    <?php endif; ?>
                </div> 

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
                            <!-- <th>Locker</th>
                            <th>Sombrilla</th> 
                            <th>Cochera</th>-->
                            <th>Añadir</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>                                    
                                    <td> <?= ucfirst( $reservation->getStay() ); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($reservation->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($reservation->getDateEnd())); ?> </td>                                    
                                    <td> $<?= $reservation->getPrice(); ?> </td>
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