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
                                                                case "temporada": ?>
                                                                    <div class="tent yellow">                                                
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <!-- FEBRERO - VER COLOR -->
                                                                <?php case "febrero": ?>
                                                                    <div class="tent violet">                                                
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent violet">                                                
                                                                <?php break; ?>
                                                                <!--  -->
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent green">                                                
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <!-- <a href="<?= FRONT_ROOT ?>additionalService/chose/<?= $rsv->getId(); ?>/yes" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Servicios
                                                            </a> -->
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
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
    
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="tent tent-inverse yellow">                                       
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <!-- FEBRERO - VER COLOR -->
                                                                <?php case "febrero": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
                                                                <!--  -->
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent tent-inverse green">                                                
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent tent-inverse orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="tent tent-inverse blue">                                                
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 
    
                                                    <?php else: ?>
                                                    
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                    case "temporada": ?>
                                                                        <div class="tent yellow">                                                
                                                                    <?php break; ?> 
                                                                
                                                                    <?php case "enero": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_dia": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_quincena": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <!-- FEBRERO - VER COLOR -->
                                                                    <?php case "febrero": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>                                                                
    
                                                                    <?php case "febrero_dia": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febero_primer_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febrero_segunda_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
                                                                    <!--  -->
    
                                                                    <?php case "diario": ?>
                                                                        <div class="tent green">                                                
                                                                    <?php break; ?>                                                                
                                                                    
                                                                    <?php case "fin_semana": ?>
                                                                        <div class="tent orange">                                                
                                                                    <?php break; ?>
                                                                    
                                                                    <?php case "periodo": ?>
                                                                        <div class="tent blue">                                                
                                                                    <?php break; ?>                                                              
                                                                <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent">
                                                        <?php endif; ?>                                                     
                                                    
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                        Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach; ?>
                                </div>   
    
                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($firtsParasol as $parasol): ?>
                                        <div>
                                            <a class="modal-trigger" href="#parasol<?= $parasol->getId(); ?>">
                                                <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>              
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="parasol-item yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="parasol-item green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="parasol-item orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="parasol-item blue">                                                
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>      
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="parasol-item">
                                                    <?php endif; ?>
    
                                                <?php else: ?>
                                                <div class="parasol-item">
                                                <?php endif; ?>
                                                    <span>
                                                    <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>     
                                            </a>
                                            
                                            <div id="parasol<?= $parasol->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Sombrilla Nº <?= $parasol->getParasolNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $parasol->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($rsv = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $parasol->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $parasol->getId(); ?>">                                         
                                                                Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>                     
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">                                          
                                                                            <i class="material-icons">info_outline</i>
                                                                            La sombrilla se encuentra actualmente reservada.
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La sombrilla tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La sombrilla no tiene reservas.    
                                                                <?php endif; ?>                                                          
    
                                                            <?php else: ?>
                                                                La sombrilla no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <div id="reser-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
                                                                            </div>                                                           
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>                                                         
                                                            </div>    
                                                        </div>
                                                    <?php endif; ?>                 
                                                </div>
    
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationParasolPath/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updateParasolPath/<?= $rsv->getId(); ?>/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
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
    
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="tent tent-inverse yellow">                                       
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <!-- FEBRERO - VER COLOR -->
                                                                <?php case "febrero": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
                                                                <!--  -->
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent tent-inverse green">                                                
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent tent-inverse orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="tent tent-inverse blue">                                                
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 
    
                                                    <?php else: ?>
                                                    
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                    case "temporada": ?>
                                                                        <div class="tent yellow">                                                
                                                                    <?php break; ?> 
                                                                
                                                                    <?php case "enero": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_dia": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_quincena": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <!-- FEBRERO - VER COLOR -->
                                                                    <?php case "febrero": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>                                                                
    
                                                                    <?php case "febrero_dia": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febero_primer_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febrero_segunda_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
                                                                    <!--  -->
    
                                                                    <?php case "diario": ?>
                                                                        <div class="tent green">                                                
                                                                    <?php break; ?>                                                                
                                                                    
                                                                    <?php case "fin_semana": ?>
                                                                        <div class="tent orange">                                                
                                                                    <?php break; ?>
                                                                    
                                                                    <?php case "periodo": ?>
                                                                        <div class="tent blue">                                                
                                                                    <?php break; ?>                                                              
                                                                <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent">
                                                        <?php endif; ?>                                                     
                                                    
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                        Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach; ?>
                                </div> 
                                
                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($secondParasol as $parasol): ?>
                                        <div>
                                            <a class="modal-trigger" href="#parasol<?= $parasol->getId(); ?>">
                                                <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>              
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="parasol-item yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="parasol-item green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="parasol-item orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="parasol-item blue">                                                
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>      
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="parasol-item">
                                                    <?php endif; ?>
    
                                                <?php else: ?>
                                                <div class="parasol-item">
                                                <?php endif; ?>
                                                    <span>
                                                    <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>     
                                            </a>
                                            
                                            <div id="parasol<?= $parasol->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Sombrilla Nº <?= $parasol->getParasolNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $parasol->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($rsv = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $parasol->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $parasol->getId(); ?>">                                         
                                                                Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>                     
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">                                          
                                                                            <i class="material-icons">info_outline</i>
                                                                            La sombrilla se encuentra actualmente reservada.
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La sombrilla tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La sombrilla no tiene reservas.    
                                                                <?php endif; ?>                                                          
    
                                                            <?php else: ?>
                                                                La sombrilla no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <div id="reser-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
                                                                            </div>                                                           
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>                                                         
                                                            </div>    
                                                        </div>
                                                    <?php endif; ?>                 
                                                </div>
    
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationParasolPath/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updateParasolPath/<?= $rsv->getId(); ?>/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
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
    
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="tent tent-inverse yellow">                                       
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <!-- FEBRERO - VER COLOR -->
                                                                <?php case "febrero": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
                                                                <!--  -->
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent tent-inverse green">                                                
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent tent-inverse orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="tent tent-inverse blue">                                                
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 
    
                                                    <?php else: ?>
                                                    
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                    case "temporada": ?>
                                                                        <div class="tent yellow">                                                
                                                                    <?php break; ?> 
                                                                
                                                                    <?php case "enero": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_dia": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_quincena": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <!-- FEBRERO - VER COLOR -->
                                                                    <?php case "febrero": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>                                                                
    
                                                                    <?php case "febrero_dia": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febero_primer_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febrero_segunda_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
                                                                    <!--  -->
    
                                                                    <?php case "diario": ?>
                                                                        <div class="tent green">                                                
                                                                    <?php break; ?>                                                                
                                                                    
                                                                    <?php case "fin_semana": ?>
                                                                        <div class="tent orange">                                                
                                                                    <?php break; ?>
                                                                    
                                                                    <?php case "periodo": ?>
                                                                        <div class="tent blue">                                                
                                                                    <?php break; ?>                                                              
                                                                <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent">
                                                        <?php endif; ?>                                                     
                                                    
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                        Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea-seant fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach; ?>
                                </div>
    
                                <!-- Parasol -->
                                <div class="parasol">                                    
                                    <?php foreach ($thirdParasol as $parasol): ?>
                                        <div>
                                            <a class="modal-trigger" href="#parasol<?= $parasol->getId(); ?>">
                                                <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>              
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="parasol-item yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="parasol-item green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="parasol-item orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="parasol-item blue">                                                
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>      
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="parasol-item">
                                                    <?php endif; ?>
    
                                                <?php else: ?>
                                                <div class="parasol-item">
                                                <?php endif; ?>
                                                    <span>
                                                    <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>     
                                            </a>
                                            
                                            <div id="parasol<?= $parasol->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Sombrilla Nº <?= $parasol->getParasolNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $parasol->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($rsv = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $parasol->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $parasol->getId(); ?>">                                         
                                                                Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>                     
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">                                          
                                                                            <i class="material-icons">info_outline</i>
                                                                            La sombrilla se encuentra actualmente reservada.
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La sombrilla tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La sombrilla no tiene reservas.    
                                                                <?php endif; ?>                                                          
    
                                                            <?php else: ?>
                                                                La sombrilla no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <div id="reser-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
                                                                            </div>                                                           
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>                                                         
                                                            </div>    
                                                        </div>
                                                    <?php endif; ?>                 
                                                </div>
    
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationParasolPath/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updateParasolPath/<?= $rsv->getId(); ?>/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
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
    
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="tent tent-inverse yellow">                                       
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <!-- FEBRERO - VER COLOR -->
                                                                <?php case "febrero": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
                                                                <!--  -->
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent tent-inverse green">                                                
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent tent-inverse orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="tent tent-inverse blue">                                                
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 
    
                                                    <?php else: ?>
                                                    
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                    case "temporada": ?>
                                                                        <div class="tent yellow">                                                
                                                                    <?php break; ?> 
                                                                
                                                                    <?php case "enero": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_dia": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_quincena": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <!-- FEBRERO - VER COLOR -->
                                                                    <?php case "febrero": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>                                                                
    
                                                                    <?php case "febrero_dia": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febero_primer_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febrero_segunda_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
                                                                    <!--  -->
    
                                                                    <?php case "diario": ?>
                                                                        <div class="tent green">                                                
                                                                    <?php break; ?>                                                                
                                                                    
                                                                    <?php case "fin_semana": ?>
                                                                        <div class="tent orange">                                                
                                                                    <?php break; ?>
                                                                    
                                                                    <?php case "periodo": ?>
                                                                        <div class="tent blue">                                                
                                                                    <?php break; ?>                                                              
                                                                <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent">
                                                        <?php endif; ?>                                                     
                                                    
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                        Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach; ?>						
                                </div>
    
                                <!-- Parasol -->
                                <div class="parasol">                                      
                                    <?php foreach ($fourthParasol as $parasol): ?>
                                        <div>
                                            <a class="modal-trigger" href="#parasol<?= $parasol->getId(); ?>">
                                                <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>              
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="parasol-item yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="parasol-item green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="parasol-item orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="parasol-item blue">                                                
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>      
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="parasol-item">
                                                    <?php endif; ?>
    
                                                <?php else: ?>
                                                <div class="parasol-item">
                                                <?php endif; ?>
                                                    <span>
                                                    <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>     
                                            </a>
                                            
                                            <div id="parasol<?= $parasol->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Sombrilla Nº <?= $parasol->getParasolNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $parasol->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($rsv = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $parasol->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $parasol->getId(); ?>">                                         
                                                                Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>                     
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">                                          
                                                                            <i class="material-icons">info_outline</i>
                                                                            La sombrilla se encuentra actualmente reservada.
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La sombrilla tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La sombrilla no tiene reservas.    
                                                                <?php endif; ?>                                                          
    
                                                            <?php else: ?>
                                                                La sombrilla no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <div id="reser-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
                                                                            </div>                                                           
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>                                                         
                                                            </div>    
                                                        </div>
                                                    <?php endif; ?>                 
                                                </div>
    
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationParasolPath/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updateParasolPath/<?= $rsv->getId(); ?>/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
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
    
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="tent tent-inverse yellow">                                       
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                                
                                                                <?php break; ?>
    
                                                                <!-- FEBRERO - VER COLOR -->
                                                                <?php case "febrero": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                                
                                                                <?php break; ?>
                                                                <!--  -->
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent tent-inverse green">                                                
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent tent-inverse orange">                                                
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="tent tent-inverse blue">                                                
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent tent-inverse">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent tent-inverse">
                                                        <?php endif; ?> 
    
                                                    <?php else: ?>
                                                    
                                                        <?php if ($this->hasReservation( $tent->getId() )): ?>  
                                                        
                                                            <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        
                                                                <?php $stay = $rsv->getStay(); ?>                                                                
                                                                <?php switch ($stay): 
                                                                    case "temporada": ?>
                                                                        <div class="tent yellow">                                                
                                                                    <?php break; ?> 
                                                                
                                                                    <?php case "enero": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_dia": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "enero_quincena": ?>
                                                                        <div class="tent fuchsia">                                                
                                                                    <?php break; ?>
    
                                                                    <!-- FEBRERO - VER COLOR -->
                                                                    <?php case "febrero": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>                                                                
    
                                                                    <?php case "febrero_dia": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febero_primer_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
    
                                                                    <?php case "febrero_segunda_quincena": ?>
                                                                        <div class="tent violet">                                                
                                                                    <?php break; ?>
                                                                    <!--  -->
    
                                                                    <?php case "diario": ?>
                                                                        <div class="tent green">                                                
                                                                    <?php break; ?>                                                                
                                                                    
                                                                    <?php case "fin_semana": ?>
                                                                        <div class="tent orange">                                                
                                                                    <?php break; ?>
                                                                    
                                                                    <?php case "periodo": ?>
                                                                        <div class="tent blue">                                                
                                                                    <?php break; ?>                                                              
                                                                <?php endswitch; ?>   
    
                                                            <?php else: ?>
                                                                <div class="tent">
                                                            <?php endif; ?>
    
                                                        <?php else: ?>
                                                        <div class="tent">
                                                        <?php endif; ?>                                                     
                                                    
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                        Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php endforeach; ?>	
                                </div>
    
                                <!-- Parasol -->
                                <div class="parasol">                        
                                    <?php foreach ($fifthParasol as $parasol): ?>
                                        <div>
                                            <a class="modal-trigger" href="#parasol<?= $parasol->getId(); ?>">
                                                <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>  
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>              
                                                        
                                                        <?php $stay = $rsv->getStay(); ?>
                                                            
                                                        <?php switch ($stay): 
                                                            case "temporada": ?>
                                                                <div class="parasol-item yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="parasol-item fuchsia">                                               
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="parasol-item violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="parasol-item green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="parasol-item orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
                                                                <div class="parasol-item blue">                                                
                                                            <?php break; ?>  
                                                            
                                                        <?php endswitch; ?>      
                                                                                                                        
                                                    <?php else: ?>
                                                    <div class="parasol-item">
                                                    <?php endif; ?>
    
                                                <?php else: ?>
                                                <div class="parasol-item">
                                                <?php endif; ?>
                                                    <span>
                                                    <?= $parasol->getParasolNumber(); ?>
                                                    </span>		
                                                </div>     
                                            </a>
                                            
                                            <div id="parasol<?= $parasol->getId(); ?>" class="modal modal-fixed-footer">
                                                <div class="modal-content center-align">
                                                    <h4>Sombrilla Nº <?= $parasol->getParasolNumber(); ?></h4>                                             
                                                    <ul id="tabs-swipe-demo" class="tabs z-depth-1">
                                                        <li class="tab col s6">
                                                            <a class="active" href="#status-<?= $parasol->getId(); ?>">                         
                                                                Reserva actual                                                            
                                                            </a>
                                                        </li>
                                                        <?php if ($rsv = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $parasol->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $parasol->getId(); ?>">                                         
                                                                Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
                                                        </li>                                                     
                                                    </ul>
                                                    
                                                    <div id="status-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
                                                        <div>
                                                            <?php if ($this->hasReservationParasol( $parasol->getId() )): ?>                     
                                                                                                                                    
                                                                <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                                    
                                                                    <div class="reserve-container">
                                                                        
                                                                        <div class="reserve-title">                                          
                                                                            <i class="material-icons">info_outline</i>
                                                                            La sombrilla se encuentra actualmente reservada.
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La sombrilla tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La sombrilla no tiene reservas.    
                                                                <?php endif; ?>                                                          
    
                                                            <?php else: ?>
                                                                La sombrilla no tiene reservas.
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if ($rsvList = $this->hasFutureReservationParasol( $parasol->getId() )): ?>
                                                        <div id="reser-<?= $parasol->getId(); ?>" class="col s12 tab-extra">
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                    <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
                                                                            </div>                                                           
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>                                                         
                                                            </div>    
                                                        </div>
                                                    <?php endif; ?>                 
                                                </div>
    
                                                <div class="modal-footer">
                                                    <a href="<?= FRONT_ROOT ?>reservation/addReservationParasolPath/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                        Reservar
                                                    </a>
                                                    <?php if ($rsv = $this->reservationTodayParasol( $parasol->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updateParasolPath/<?= $rsv->getId(); ?>/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $parasol->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
                                                    <?php endif; ?>
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
                                                            
                                                            <?php $stay = $rsv->getStay(); ?>
                                                                
                                                            <?php switch ($stay): 
                                                                case "temporada": ?>
                                                                    <div class="tent tent-inverse yellow">                                       
                                                                <?php break; ?> 
                                                            
                                                                <?php case "enero": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                      
                                                                <?php break; ?>
    
                                                                <?php case "enero_dia": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                      
                                                                <?php break; ?>
    
                                                                <?php case "enero_quincena": ?>
                                                                    <div class="tent tent-inverse fuchsia">                                      
                                                                <?php break; ?>
                                                                
                                                                <?php case "febrero": ?>
                                                                    <div class="tent tent-inverse violet">                                       
                                                                <?php break; ?>                                                                
    
                                                                <?php case "febrero_dia": ?>
                                                                    <div class="tent tent-inverse violet">                                       
                                                                <?php break; ?>
    
                                                                <?php case "febero_primer_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                       
                                                                <?php break; ?>
    
                                                                <?php case "febrero_segunda_quincena": ?>
                                                                    <div class="tent tent-inverse violet">                                       
                                                                <?php break; ?>                                                                
    
                                                                <?php case "diario": ?>
                                                                    <div class="tent tent-inverse green">                                        
                                                                <?php break; ?>                                                                
                                                                
                                                                <?php case "fin_semana": ?>
                                                                    <div class="tent tent-inverse orange">                                       
                                                                <?php break; ?>
                                                                
                                                                <?php case "periodo": ?>
                                                                    <div class="tent tent-inverse blue">                                         
                                                                <?php break; ?>  
                                                                
                                                            <?php endswitch; ?>     
                                                                                                                            
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
                                                            <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                            <li class="tab col s6">                                              
                                                                <a href="#reser-<?= $tent->getId(); ?>">
                                                                    <span class="fut-rsv-alert">                                                 
                                                                        <i class="material-icons">warning</i>
                                                                        Futuras reservas
                                                                    </span>
                                                                </a>                                                       
                                                            <?php else: ?>
                                                            <li class="tab disabled col s6">                                                     
                                                                <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                        Futuras reservas                                                         
                                                                </a>  
                                                            <?php endif; ?>                                                            
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
    
                                                                    <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                        <span class="fut-rsv-alert">                                         
                                                                            <i class="material-icons">warning</i>
                                                                            La carpa tiene futuras reservas.
                                                                        </span>
                                                                    <?php else: ?>
                                                                        La carpa no tiene reservas.    
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
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Fecha fin: </span>
                                                                                    <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Telefono: </span>
                                                                                    <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                                </div>
    
                                                                                <div>
                                                                                    <span class="title-2">• Estadia: </span>
                                                                                    <span>  
                                                                                            <?= ucfirst(
                                                                                                str_replace('_', ' ', $rsv->getStay()) 
                                                                                            ); 
                                                                                        ?> 
                                                                                    </span>         
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
                                                        <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                            <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Modificar
                                                            </a>
                                                            <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                            class="modal-close waves-effect waves-green btn-flat ">
                                                                Deshabilitar
                                                            </a>
                                                        <?php endif; ?>
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
                                                            case "temporada": ?>
                                                                <div class="tent-sea yellow">                                                
                                                            <?php break; ?> 
                                                        
                                                            <?php case "enero": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_dia": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
    
                                                            <?php case "enero_quincena": ?>
                                                                <div class="tent-sea fuchsia">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "febrero": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                                
    
                                                            <?php case "febrero_dia": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febero_primer_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>
    
                                                            <?php case "febrero_segunda_quincena": ?>
                                                                <div class="tent-sea violet">                                                
                                                            <?php break; ?>                                                            
    
                                                            <?php case "diario": ?>
                                                                <div class="tent-sea green">                                                
                                                            <?php break; ?>                                                                
                                                            
                                                            <?php case "fin_semana": ?>
                                                                <div class="tent-sea orange">                                                
                                                            <?php break; ?>
                                                            
                                                            <?php case "periodo": ?>
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
                                                        <?php if ($rsv = $this->hasFutureReservation( $tent->getId() )): ?>
                                                        <li class="tab col s6">                                              
                                                            <a href="#reser-<?= $tent->getId(); ?>">
                                                                <span class="fut-rsv-alert">                                                 
                                                                    <i class="material-icons">warning</i>
                                                                    Futuras reservas
                                                                </span>
                                                            </a>                                                       
                                                        <?php else: ?>
                                                        <li class="tab disabled col s6">                                                     
                                                            <a href="#reser-<?= $tent->getId(); ?>">                                         
                                                                    Futuras reservas                                                         
                                                            </a>  
                                                        <?php endif; ?>                                                            
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
    
                                                                <?php elseif ($rsvList = $this->hasFutureReservation( $tent->getId() )): ?>  
                                                                    <span class="fut-rsv-alert">                                         
                                                                        <i class="material-icons">warning</i>
                                                                        La carpa tiene futuras reservas.
                                                                    </span>
                                                                <?php else: ?>
                                                                    La carpa no tiene reservas.    
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
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateStart())); ?> </span>
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Fecha fin: </span>
                                                                                <span> <?= date("d-m-Y" , strtotime($rsv->getDateEnd())); ?> </span>                     
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Telefono: </span>
                                                                                <span> <?= $rsv->getClient()->getPhone(); ?> </span>         
                                                                            </div>
    
                                                                            <div>
                                                                                <span class="title-2">• Estadia: </span>
                                                                                <span>  
                                                                                        <?= ucfirst(
                                                                                            str_replace('_', ' ', $rsv->getStay()) 
                                                                                        ); 
                                                                                    ?> 
                                                                                </span>         
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
                                                    <?php if ($rsv = $this->reservationToday( $tent->getId() )): ?>
                                                        <a href="<?= FRONT_ROOT ?>reservation/updatePath/<?= $rsv->getId(); ?>/<?= $tent->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Modificar
                                                        </a>
                                                        <a href="<?= FRONT_ROOT ?>reservation/disable/<?= $rsv->getId(); ?>" 
                                                        class="modal-close waves-effect waves-green btn-flat ">
                                                            Deshabilitar
                                                        </a>
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
        </div>        

	</div>
</div>
