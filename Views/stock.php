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
                            <th>Proveedor</th>
                            <th>Categoria</th>
                            <th>Precio</th>                            
                            <th>Stock actual</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td> <?= $product->getId(); ?> </td>
                                    <td> <?= ucfirst( $product->getName() ); ?> </td>
                                    <td> <?= ucfirst( $this->getProviderByProduct($product) ); ?>   </td>
                                    <td> <?= ucfirst($product->getCategory()->getName() ); ?> </td>
                                    <td> $<?= $product->getPrice(); ?> </td>
                                    <td> <?= $product->getQuantity(); ?> </td>       
                                    <td> <?= $product->getDateRegister(); ?> </td>                             
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
                                                                <input id="quantity_r" type="number" name="quantity_r" class="validate" required>
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
<script>

	let outerInput = document.getElementById('search');

    outerInput.addEventListener('keyup', function() {
        let innerInput, filter, table, tr, td, i, txtValue;
        innerInput = document.getElementById('search');
        filter = innerInput.value.toUpperCase();
        table = document.getElementById('table-filter');
        tr = table.getElementsByTagName('tr');
        
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    });

</script>