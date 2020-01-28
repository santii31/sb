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

                <?php if (sizeof($checks) > 0): ?>
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
                                <th>Ciudad</th>
                                <th>Banco</th>
                                <th>Nº Cuenta</th>
                                <th>Nº Cheque</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($checks as $check): ?>
                            <tr>                                
                                <td> <?= ucfirst( $check->getClient()->getName() ) ; ?> </td>
                                <td> <?= ucfirst( $check->getClient()->getLastName() ); ?> </td>
                                <td> <?= ucfirst( $check->getClient()->getAddress() ); ?> </td>                                
                                <td> <?= $check->getClient()->getEmail(); ?> </td>
                                <td> <?= $check->getClient()->getPhone(); ?> </td>
                                <td> <?= ucfirst( $check->getClient()->getCity() ); ?> </td>
                                <td> <?= ucfirst( $check->getBank() ); ?> </td>                                
                                <td> <?= $check->getBank(); ?> </td>
                                <td> <?= $check->getAccountNumber(); ?> </td>
                                <td> <?= $check->getCheckNumber(); ?> </td>  
                                <td> <?= ucfirst( $check->getCharged()); ?> </td>        
                                <td class="actions">
                                    <a href="<?= FRONT_ROOT ?>//<?= $check->getId(); ?>reservation/payed" class="waves-effect waves-light btn-small">
                                        <i class="material-icons left"></i>
                                        Cheque cobrado
                                    </a> 
                                    <a href="<?= FRONT_ROOT ?>//<?= $check->getId(); ?>reservation/unpayed" class="waves-effect waves-light btn-small">
                                        <i class="material-icons left"></i>
                                        Cheque rebotado
                                    </a>                                     
                                </td>                      
                            </tr>
                            <?php endforeach; ?>         
                        </tbody>
                    </table>                                          
                    
                </div>
                <?php else: ?>
                    <div class="row">
                        <div class="col s6">
                            <div class="card-panel lime lighten-4">
                                <i class="material-icons left">error</i>
                                <span class="card-text card-warning">No se encontraron cheques. Intente mas tarde!</span>                       
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