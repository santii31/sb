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
                            <th>Locker</th>
                            <th>Sombrilla</th>
                            <th>Cochera</th>
                            <th>Añadir</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>                                    
                                    <td> <?= ucfirst( $reservation->getStay() ); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($reservation->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($reservation->getDateEnd())); ?> </td>                                    
                                    <td> <?= $reservation->getPrice(); ?> </td>
                                    <td> <?= 
                                            ucfirst($reservation->getClient()->getName()) 
                                            . " " . 
                                            ucfirst($reservation->getClient()->getLastName()); ?> 
                                    </td>
                                    <td> <?= $reservation->getBeachTent()->getNumber(); ?> </td>
                                    
                                    <?php $service=null; ?>
                                    <?php $lockers=null; ?>
                                    
                                    <?php if ($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())): ?>       
                                        <?php if ($lockers = $this->servicexlockerDAO->getLockerByService($service->getId())): ?>                 
                                            <td>
                                                <ul> 
                                                    <?php foreach ($lockers as $locker): ?>
                                                        <li>
                                                            • <?= $locker->getLockerNumber() . "(" .$locker->getSex() . ")" ; ?> 
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        <?php else: ?>
                                            <td> N/A </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td> N/A </td>
                                    <?php endif; ?>

                                    <?php if ($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())): ?>
                                        <?php if ($parasoles = $this->servicexparasolDAO->getParasolByService($service->getId())): ?>
                                            <td>
                                                <ul>
                                                    <?php foreach ($parasoles as $parasol): ?>
                                                        <li>
                                                            • <?= $parasol->getParasolNumber(); ?> 
                                                        </li>
                                                    <?php endforeach; ?>                                            
                                                </ul>
                                            </td>
                                        <?php else: ?>
                                        <td>N/A</td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td>N/A</td>
                                    <?php endif; ?>

                                    <?php if ($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())): ?>       
                                        <?php if ($parkings = $this->servicexparkingDAO->getParkingByService($service->getId())): ?>              
                                            <td>
                                                <ul>
                                                    <?php foreach ($parkings as $parking): ?>
                                                        <li>
                                                            • <?= $parking->getNumber(); ?> 
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        <?php else: ?>
                                            <td> N/A </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td> N/A </td>
                                    <?php endif; ?>

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