        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>client/update" method="post" class="col s10 form-test">

                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
                            <h2>
                                <?= $title ?>
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

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

                        <input id="id" type="hidden" name="id" value="<?= $client->getId(); ?>">

                        <div class="row">                        
                            <div class="input-field col s6">                                
                                <input id="name" type="text" name="name" class="validate" value="<?= $client->getName(); ?>" required>            
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="l_name" type="text" name="l_name" class="validate" value="<?= $client->getLastName(); ?>" required>    
                                <label for="l_name">Apellido</label>
                            </div>                                                                          
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="addr" type="text" name="addr" class="validate" value="<?= $client->getAddress(); ?>" required>
                                <label for="addr">Domicilio</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="city" type="text" name="city" class="validate" value="<?= $client->getCity(); ?>" required>
                                <label for="city">Ciudad</label>
                            </div>
                            <div class="input-field col s4">                            
                                <input id="cp" type="number" name="cp" class="validate" value="<?= $client->getCp(); ?>" required>
                                <label for="cp">Codigo Postal</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="email" type="email" name="email" class="validate" value="<?= $client->getEmail(); ?>" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="phone" type="number" name="phone" class="validate" value="<?= $client->getPhone(); ?>" required>
                                <label for="phone">Telefono</label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="fam" type="text" name="fam" class="validate" value="<?= $client->getFamilyGroup(); ?>" required>
                                <label for="fam">Grupo familiar</label>
                            </div>       

                            <div class="input-field col s6">
                                <input id="phone2" type="number" name="auxiliary_phone" class="validate" value="<?= $client->getAuxiliaryPhone(); ?>" required>
                                <label for="phone2">Telefono auxiliar</label>
                            </div>                                  
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <label>Tipo de vehiculo:</label>
                            </div>
                            <div class="input-field col s2">
                                <p>
                                    <label>
                                        <input id="vehicle" type="radio" name="vehicle" class="with-gap" value="car">
                                        <span>Auto</span>
                                    </label>
                                </p>                                        
                            </div>
                            
                            <div class="input-field col s2">
                                <p>
                                    <label>
                                        <input id="vehicle" type="radio" name="vehicle" class="with-gap" value="van">
                                        <span>Camioneta</span>
                                    </label>
                                </p>
                            </div>
                            
                            <div class="input-field col s2">
                                <p>
                                    <label>
                                        <input id="vehicle" type="radio" name="vehicle" class="with-gap" value="motorcycle">
                                        <span>Moto</span>
                                    </label>
                                </p>
                            </div>                
                            
                            <div class="input-field col s2">
                                <p>
                                    <label>
                                        <input id="none" type="radio" name="vehicle" class="with-gap" value="none">
                                        <span>Sin vehiculo</span>
                                    </label>
                                </p>
                            </div>                                                  

                        </div>

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Modificar
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
    
