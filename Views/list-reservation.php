<!-- Main content  -->
<div class="col s12 m8 l10">
            <div class="main-content table-container">
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>
                        <?= $title ?>
                    </h2>
                </div>
            
                    <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Filtrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                </form>


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
                            <input id="search" type="search" placeholder="Filtrar por descripcion...">
                            <label class="label-icon" for="search">
                                <i class="material-icons" >search</i>
                            </label>                            
                        </div>                    
                    </div>
                </nav>                
                
                <div class="row">                    
                    <table class="responsive-table centered" id="table-filter">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha entrada</th>
                            <th>Fecha salida</th>
                            <th>Precio final</th>
                            <th>Cliente</th>
                            <th>Carpa</th>
                            <th>Locker</th>
                            <th>Sombrilla</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <td> <?= $reservation->getId(); ?> </td>
                                    <td> <?= $reservation->getDateStart(); ?> </td>
                                    <td> <?= $reservation->getDateEnd(); ?> </td>
                                    <td> <?= $reservation->getPrice(); ?> </td>
                                    <td> <?= $reservation->getClient()->getName() . " " . $reservation->getClient()->getLastName(); ?> </td>
                                    <td> <?= $reservation->getBeachTent()->getNumber(); ?> </td>
                                    <?php if($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())) { ?>
                                        <?php if($lockers = $this->servicexlockerDAO->getLockerByService($service->getId())){ ?>
                                            <?php foreach($lockers as $locker){ ?>
                                               <td> <?php $locker->getLockerNumber(); ?> </td>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <td> No tiene lockers </td>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <td> No tiene lockers </td>
                                    <?php } ?>

                                    <?php if($service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId())) { ?>
                                        <?php if($parasoles = $this->servicexparasolDAO->getParasolByService($service->getId())){ ?>
                                            <?php foreach($parasoles as $parasol){ ?>
                                                <td> <?php $parasol->getLockerNumber(); ?> </td>
                                            <?php } ?>
                                            <?php }else{ ?>
                                            <td> No tiene somnrillas </td>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <td> No tiene sombrillas </td>
                                    <?php } ?>

                                    <td class="actions">
                                        
                                        <a href="<?= FRONT_ROOT ?>additionalService/addLockerPath/<?= $reservation->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                            <i class="material-icons left"></i>
                                            Agregar locker
                                        </a>
                                        
                                        <a href="<?= FRONT_ROOT ?>additionalService/addParasolPath/<?= $reservation->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left"></i>
                                            Agregar sombrilla
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
            td = tr[i].getElementsByTagName("td")[1];
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