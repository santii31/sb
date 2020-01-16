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
                                                    <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                            
                                                            <?php $stay = $rsv->getStay(); ?>
                                                                
                                                            <?php switch ($stay): 
                                                                case "season": ?>
                                                                    <div class="tent yellow">                                                
                                                                <?php break; ?> 
                                                            
                                                                <?php case "day": ?>
                                                                    <div class="tent green">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "january": ?>
                                                                    <div class="tent fuchsia">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "rest": ?>
                                                                    <div class="tent orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "period": ?>
                                                                    <div class="tent blue">                                                
                                                                <?php break; ?>
                                                                
                                                            <?php endswitch; ?>    
                                                                                                                          
                                                        <?php else: ?>
                                                        <div class="tent">
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif; ?>
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
                                                                </a>
                                                            </li>
                                                            <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">
                                                            <?php endif; ?>
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    Futuras reservas
                                                                </a>
                                                            </li>                                                     
                                                        </ul>
                                                        
                                                        <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div>
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                        <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
                                                    </div>
                                                </div> 
                                            </div>
                                        <?php endforeach; ?> 																					
									</div>
								</div>

								<!-- Sea tent -->
								<div class="tents-sea-container">                                									
                                    <?php foreach ($firstSeaRow as $tent): ?>
                                        <div>                                                                                                
                                            <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
                                        <?php foreach ($secondRow as $tent): ?>
                                            <div>                                                                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">                                                                                                        
                                                    <?php if ($i <= 16): ?>
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                <!-- ver colores estadias -->
                                                                <div class="tent tent-inverse yellow">                                                            
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 

                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>     
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>
                                                    </div>                                                   
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
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
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                    <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
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
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
                                        <?php foreach ($thirdRow as $tent): ?>
                                            <div>                                                                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">                                                                                                        
                                                    <?php if ($i <= 16): ?>
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                <!-- ver colores estadias -->
                                                                <div class="tent tent-inverse yellow">                                                            
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 

                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>     
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>
                                                    </div>                                                   
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
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
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                    <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
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
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
                                        <?php foreach ($fourthRow as $tent): ?>
                                            <div>                                                                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">                                                                                                        
                                                    <?php if ($i <= 16): ?>
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                <!-- ver colores estadias -->
                                                                <div class="tent tent-inverse yellow">                                                            
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 

                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>     
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>
                                                    </div>                                                   
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
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
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                    <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
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
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
                                        <?php foreach ($fifthRow as $tent): ?>
                                            <div>                                                                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">                                                                                                        
                                                    <?php if ($i <= 16): ?>
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                <!-- ver colores estadias -->
                                                                <div class="tent tent-inverse yellow">                                                            
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 

                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>     
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>
                                                    </div>                                                   
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
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
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                    <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
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
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
                                        <?php foreach ($sixthRow as $tent): ?>
                                            <div>                                                                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">                                                                                                        
                                                    <?php if ($i <= 16): ?>
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                <!-- ver colores estadias -->
                                                                <div class="tent tent-inverse yellow">                                                            
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 

                                                    <?php else: ?>
                                                    <div class="tent">
                                                    <?php endif?>     
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>
                                                    </div>                                                   
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
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
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                    <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
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
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
                                            <div>                                                                                                
                                                <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                    <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        
                                                        <!-- ver estadia -->
                                                        <div class="tent tent-inverse yellow">                                                        
                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                    <div class="tent tent-inverse">
                                                    <?php endif; ?>
                                                        <span>
                                                            <?= $tent->getNumber(); ?>
                                                        </span>		
                                                    </div>      
                                                </a>                    
                                                
                                                <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content center-align">
                                                        <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                        <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                            <li class="tab col s6">
                                                                <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                    Reserva actual                                                            
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
                                                                <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                     
                                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                        
                                                                    <div class="reserve-container">
                                                                            
                                                                            <div class="reserve-title">
                                                                                <i class="material-icons">info_outline</i>
                                                                                La carpa se encuentra actualmente reservada.                     
                                                                            </div>        
                                                                            
                                                                            <div class="reserve-client">
                                                                                
                                                                                <div class="client-subinfo">
                                                                                    <i class="material-icons">person_pin</i>                     
                                                                                    Cliente                                                      
                                                                                </div>

                                                                                <div>                                                            
                                                                                    <span>
                                                                                        <span class="title">• Nombre:  </span>
                                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Email:  </span>
                                                                                        <?= $rsv->getClient()->getEmail(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Telefono:  </span>
                                                                                        <?= $rsv->getClient()->getPhone(); ?> 
                                                                                    </span>
                                                                                    <!-- <span>
                                                                                        <span class="title">• Grupo Familiar:  </span>
                                                                                        <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                    </span> -->
                                                                                    <span>
                                                                                        <span class="title">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getDateStart(); ?> 
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title">• Fecha fin:  </span>
                                                                                        <?= $rsv->getDateEnd(); ?> 
                                                                                    </span>
                                                                                </div>

                                                                                <?php ?>
                                                                            </div>                                                               
                                                                        </div>                                                                   

                                                                        <?php else: ?>
                                                                            Reservas futuras
                                                                        <?php endif; ?>                                                          

                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                            <div class="future-container">                                                        
                                                                <?php foreach ($rsvList as $rsv): ?>
                                                                <div class="future-item">
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>
                                                                        <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                            $rsv->getClient()->getLastName(); ?>
                                                                    </div>
                                                                    <div class="date">
                                                                        <div>
                                                                            <span class="title-2">• Fecha inicio: </span>
                                                                            <span> <?= $rsv->getDateStart(); ?> </span>
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Fecha fin: </span>
                                                                            <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                        </div>

                                                                        <div>
                                                                            <span class="title-2">• Telefono: </span>
                                                                            <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; ?>                                                              
                                                            </div>    
                                                        </div>
                                                        <?php endif; ?>                 
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
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
                                            <a class="modal-trigger" href="#modal<?= $tent->getId(); ?>">
                                                <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>                          
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "season": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "day": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "january": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "rest": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "period": ?>
                                                                <div class="tent-sea blue">                                                
                                                            <?php break; ?>
                                                            
                                                        <?php endswitch; ?>    
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="tent-sea">
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                <div class="tent-sea">
                                                <?php endif; ?>
                                                    <span>
                                                        <?= $tent->getNumber(); ?>
                                                    </span>		
                                                </div>      
                                            </a>                    
                                            
                                            <div id="modal<?= $tent->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Carpa Nº <?= $tent->getNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $tent->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">
                                                        <?php endif; ?>
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                Futuras reservas
                                                            </a>
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservation( $tent->getId() )): ?>                           
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">
                                                                            <i class="material-icons">info_outline</i>
                                                                            La carpa se encuentra actualmente reservada.                     
                                                                        </div>        
                                                                        
                                                                        <div class="reserve-client">
                                                                            
                                                                            <div class="client-subinfo">
                                                                                <i class="material-icons">person_pin</i>                     
                                                                                Cliente                                                      
                                                                            </div>

                                                                            <div>                                                            
                                                                                <span>
                                                                                    <span class="title">• Nombre:  </span>
                                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . $rsv->getClient()->getLastName(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Email:  </span>
                                                                                    <?= $rsv->getClient()->getEmail(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Telefono:  </span>
                                                                                    <?= $rsv->getClient()->getPhone(); ?> 
                                                                                </span>
                                                                                <!-- <span>
                                                                                    <span class="title">• Grupo Familiar:  </span>
                                                                                    <?= $rsv->getClient()->getFamilyGroup(); ?> 
                                                                                </span> -->
                                                                                <span>
                                                                                    <span class="title">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getDateStart(); ?> 
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title">• Fecha fin:  </span>
                                                                                    <?= $rsv->getDateEnd(); ?> 
                                                                                </span>
                                                                            </div>

                                                                            <?php ?>
                                                                        </div>                                                               
                                                                    </div>                                                                   

                                                                    <?php else: ?>
                                                                        Reservas futuras
                                                                    <?php endif; ?>                                                          

                                                            <?php else: ?>
                                                                La carpa no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>
                                                    <div id="reser-<?= $tent->getId(); ?>" class="col s12 tab-extra">
                                                        <div class="future-container">                                                        
                                                            <?php foreach ($rsvList as $rsv): ?>
                                                            <div class="future-item">
                                                                <div class="client">
                                                                    <i class="material-icons">person_pin</i>
                                                                    <?= ucfirst($rsv->getClient()->getName()) . ' ' . 
                                                                        $rsv->getClient()->getLastName(); ?>
                                                                </div>
                                                                <div class="date">
                                                                    <div>
                                                                        <span class="title-2">• Fecha inicio: </span>
                                                                        <span> <?= $rsv->getDateStart(); ?> </span>
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Fecha fin: </span>
                                                                        <span> <?= $rsv->getDateEnd(); ?> </span>                     
                                                                    </div>

                                                                    <div>
                                                                        <span class="title-2">• Telefono: </span>
                                                                        <span> <?= $rsv->getClient()->getPhone(); ?> </span>           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>                                                              
                                                        </div>    
                                                    </div>
                                                    <?php endif; ?>                 
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationPath/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
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
