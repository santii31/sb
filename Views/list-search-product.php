        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content table-container">
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>
                        <?= $title ?>
                    </h2>
                </div>

                <div class="divider mb-divider"></div>

                <nav class="search-container">                
                    <div class="nav-wrapper s-color">                    
                        <div class="input-field">
                            <input id="search" type="search" placeholder="Filtrar por nombre...">
                            <label class="label-icon" for="search">
                                <i class="material-icons" >search</i>
                            </label>                            
                        </div>                    
                    </div>
                </nav>                
                
                <div class="row">                    
                    <table class="responsive-table centered" id="table-filter">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td> <?= $product->getId(); ?> </td>
                                    <td> <?= ucfirst( $product->getName() ); ?> </td>
                                    <td> $ <?= $product->getPrice(); ?> </td>
                                    <td> <?= $product->getQuantity(); ?> </td>
                                    <td> <?= ucfirst( $product->getCategory()->getName() ); ?> </td>
                                    <td class="actions">    
                                        <div>                                            
                                            <a class="waves-effect waves-light btn modal-trigger btn-small btn-danger" href="#remove">Quitar</a>
                                            
                                            <div id="remove" class="modal">
                                                <div class="modal-content">
                                                    <h4>Quitar stock</h4>       

                                                    <form action="<?= FRONT_ROOT ?>stock/removeStock" method="post">
                                                        <input type="hidden" name="id_product" value="<?= $product->getId(); ?>">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <input id="quantity_r" type="number" name="quantity" class="validate" required>
                                                                <label for="quantity_r">Ingrese cantidad a quitar</label>
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
                                        <div>                                                                                        
                                            <a class="waves-effect waves-light btn modal-trigger btn-small btn-safe" href="#add">Agregar</a>
                                            
                                            <div id="add" class="modal">
                                                <div class="modal-content">
                                                    <h4>Agregar stock</h4>    

                                                    <form action="<?= FRONT_ROOT ?>stock/addStock" method="post">
                                                        <input type="hidden" name="id_product" value="<?= $product->getId(); ?>">
                                                        <div class="row">
                                                            <div class="input-field col s12">
                                                                <input id="quantity" type="number" name="quantity" class="validate" required>
                                                                <label for="quantity">Ingrese cantidad a agregar</label>
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
                                    </td>                   
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>