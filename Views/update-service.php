        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>additionalService/update" method="post" class="col s10 form-test">

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

                        <input id="id" type="hidden" name="id" value="<?= $srv->getId(); ?>">

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="name" type="text" name="description" value="<?= $srv->getDescription(); ?>" class="validate" required>
                                <label for="name">Descripcion</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="last_name" type="number" name="price" value="<?= $srv->getTotal(); ?>" class="validate" required>
                                <label for="last_name">Precio</label>
                            </div>                         
                        </div>                        
                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Modificar
                                    <i class="material-icons right">update</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>      