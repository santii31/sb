<!-- Main content  -->
<div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>admin/register" method="post" class="col s10 form-test">

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
                                <input id="name" type="text" name="" class="validate" required>
                                <label for="name">Cargo</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="last_name" type="text" name="" class="validate" required>
                                <label for="last_name">Fecha de inicio</label>
                            </div>                         
                            <div class="input-field col s4">
                                <input id="email" type="email" name="" class="validate" required>
                                <label for="email">Fecha de finalizacion</label>
                            </div>                                                       
                        </div> 

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="dni" type="number" name="" class="validate" required>
                                <label for="dni">Nombre</label>
                            </div>  
                            <div class="input-field col s6">
                                <input id="contraseña" type="password" name="" class="validate" required>
                                <label for="contraseña">Apellido</label>
                            </div>                                                             
                        </div>   

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="contraseña" type="password" name="" class="validate" required>
                                <label for="contraseña">DNI</label>
                            </div>               
                            <div class="input-field col s4">
                                <input id="contraseña" type="password" name="" class="validate" required>
                                <label for="contraseña">Direccion</label>
                            </div>    
                            <div class="input-field col s4">
                                <input id="contraseña" type="password" name="" class="validate" required>
                                <label for="contraseña">Telefono</label>
                            </div>  
                        </div>      
                                 
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="contraseña" type="password" name="" class="validate" required>
                                <label for="contraseña">Talla de pantalon</label>
                            </div>    
                            <div class="input-field col s6">
                                <input id="contraseña" type="password" name="" class="validate" required>
                                <label for="contraseña">Talla de remera</label>
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