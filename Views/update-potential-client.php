        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT  ?>clientPotential/update" method="post" class="col s10 form-test">

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

                        <input id="name" type="hidden" name="id" value="<?= $client->getId(); ?>">

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="name" type="text" name="name" value="<?= $client->getName(); ?>" class="validate" required autofocus>
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="lastname" type="text" name="lastname" value="<?= $client->getLastName(); ?>" class="validate" required>
                                <label for="lastname">Apellido</label>
                            </div>                         
                        </div>
                                                
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address" type="text" name="address" value="<?= $client->getAddress(); ?>" class="validate" required>
                                <label for="address">Domicilio</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="city" type="text" name="city" value="<?= $client->getCity(); ?>" class="validate" required>
                                <label for="city">Ciudad</label>
                            </div>                                                       
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="email" type="email" name="email" value="<?= $client->getEmail(); ?>" class="validate" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="phone" type="number" name="phone" value="<?= $client->getPhone(); ?>" class="validate" required>
                                <label for="phone">Telefono</label>
                            </div>      
                            <div class="input-field col s4">
                                <input id="num_tent" type="number" name="num_tent" value="<?= $client->getNumTent(); ?>" class="validate" required>
                                <label for="num_tent">Numero de carpa</label>
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