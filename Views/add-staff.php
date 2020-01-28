        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>staff/addStaff" method="post" class="col s10 form-test">

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
                                <?php if (isset($inputs["position"])): ?>              
                                <input id="position" type="text" name="position" class="validate" value="<?= $inputs["position"]; ?>" required>
                                <?php else: ?>
                                <input id="position" type="text" name="position" class="validate" required>
                                <?php endif; ?>                                 
                                <label for="position">Cargo</label>
                            </div>                                                 
                            <div class="input-field col s6">
                                <?php if (isset($inputs["salary"])): ?>              
                                <input id="salary" type="number" name="salary" class="validate" value="<?= $inputs["salary"]; ?>" required>
                                <?php else: ?>
                                <input id="salary" type="number" name="salary" min="0" class="validate" required>
                                <?php endif; ?>                                 
                                <label for="salary">Sueldo</label>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <?php if (isset($inputs["date_start"])): ?>              
                                <input id="date_start" type="date" name="date_start" class="validate" value="<?= $inputs["date_start"]; ?>" required> 
                                <?php else: ?>
                                <input id="date_start" type="date" name="date_start" class="validate" required>                                
                                <?php endif; ?>                                   
                                <label for="date_start">Fecha de inicio</label>
                            </div>                         
                            <div class="input-field col s6">
                                <?php if (isset($inputs["date_end"])): ?>              
                                <input id="date_end" type="date" name="date_end" class="validate" value="<?= $inputs["date_end"]; ?>" required> 
                                <?php else: ?>
                                <input id="date_end" type="date" name="date_end" class="validate" required>                                
                                <?php endif; ?>                                  
                                <label for="date_end">Fecha de fin</label>
                            </div>                                                       
                        </div>                         

                        <div class="row">
                            <div class="input-field col s4">
                                <?php if (isset($inputs["dni"])): ?>              
                                <input id="dni" type="number" name="dni" class="validate" value="<?= $inputs["dni"]; ?>" required>
                                <?php else: ?>
                                <input id="dni" type="number" name="dni" min="0" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="dni">DNI</label>
                            </div>               
                            <div class="input-field col s4">
                                <?php if (isset($inputs["address"])): ?>              
                                <input id="address" type="text" name="address" class="validate" value="<?= $inputs["address"]; ?>" required>
                                <?php else: ?>
                                <input id="address" type="text" name="address" class="validate" required>
                                <?php endif; ?>                                 
                                <label for="address">Direccion</label>
                            </div>    
                            <div class="input-field col s4">
                                <?php if (isset($inputs["phone"])): ?>              
                                <input id="phone" type="number" name="phone" class="validate" value="<?= $inputs["phone"]; ?>" required>
                                <?php else: ?>
                                <input id="phone" type="number" name="phone" min="0" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="phone">Telefono</label>
                            </div>  
                        </div>      
                                 
                        <div class="row">
                            <div class="input-field col s6">
                                <?php if (isset($inputs["shirt_size"])): ?>              
                                <input id="shirt_size" type="text" name="shirt_size" class="validate" value="<?= $inputs["shirt_size"]; ?>" required>
                                <?php else: ?>
                                <input id="shirt_size" type="text" name="shirt_size" class="validate" required>
                                <?php endif; ?>                                 
                                <label for="shirt_size">Talla de pantalon</label>
                            </div>    
                            <div class="input-field col s6">
                                <?php if (isset($inputs["pant_size"])): ?>              
                                <input id="pant_size" type="text" name="pant_size" class="validate" value="<?= $inputs["pant_size"]; ?>" required>
                                <?php else: ?>
                                <input id="pant_size" type="text" name="pant_size" class="validate" required>
                                <?php endif; ?>                                      
                                <label for="pant_size">Talla de remera</label>
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