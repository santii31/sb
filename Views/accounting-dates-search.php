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
                
                <div class="row center-align">
                    <div class="col s6 ce">
                      
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Ventas en determinada fecha</a>
                        <div class="sales-info">
                            <span>
                                Por ejemplo: Buscar las ventas del día 01/01/2020.
                            </span>
                        </div>

                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4>Ventas en determinada fecha</h4>
                                
                                <form action="<?= FRONT_ROOT ?>accounting/search" method="post" class="col s12">                    
                                    <div class="row">                                                                        
                                        <div class="input-field col s12">
                                            <input id="start_1" type="date" name="start" class="validate" required>
                                            <label for="start_1">Fecha</label>
                                        </div>                                                    
                                    </div>                        
                                    <div class="row">
                                        <div class="col s12 center-align">
                                            <button class="btn waves-effect waves-light" type="submit" name="action">Buscar
                                                <i class="material-icons right">search</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>  
                                
                            </div>                            
                        </div>
                    </div>

                    <div class="col s6">

                        <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Ventas entre fechas</a>
                        <div class="sales-info">
                            <span>
                                Por ejemplo: Buscar ventas entre el 01/01/2020 y el 31/01/2020.
                            </span>
                        </div>

                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4>Ventas entre fechas</h4>
                                
                                <form action="<?= FRONT_ROOT ?>accounting/searchBetween" method="post" class="col s12 form-test">                 
                                    <div class="row">                                                                        
                                        <div class="input-field col s6">
                                            <input id="start" type="date" name="start" class="validate" required>
                                            <label for="start">Fecha de inicio</label>
                                        </div>

                                        <div class="input-field col s6">
                                            <input id="end" type="date" name="end" class="validate" required>
                                            <label for="end">Fecha de fin</label>
                                        </div>                                                     
                                    </div>                        
                                    <div class="row">
                                        <div class="col s12 center-align">
                                            <button class="btn waves-effect waves-light" type="submit" name="action">Buscar
                                                <i class="material-icons right">search</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>  
                                
                            </div>                                
                        </div>                    
                    </div>
                </div>                  

            </div>
        </div>
    </div>
</div>