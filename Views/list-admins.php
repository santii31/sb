        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content table-container">
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>
                        Administradores
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
                    <table class="responsive-table" id="table-filter">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>DNI</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($admins as $admin): ?>
                                <tr>
                                    <td> <?= $admin->getId(); ?> </td>
                                    <td> <?= $admin->getName(); ?> </td>
                                    <td> <?= $admin->getLastName(); ?> </td>
                                    <td> <?= $admin->getEmail(); ?> </td>
                                    <td> <?= $admin->getDni(); ?> </td>
                                    <td class="actions">

                                        <!-- <div>
                                            <form action="<?= FRONT_ROOT ?>admin/disable/<?= $admin->getId(); ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $admin->getId(); ?>">
                                                <button type="submit" class="waves-effect waves-light btn-small btn-danger">
                                                    <i class="material-icons left">delete_forever</i>
                                                    Deshabilitar
                                                </button>
                                            </form>
                                        </div>

                                        <div>
                                            <form action="<?= FRONT_ROOT ?>admin/updatePath/<?= $admin->getId(); ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $admin->getId(); ?>">
                                                <button type="submit" class="waves-effect waves-light btn-small">
                                                    <i class="material-icons left">build</i>
                                                    Modificar
                                                </button>
                                            </form>
                                        </div> -->
                                        <a href="<?= FRONT_ROOT ?>admin/disable/<?= $admin->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                            <i class="material-icons left">delete_forever</i>
                                            Deshabilitar
                                        </a>
                                        <a href="<?= FRONT_ROOT ?>admin/updatePath/<?= $admin->getId(); ?>" class="waves-effect waves-light btn-small">
                                            <i class="material-icons left">build</i>
                                            Modificar
                                        </a>
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