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
							<div class="box-color violet"></div>
							<span>Febrero</span>
						</div>
						<div class="beach-color">
							<div class="box-color orange"></div>
							<span>Fin de semana</span>
						</div>
						<div class="beach-color">
							<div class="box-color blue"></div>
							<span>Periodo</span>
						</div>
					</div>               

                    <?php if (isset($id_reservation)): ?>
                    <div class="more-list">
                        <a href="<?= FRONT_ROOT ?>additionalService/hasAdditionalService/<?= $id_reservation; ?>">              
                            <i class="material-icons left">arrow_forward</i>
                            <span>
                                Dar de alta sin estacionamiento
                            </span>    
                        </a>
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

                    <div class="parking-map">

                        <!-- Left -->
                        <div class="left">
                            <?php foreach($firstRow as $parking): ?>
                                <div class="parking-container">                                                                        
                                    <a class="modal-trigger" href="#modal<?= $parking->getId(); ?>">                                            
                                        <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                            <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
        
                                                <?php $stay = $rsv->getStay(); ?>
                                                                                                     
                                                <?php switch ($stay): 
                                                    case "temporada": ?>
                                                        <div class="item yellow">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?> 
                                                
                                                    <?php case "enero": ?>
                                                        <div class="item fuchsia">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "enero_dia": ?>
                                                        <div class="item fuchsia">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "enero_quincena": ?>
                                                        <div class="item fuchsia">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>
                                                    
                                                    <?php case "febrero": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>                                                                

                                                    <?php case "febrero_dia": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "febero_primer_quincena": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "febrero_segunda_quincena": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>                                                    

                                                    <?php case "diario": ?>
                                                        <div class="item green">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>                                                                
                                                    
                                                    <?php case "fin_semana": ?>
                                                        <div class="item orange">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>
                                                    
                                                    <?php case "periodo": ?>
                                                        <div class="item blue">  
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>  
                                                    
                                                <?php endswitch; ?>                                                                              
                                                                                                                
                                            <?php else: ?>
                                            <div class="item">
                                                <span>
                                                    <?= $parking->getNumber(); ?>
                                                </span>		
                                            </div>  
                                            <?php endif; ?>

                                        <?php else: ?>
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
                                            
                                            <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                
                                                <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                
                                                                <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                <span>
                                                                    <span class="title">• Carpa:  </span>
                                                                    <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                </span>
                                                                <?php else: ?>
                                                                <span>
                                                                    <span class="title">• Sombrilla:  </span>
                                                                    <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                </span>                                                                
                                                                <?php endif; ?>

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
                                                                    <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                </span>
                                                                <span>
                                                                    <span class="title">• Fecha fin:  </span>
                                                                    <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                </span>
                                                                
                                                                <span>
                                                                    <span class="title">• Estadia:  </span>
                                                                    <?= ucfirst(
                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                        ); 
                                                                    ?>                    
                                                                </span>
                                                            </div>

                                                            <?php ?>
                                                        </div>                                                               
                                                    </div>  
                                                <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                        
                                                    <p class="no-reservation z-depth-4">                                                        
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
                                                                            <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                <span class="title-2">• Carpa:  </span>
                                                                                <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                            <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                <span class="title">• Sombrilla:  </span>
                                                                                <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                            <?php endif; ?>                                                      
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha inicio:  </span>                       
                                                                            <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                ); 
                                                                            ?>   
                                                                        </span>
                                                                    </div>                                                                    
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </p>                                                                                          
                                                <?php else: ?>
                                                    <p class="no-reservation z-depth-4">
                                                        <i class="material-icons">info_outline</i>
                                                        Estacionamiento disponible.                     
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
                                                
                                                <?php if (isset($fromList)): ?>
                                                <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                    Reservar
                                                </a>   
                                                <?php else: ?>
                                                
                                                <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                    Reservar
                                                </a>                             
                                                <?php endif; ?>

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
                                                <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                    <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                
                                                        <?php $stay = $rsv->getStay(); ?>
                                                                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="item yellow">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_dia": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_quincena": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                

                                                            <?php case "febrero_dia": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>                                                    

                                                            <?php case "diario": ?>
                                                                <div class="item green">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="item orange">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="item blue">  
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>                                                                              
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>

                                                <?php else: ?>
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
                                                    
                                                    <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                        
                                                                        <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
                                                                        <?php else: ?>
                                                                        <span>
                                                                            <span class="title">• Sombrilla:  </span>
                                                                            <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                        </span>                                                                
                                                                        <?php endif; ?>

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
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            <span class="title">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getStay()) 
                                                                                ); 
                                                                            ?>                    
                                                                        </span>
                                                                    </div>

                                                                    <?php ?>
                                                                </div>                                                               
                                                            </div>  
                                                        <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                
                                                            <p class="no-reservation z-depth-4">                                                        
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
                                                                                    <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                    <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                        <span class="title">• Sombrilla:  </span>
                                                                                        <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                    <?php endif; ?>                                                      
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>                       
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Estadia:  </span>
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                        ); 
                                                                                    ?>   
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </p>                                                                                          
                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
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
                                                        
                                                        <?php if (isset($fromList)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>   
                                                        <?php else: ?>
                                                        
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>                             
                                                        <?php endif; ?>

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
                                                <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                    <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                
                                                        <?php $stay = $rsv->getStay(); ?>
                                                                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="item yellow">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_dia": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_quincena": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                

                                                            <?php case "febrero_dia": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>                                                    

                                                            <?php case "diario": ?>
                                                                <div class="item green">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="item orange">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="item blue">  
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>                                                                              
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>

                                                <?php else: ?>
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
                                                    
                                                    <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                        
                                                                        <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
                                                                        <?php else: ?>
                                                                        <span>
                                                                            <span class="title">• Sombrilla:  </span>
                                                                            <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                        </span>                                                                
                                                                        <?php endif; ?>

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
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            <span class="title">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getStay()) 
                                                                                ); 
                                                                            ?>                    
                                                                        </span>
                                                                    </div>

                                                                    <?php ?>
                                                                </div>                                                               
                                                            </div>  
                                                        <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                
                                                            <p class="no-reservation z-depth-4">                                                        
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
                                                                                    <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                    <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                        <span class="title">• Sombrilla:  </span>
                                                                                        <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                    <?php endif; ?>                                                      
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>                       
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Estadia:  </span>
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                        ); 
                                                                                    ?>   
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </p>                                                                                          
                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
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
                                                        
                                                        <?php if (isset($fromList)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>   
                                                        <?php else: ?>
                                                        
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>                             
                                                        <?php endif; ?>

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
                                                    <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                    
                                                            <?php $stay = $rsv->getStay(); ?>
                                                                                                                
                                                            <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="item yellow">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "enero_dia": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "enero_quincena": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>
                                                                
                                                                <?php case "febrero": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>                                                                

                                                                <?php case "febrero_dia": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>                                                    

                                                                <?php case "diario": ?>
                                                                    <div class="item green">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="item orange">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="item blue">  
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>                                                                              
                                                                                                                            
                                                        <?php else: ?>
                                                        <div class="item">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>  
                                                        <?php endif; ?>

                                                    <?php else: ?>
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
                                                        
                                                        <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                            
                                                                            <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
                                                                            <?php else: ?>
                                                                            <span>
                                                                                <span class="title">• Sombrilla:  </span>
                                                                                <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                            </span>                                                                
                                                                            <?php endif; ?>

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
                                                                                <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                            </span>
                                                                            <span>
                                                                                <span class="title">• Fecha fin:  </span>
                                                                                <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                            </span>
                                                                            
                                                                            <span>
                                                                                <span class="title">• Estadia:  </span>
                                                                                <?= ucfirst(
                                                                                        str_replace('_', ' ', $rsv->getStay()) 
                                                                                    ); 
                                                                                ?>                    
                                                                            </span>
                                                                        </div>

                                                                        <?php ?>
                                                                    </div>                                                               
                                                                </div>  
                                                            <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                    
                                                                <p class="no-reservation z-depth-4">                                                        
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
                                                                                        <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                            <span class="title-2">• Carpa:  </span>
                                                                                            <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                        <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                            <span class="title">• Sombrilla:  </span>
                                                                                            <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                        <?php endif; ?>                                                      
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>                       
                                                                                        <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Estadia:  </span>
                                                                                        <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                            ); 
                                                                                        ?>   
                                                                                    </span>
                                                                                </div>                                                                    
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </p>                                                                                          
                                                            <?php else: ?>
                                                                <p class="no-reservation z-depth-4">
                                                                    <i class="material-icons">info_outline</i>
                                                                    Estacionamiento disponible.                     
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
                                                            
                                                            <?php if (isset($fromList)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>   
                                                            <?php else: ?>
                                                            
                                                            <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>                             
                                                            <?php endif; ?>

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
                                                    <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                    
                                                            <?php $stay = $rsv->getStay(); ?>
                                                                                                                
                                                            <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="item yellow">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "enero_dia": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "enero_quincena": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>
                                                                
                                                                <?php case "febrero": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>                                                                

                                                                <?php case "febrero_dia": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>                                                    

                                                                <?php case "diario": ?>
                                                                    <div class="item green">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="item orange">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="item blue">  
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>                                                                              
                                                                                                                            
                                                        <?php else: ?>
                                                        <div class="item">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>  
                                                        <?php endif; ?>

                                                    <?php else: ?>
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
                                                        
                                                        <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                            
                                                                            <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
                                                                            <?php else: ?>
                                                                            <span>
                                                                                <span class="title">• Sombrilla:  </span>
                                                                                <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                            </span>                                                                
                                                                            <?php endif; ?>

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
                                                                                <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                            </span>
                                                                            <span>
                                                                                <span class="title">• Fecha fin:  </span>
                                                                                <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                            </span>
                                                                            
                                                                            <span>
                                                                                <span class="title">• Estadia:  </span>
                                                                                <?= ucfirst(
                                                                                        str_replace('_', ' ', $rsv->getStay()) 
                                                                                    ); 
                                                                                ?>                    
                                                                            </span>
                                                                        </div>

                                                                        <?php ?>
                                                                    </div>                                                               
                                                                </div>  

                                                            <?php else: ?>
                                                                <p class="no-reservation z-depth-4">
                                                                    <?php if ($f_rsv = $this->hasFutureReservation($parking->getNumber())): ?>
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
                                                                                        <?php if ($rsv->getBeachTent() != null): ?>                          
                                                                                            <span class="title-2">• Carpa:  </span>
                                                                                            <?= $rsv->getBeachTent()->getNumber(); ?>                        
                                                                                        <?php else: ?>
                                                                                            <span class="title">• Sombrilla:  </span>
                                                                                            <?= $rsv->getParasol()->getParasolNumber(); ?>                   
                                                                                        <?php endif; ?>                                                      
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>                       
                                                                                        <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Estadia:  </span>
                                                                                        <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?>   
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
                                                            
                                                            <?php if (isset($fromList)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>   
                                                            <?php else: ?>
                                                            
                                                            <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>                             
                                                            <?php endif; ?>

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
                                                <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                    <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                
                                                        <?php $stay = $rsv->getStay(); ?>
                                                                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="item yellow">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_dia": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_quincena": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                

                                                            <?php case "febrero_dia": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>                                                    

                                                            <?php case "diario": ?>
                                                                <div class="item green">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="item orange">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="item blue">  
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>                                                                              
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>

                                                <?php else: ?>
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
                                                    
                                                    <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                        
                                                                        <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
                                                                        <?php else: ?>
                                                                        <span>
                                                                            <span class="title">• Sombrilla:  </span>
                                                                            <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                        </span>                                                                
                                                                        <?php endif; ?>

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
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            <span class="title">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getStay()) 
                                                                                ); 
                                                                            ?>                    
                                                                        </span>
                                                                    </div>

                                                                    <?php ?>
                                                                </div>                                                               
                                                            </div>  
                                                        <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                
                                                            <p class="no-reservation z-depth-4">                                                        
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
                                                                                    <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                    <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                        <span class="title">• Sombrilla:  </span>
                                                                                        <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                    <?php endif; ?>                                                      
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>                       
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Estadia:  </span>
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                        ); 
                                                                                    ?>   
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </p>                                                                                          
                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
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
                                                        
                                                        <?php if (isset($fromList)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>   
                                                        <?php else: ?>
                                                        
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>                             
                                                        <?php endif; ?>

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
                                                <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                    <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                
                                                        <?php $stay = $rsv->getStay(); ?>
                                                                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="item yellow">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_dia": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_quincena": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                

                                                            <?php case "febrero_dia": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>                                                    

                                                            <?php case "diario": ?>
                                                                <div class="item green">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="item orange">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="item blue">  
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>                                                                              
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>

                                                <?php else: ?>
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
                                                    
                                                    <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                        
                                                                        <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
                                                                        <?php else: ?>
                                                                        <span>
                                                                            <span class="title">• Sombrilla:  </span>
                                                                            <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                        </span>                                                                
                                                                        <?php endif; ?>

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
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            <span class="title">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getStay()) 
                                                                                ); 
                                                                            ?>                    
                                                                        </span>
                                                                    </div>

                                                                    <?php ?>
                                                                </div>                                                               
                                                            </div>  
                                                        <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                
                                                            <p class="no-reservation z-depth-4">                                                        
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
                                                                                    <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                    <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                        <span class="title">• Sombrilla:  </span>
                                                                                        <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                    <?php endif; ?>                                                      
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>                       
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Estadia:  </span>
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                        ); 
                                                                                    ?>   
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </p>                                                                                          
                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
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
                                                        
                                                        <?php if (isset($fromList)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>   
                                                        <?php else: ?>
                                                        
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>                             
                                                        <?php endif; ?>

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
                                                    <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                    
                                                            <?php $stay = $rsv->getStay(); ?>
                                                                                                                
                                                            <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="item yellow">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "enero_dia": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "enero_quincena": ?>
                                                                    <div class="item fuchsia">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>
                                                                
                                                                <?php case "febrero": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>                                                                

                                                                <?php case "febrero_dia": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>

                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="item violet">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>                                                    

                                                                <?php case "diario": ?>
                                                                    <div class="item green">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                              
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="item orange">   
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="item blue">  
                                                                        <span>
                                                                            <?= $parking->getNumber(); ?>
                                                                        </span>		
                                                                    </div>                                                                                   
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>                                                                              
                                                                                                                            
                                                        <?php else: ?>
                                                        <div class="item">
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>  
                                                        <?php endif; ?>

                                                    <?php else: ?>
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
                                                        
                                                        <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                            
                                                            <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                            
                                                                            <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                            <span>
                                                                                <span class="title">• Carpa:  </span>
                                                                                <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                            </span>
                                                                            <?php else: ?>
                                                                            <span>
                                                                                <span class="title">• Sombrilla:  </span>
                                                                                <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                            </span>                                                                
                                                                            <?php endif; ?>

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
                                                                                <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                            </span>
                                                                            <span>
                                                                                <span class="title">• Fecha fin:  </span>
                                                                                <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                            </span>
                                                                            
                                                                            <span>
                                                                                <span class="title">• Estadia:  </span>
                                                                                <?= ucfirst(
                                                                                        str_replace('_', ' ', $rsv->getStay()) 
                                                                                    ); 
                                                                                ?>                    
                                                                            </span>
                                                                        </div>

                                                                        <?php ?>
                                                                    </div>                                                               
                                                                </div>  
                                                            <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                    
                                                                <p class="no-reservation z-depth-4">                                                        
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
                                                                                        <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                            <span class="title-2">• Carpa:  </span>
                                                                                            <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                        <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                            <span class="title">• Sombrilla:  </span>
                                                                                            <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                        <?php endif; ?>                                                      
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha inicio:  </span>                       
                                                                                        <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Fecha fin:  </span>
                                                                                        <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                    </span>
                                                                                    <span>
                                                                                        <span class="title-2">• Estadia:  </span>
                                                                                        <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                            ); 
                                                                                        ?>   
                                                                                    </span>
                                                                                </div>                                                                    
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </p>                                                                                          
                                                            <?php else: ?>
                                                                <p class="no-reservation z-depth-4">
                                                                    <i class="material-icons">info_outline</i>
                                                                    Estacionamiento disponible.                     
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
                                                            
                                                            <?php if (isset($fromList)): ?>
                                                            <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>   
                                                            <?php else: ?>
                                                            
                                                            <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                                Reservar
                                                            </a>                             
                                                            <?php endif; ?>

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
                                                <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                                    <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
                
                                                        <?php $stay = $rsv->getStay(); ?>
                                                                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="item yellow">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_dia": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "enero_quincena": ?>
                                                                <div class="item fuchsia">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                

                                                            <?php case "febrero_dia": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>

                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="item violet">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>                                                    

                                                            <?php case "diario": ?>
                                                                <div class="item green">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                              
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="item orange">   
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="item blue">  
                                                                    <span>
                                                                        <?= $parking->getNumber(); ?>
                                                                    </span>		
                                                                </div>                                                                                   
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>                                                                              
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="item">
                                                        <span>
                                                            <?= $parking->getNumber(); ?>
                                                        </span>		
                                                    </div>  
                                                    <?php endif; ?>

                                                <?php else: ?>
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
                                                    
                                                    <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                        
                                                        <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                        
                                                                        <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                        <span>
                                                                            <span class="title">• Carpa:  </span>
                                                                            <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                        </span>
                                                                        <?php else: ?>
                                                                        <span>
                                                                            <span class="title">• Sombrilla:  </span>
                                                                            <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                        </span>                                                                
                                                                        <?php endif; ?>

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
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                        </span>
                                                                        
                                                                        <span>
                                                                            <span class="title">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getStay()) 
                                                                                ); 
                                                                            ?>                    
                                                                        </span>
                                                                    </div>

                                                                    <?php ?>
                                                                </div>                                                               
                                                            </div>  
                                                        <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                                
                                                            <p class="no-reservation z-depth-4">                                                        
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
                                                                                    <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                        <span class="title-2">• Carpa:  </span>
                                                                                        <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                                    <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                        <span class="title">• Sombrilla:  </span>
                                                                                        <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                                    <?php endif; ?>                                                      
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha inicio:  </span>                       
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Fecha fin:  </span>
                                                                                    <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                                </span>
                                                                                <span>
                                                                                    <span class="title-2">• Estadia:  </span>
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                        ); 
                                                                                    ?>   
                                                                                </span>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </p>                                                                                          
                                                        <?php else: ?>
                                                            <p class="no-reservation z-depth-4">
                                                                <i class="material-icons">info_outline</i>
                                                                Estacionamiento disponible.                     
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
                                                        
                                                        <?php if (isset($fromList)): ?>
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>   
                                                        <?php else: ?>
                                                        
                                                        <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                            Reservar
                                                        </a>                             
                                                        <?php endif; ?>

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
                                        <?php if ($this->hasReservation($parking->getNumber())): ?>  
                                            <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                          
        
                                                <?php $stay = $rsv->getStay(); ?>
                                                                                                     
                                                <?php switch ($stay): 
                                                    case "temporada": ?>
                                                        <div class="item yellow">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?> 
                                                
                                                    <?php case "enero": ?>
                                                        <div class="item fuchsia">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "enero_dia": ?>
                                                        <div class="item fuchsia">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "enero_quincena": ?>
                                                        <div class="item fuchsia">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>
                                                    
                                                    <?php case "febrero": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>                                                                

                                                    <?php case "febrero_dia": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "febero_primer_quincena": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>

                                                    <?php case "febrero_segunda_quincena": ?>
                                                        <div class="item violet">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>                                                    

                                                    <?php case "diario": ?>
                                                        <div class="item green">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                              
                                                    <?php break; ?>                                                                
                                                    
                                                    <?php case "fin_semana": ?>
                                                        <div class="item orange">   
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>
                                                    
                                                    <?php case "periodo": ?>
                                                        <div class="item blue">  
                                                            <span>
                                                                <?= $parking->getNumber(); ?>
                                                            </span>		
                                                        </div>                                                                                   
                                                    <?php break; ?>  
                                                    
                                                <?php endswitch; ?>                                                                              
                                                                                                                
                                            <?php else: ?>
                                            <div class="item">
                                                <span>
                                                    <?= $parking->getNumber(); ?>
                                                </span>		
                                            </div>  
                                            <?php endif; ?>

                                        <?php else: ?>
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
                                            
                                            <?php if ($this->hasReservation($parking->getNumber())):  ?>
                                                
                                                <?php if ($rsv = $this->reservationToday($parking->getNumber())): ?>                                  
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
                                                                
                                                                <?php if ($rsv->getBeachTent() != null): ?>                                     
                                                                <span>
                                                                    <span class="title">• Carpa:  </span>
                                                                    <?= $rsv->getBeachTent()->getNumber(); ?> 
                                                                </span>
                                                                <?php else: ?>
                                                                <span>
                                                                    <span class="title">• Sombrilla:  </span>
                                                                    <?= $rsv->getParasol()->getParasolNumber(); ?> 
                                                                </span>                                                                
                                                                <?php endif; ?>

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
                                                                    <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?>
                                                                </span>
                                                                <span>
                                                                    <span class="title">• Fecha fin:  </span>
                                                                    <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?>                      
                                                                </span>
                                                                
                                                                <span>
                                                                    <span class="title">• Estadia:  </span>
                                                                    <?= ucfirst(
                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                        ); 
                                                                    ?>                    
                                                                </span>
                                                            </div>

                                                            <?php ?>
                                                        </div>                                                               
                                                    </div>  
                                                <?php elseif ($f_rsv = $this->hasFutureReservation( $parking->getId() )): ?>                                                  
                                                                                                        
                                                    <p class="no-reservation z-depth-4">                                                        
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
                                                                            <?php if ($rsv->getReservation()->getBeachTent() != null): ?>                          
                                                                                <span class="title-2">• Carpa:  </span>
                                                                                <?= $rsv->getReservation()->getBeachTent()->getNumber(); ?>                        
                                                                            <?php elseif ($rsv->getReservation()->getParasol() != null): ?>
                                                                                <span class="title">• Sombrilla:  </span>
                                                                                <?= $rsv->getReservation()->getParasol()->getParasolNumber(); ?>                   
                                                                            <?php endif; ?>                                                      
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha inicio:  </span>                       
                                                                            <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateStart())); ?>
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Fecha fin:  </span>
                                                                            <?= date("d-m-Y" , strtotime($rsv->getReservation()->getDateEnd())); ?>                                                                   
                                                                        </span>
                                                                        <span>
                                                                            <span class="title-2">• Estadia:  </span>
                                                                            <?= ucfirst(
                                                                                    str_replace('_', ' ', $rsv->getReservation()->getStay()) 
                                                                                ); 
                                                                            ?>   
                                                                        </span>
                                                                    </div>                                                                    
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </p>                                                                                          
                                                <?php else: ?>
                                                    <p class="no-reservation z-depth-4">
                                                        <i class="material-icons">info_outline</i>
                                                        Estacionamiento disponible.                     
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
                                                
                                                <?php if (isset($fromList)): ?>
                                                <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>/list" class="modal-close waves-effect waves-green btn-flat ">
                                                    Reservar
                                                </a>   
                                                <?php else: ?>
                                                
                                                <a href="<?= FRONT_ROOT ?>parking/addPrice/<?= $id_reservation; ?>/<?= $parking->getId(); ?>" class="modal-close waves-effect waves-green btn-flat ">
                                                    Reservar
                                                </a>                             
                                                <?php endif; ?>

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