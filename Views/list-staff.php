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
                    <?php if (isset($showDisables)): ?>
                    <a href="<?= FRONT_ROOT ?>staff/listStaffPath">                    
                        <i class="material-icons left">arrow_forward</i>
                        <span>
                            Mostrar solo habilitados
                        </span>    
                    </a>
                    <?php else: ?>
                        <a href="<?= FRONT_ROOT ?>staff/listStaffPath/1/disables">                    
                        <i class="material-icons left">arrow_forward</i>
                        <span>
                            Mostrar deshabilitados
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

                <?php if (sizeof($staffs) > 0): ?>
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
                                <th>Cargo</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Sueldo</th>
                                <th>Mas información</th>                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($staffs as $staff): ?>
                                <tr>                                
                                    <td> <?= ucfirst( $staff->getName() ); ?> </td>
                                    <td> <?= ucfirst( $staff->getLastName() ); ?> </td>
                                    <td> <?= ucfirst( $staff->getPosition() ); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($staff->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($staff->getDateEnd())); ?> </td>
                                    <td> $<?= number_format($staff->getSalary(), 2, ',', '.'); ?> </td>
                                    <td>
                                        <ul class="collapsible">
                                            <li>
                                                <div class="collapsible-header">
                                                    <i class="material-icons left">arrow_forward</i>Ver mas
                                                </div>
                                                <div class="collapsible-body">
                                                    <ul>
                                                        <li>• DNI:  <?= $staff->getDni(); ?> </li>
                                                        <li>• Dirección:  <?= ucfirst( $staff->getAddress() ); ?> </li>
                                                        <li>• Telefono:  <?= $staff->getPhone(); ?> </li>
                                                        <li>• Talle de remera:  <?= ucfirst( $staff->getShirtSize() ); ?> </li>
                                                        <li>• Talle de pantalon:  <?= ucfirst( $staff->getPantSize() ); ?> </li>
                                                        <li>• Registrado por: 
                                                                <?= ucfirst( $staff->getRegisterBy()->getName() ); ?>
                                                                <?= ucfirst( $staff->getRegisterBy()->getLastName() ); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>                                      
                                    </td>  

                                    <td class="actions">
                                        <?php if ($staff->getIsActive()): ?>
                                            <a href="<?= FRONT_ROOT ?>staff/disable/<?= $staff->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                                <i class="material-icons left">delete_forever</i>
                                                Deshabilitar
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= FRONT_ROOT ?>staff/enable/<?= $staff->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                                <i class="material-icons left">delete_forever</i>
                                                Habilitar
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?= FRONT_ROOT ?>staff/updatePath/<?= $staff->getId(); ?>" class="waves-effect waves-light btn-small">
                                            <i class="material-icons left">build</i>
                                            Modificar
                                        </a>
                                    </td>                                   
                                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>                                          

                    <?php if (isset($staffsCount)): ?>
                        <?php if ($staffsCount > MAX_ITEMS_PAGE): ?>
                            <ul class="pagination center-align">     

                                <?php if ($page > 1): ?>                    
                                <li class="waves-effect">
                                    <a href="<?= FRONT_ROOT ?>staff/listStaffPath/<?= $page - 1; ?>">
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
                                        <a href="<?= FRONT_ROOT ?>staff/listStaffPath/<?= $i; ?>">
                                            <?php $current = $i; ?>
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?> 

                                <?php if ($page != $current): ?>
                                    <li class="waves-effect">
                                        <a href="<?= FRONT_ROOT ?>staff/listStaffPath/<?= $page + 1; ?>">
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

                    <?php elseif (isset($d_staffsCount)): ?>
                        <?php if ($d_staffsCount > MAX_ITEMS_PAGE): ?>                            
                            <ul class="pagination center-align">     

                                <?php if ($page > 1): ?>                    
                                <li class="waves-effect">
                                    <a href="<?= FRONT_ROOT ?>staff/listStaffPath/<?= $page - 1; ?>/disables">
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
                                        <a href="<?= FRONT_ROOT ?>staff/listStaffPath/<?= $i; ?>/disables">
                                            <?php $d_current = $i; ?>
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?> 

                                <?php if ($page != $d_current): ?>
                                    <li class="waves-effect">                                    
                                        <a href="<?= FRONT_ROOT ?>staff/listStaffPath/<?= $page + 1; ?>/disables">
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
                <?php else: ?>
                    <div class="row">
                        <div class="col s6">
                            <div class="card-panel lime lighten-4">
                                <i class="material-icons left">error</i>
                                <span class="card-text card-warning">No se encontró personal. Intente mas tarde!</span>                       
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
 