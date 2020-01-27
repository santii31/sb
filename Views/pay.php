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
                    <div class="col s12 m6">
                        <div class="card medium blue-grey darken-1 indigo lighten-4">
                            <div class="card-content white-text">
                                <span class="card-title">Reserva realizada con éxito!</span>
                                
                                <ul>
                                    <li>• Cliente: <?= ucfirst($reservation->getClient()->getName()) . " " . ucfirst($reservation->getClient()->getLastName()); ?> </li>
                                    <li>• Fecha inicio: <?= date("d-m-Y", strtotime($reservation->getDateStart())); ?> </li>
                                    <li>• Fecha fin: <?= date("d-m-Y", strtotime($reservation->getDateEnd())); ?> </li>
                                    <li>• Carpa: <?= $reservation->getBeachTent()->getNumber(); ?> </li>
                                    <li>• Precio: $<?= number_format($reservation->getPrice(), 2, ',', '.'); ?> </li>
                                    <li>• Estadia:                                                                                         
                                        <?= ucfirst(
                                                str_replace('_', ' ', $reservation->getStay()) 
                                            ); 
                                        ?> 
                                    </li>
                                </ul>                                

                            </div>
                            <div class="card-action">                                                                
                                <a href="<?= FRONT_ROOT; ?>">Volver al inicio</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>