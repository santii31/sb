        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>reservation/addCheck" method="post" class="col s10 form-test">

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

                        <div class="row">
                        
                            <div class="input-field col s4">
                                <input id="bank" type="text" name="bank" class="validate" required>
                                <label for="bank">Banco</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="account_number" type="number" name="account_number" class="validate" required>
                                <label for="account_number">Numero de cuenta</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="check_number" type="number" name="check_number" class="validate" required>
                                <label for="check_number">Numero de cheque</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="check_paymentDate" type="date" name="check_paymentDate" class="validate" required>
                                <label for="check_paymentDate">Fecha de entrega</label>
                            </div>
                            
                        </div>    
                        
                        <input type="hidden" name="id_client" value="<?= $reservation->getClient()->getId(); ?>" >
                        <input type="hidden" name="id_reserve" value="<?= $id_reserve; ?>">
                                            
                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Añadir
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>