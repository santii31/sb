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
                    <a href="<?= FRONT_ROOT ?>provider/listProviderPath">              
                        <i class="material-icons left">arrow_forward</i>
                        <span>
                            Mostrar solo habilitados
                        </span>    
                    </a>
                    <?php else: ?>                        
                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath/1/disables">                    
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

                <?php if (sizeof($providers) > 0): ?>
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
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Rubro</th>                                
                                <th>Mas información</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($providers as $provider): ?>
                            <tr>                                
                                <td> <?= ucfirst( $provider->getName() ); ?> </td>
                                <td> <?= ucfirst( $provider->getLastName() ); ?> </td>
                                <td> <?= $provider->getPhone(); ?> </td>
                                <td> <?= $provider->getEmail(); ?> </td>
                                <td> <?= ucfirst( $provider->getItem() ); ?> </td>                                
                                <td>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons left">arrow_forward</i>Ver mas
                                            </div>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <li>• Domicilio:  <?= ucfirst( $provider->getAddress() ); ?> </li>
                                                    <li>• DNI:  <?= $provider->getDni(); ?> </li>
                                                    <li>• Número de CUIL:  <?= $provider->getCuilNumber(); ?> </li>
                                                    <li>• Razón social:  <?= ucfirst( $provider->getSocialReason() ); ?> </li>
                                                    <li>• Tipo de facturacion:  <?= ucfirst( $provider->getBilling() ); ?> </li>
                                                    <li>• Registrado por: 
                                                            <?= ucfirst( $provider->getRegisterBy()->getName() ); ?>
                                                            <?= ucfirst( $provider->getRegisterBy()->getLastName() ); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>                                      
                                </td>                                
                                <td class="actions">
                                    <?php if ($provider->getIsActive()): ?>
                                        <a href="<?= FRONT_ROOT ?>provider/disable/<?= $provider->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                            <i class="material-icons left">delete_forever</i>
                                            Deshabilitar
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= FRONT_ROOT ?>provider/enable/<?= $provider->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left">delete_forever</i>
                                            Habilitar
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?= FRONT_ROOT ?>provider/updatePath/<?= $provider->getId(); ?>" class="waves-effect waves-light btn-small">
                                        <i class="material-icons left">build</i>
                                        Modificar
                                    </a>                                                                                            
                                </td>
                            </tr>
                            <?php endforeach; ?>         
                        </tbody>
                    </table>                                          

                    <?php if (isset($providersCount)): ?>
                        <?php if ($providersCount > MAX_ITEMS_PAGE): ?>
                            <ul class="pagination center-align">     

                                <?php if ($page > 1): ?>                    
                                <li class="waves-effect">
                                    <a href="<?= FRONT_ROOT ?>provider/listProviderPath/<?= $page - 1; ?>">
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
                                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath/<?= $i; ?>">
                                            <?php $current = $i; ?>
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?> 

                                <?php if ($page != $current): ?>
                                    <li class="waves-effect">
                                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath/<?= $page + 1; ?>">
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

                    <?php elseif (isset($d_providersCount)): ?>
                        <?php if ($d_providersCount > MAX_ITEMS_PAGE): ?>                            
                            <ul class="pagination center-align">     

                                <?php if ($page > 1): ?>                    
                                <li class="waves-effect">
                                    <a href="<?= FRONT_ROOT ?>provider/listProviderPath/<?= $page - 1; ?>/disables">
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
                                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath/<?= $i; ?>/disables">
                                            <?php $d_current = $i; ?>
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?> 

                                <?php if ($page != $d_current): ?>
                                    <li class="waves-effect">                                    
                                        <a href="<?= FRONT_ROOT ?>provider/listProviderPath/<?= $page + 1; ?>/disables">
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
                                <span class="card-text card-warning">No se encontraron proveedores. Intente mas tarde!</span>                       
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