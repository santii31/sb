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
          
                <div class="row">    
                    <table class="responsive-table centered" id="table-filter">
                        <thead>                            
                            <tr>                                
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Domicilio</th>
                                <th>Ciudad</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Carpa interesado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($clients as $client): ?>
                            <tr>                                
                                <td> <?= ucfirst( $client->getName() ); ?> </td>
                                <td> <?= ucfirst( $client->getLastName() ); ?> </td>
                                <td> <?= ucfirst( $client->getAddress() ); ?> </td>
                                <td> <?= ucfirst( $client->getCity() ); ?> </td>
                                <td> <?= $client->getEmail(); ?> </td>
                                <td> <?= $client->getPhone(); ?> </td>
                                <td> <?= $client->getNumTent(); ?> </td>
                                                                   
                                <td class="actions">
                                    <?php if ($client->getIsActive()): ?>
                                        <a href="<?= FRONT_ROOT ?>clientPotential/disable/<?= $client->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                            <i class="material-icons left">delete_forever</i>
                                            Deshabilitar
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= FRONT_ROOT ?>clientPotential/enable/<?= $client->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left">delete_forever</i>
                                            Habilitar
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?= FRONT_ROOT ?>clientPotential/updatePotentialPath/<?= $client->getId(); ?>" class="waves-effect waves-light btn-small">
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