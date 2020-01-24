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
                                <input id="lastName" type="text" name="lastName" class="validate" value="<?= $inputs["lastName"]; ?>" required>
                                <?php else: ?>
                                <input id="lastName" type="text" name="lastName" class="validate" required>
                                <?php endif; ?>                                                                
                                <label for="lastName">Apellido</label>
                            </div>                         
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <?php if (isset($inputs["email"])): ?>              
                                <input id="email" type="email" name="email" class="validate" value="<?= $inputs["email"]; ?>" required>
                                <?php else: ?>
                                <input id="email" type="email" name="email" class="validate" required>
                                <?php endif; ?>                                                                 
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s6">
                                <?php if (isset($inputs["dni"])): ?>              
                                <input id="dni" type="number" name="dni" class="validate" value="<?= $inputs["dni"]; ?>" required>
                                <?php else: ?>
                                <input id="dni" type="number" name="dni" class="validate" required>
                                <?php endif; ?>                                             
                                <label for="dni">DNI</label>
                            </div>                                                         
                        </div>                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" name="password" class="validate" required>
                                <label for="password">Contraseña</label>
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