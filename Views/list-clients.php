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

                <?php if (sizeof($rsv) > 0): ?>
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
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Domicilio</th>                                
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Nº Carpa</th>
                                <th>Nº Sombrilla</th>
                                <th>Estadia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($rsv as $reservation): ?>
                            <tr>                                
                                <td> <?= ucfirst( $reservation->getClient()->getName() ) ; ?> </td>
                                <td> <?= ucfirst( $reservation->getClient()->getLastName() ); ?> </td>
                                <td> <?= ucfirst( $reservation->getClient()->getAddress() ); ?> </td>                                
                                <td> <?= $reservation->getClient()->getEmail(); ?> </td>
                                <td> <?= $reservation->getClient()->getPhone(); ?> </td>
                                
                                <?php if ($reservation->getBeachTent() != null): ?>
                                <td> <?= $reservation->getBeachTent()->getNumber(); ?> </td>
                                <?php else: ?>
                                <td> N/A </td>
                                <?php endif; ?>

                                <?php if ($reservation->getParasol() != null): ?>
                                <td> <?= $reservation->getParasol()->getParasolNumber(); ?> </td>
                                <?php else: ?>
                                <td> N/A </td>
                                <?php endif; ?>                                   

                                <td> <?= ucfirst( str_replace('_', ' ', $reservation->getStay()) ); ?> </td>                                
                                <td> <?= date("d-m-Y" , strtotime($reservation->getDateStart())); ?> </td>
                                <td> <?= date("d-m-Y" , strtotime($reservation->getDateEnd())); ?> </td>          
                                <td>
                                    <a href="<?= FRONT_ROOT ?>balance/addBalancePath/<?= $reservation->getId(); ?>" class="waves-effect waves-light btn-small">
                                        <!--<i class="material-icons left">attach_money</i>-->
                                        Saldo
                                    </a>
                                    <a href="<?= FRONT_ROOT ?>client/updatePath/<?= $reservation->getClient()->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                        <!--<i class="material-icons left">attach_money</i>-->
                                        Modificar
                                    </a>
                                </td>                      
                            </tr>
                            <?php endforeach; ?>         
                        </tbody>
                    </table>                                          
                    
                    <?php if ($rsvClientsCount > MAX_ITEMS_PAGE): ?>
                    <ul class="pagination center-align">     

                        <?php if ($page > 1): ?>                    
                        <li class="waves-effect">
                            <a href="<?= FRONT_ROOT ?>client/listClientPath/<?= $page - 1; ?>">
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
                                <a href="<?= FRONT_ROOT ?>client/listClientPath/<?= $i; ?>">
                                    <?php $current = $i; ?>
                                    <?= $i; ?>
                                </a>
                            </li>
					    <?php endfor; ?> 

                        <?php if ($page != $current): ?>
                            <li class="waves-effect">
                                <a href="<?= FRONT_ROOT ?>client/listClientPath/<?= $page + 1; ?>">
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
                </div>
                <?php else: ?>
                    <div class="row">
                        <div class="col s6">
                            <div class="card-panel lime lighten-4">
                                <i class="material-icons left">error</i>
                                <span class="card-text card-warning">No se encontraron clientes. Intente mas tarde!</span>                       
                            </div>        
                        </div>                    
                    </div>    
                <?php endif; ?>
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
            td = tr[i].getElementsByTagName("td")[0];
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