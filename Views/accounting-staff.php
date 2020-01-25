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
                    <div class="col s12">
                        <h5>• Total gastado en personal: $<?= $total ?></h5>
                    </div>
                </div>

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
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($staffs as $staff): ?>
                                <tr>                                    
                                    <td> <?= ucfirst( $staff->getName() ); ?> </td>
                                    <td> <?= ucfirst( $staff->getLastName() ); ?> </td>
                                    <td> <?= ucfirst( $staff->getPosition() ); ?> </td>                                    
                                    <td> <?= date("d-m-Y", strtotime($staff->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y", strtotime($staff->getDateEnd())); ?> </td>
                                    <td> $<?= $staff->getSalary(); ?> </td>                                            
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
 