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
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Nº Carpa</th>
                                <th>Estadia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <?php foreach ($rsvClients as $rsv): ?>
                            <tr>                                
                                <td> <?= ucfirst( $rsv->getClient()->getName() ); ?> </td>
                                <td> <?= ucfirst( $rsv->getClient()->getLastName() ); ?> </td>
                                <td> <?= ucfirst( $rsv->getClient()->getAddress() ); ?> </td>                                
                                <td> <?= $rsv->getClient()->getEmail(); ?> </td>
                                <td> <?= $rsv->getClient()->getPhone(); ?> </td>
                                <td> <?= $rsv->getBeachTent()->getNumber(); ?> </td>
                                <td> <?= ucfirst( $rsv->getStay() ); ?> </td>
                                <td> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </td>
                                <td> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </td>                                
                                <td>
                                    <a href="<?= FRONT_ROOT ?>balance/addBalancePath/<?= $rsv->getId(); ?>" class="waves-effect waves-light btn-small">
                                        <i class="material-icons left">attach_money</i>
                                        Saldo
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
