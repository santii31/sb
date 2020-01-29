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

                <?php if (sizeof($adminList) > 0): ?>
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
                            <th>Cantidad de ventas</th>
                            <th>Cantidad en pesos</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($adminList as $adminA): ?>
                                <tr>                                                                  
                                    <td> <?= ucfirst( $adminA->getName() ); ?> </td>
                                    <td> <?= ucfirst( $adminA->getLastName() ); ?> </td>
                                    <td> <?= $this->adminController->getAllCountRsvByAdmin($adminA); ?></td>
                                    <td> $<?= number_format($this->adminController->getTotalRsvById($adminA), 2, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?= FRONT_ROOT ?>reservation/listReservationByAdminPath/<?= $adminA->getId(); ?>" class="waves-effect waves-light btn-small">
                                            <i class="material-icons left">list</i>
                                            Ver reservas
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
                                <span class="card-text card-warning">Los administradores no han realizado ventas.</span>                       
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