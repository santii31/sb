        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>additionalService/chose" method="post" class="col s10 form-test">

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

                        <div class="row center-align">
                            <div class="input-field col s6">
                            <p>
                                <label>
                                    <input id="last_name" type="radio" name="answer" class="with-gap" value="yes">
                                    <span>Si</span>
                                </label>
                            </p>
                                
                            </div>
                            <div class="input-field col s6">
                            <p>
                                <label>
                                    <input id="last_name" type="radio" name="answer" class="with-gap" value="no">
                                    <span>No</span>
                                </label>
                            </p>
                            </div>

                            <input type="hidden" name="id_reserve" value="<?= $id_reservation ?>">                                               
                        </div>                        

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Siguiente
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