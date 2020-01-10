        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>email/sendEmail" method="post" class="col s10 form-test">

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

                        <div class="mail-filter">
                            <span>Enviar a:</span>
                            <label>
                                <input type="checkbox" name="check[]" value="client" checked />
                                <span>Clientes</span>
                            </label>
                            <label>
                                <input type="checkbox" name="check[]" value="client_p" />
                                <span>Clientes potenciales</span>
                            </label>
                            <label>
                                <input type="checkbox" name="check[]" value="admin" />
                                <span>Administradores</span>
                            </label>
                        </div>                        

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="title" type="text" name="title" class="validate" required>
                                <label for="title">Asunto</label>
                            </div>                            
                        </div>                                                    
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea1" name="msg" class="materialize-textarea"></textarea>
                                <label for="textarea1">Mensaje</label>
                            </div>
                        </div>                                                    
                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
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