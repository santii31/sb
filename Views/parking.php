		<!-- Main content  -->
		<div class="col s12 m8 l10">
			<div class="main-content">			
				<div class="map-container">
        
					<!-- Box's colors -->
					<div class="beach-map-colors">
						<div class="beach-color">
							<div class="box-color yellow"></div>
							<span>Temporada</span>
						</div>
						<div class="beach-color">
							<div class="box-color green"></div>
							<span>Diario</span>
						</div>
						<div class="beach-color">
							<div class="box-color fuchsia"></div>
							<span>Enero</span>
						</div>
						<div class="beach-color">
							<div class="box-color orange"></div>
							<span>Fin de semana/Feriados</span>
						</div>
						<div class="beach-color">
							<div class="box-color blue"></div>
							<span>Periodo</span>
						</div>
					</div>                

                    <div class="parking-map">

                        <!-- Left -->
                        <div class="left">
                            <?php foreach($firstRow as $parking): ?>
                                <div class="parking-container">                                    
                                    <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                        <div class="item">
                                            <span>
                                                <?= $parking->getNumber(); ?>
                                            </span>		
                                        </div>      
                                    </a>                                    
                                    <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                        <div class="modal-content">
                                            <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                            <p>Actualmente desocupado.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">Reservar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="center-container">

                            <!-- Center upper -->
                            <div class="center-upper">
                                <div class="center-upper-left">                                    
                                <?php foreach($secondRow as $parking): ?>
                                    <div class="parking-container">                                    
                                        <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                            <div class="item">
                                                <span>
                                                    <?= $parking->getNumber(); ?>
                                                </span>		
                                            </div>      
                                        </a>                                    
                                        <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                            <div class="modal-content">
                                                <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                <p>A bunch of text</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>

                                <div class="center-upper-right">
                                    <?php foreach($thirdRow as $parking): ?>
                                        <div class="parking-container">                                    
                                            <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                                    
                                            <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>                                
                            </div>

                            <!-- Normal center -->
                            <div class="center">

                                <!-- Center first  -->
                                <div class="center-first">
                                    <div class="upper">
                                        <?php foreach($fourthRow as $parking): ?>
                                            <div class="parking-container">                                    
                                                <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                    
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="lower">
                                        <?php foreach($fifthRow as $parking): ?>
                                            <div class="parking-container">                                    
                                                <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                    
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Center middle single -->
                                <div class="center-middle-single">
                                    <?php foreach($sixthRow as $parking): ?>
                                        <div class="parking-container">                                    
                                            <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                                    
                                            <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Center middle up -->
                                <div class="center-middle-double">
                                    <div class="upper">
                                        <?php foreach($seventhRow as $parking): ?>
                                            <div class="parking-container">                                    
                                                <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                    
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <div class="last">
                                        <?php foreach($eighthRow as $parking): ?>
                                            <div class="parking-container">                                    
                                                <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                    
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Center last -->
                                <div class="center-lower">
                                    <?php foreach($ninthhRow as $parking): ?>
                                        <div class="parking-container">                                    
                                            <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                                    
                                            <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>

                        <!-- Right -->
                        <div class="right">
                            <?php foreach($tenthRow as $parking): ?>
                                <div class="parking-container">                                    
                                    <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                        <div class="item">
                                            <span>
                                                <?= $parking->getNumber(); ?>
                                            </span>		
                                        </div>      
                                    </a>                                    
                                    <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                        <div class="modal-content">
                                            <h4>Estacionamiento nº <?= $parking->getNumber(); ?></h4>
                                            <p>A bunch of text</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>

			    </div>
		    </div>
	    </div>
	</div>