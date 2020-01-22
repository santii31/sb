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
                
                <div class="row">                    
                    <table class="responsive-table centered" id="table-filter">
                        <thead>
                        <tr>                       
                            <th>Fecha actual</th>     
                            <th>Total de carpas</th>
                            <th>Actualmente ocupadas</th>
                            <th>Actualmente libres</th>
                        </tr>
                        </thead>

                        <tbody>                            
                            <tr>
                                <td> <?= date("d-m-Y"); ?></td>
                                <td> <?= $this->getAllTents() ; ?> (100%)</td>
                                <td> <?= $this->getAllTentsWithReservation(); ?> (<?= $this->getAllTentsWithReservationPercentage(); ?>%) </td>   
                                <td> <?= $this->getAllTentsFree(); ?> (<?= $this->getAllTentsFreePercentage(); ?>%)</td>    
                            </tr>                                                 
                        </tbody>
                    </table>
                </div>

                <br>
                <br>
                        
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>
                        Futuras reservas
                    </h2>
                </div>
                
                <div class="divider mb-divider"></div>             
                
                <div class="row">    
                    <div class="col s12">
                    
                    <table class="responsive-table centered" id="table-filter">
                        <thead>
                        <tr>                       
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Nº Carpa</th>     
                            <th>Cliente</th>
                            <th>Telefono</th>
                        </tr>
                        </thead>

                        <tbody>       
                            <?php foreach ($rsvFuture as $rsv): ?>
                                <tr>
                                    <td> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </td>
                                    <td> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </td>                                    
                                    <td> <?= $rsv->getBeachTent()->getNumber(); ?></td>
                                    <td> <?= ucfirst( $rsv->getClient()->getName() ) . ' ' . $rsv->getClient()->getLastName(); ?></td>
                                    <td> <?= $rsv->getClient()->getPhone(); ?> </td>
                                </tr>                                 
                            <?php endforeach; ?>                
                        </tbody>
                    </table>
                    </div>                
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