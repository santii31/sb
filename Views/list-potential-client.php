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
                    <table class="responsive-table centered" id="table-filter">
                        <thead>                            
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Domicilio</th>
                                <th>Ciudad</th>
                                <th>Email</th>
                                <th>Telefono</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($clients as $client): ?>
                            <tr>
                                <td> <?= $client->getId(); ?> </td>
                                <td> <?= ucfirst( $client->getName() ); ?> </td>
                                <td> <?= ucfirst( $client->getLastName() ); ?> </td>
                                <td> <?= ucfirst( $provider->getAddress() ); ?> </td>
                                <td> <?= ucfirst( $provider->getCity() ); ?> </td>
                                <td> <?= $provider->getEmail(); ?> </td>
                                <td> <?= $client->getPhone(); ?> </td>
                                
                                <td>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons left">arrow_forward</i>Ver mas
                                            </div>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <li>• DNI:  <?= $provider->getDni(); ?> </li>
                                                    <li>• Número de CUIL:  <?= $provider->getCuilNumber(); ?> </li>
                                                    <li>• Razón social:  <?= ucfirst( $provider->getSocialReason() ); ?> </li>
                                                    <li>• Tipo de facturacion:  <?= ucfirst( $provider->getBilling() ); ?> </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>                                      
                                </td>                                
                                <td class="actions">

                                    <?php if ($client->getIsActive()): ?>
                                        <a href="<?= FRONT_ROOT ?>client/disablePotential/<?= $client->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                            <i class="material-icons left">delete_forever</i>
                                            Deshabilitar
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= FRONT_ROOT ?>client/enablePotential/<?= $client->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left">delete_forever</i>
                                            Habilitar
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?= FRONT_ROOT ?>client/updatePotentialPath/<?= $client->getId(); ?>" class="waves-effect waves-light btn-small">
                                        <i class="material-icons left">build</i>
                                        Modificar
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