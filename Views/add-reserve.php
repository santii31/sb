        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>reservation/addReservation" method="post" class="col s10 form-test">

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
                                <select name="stay">
                                    <option value="" disabled selected>Seleccione su opcion</option>                                    
                                        <option value="season">
                                            Temporada
                                        </option>                                    
                                        <option value="period">
                                            Periodo
                                        </option>
                                        <option value="fortnight">
                                            Quincena
                                        </option>
                                </select>
                                <label>Estadia</label>
                                
                                <!-- <input id="stay" type="text" name="stay" class="validate" required>
                                <label for="stay">Estadia</label> -->
                            </div>  
                            <div class="input-field col s4">
                                <input id="start" type="Date" name="start" class="validate" required>
                                <label for="start">Fecha de ingreso</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="end" type="Date" name="end" class="validate" required>
                                <label for="end">Fecha de egreso</label>
                            </div>                            
                        </div>      

                        <div class="row">                        
                            <div class="input-field col s6">
                                <input id="name" type="text" name="name" class="validate" required>
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="l_name" type="text" name="l_name" class="validate" required>
                                <label for="l_name">Apellido</label>
                            </div>                                                                          
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="addr" type="text" name="addr" class="validate" required>
                                <label for="addr">Domicilio</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="city" type="text" name="city" class="validate" required>
                                <label for="city">Ciudad</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="cp" type="number" name="cp" class="validate" required>
                                <label for="cp">Codigo Postal</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="phone" type="number" name="phone" class="validate" required>
                                <label for="phone">Telefono</label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="fam" type="text" name="fam" class="validate" required>
                                <label for="fam">Grupo familiar</label>
                            </div>                            
                            <div class="input-field col s4">
                                <input id="addrStay" type="text" name="addrStay" class="validate">
                                <label for="addrStay">Domicilio de estadia</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="phone2" type="number" name="phone2" class="validate">
                                <label for="phone2">Telefono de estadia</label>
                            </div>                                  
                        </div>                                                                
                                                
                        <input type="hidden" name="tent" value="<?= $id_tent ?>">

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
    