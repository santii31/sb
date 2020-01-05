        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>provider/addProvider" method="post" class="col s10 form-test">

                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
                            <h2>
                                Añadir proveedor
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
                                <input id="tel" type="number" name="tel" class="validate" required>
                                <label for="tel">Telefono</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Email</label>
                            </div>    
                            <div class="input-field col s4">
                                <input id="dni" type="number" name="dni" class="validate">
                                <label for="dni">DNI</label>
                            </div>                                                       
                        </div>                        
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="factura" type="text" name="fact" class="validate" required>
                                <label for="factura">Tipo de factura</label>
                            </div>   
                            <div class="input-field col s4">
                                <input id="cuil" type="number" name="cuil" class="validate" required>
                                <label for="cuil">Numero de CUIL</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="rs" type="text" name="socReason" class="validate" required>
                                <label for="rs">Razon social</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="domicilio" type="text" name="address" class="validate" required>
                                <label for="domicilio">Domicilio</label>
                            </div>                                                    
                        </div>                                               
                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
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
    