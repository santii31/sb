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

                <?php if (sizeof($rsvList) > 0): ?>
                <nav class="search-container">                
                    <div class="nav-wrapper s-color">                    
                        <div class="input-field">
                            <input id="search" type="search" placeholder="Filtrar por cliente...">
                            <label class="label-icon" for="search">
                                <i class="material-icons" >search</i>
                            </label>                            
                        </div>                    
                    </div>
                </nav>                
                                
                <div class="row">
                    <div class="col s12">
                        <h5>• Total recaudado: $<?= number_format($total, 2, ',', '.'); ?></h5>
                    </div>
                </div>

                <div class="row">                    
                    <table class="responsive-table striped centered" id="table-filter">
                        <thead>
                        <tr>                            
                            <th>Cliente</th>    
                            <th>Nº Carpa</th>       
                            <th>Nº Sombrilla</th>  
                            <th>Fecha inicio</th>                                           
                            <th>Fecha fin</th>
                            <th>Precio</th>                            
                            <th>Registrado por</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rsvList as $rsv): ?>
                                <tr>                                    
                                    <td> <?= ucfirst($rsv->getClient()->getName()) . ' ' . ucfirst( $rsv->getClient()->getLastName() ); ?> </td>
                                    
                                    <?php if ($rsv->getBeachTent() != null): ?>
                                    <td> <?= $rsv->getBeachTent()->getNumber(); ?> </td>
                                    <?php else: ?>
                                    <td> N/A </td>
                                    <?php endif; ?>

                                    <?php if ($rsv->getParasol() != null): ?>
                                    <td> <?= $rsv->getParasol()->getParasolNumber(); ?> </td>
                                    <?php else: ?>
                                    <td> N/A </td>
                                    <?php endif; ?>                                    

                                    <td> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </td>                                    
                                    <td> $<?= number_format($rsv->getPrice(), 2, ',', '.');  ?> </td>
                                    <td> <?= ucfirst( $rsv->getRegisterBy()->getName()) . ' ' . ucfirst( $rsv->getRegisterBy()->getLastName()); ?> </td>
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
                                <span class="card-text card-warning">No se realizaron ventas en el día de hoy.</span>                       
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