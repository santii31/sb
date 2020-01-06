        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>admin/update" method="post" class="col s10 form-test">

                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
                            <h2>
                                <?= $title ?>
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

                        <!--   
                        <?php if ($alert != null): ?>
                        <div class="row">
                            <div class="col s6">
                                <div class="card-panel red lighten-4">
                                    <i class="material-icons left">error</i>
                                    <span class="card-text card-alert"> <?= $alert; ?> </span>                            
                                </div>        
                            </div>                    
                        </div>                
                        <?php endif; ?> -->

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="name" type="text" name="name" class="validate" value="<?= $adm->getName(); ?>" required autofocus>
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="last_name" type="text" name="lastname" class="validate" value="<?= $adm->getLastName(); ?>" required>
                                <label for="last_name">Apellido</label>
                            </div>                         
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="email" type="email" name="email" class="validate" value="<?= $adm->getEmail(); ?>" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="dni" type="number" name="dni" class="validate" value="<?= $adm->getDni(); ?>" required>
                                <label for="dni">DNI</label>
                            </div>                                                         
                        </div>                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="contraseña" type="password" name="password" class="validate" required>
                                <label for="contraseña">Contraseña</label>
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