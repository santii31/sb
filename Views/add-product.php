        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>product/addProduct" method="post" class="col s10 form-test">

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
                                <select name="id_category">
                                    <option value="" disabled selected>Seleccione su opcion</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->getId(); ?>"><?= ucfirst( $category->getName() ); ?></option>
                                    <?php endforeach; ?> 
                                </select>
                                <label>Categoria</label>
                            </div>

                            <div class="input-field col s4">
                                <select name="id_provider">
                                    <option value="" disabled selected>Seleccione su opcion</option>
                                    <?php foreach ($providers as $provider): ?>
                                        <option value="<?= $provider->getId(); ?>"><?= ucfirst( $provider->getName() ) . ' ' . $provider->getLastName(); ?></option>
                                    <?php endforeach; ?> 
                                </select>
                                <label>Proveedor</label>
                            </div>

                            <div class="input-field col s4">
                                <?php if (isset($inputs["name"])): ?>              
                                <input id="name" type="text" name="name" class="validate" value="<?= $inputs["name"]; ?>" required>
                                <?php else: ?>
                                <input id="name" type="text" name="name" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="name">Nombre del producto</label>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <?php if (isset($inputs["price"])): ?>              
                                <input id="price" type="number" name="price" class="validate" value="<?= $inputs["price"]; ?>" required>
                                <?php else: ?>
                                <input id="price" type="number" name="price" min="0" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="price">Precio</label>
                            </div>
                            <div class="input-field col s6">
                                <?php if (isset($inputs["quantity"])): ?>              
                                <input id="quantity" type="number" name="quantity" class="validate" value="<?= $inputs["quantity"]; ?>" required>
                                <?php else: ?>
                                <input id="quantity" type="number" name="quantity" min="0" class="validate" required>
                                <?php endif; ?>                                  
                                <label for="quantity">Cantidad</label>
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