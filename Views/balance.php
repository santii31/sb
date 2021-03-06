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

                <div class="row">
                    <div class="col s12">
                        <ul class="collapsible ">
                            <li class="active">
                                <div class="collapsible-header">
                                    <i class="material-icons">arrow_drop_down</i>
                                    Ver informacion de la reserva
                                </div>
                                <div class="collapsible-body">
                                    <div class="more-info-reservation z-depth-1">
                                        <span>
                                            • Cliente: <?= ucfirst($reservation->getClient()->getName()) 
                                                        . ' ' . 
                                                        ucfirst($reservation->getClient()->getLastName()); ?>
                                        </span>

                                        <?php if ($reservation->getBeachTent() != null): ?>
                                        <span>
                                            • Nº Carpa: <?= $reservation->getBeachTent()->getNumber(); ?>
                                        </span>
                                        <?php elseif ($reservation->getParasol() != null): ?>
                                        <span>
                                            • Nº Sombrilla: <?= $reservation->getParasol()->getParasolNumber(); ?>
                                        </span>
                                        <?php endif; ?>

                                        <span>
                                            • Fecha inicio: <?= date("d-m-Y" , strtotime($reservation->getDateStart())); ?>
                                        </span>
                                        <span>
                                            • Fecha fin: <?= date("d-m-Y" , strtotime($reservation->getDateEnd())); ?>
                                        </span>
                                        <span>
                                            • Telefono: <?= $reservation->getClient()->getPhone(); ?>
                                        </span><br>
                                        <span>
                                            • Precio final: $<?= number_format($reservation->getPrice(), 2, ',', '.'); ?>
                                        </span>
                                        <span>
                                            • Depositado: $<?= number_format($partialByClient, 2, ',', '.'); ?>
                                        </span>
                                    </div>                                    
                                </div>
                            </li>                        
                        </ul>
                    </div>
                </div>

                <?php if ($flag === true): ?>
                <div class="row">
                    <div class="col s12 center-align centered">
                        <div>                                            
                            <a class="waves-effect waves-light btn modal-trigger btn-small btn-safe" href="#remove">
                                Agregar Cuenta cliente
                            </a>                            
                            <div id="remove" class="modal">
                                <div class="modal-content">
                                    <h4>Cuenta cliente</h4>       
                                    <form action="<?= FRONT_ROOT ?>balance/add" method="post">
                                        
                                        <input type="hidden" name="id_reservation" value="<?= $id_reservation ?>">
                                        
                                        <div class="row">                                            
                                            <div class="input-field col s4">
                                                <input id="date" type="date" name="date" class="validate" required>
                                                <label for="date">Fecha</label>
                                            </div>            
                                            <div class="input-field col s4">
                                                <input id="concept" type="text" name="concept" class="validate" required>
                                                <label for="concept">Concepto</label>
                                            </div>            
                                            <div class="input-field col s4">
                                                <input id="number_r" type="text" name="number_r" class="validate" required>
                                                <label for="number_r">Nº Recibo</label>
                                            </div>            
                                        </div>

                                        <div class="row">                                            
                                            <div class="input-field col s4">
                                                <?php if (sizeof($balances) == 0): ?>
                                                <input id="total" type="number" name="total" class="validate" value="<?= $reservation->getPrice(); ?>" required> 
                                                <?php else: ?>
                                                <input id="total" type="number" name="total" min="0" class="validate" value="<?= $remainderByClient; ?>" required>
                                                <?php endif; ?>
                                                <label for="total">Debe</label>
                                            </div>            
                                            <div class="input-field col s4">
                                                <input id="partial" type="number" name="partial" min="0" class="validate" required>
                                                <label for="partial">Haber</label>
                                            </div>            
                                            <div class="input-field col s4">
                                                <input id="remainder" type="number" name="remainder" min="0" class="validate" value=0 required>
                                                <label for="remainder">Saldo</label>
                                            </div>            
                                        </div>

                                        <div class="row">
                                            <div class="col s12 center-align">
                                                <button class="btn waves-effect waves-light" type="submit" name="action">Añadir
                                                    <i class="material-icons right">add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>                                                
                            </div>
                        </div> 
                    </div>
                </div>
                <?php else: ?>
                    <div class="row">
                        <div class="col s6">
                            <div class="card-panel green lighten-4">
                                <i class="material-icons left">check</i>                            
                                <span class="card-text card-success"> Cuenta saldada! </span>
                            </div>        
                        </div>                    
                    </div>  
                <?php endif; ?>

                <div class="row">    
                <?php if (sizeof($balances)): ?>
                    <table class="responsive-table striped centered" id="table-filter">
                        <thead>                            
                            <tr>                                
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>Nº Recibo</th>                                
                                <th>Debe</th>
                                <th>Haber</th>
                                <th>Saldo</th>  
                                <th>Acciones</th>                              
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($balances as $balance): ?>
                            <tr>                                                                
                                <td> <?= date("d-m-Y" , strtotime($balance->getDate())); ?> </td>
                                <td> <?= ucfirst( $balance->getConcept() ); ?> </td>
                                <td> <?= $balance->getNumberReceipt(); ?> </td>
                                <td> $<?= number_format($balance->getTotal(), 2, ',', '.'); ?> </td>
                                <td> $<?= number_format($balance->getPartial(), 2, ',', '.'); ?> </td>
                                <td> $<?= number_format($balance->getRemainder(), 2, ',', '.'); ?> </td>
                                <td>
                                    <a href="<?= FRONT_ROOT ?>balance/updatePath/<?= $balance->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">                                        
                                        Modificar
                                    </a>
                                    <a href="<?= FRONT_ROOT ?>balance/delete/<?= $balance->getId(); ?>/<?= $id_reservation ?>" class="waves-effect waves-light btn-small btn-danger">                                        
                                        Eliminar
                                    </a>
                                </td>  
                            </tr>
                            <?php endforeach; ?>         
                        </tbody>
                    </table>                                          
                <?php else: ?>                    
                    <div class="row">
                        <div class="col s12 center-align">                            
                            <h5>
                                <i class="material-icons">report</i>                        
                                El cliente no ha realizado pagos por el momento.
                            </h5>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script>

    const totalInput = document.getElementById('total');
    const partialInput = document.getElementById('partial');
    const remainderInput = document.getElementById('remainder');

    let total = totalInput.value;    
    let partial = 0;  
    let remainder = 0;                  

    function renderTotal() {
        remainderInput.value =  (total - partial);
    }

    totalInput.addEventListener('change', () => {
        total = totalInput.value;
        renderTotal();        
    });

    partialInput.addEventListener('change', () => {
        partial = partialInput.value;
        renderTotal();        
    });                                

</script>
