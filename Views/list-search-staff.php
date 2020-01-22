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
                                <th>Cargo</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Sueldo</th>
                                <th>Mas información</th>                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($staffs as $staff): ?>
                                <tr>                                    
                                    <td> <?= ucfirst( $staff->getName() ); ?> </td>
                                    <td> <?= ucfirst( $staff->getLastName() ); ?> </td>
                                    <td> <?= ucfirst( $staff->getPosition() ); ?> </td>
                                    <td> <?= $staff->getDateStart(); ?> </td>
                                    <td> <?= $staff->getDateEnd(); ?> </td>
                                    <td> $<?= $staff->getSalary(); ?> </td>
                                    <td>
                                        <ul class="collapsible">
                                            <li>
                                                <div class="collapsible-header">
                                                    <i class="material-icons left">arrow_forward</i>Ver mas
                                                </div>
                                                <div class="collapsible-body">
                                                    <ul>
                                                        <li>• DNI:  <?= $staff->getDni(); ?> </li>
                                                        <li>• Dirección:  <?= ucfirst( $staff->getAddress() ); ?> </li>
                                                        <li>• Telefono:  <?= $staff->getPhone(); ?> </li>
                                                        <li>• Talle de remera:  <?= ucfirst( $staff->getShirtSize() ); ?> </li>
                                                        <li>• Talle de pantalon:  <?= ucfirst( $staff->getPantSize() ); ?> </li>
                                                        <li>• Registrado por: 
                                                                <?= ucfirst( $staff->getRegisterBy()->getName() ); ?>
                                                                <?= ucfirst( $staff->getRegisterBy()->getLastName() ); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>                                      
                                    </td>  

                                    <td class="actions">
                                        <?php if ($staff->getIsActive()): ?>
                                            <a href="<?= FRONT_ROOT ?>staff/disable/<?= $staff->getId(); ?>" class="waves-effect waves-light btn-small btn-danger">
                                                <i class="material-icons left">delete_forever</i>
                                                Deshabilitar
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= FRONT_ROOT ?>staff/enable/<?= $staff->getId(); ?>" class="waves-effect waves-light btn-small btn-safe">
                                                <i class="material-icons left">delete_forever</i>
                                                Habilitar
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?= FRONT_ROOT ?>staff/updatePath/<?= $staff->getId(); ?>" class="waves-effect waves-light btn-small">
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