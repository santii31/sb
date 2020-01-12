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

					<div class="beach-map">
						
						<div class="beach-map-container">                
							
							<!-- Only for the first hall -->
							<div class="extra-beach-tents">
								
                                <!-- Normal flow tents -->
								<div class="beach-tents">									
									<div class="tent-container">											
                                        <?php foreach ($firstRow as $tent): ?>
                                            <div>                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                    <div class="tent">
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                                                                            
                                                        <ul id="tabs-swipe-demo" class="tabs">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    
                                                                <?php if ($reservation = $this->hasReservation( $tent->getId() )){ ?>
                                                                    ocupada
                                                                <?php }else{ ?>
                                                                    libre
                                                                <?php } ?>
                                                                
                                                                
                                                                    <!-- verificar si tienen reserva -->
                                                                    <!-- if (tiene reserva) reservada -->
                                                                </a>
                                                            </li>
                                                            <li class="tab col s6">
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    Futuras reservas
                                                                </a>
                                                            </li>                                                     
                                                        </ul>
                                                        
                                                        <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div>
                                                                <i class="material-icons">info_outline</i>
                                                                La carpa se encuentra actualmente reservada.
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div>                                                                
                                                                <ol>
                                                                    <li>
                                                                        15/1/2020
                                                                    </li>
                                                                    <li>
                                                                        25/1/2020
                                                                    </li>
                                                                    <li>
                                                                        3/2/2020
                                                                    </li>
                                                                </ol>
                                                            </div>    
                                                        </div>
                                                                                             
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
                                                    </div>
                                                </div> 
                                            </div>
                                        <?php endforeach; ?> 
										
										<!-- <div class="tent-special-container">

											
											<a class="modal-trigger" href="#modal1">
												<div class="tent tent-inverse">
													<span>150B</span>		
												</div>      
											</a>

											
											<div id="modal1" class="modal modal-fixed-footer">
												<div class="modal-content">
													<h4>Carpa nº 150</h4>
													<p>A bunch of text</p>
												</div>
												<div class="modal-footer">
													<a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
												</div>
											</div>		


											
											<a class="modal-trigger" href="#modal1">
												<div class="tent">
													<span>150</span>		
												</div>      
											</a>

											
											<div id="modal1" class="modal modal-fixed-footer">
												<div class="modal-content">
													<h4>Carpa nº 150</h4>
													<p>A bunch of text</p>
												</div>
												<div class="modal-footer">
													<a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
												</div>
											</div>		

										</div> -->
																		
									</div>
								</div>

								<!-- Sea tent -->
								<div class="tents-sea-container">
                                    
                                    <?php foreach ($firstSeaRow as $tent): ?>
									<div>	                                        
                                        <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
											<div class="tent-sea">
												<span>
                                                    <?= $tent->getNumber(); ?>
                                                </span>		
											</div>      
										</a>
										
										<div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
											<div class="modal-content">
												<h4>Carpa nº <?= $tent->getNumber(); ?></h4>
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

							<!-- 1 Halls -->
							<div class="beach-hall">
							
                                <!-- Normal flow -->
								<div class="hall-container">
									<!-- Hall number -->
									<div class="hall-name">
										Pasillo 1
									</div>
																	
									<div class="beach-tents">
                                            
                                        <?php $i = 1; ?>                                        
                                        <?php foreach ($secondRow as $row): ?>
                                                
                                            <div class="tent-container">
                                                <a class="modal-trigger" href="#modal<?=$row->getId();?>">                                      
                                                    <?php if ($i <= 16): ?>
                                                    <div class="tent tent-inverse">
                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>
                                                        <span>
                                                            <?= $row->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                            
                                                <div id="modal<?=$row->getId();?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Carpa nº <?= $row->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>                     
                                            </div>                                        
                                                                                            
                                        <?php $i++; ?>
                                        <?php endforeach; ?> 							
									</div>
								</div>
								                                
                                <!-- Sea tent -->
                                <div class="tents-sea-container">
                                    
                                    <?php foreach ($secondSeaRow as $tent): ?>
                                    <div>										
                                        <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                            <div class="tent-sea">
                                                <span>
                                                    <?= $tent->getNumber(); ?>
                                                </span>		
                                            </div>      
                                        </a>
                                        
                                        <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                            <div class="modal-content">
                                                <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
                                                <p>A bunch of text</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <?php endforeach; ?>									

                                </div>   

                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($firtsParasol as $parasol): ?>
                                        <div class="parasol-item">                                        
                                            <a class="modal-trigger" href="#">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4></h4>
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 										
                                        </div>
                                    <?php endforeach; ?>                                                                                         
                                </div>

							</div>							

							<!-- 2 Halls -->
							<div class="beach-hall">
							
                                <!-- Normal flow -->
								<div class="hall-container">
									<!-- Hall number -->
									<div class="hall-name">
										Pasillo 2
									</div>
																	
									<div class="beach-tents">
                                            
                                        <?php $i = 1; ?>                                        
                                        <?php foreach ($thirdRow as $row): ?>
                                                
                                            <div class="tent-container">
                                                <a class="modal-trigger" href="#modal<?=$row->getId();?>">                                      
                                                    <?php if ($i <= 16): ?>
                                                    <div class="tent tent-inverse">
                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>
                                                        <span>
                                                            <?= $row->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                            
                                                <div id="modal<?=$row->getId();?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Carpa nº <?= $row->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>                     
                                            </div>                                        
                                                                                            
                                        <?php $i++; ?>
                                        <?php endforeach; ?> 							
									</div>
								</div>
								                                
                                <!-- Sea tent -->
                                <div class="tents-sea-container">
                                    
                                    <?php foreach ($thirdSeaRow as $tent): ?>
                                    <div>										
                                        <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                            <div class="tent-sea">
                                                <span>
                                                    <?= $tent->getNumber(); ?>
                                                </span>		
                                            </div>      
                                        </a>
                                        
                                        <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                            <div class="modal-content">
                                                <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
                                                <p>A bunch of text</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <?php endforeach; ?>									

                                </div> 
                                
                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($secondParasol as $parasol): ?>
                                        <div class="parasol-item">                                        
                                            <a class="modal-trigger" href="#">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4></h4>
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 										
                                        </div>
                                    <?php endforeach; ?>                                                                                         
                                </div>

							</div>																				

							<!-- 3 Halls -->
							<div class="beach-hall">
                                
                                <!-- Normal flow -->
								<div class="hall-container">
									<!-- Hall number -->
									<div class="hall-name">
										Pasillo 3
									</div>
																	
									<div class="beach-tents">
                                            
                                        <?php $i = 1; ?>                                        
                                        <?php foreach ($fourthRow as $row): ?>
                                                
                                            <div class="tent-container">
                                                <a class="modal-trigger" href="#modal<?=$row->getId();?>">                                      
                                                    <?php if ($i <= 16): ?>
                                                    <div class="tent tent-inverse">
                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>
                                                        <span>
                                                            <?= $row->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                            
                                                <div id="modal<?=$row->getId();?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Carpa nº <?= $row->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>                     
                                            </div>                                        
                                                                                            
                                        <?php $i++; ?>
                                        <?php endforeach; ?> 							
									</div>
								</div>
								                                
                                <!-- Sea tent -->
								<div class="tents-sea-container">

                                    <?php foreach ($fourthSeaRow as $tent): ?>
                                        <div>										
                                            <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php endforeach; ?>									

								</div>

                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($thirdParasol as $parasol): ?>
                                        <div class="parasol-item">                                        
                                            <a class="modal-trigger" href="#">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4></h4>
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 										
                                        </div>
                                    <?php endforeach; ?>                                                                                         
                                </div>

							</div>

                            <!-- 4 Halls -->
							<div class="beach-hall">
							    
                                <!-- Normal flow -->
                                <div class="hall-container">
                                    <!-- Hall number -->
                                    <div class="hall-name">
                                        Pasillo 4
                                    </div>
                                                                    
                                    <div class="beach-tents">
                                            
                                        <?php $i = 1; ?>                                        
                                        <?php foreach ($fifthRow as $row): ?>
                                                
                                            <div class="tent-container">
                                                <a class="modal-trigger" href="#modal<?=$row->getId();?>">                                      
                                                    <?php if ($i <= 16): ?>
                                                    <div class="tent tent-inverse">
                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>
                                                        <span>
                                                            <?= $row->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                            
                                                <div id="modal<?=$row->getId();?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Carpa nº <?= $row->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>                     
                                            </div>                                        
                                                                                            
                                        <?php $i++; ?>
                                        <?php endforeach; ?> 							
                                    </div>
                                </div>
                                                                
                                <!-- Sea tent -->
                                <div class="tents-sea-container">
                                    				
                                    <?php foreach ($fifthSeaRow as $tent): ?>
                                        <div>										
                                            <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php endforeach; ?>									
                                                    																																							
                                </div>

                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($fourthParasol as $parasol): ?>
                                        <div class="parasol-item">                                        
                                            <a class="modal-trigger" href="#">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4></h4>
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 										
                                        </div>
                                    <?php endforeach; ?>                                                                                         
                                </div>

                            </div>

                            <!-- 5 Halls -->
							<div class="beach-hall">
							
                                <!-- Normal flow -->
                                <div class="hall-container">
                                    <!-- Hall number -->
                                    <div class="hall-name">
                                        Pasillo 5
                                    </div>
                                                                    
                                    <div class="beach-tents">
                                            
                                        <?php $i = 1; ?>                                        
                                        <?php foreach ($sixthRow as $row): ?>
                                                
                                            <div class="tent-container">
                                                <a class="modal-trigger" href="#modal<?=$row->getId();?>">                                      
                                                    <?php if ($i <= 16): ?>
                                                    <div class="tent tent-inverse">
                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>
                                                        <span>
                                                            <?= $row->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                                            
                                                <div id="modal<?=$row->getId();?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Carpa nº <?= $row->getNumber(); ?></h4>
                                                        <p>A bunch of text</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                    </div>
                                                </div>                     
                                            </div>                                        
                                                                                            
                                        <?php $i++; ?>
                                        <?php endforeach; ?> 							
                                    </div>
                                </div>
                                                                
                                <!-- Sea tent -->
                                <div class="tents-sea-container">
                                    
                                    <?php foreach ($sixthSeaRow as $tent): ?>
                                        <div>										
                                            <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 
                                        </div>
                                        <?php endforeach; ?>									

                                </div>

                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($fifthParasol as $parasol): ?>
                                        <div class="parasol-item">                                        
                                            <a class="modal-trigger" href="#">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4></h4>
                                                    <p></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>" class="modal-close waves-effect waves-green btn-flat ">Agree</a>
                                                </div>
                                            </div> 										
                                        </div>
                                    <?php endforeach; ?>                                                                                         
                                </div>

                            </div>

							<!-- 6 Last Hall -->
							<div class="beach-hall last-hall">
							
                                <!-- Normal flow -->
								<div class="hall-container ">
                                    <!-- Hall number -->
                                    <div class="hall-name">
                                        Pasillo 6
                                    </div>
																	
                                    <div class="beach-tents">                                        
                                        <?php foreach ($seventhRow as $tent): ?>
                                            <div class="tent-container">                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                    <div class="tent tent-inverse">
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
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
								
                                <!-- Sea tent -->
								<div class="tents-sea-container">

                                    <?php foreach ($seventhSeaRow as $tent): ?>
                                        <div>										
                                            <a class="modal-trigger" href="#show<?= $tent->getId(); ?>">
                                                <div class="tent-sea">
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>
                                            
                                            <div id="show<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Carpa nº <?= $tent->getNumber(); ?></h4>
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
		</div>
	</div>

	</div>
