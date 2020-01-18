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

                    <div class="parking-map">

                        <!-- Left -->
                        <div class="left">
                            <?php foreach($firstRow as $parking): ?>
                                <div class="parking-container">                                                                        
                                    <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                        <?php if ($this->hasReservation($parking->getId())):  ?>
                                            <?php if ($this->reservationToday($parking->getId())): ?>
                                                
                                                <!-- ver colores estadia -->
                                                <div class="item yellow">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>  

                                            <?php else: ?>
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>                                            
                                            <?php endif; ?>                                            
                                        <?php else : ?>
                                        <div class="item">
                                            <span>
                                                <?= $parking->getNumber(); ?>
                                            </span>		
                                        </div>  
                                        <?php endif; ?>    
                                    </a>                                    
                                    
                                    <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                        <div class="modal-content">
                                            <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                            <?php if ($this->hasReservation($parking->getId())):  ?>
                                                
                                                <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                    <div class="reserve-container">                                                               
                                                        <div class="reserve-title">
                                                            <i class="material-icons">info_outline</i>
                                                            <p>
                                                                Estacionamiento actualmente reservado.                                            
                                                            </p>
                                                        </div>        
                                                        
                                                        <div class="reserve-client">
                                                            
                                                            <div class="client-subinfo">
                                                                <i class="material-icons">person_pin</i>                     
                                                                Cliente                                                      
                                                            </div>

                                                            <div>                                                            
                                                                <span>
                                                                    <span class="title">• Carpa:  </span>
                                                                    <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                </span>
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
                                                    <p class="no-reservation z-depth-4">
                                                        <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                            <i class="material-icons">info_outline</i>
                                                            El estacionamiento tiene futuras reservas
                                                            <div class="future-reservation-parking">
                                                                <?php foreach ($f_rsv as $rsv): ?>
                                                                <div>
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>                                  
                                                                    </div>
                                                                    <div class="date">
                                                                        <span>
                                                                            <span class="title-2">• Nombre:  </span>
                                                                            <?= 
                                                                                ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                            ?> 
                                                                        </span>                                                     
                                                                        <span>
                                                                            <span class="title-2">• Carpa:  </span>
                                                                            <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha inicio:  </span>
                                                                            <?= $rsv->getReservation()->getDateStart(); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha fin:  </span>
                                                                            <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                        </span>
                                                                    </div>                                                                    
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </p>                                                                                          
                                                <?php endif; ?>

                                            <?php else: ?>
                                                <p class="no-reservation z-depth-4">
                                                    <i class="material-icons">info_outline</i>
                                                    Estacionamiento disponible.                     
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if (isset($id_reservation)): ?>
                                                <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                    Reservar
                                                </a>
                                            <?php else: ?>  
                                                
                                            <?php endif; ?>
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
                                            <?php if ($this->hasReservation($parking->getId())):  ?>
                                                <?php if ($this->reservationToday($parking->getId())): ?>
                                                    
                                                    <!-- ver colores estadia -->
                                                    <div class="item yellow">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  

                                                <?php else: ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>                                            
                                                <?php endif; ?>                                            
                                            <?php else : ?>
                                            <div class="item">
                                                <span>
                                                    <?= $parking->getNumber(); ?>
                                                </span>		
                                            </div>  
                                            <?php endif; ?>    
                                        </a>                                    
                                        
                                        <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                            <div class="modal-content">
                                                <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                <?php if ($this->hasReservation($parking->getId())):  ?>
                                                    
                                                    <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                        <div class="reserve-container">                                                               
                                                            <div class="reserve-title">
                                                                <i class="material-icons">info_outline</i>
                                                                <p>
                                                                    Estacionamiento actualmente reservado.                                            
                                                                </p>
                                                            </div>        
                                                            
                                                            <div class="reserve-client">
                                                                
                                                                <div class="client-subinfo">
                                                                    <i class="material-icons">person_pin</i>                     
                                                                    Cliente                                                      
                                                                </div>

                                                                <div>                                                            
                                                                    <span>
                                                                        <span class="title">• Carpa:  </span>
                                                                        <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                    </span>
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
                                                        <p class="no-reservation z-depth-4">
                                                            <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                <i class="material-icons">info_outline</i>
                                                                El estacionamiento tiene futuras reservas
                                                                <div class="future-reservation-parking">
                                                                    <?php foreach ($f_rsv as $rsv): ?>
                                                                    <div>
                                                                        <div class="client">
                                                                            <i class="material-icons">person_pin</i>                                  
                                                                        </div>
                                                                        <div class="date">
                                                                            <span>
                                                                                <span class="title-2">• Nombre:  </span>
                                                                                <?= 
                                                                                    ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                    ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                ?> 
                                                                            </span>                                                     
                                                                            <span>
                                                                                <span class="title-2">• Carpa:  </span>
                                                                                <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                            </span>
                                                                            <span>
                                                                                <span class="title-2">• Fecha inicio:  </span>
                                                                                <?= $rsv->getReservation()->getDateStart(); ?>
                                                                            </span>
                                                                            <span>
                                                                                <span class="title-2">• Fecha fin:  </span>
                                                                                <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                            </span>
                                                                        </div>                                                                    
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </p>                                                                                          
                                                    <?php endif; ?>

                                                <?php else: ?>
                                                    <p class="no-reservation z-depth-4">
                                                        <i class="material-icons">info_outline</i>
                                                        Estacionamiento disponible.                     
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <?php if (isset($id_reservation)): ?>
                                                    <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
                                                <?php else: ?>  
                                                    
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                                </div>

                                <div class="center-upper-right">                      
                                    <?php foreach($thirdRow as $parking): ?>
                                        <div class="parking-container">                                                                        
                                            <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                <?php if ($this->hasReservation($parking->getId())):  ?>
                                                    <?php if ($this->reservationToday($parking->getId())): ?>
                                                        
                                                        <!-- ver colores estadia -->
                                                        <div class="item yellow">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>  

                                                    <?php else: ?>
                                                        <div class="item">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                            
                                                    <?php endif; ?>                                            
                                                <?php else : ?>
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>  
                                                <?php endif; ?>    
                                            </a>                                    
                                        
                                            <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                            <div class="reserve-container">                                                               
                                                                <div class="reserve-title">
                                                                    <i class="material-icons">info_outline</i>
                                                                    <p>
                                                                        Estacionamiento actualmente reservado.                                            
                                                                    </p>
                                                                </div>        
                                                                
                                                                <div class="reserve-client">
                                                                    
                                                                    <div class="client-subinfo">
                                                                        <i class="material-icons">person_pin</i>                     
                                                                        Cliente                                                      
                                                                    </div>

                                                                    <div>                                                            
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
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
                                                            <p class="no-reservation z-depth-4">
                                                                <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                    <i class="material-icons">info_outline</i>
                                                                    El estacionamiento tiene futuras reservas
                                                                    <div class="future-reservation-parking">
                                                                        <?php foreach ($f_rsv as $rsv): ?>
                                                                        <div>
                                                                            <div class="client">
                                                                                <i class="material-icons">person_pin</i>                                  
                                                                            </div>
                                                                            <div class="date">
                                                                                <span>
                                                                                    <span class="title-2">• Nombre:  </span>
                                                                                    <?= 
                                                                                        ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                        ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                    ?> 
                                                                                </span>                                                     
                                                                                <span>
                                                                                    <span class="title-2">• Carpa:  </span>
                                                                                    <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </p>                                                                                          
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                        <p class="no-reservation z-depth-4">
                                                            <i class="material-icons">info_outline</i>
                                                            Estacionamiento disponible.                     
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <?php if (isset($id_reservation)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
                                                    <?php else: ?>  
                                                        
                                                    <?php endif; ?>
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
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        <?php if ($this->reservationToday($parking->getId())): ?>
                                                            
                                                            <!-- ver colores estadia -->
                                                            <div class="item yellow">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>  

                                                        <?php else: ?>
                                                            <div class="item">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>                                            
                                                        <?php endif; ?>                                            
                                                    <?php else : ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>    
                                                </a>                                    
                                            
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                        <?php if ($this->hasReservation($parking->getId())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                                <div class="reserve-container">                                                               
                                                                    <div class="reserve-title">
                                                                        <i class="material-icons">info_outline</i>
                                                                        <p>
                                                                            Estacionamiento actualmente reservado.                                            
                                                                        </p>
                                                                    </div>        
                                                                    
                                                                    <div class="reserve-client">
                                                                        
                                                                        <div class="client-subinfo">
                                                                            <i class="material-icons">person_pin</i>                     
                                                                            Cliente                                                      
                                                                        </div>

                                                                        <div>                                                            
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
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
                                                                <p class="no-reservation z-depth-4">
                                                                    <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                        <i class="material-icons">info_outline</i>
                                                                        El estacionamiento tiene futuras reservas
                                                                        <div class="future-reservation-parking">
                                                                            <?php foreach ($f_rsv as $rsv): ?>
                                                                            <div>
                                                                                <div class="client">
                                                                                    <i class="material-icons">person_pin</i>                                  
                                                                                </div>
                                                                                <div class="date">
                                                                                    <span>
                                                                                        <span class="title-2">• Nombre:  </span>
                                                                                        <?= 
                                                                                            ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                            ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                        ?> 
                                                                                    </span>                                                     
                                                                                    <span>
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                    </span>
                                                                                </div>                                                                    
                                                                            </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </p>                                                                                          
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if (isset($id_reservation)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>
                                                        <?php else: ?>  
                                                            
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="lower">
                                        <?php foreach($fifthRow as $parking): ?>
                                            <div class="parking-container">                                                                       
                                                <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        <?php if ($this->reservationToday($parking->getId())): ?>
                                                            
                                                            <!-- ver colores estadia -->
                                                            <div class="item yellow">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>  

                                                        <?php else: ?>
                                                            <div class="item">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>                                            
                                                        <?php endif; ?>                                            
                                                    <?php else : ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>    
                                                </a>                                    
                                            
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                        <?php if ($this->hasReservation($parking->getId())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                                <div class="reserve-container">                                                               
                                                                    <div class="reserve-title">
                                                                        <i class="material-icons">info_outline</i>
                                                                        <p>
                                                                            Estacionamiento actualmente reservado.                                            
                                                                        </p>
                                                                    </div>        
                                                                    
                                                                    <div class="reserve-client">
                                                                        
                                                                        <div class="client-subinfo">
                                                                            <i class="material-icons">person_pin</i>                     
                                                                            Cliente                                                      
                                                                        </div>

                                                                        <div>                                                            
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
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
                                                                <p class="no-reservation z-depth-4">
                                                                    <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                        <i class="material-icons">info_outline</i>
                                                                        El estacionamiento tiene futuras reservas
                                                                        <div class="future-reservation-parking">
                                                                            <?php foreach ($f_rsv as $rsv): ?>
                                                                            <div>
                                                                                <div class="client">
                                                                                    <i class="material-icons">person_pin</i>                                  
                                                                                </div>
                                                                                <div class="date">
                                                                                    <span>
                                                                                        <span class="title-2">• Nombre:  </span>
                                                                                        <?= 
                                                                                            ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                            ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                        ?> 
                                                                                    </span>                                                     
                                                                                    <span>
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                    </span>
                                                                                </div>                                                                    
                                                                            </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </p>                                                                                          
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if (isset($id_reservation)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>
                                                        <?php else: ?>  
                                                            
                                                        <?php endif; ?>
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
                                                <?php if ($this->hasReservation($parking->getId())):  ?>
                                                    <?php if ($this->reservationToday($parking->getId())): ?>
                                                        
                                                        <!-- ver colores estadia -->
                                                        <div class="item yellow">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>  

                                                    <?php else: ?>
                                                        <div class="item">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                            
                                                    <?php endif; ?>                                            
                                                <?php else : ?>
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>  
                                                <?php endif; ?>    
                                            </a>                                    
                                        
                                            <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                            <div class="reserve-container">                                                               
                                                                <div class="reserve-title">
                                                                    <i class="material-icons">info_outline</i>
                                                                    <p>
                                                                        Estacionamiento actualmente reservado.                                            
                                                                    </p>
                                                                </div>        
                                                                
                                                                <div class="reserve-client">
                                                                    
                                                                    <div class="client-subinfo">
                                                                        <i class="material-icons">person_pin</i>                     
                                                                        Cliente                                                      
                                                                    </div>

                                                                    <div>                                                            
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
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
                                                            <p class="no-reservation z-depth-4">
                                                                <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                    <i class="material-icons">info_outline</i>
                                                                    El estacionamiento tiene futuras reservas
                                                                    <div class="future-reservation-parking">
                                                                        <?php foreach ($f_rsv as $rsv): ?>
                                                                        <div>
                                                                            <div class="client">
                                                                                <i class="material-icons">person_pin</i>                                  
                                                                            </div>
                                                                            <div class="date">
                                                                                <span>
                                                                                    <span class="title-2">• Nombre:  </span>
                                                                                    <?= 
                                                                                        ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                        ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                    ?> 
                                                                                </span>                                                     
                                                                                <span>
                                                                                    <span class="title-2">• Carpa:  </span>
                                                                                    <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </p>                                                                                          
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                        <p class="no-reservation z-depth-4">
                                                            <i class="material-icons">info_outline</i>
                                                            Estacionamiento disponible.                     
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <?php if (isset($id_reservation)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
                                                    <?php else: ?>  
                                                        
                                                    <?php endif; ?>
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
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        <?php if ($this->reservationToday($parking->getId())): ?>
                                                            
                                                            <!-- ver colores estadia -->
                                                            <div class="item yellow">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>  

                                                        <?php else: ?>
                                                            <div class="item">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>                                            
                                                        <?php endif; ?>                                            
                                                    <?php else : ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>    
                                                </a>                                    
                                            
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                        <?php if ($this->hasReservation($parking->getId())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                                <div class="reserve-container">                                                               
                                                                    <div class="reserve-title">
                                                                        <i class="material-icons">info_outline</i>
                                                                        <p>
                                                                            Estacionamiento actualmente reservado.                                            
                                                                        </p>
                                                                    </div>        
                                                                    
                                                                    <div class="reserve-client">
                                                                        
                                                                        <div class="client-subinfo">
                                                                            <i class="material-icons">person_pin</i>                     
                                                                            Cliente                                                      
                                                                        </div>

                                                                        <div>                                                            
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
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
                                                                <p class="no-reservation z-depth-4">
                                                                    <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                        <i class="material-icons">info_outline</i>
                                                                        El estacionamiento tiene futuras reservas
                                                                        <div class="future-reservation-parking">
                                                                            <?php foreach ($f_rsv as $rsv): ?>
                                                                            <div>
                                                                                <div class="client">
                                                                                    <i class="material-icons">person_pin</i>                                  
                                                                                </div>
                                                                                <div class="date">
                                                                                    <span>
                                                                                        <span class="title-2">• Nombre:  </span>
                                                                                        <?= 
                                                                                            ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                            ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                        ?> 
                                                                                    </span>                                                     
                                                                                    <span>
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                    </span>
                                                                                </div>                                                                    
                                                                            </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </p>                                                                                          
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if (isset($id_reservation)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>
                                                        <?php else: ?>  
                                                            
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    <div class="last">                    
                                        <?php foreach($eighthRow as $parking): ?>
                                            <div class="parking-container">                                                                       
                                                <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        <?php if ($this->reservationToday($parking->getId())): ?>
                                                            
                                                            <!-- ver colores estadia -->
                                                            <div class="item yellow">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>  

                                                        <?php else: ?>
                                                            <div class="item">
                                                                <span>
                                                                    <?= $parking->getNumber(); ?>
                                                                </span>		
                                                            </div>                                            
                                                        <?php endif; ?>                                            
                                                    <?php else : ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>    
                                                </a>                                    
                                            
                                                <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                    <div class="modal-content">
                                                        <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                        <?php if ($this->hasReservation($parking->getId())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                                <div class="reserve-container">                                                               
                                                                    <div class="reserve-title">
                                                                        <i class="material-icons">info_outline</i>
                                                                        <p>
                                                                            Estacionamiento actualmente reservado.                                            
                                                                        </p>
                                                                    </div>        
                                                                    
                                                                    <div class="reserve-client">
                                                                        
                                                                        <div class="client-subinfo">
                                                                            <i class="material-icons">person_pin</i>                     
                                                                            Cliente                                                      
                                                                        </div>

                                                                        <div>                                                            
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
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
                                                                <p class="no-reservation z-depth-4">
                                                                    <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                        <i class="material-icons">info_outline</i>
                                                                        El estacionamiento tiene futuras reservas
                                                                        <div class="future-reservation-parking">
                                                                            <?php foreach ($f_rsv as $rsv): ?>
                                                                            <div>
                                                                                <div class="client">
                                                                                    <i class="material-icons">person_pin</i>                                  
                                                                                </div>
                                                                                <div class="date">
                                                                                    <span>
                                                                                        <span class="title-2">• Nombre:  </span>
                                                                                        <?= 
                                                                                            ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                            ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                        ?> 
                                                                                    </span>                                                     
                                                                                    <span>
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>
                                                                                        <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                    </span>
                                                                                </div>                                                                    
                                                                            </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </p>                                                                                          
                                                            <?php endif; ?>

                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php if (isset($id_reservation)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>
                                                        <?php else: ?>  
                                                            
                                                        <?php endif; ?>
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
                                                <?php if ($this->hasReservation($parking->getId())):  ?>
                                                    <?php if ($this->reservationToday($parking->getId())): ?>
                                                        
                                                        <!-- ver colores estadia -->
                                                        <div class="item yellow">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>  

                                                    <?php else: ?>
                                                        <div class="item">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                            
                                                    <?php endif; ?>                                            
                                                <?php else : ?>
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>  
                                                <?php endif; ?>    
                                            </a>                                    
                                        
                                            <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content">
                                                    <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                                    <?php if ($this->hasReservation($parking->getId())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                            <div class="reserve-container">                                                               
                                                                <div class="reserve-title">
                                                                    <i class="material-icons">info_outline</i>
                                                                    <p>
                                                                        Estacionamiento actualmente reservado.                                            
                                                                    </p>
                                                                </div>        
                                                                
                                                                <div class="reserve-client">
                                                                    
                                                                    <div class="client-subinfo">
                                                                        <i class="material-icons">person_pin</i>                     
                                                                        Cliente                                                      
                                                                    </div>

                                                                    <div>                                                            
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
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
                                                            <p class="no-reservation z-depth-4">
                                                                <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                                    <i class="material-icons">info_outline</i>
                                                                    El estacionamiento tiene futuras reservas
                                                                    <div class="future-reservation-parking">
                                                                        <?php foreach ($f_rsv as $rsv): ?>
                                                                        <div>
                                                                            <div class="client">
                                                                                <i class="material-icons">person_pin</i>                                  
                                                                            </div>
                                                                            <div class="date">
                                                                                <span>
                                                                                    <span class="title-2">• Nombre:  </span>
                                                                                    <?= 
                                                                                        ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                        ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                                    ?> 
                                                                                </span>                                                     
                                                                                <span>
                                                                                    <span class="title-2">• Carpa:  </span>
                                                                                    <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>
                                                                                    <?= $rsv->getReservation()->getDateStart(); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </p>                                                                                          
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                        <p class="no-reservation z-depth-4">
                                                            <i class="material-icons">info_outline</i>
                                                            Estacionamiento disponible.                     
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <?php if (isset($id_reservation)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>
                                                    <?php else: ?>  
                                                        
                                                    <?php endif; ?>
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
                                        <?php if ($this->hasReservation($parking->getId())):  ?>
                                            <?php if ($this->reservationToday($parking->getId())): ?>
                                                
                                                <!-- ver colores estadia -->
                                                <div class="item yellow">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>  

                                            <?php else: ?>
                                                <div class="item">
                                                    <span>
                                                        <?= $parking->getNumber(); ?>
                                                    </span>		
                                                </div>                                            
                                            <?php endif; ?>                                            
                                        <?php else : ?>
                                        <div class="item">
                                            <span>
                                                <?= $parking->getNumber(); ?>
                                            </span>		
                                        </div>  
                                        <?php endif; ?>    
                                    </a>                                    
                                
                                    <div id="modal<?= $parking->getId(); ?>" class="modal modal-fixed-footer">
                                        <div class="modal-content">
                                            <h4>Estacionamiento Nº <?= $parking->getNumber(); ?></h4>
                                            <?php if ($this->hasReservation($parking->getId())):  ?>
                                                
                                                <?php if ($rsv = $this->reservationToday($parking->getId())): ?>                                  
                                                    <div class="reserve-container">                                                               
                                                        <div class="reserve-title">
                                                            <i class="material-icons">info_outline</i>
                                                            <p>
                                                                Estacionamiento actualmente reservado.                                            
                                                            </p>
                                                        </div>        
                                                        
                                                        <div class="reserve-client">
                                                            
                                                            <div class="client-subinfo">
                                                                <i class="material-icons">person_pin</i>                     
                                                                Cliente                                                      
                                                            </div>

                                                            <div>                                                            
                                                                <span>
                                                                    <span class="title">• Carpa:  </span>
                                                                    <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                </span>
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
                                                    <p class="no-reservation z-depth-4">
                                                        <?php if ($f_rsv = $this->hasFutureReservation($parking->getId())): ?>
                                                            <i class="material-icons">info_outline</i>
                                                            El estacionamiento tiene futuras reservas
                                                            <div class="future-reservation-parking">
                                                                <?php foreach ($f_rsv as $rsv): ?>
                                                                <div>
                                                                    <div class="client">
                                                                        <i class="material-icons">person_pin</i>                                  
                                                                    </div>
                                                                    <div class="date">
                                                                        <span>
                                                                            <span class="title-2">• Nombre:  </span>
                                                                            <?= 
                                                                                ucfirst($rsv->getReservation()->getClient()->getName()) . ' ' .
                                                                                ucfirst($rsv->getReservation()->getClient()->getLastName()); 
                                                                            ?> 
                                                                        </span>                                                     
                                                                        <span>
                                                                            <span class="title-2">• Carpa:  </span>
                                                                            <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha inicio:  </span>
                                                                            <?= $rsv->getReservation()->getDateStart(); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha fin:  </span>
                                                                            <?= $rsv->getReservation()->getDateEnd(); ?>
                                                                        </span>
                                                                    </div>                                                                    
                                                                </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </p>                                                                                          
                                                <?php endif; ?>

                                            <?php else: ?>
                                                <p class="no-reservation z-depth-4">
                                                    <i class="material-icons">info_outline</i>
                                                    Estacionamiento disponible.                     
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if (isset($id_reservation)): ?>
                                                <a href="<?= FRONT_ROOT ?>parking/reserve/<?= $id_reservation ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                    Reservar
                                                </a>
                                            <?php else: ?>  
                                                
                                            <?php endif; ?>
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