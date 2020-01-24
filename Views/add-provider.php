        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>provider/addProvider" method="post" class="col s10 form-test">

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
                                <input id="last_name" type="text" name="lastname" class="validate" value="<?= $inputs["lastName"]; ?>" required>
                                <?php else: ?>
                                <input id="last_name" type="text" name="lastname" class="validate" required>
                                <?php endif; ?>                                    
                                <label for="last_name">Apellido</label>
                            </div>                         
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <?php if (isset($inputs["phone"])): ?>              
                                <input id="tel" type="number" name="tel" class="validate" value="<?= $inputs["phone"]; ?>" required>
                                <?php else: ?>
                                <input id="tel" type="number" name="tel" class="validate" required>
                                <?php endif; ?>                                   
                                <label for="tel">Telefono</label>
                            </div>
                            <div class="input-field col s4">
                                <?php if (isset($inputs["email"])): ?>              
                                <input id="email" type="email" name="email" class="validate" value="<?= $inputs["email"]; ?>" required>
                                <?php else: ?>
                                <input id="email" type="email" name="email" class="validate" required>
                                <?php endif; ?>                                 
                                <label for="email">Email</label>
                            </div>    
                            <div class="input-field col s4">
                                <?php if (isset($inputs["dni"])): ?>              
                                <input id="dni" type="number" name="dni" class="validate" value="<?= $inputs["dni"]; ?>" required>
                                <?php else: ?>
                                <input id="dni" type="number" name="dni" class="validate" required>
                                <?php endif; ?>                                     
                                <label for="dni">DNI</label>
                            </div>                                                       
                        </div>                        
                        <div class="row">
                            <div class="input-field col s4">
                                <?php if (isset($inputs["billing"])): ?>              
                                <input id="factura" type="text" name="fact" class="validate" value="<?= $inputs["billing"]; ?>" required>
                                <?php else: ?>
                                <input id="factura" type="text" name="fact" class="validate" required>
                                <?php endif; ?>                                 
                                <label for="factura">Tipo de factura</label>
                            </div>   
                            <div class="input-field col s4">
                                <?php if (isset($inputs["cuil_number"])): ?>              
                                <input id="cuil" type="number" name="cuil" class="validate" value="<?= $inputs["cuil_number"]; ?>" required>
                                <?php else: ?>
                                <input id="cuil" type="number" name="cuil" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="cuil">Número de CUIL</label>
                            </div>
                            <div class="input-field col s4">
                                <?php if (isset($inputs["social_reason"])): ?>              
                                <input id="rs" type="text" name="socReason" class="validate" value="<?= $inputs["social_reason"]; ?>" required>
                                <?php else: ?>
                                <input id="rs" type="text" name="socReason" class="validate" required>
                                <?php endif; ?>                                   
                                <label for="rs">Razón social</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <?php if (isset($inputs["address"])): ?>              
                                <input id="domicilio" type="text" name="address" class="validate" value="<?= $inputs["address"]; ?>" required>
                                <?php else: ?>
                                <input id="domicilio" type="text" name="address" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="domicilio">Domicilio</label>
                            </div>
                            <div class="input-field col s6">
                                <?php if (isset($inputs["item"])): ?>              
                                <input id="item" type="text" name="item" class="validate" value="<?= $inputs["item"]; ?>" required>
                                <?php else: ?>
                                <input id="item" type="text" name="item" class="validate" required>
                                <?php endif; ?>                                    
                                <label for="item">Rubro</label>
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
    