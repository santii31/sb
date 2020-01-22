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
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Rubro</th>
                                <th>Domicilio</th>
                                <th>Mas información</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($providers as $provider): ?>
                            <tr>                                
                                <td> <?= ucfirst( $provider->getName() ); ?> </td>
                                <td> <?= ucfirst( $provider->getLastName() ); ?> </td>
                                <td> <?= $provider->getPhone(); ?> </td>
                                <td> <?= $provider->getEmail(); ?> </td>
                                <td> <?= ucfirst( $provider->getItem() ); ?> </td>
                                <td> <?= ucfirst( $provider->getAddress() ); ?> </td>
                                <td>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons left">arrow_forward</i>Ver mas
                                            </div>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <li>• DNI:  <?= $provider->getDni(); ?> </li>
                                                    <li>• Número de CUIL:  <?= $provider->getCuilNumber(); ?> </li>
                                                    <li>• Razón social:  <?= ucfirst( $provider->getSocialReason() ); ?> </li>
                                                    <li>• Tipo de facturacion:  <?= ucfirst( $provider->getBilling() ); ?> </li>
                                                    <li>• Registrado por: 
                                                            <?= ucfirst( $provider->getRegisterBy()->getName() ); ?>
                                                            <?= ucfirst( $provider->getRegisterBy()->getLastName() ); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>                                      
                                </td>                                
                                <td class="actions">
                                    <?php if ($provider->getIsActive()): ?>
                                        <a href="<?= FRONT_ROOT ?>provider/disable/<?= $provider->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                            <i class="material-icons left">delete_forever</i>
                                            Deshabilitar
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= FRONT_ROOT ?>provider/enable/<?= $provider->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                            <i class="material-icons left">delete_forever</i>
                                            Habilitar
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?= FRONT_ROOT ?>provider/updatePath/<?= $provider->getId(); ?>" class="waves-effect waves-light btn-small">
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