        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form class="col s10 form-test">

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
                            <div class="input-field col s6">
                                <input id="name" type="text" name="name" class="validate" required>
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="last_name" type="text" name="lastname" class="validate" required>
                                <label for="last_name">Apellido</label>
                            </div>                         
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="estadia" type="text" name="estadia" class="validate" required>
                                <label for="estadia">Estadia</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="cofres" type="text" name="chest" class="validate" required>
                                <label for="cofres">Cofres</label>
                            </div>    
                            <div class="input-field col s4">
                                <input id="servicio_ad" type="text" name="additionalServ" class="validate">
                                <label for="servicio_ad">Servicio adicional</label>
                            </div>                                                       
                        </div>                        
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="domicilio" type="text" name="address" class="validate" required>
                                <label for="domicilio">Domicilio</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="ciudad" type="text" name="city" class="validate" required>
                                <label for="ciudad">Ciudad</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="cp" type="number" name="cp" class="validate" required>
                                <label for="cp">CP</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="tel1" type="number" name="tel1" class="validate" required>
                                <label for="tel1">Telefono</label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="grupof" type="text" name="groupF" class="validate" required>
                                <label for="grupof">Grupo familiar</label>
                            </div>                            
                        </div>
                        <div class="divider mb-divider"></div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="domicilioEsta" type="text" name="addressEsta" class="validate">
                                <label for="domicilioEsta">Domicilio de estadia</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="tel2" type="number" name="tel2" class="validate">
                                <label for="tel2">Telefono de estadia</label>
                            </div>                                  
                        </div>                        
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
    