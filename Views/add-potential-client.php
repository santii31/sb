        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT  ?>clientPotential/addPotentialClient" method="post" class="col s10 form-test">

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
                                <?php if (isset($inputs["name"])): ?>              
                                <input id="name" type="text" name="name" class="validate" value="<?= $inputs["name"]; ?>" required>
                                <?php else: ?>
                                <input id="name" type="text" name="name" class="validate" required>
                                <?php endif; ?>                                   
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <?php if (isset($inputs["lastName"])): ?>              
                                <input id="lastname" type="text" name="lastname" class="validate" value="<?= $inputs["lastName"]; ?>" required>
                                <?php else: ?>
                                <input id="lastname" type="text" name="lastname" class="validate" required>
                                <?php endif; ?>                                                                   
                                <label for="lastname">Apellido</label>
                            </div>                         
                        </div>
                                                
                        <div class="row">
                            <div class="input-field col s6">
                                <?php if (isset($inputs["address"])): ?>              
                                <input id="address" type="text" name="address" class="validate" value="<?= $inputs["address"]; ?>" required>
                                <?php else: ?>
                                <input id="address" type="text" name="address" class="validate" required>
                                <?php endif; ?>                                    
                                <label for="address">Domicilio</label>
                            </div>
                            <div class="input-field col s6">
                                <?php if (isset($inputs["city"])): ?>              
                                <input id="city" type="text" name="city" class="validate" value="<?= $inputs["city"]; ?>" required>
                                <?php else: ?>
                                <input id="city" type="text" name="city" class="validate" required>
                                <?php endif; ?>                                      
                                <label for="city">Ciudad</label>
                            </div>                                                       
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <?php if (isset($inputs["email"])): ?>              
                                <input id="email" type="email" name="email" class="validate" value="<?= $inputs["email"]; ?>" required>
                                <?php else: ?>
                                <input id="email" type="email" name="email" class="validate" required>
                                <?php endif; ?>                                   
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <?php if (isset($inputs["phone"])): ?>              
                                <input id="phone" type="number" name="phone" class="validate" value="<?= $inputs["phone"]; ?>" required>
                                <?php else: ?>
                                <input id="phone" type="number" name="phone" class="validate" required>
                                <?php endif; ?>                                        
                                <label for="phone">Telefono</label>
                            </div>      
                            <div class="input-field col s4">
                                <?php if (isset($inputs["num_tent"])): ?>              
                                <input id="num_tent" type="number" name="num_tent" class="validate" value="<?= $inputs["num_tent"]; ?>" required>
                                <?php else: ?>
                                <input id="num_tent" type="number" name="num_tent" class="validate" required>
                                <?php endif; ?>                                   
                                <label for="num_tent">Numero de carpa de interes</label>
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
    