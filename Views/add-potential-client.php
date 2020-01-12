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
                                <input id="name" type="text" name="name" class="validate" required>
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="lastname" type="text" name="lastname" class="validate" required>
                                <label for="lastname">Apellido</label>
                            </div>                         
                        </div>
                                                
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address" type="text" name="address" class="validate" required>
                                <label for="address">Domicilio</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="city" type="text" name="city" class="validate" required>
                                <label for="city">Ciudad</label>
                            </div>                                                       
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="phone" type="number" name="phone" class="validate" required>
                                <label for="phone">Telefono</label>
                            </div>      
                            <div class="input-field col s4">
                                <input id="num_tent" type="number" name="num_tent" class="validate" required>
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
    