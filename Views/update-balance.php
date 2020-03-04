        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>balance/update" method="post" class="col s10 form-test">

                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
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
                                        
                        <input type="hidden" name="id_balance" value="<?= $id_balance ?>">
                        
                        <div class="row">                                            
                            <div class="input-field col s4">
                                <input id="date" type="date" name="date" class="validate" value="<?= $balance->getDate(); ?>" required>
                                <label for="date">Fecha</label>
                            </div>            
                            <div class="input-field col s4">
                                <input id="concept" type="text" name="concept" class="validate" value="<?= $balance->getConcept(); ?>" required>
                                <label for="concept">Concepto</label>
                            </div>            
                            <div class="input-field col s4">
                                <input id="number_r" type="text" name="number_r" class="validate" value="<?= $balance->getNumberReceipt(); ?>" required>
                                <label for="number_r">Nº Recibo</label>
                            </div>            
                        </div>

                        <div class="row">                                            
                            <div class="input-field col s4">                                    
                                <input id="total" type="number" name="total" min="0" class="validate" value="<?= $balance->getTotal(); ?>" required>                                    
                                <label for="total">Debe</label>
                            </div>            
                            <div class="input-field col s4">
                                <input id="partial" type="number" name="partial" min="0" class="validate" value="<?= $balance->getPartial(); ?>" required>
                                <label for="partial">Haber</label>
                            </div>            
                            <div class="input-field col s4">
                                <input id="remainder" type="number" name="remainder" min="0" class="validate" value="<?= $balance->getRemainder(); ?>" required>
                                <label for="remainder">Saldo</label>
                            </div>            
                        </div>
                        <input type="hidden" name="id_reservation" value="<?= $balance->getReservation()->getId(); ?>">

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Modificar
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