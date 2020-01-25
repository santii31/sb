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
                                        <span>
                                            • Nº Carpa: <?= $reservation->getBeachTent()->getNumber(); ?>
                                        </span>
                                        <span>
                                            • Precio final: $<?= $reservation->getPrice(); ?>
                                        </span>
                                        <span>
                                            • Fecha inicio: <?= date("d-m-Y" , strtotime($reservation->getDateStart())); ?>
                                        </span>
                                        <span>
                                            • Fecha fin: <?= date("d-m-Y" , strtotime($reservation->getDateEnd())); ?>
                                        </span>
                                        <span>
                                            • Telefono: <?= $reservation->getClient()->getPhone(); ?>
                                        </span>
                                    </div>                                    
                                </div>
                            </li>                        
                        </ul>
                    </div>
                </div>

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
                                                <input id="total" type="number" name="total" class="validate" value="<?= $reservation->getPrice() ?>" required> 
                                                <?php else: ?>
                                                <input id="total" type="number" name="total" class="validate" required>
                                                <?php endif; ?>
                                                <label for="total">Debe</label>
                                            </div>            
                                            <div class="input-field col s4">
                                                <input id="partial" type="number" name="partial" class="validate" required>
                                                <label for="partial">Haber</label>
                                            </div>            
                                            <div class="input-field col s4">
                                                <input id="remainder" type="number" name="remainder" class="validate" value=0 required>
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
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($balances as $balance): ?>
                            <tr>                                
                                <td> <?= date("d-m-Y" , strtotime($balance->getDate())); ?> </td>
                                <td> <?= ucfirst( $balance->getConcept() ); ?> </td>
                                <td> <?= $balance->getNumberReceipt(); ?> </td>
                                <td> $<?= $balance->getTotal(); ?> </td>
                                <td> $<?= $balance->getPartial(); ?> </td>
                                <td> $<?= $balance->getRemainder(); ?> </td>
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
