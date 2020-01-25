        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>config/update" method="post" class="col s10 form-test">

                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
                            <h2>
                                <?= $title ?>
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

                        <?php if ($success == null && $alert == null): ?>
                        <div class="row">
                            <div class="col s6">
                                <div class="card-panel lime lighten-4">
                                    <i class="material-icons left">warning</i>
                                    <span class="card-text card-warning">
                                        Actualice los siguientes valores con precaución.
                                    </span>                            
                                </div>        
                            </div>                    
                        </div>                         
                        <?php endif; ?>                                           

                        <?php if ($success != null): ?>
                        <div class="row">
                            <div class="col s6">
                                <div class="card-panel green lighten-4">
                                    <i class="material-icons left">check</i>                            
                                    <span class="card-text card-success"> <?= $success; ?> </span>
                                </div>        
                            </div>                    
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

                        <div class="subtitle">
                            <i class="material-icons left">chevron_right</i>
                            <h2>
                                General
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

                        <div class="row">                            
                            <div class="input-field col s4">
                                <input id="date_s" type="date" name="date_s" class="validate" value="<?= $cfg->getDateStartSeason()?>" required>
                                <label for="date_s">Fecha inicio de temporada</label>                                 
                            </div>
                            <div class="input-field col s4">
                                <input id="date_e" type="date" name="date_e" class="validate" value="<?= $cfg->getDateEndSeason()?>" required>
                                <label for="date_e">Fecha fin de temporada</label>                                 
                            </div>
                            <div class="input-field col s4">
                                <input id="season" type="number" name="season" class="validate" value="<?= $cfg->getPriceTentSeason()?>" required>
                                <label for="season">Valor carpa por temporada</label>
                            </div>                                                   
                        </div>           

                        <div class="subtitle">          
                            <i class="material-icons left">chevron_right</i>                  
                            <h2>
                                Enero
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="day" type="number" name="january" class="validate" value="<?= $cfg->getPriceTentJanuary()?>" required>
                                <label for="day">Valor carpa enero</label>                                 
                            </div>
             
                            <div class="input-field col s4">
                                <input id="january_day" type="number" name="january_day" class="validate" value="<?= $cfg->getPriceTentJanuaryDay()?>" required>
                                <label for="january_day">Valor carpa dia enero</label>
                            </div>     
                            <div class="input-field col s4">
                                <input id="january_fortnigh" type="number" name="january_fortnigh" class="validate" value="<?= $cfg->getPriceTentJanuaryFortnigh()?>" required>
                                <label for="january_fortnigh">Valor carpa quincena enero</label>
                            </div>                                                   
                        </div>

                        <div class="subtitle">    
                            <i class="material-icons left">chevron_right</i>                        
                            <h2>
                                Febrero
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="february" type="number" name="february" class="validate" value="<?= $cfg->getPriceTentFebruary()?>" required>
                                <label for="february">Valor carpa febrero</label>                                 
                            </div>
                            <div class="input-field col s6">
                                <input id="february_day" type="number" name="february_day" class="validate" value="<?= $cfg->getPriceTentFebruaryDay()?>" required>
                                <label for="february_day">Valor carpa dia febrero</label>
                            </div>                        
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="february_first_fortnigh" type="number" name="february_first_fortnigh" class="validate" value="<?= $cfg->getPriceTentFebruaryFirstFortnigh()?>" required>
                                <label for="february_first_fortnigh">Valor carpa primer quincena febrero</label>                                 
                            </div>
             
                            <div class="input-field col s6">
                                <input id="february_second_fortnigh" type="number" name="february_second_fortnigh" class="validate" value="<?= $cfg->getPriceTentFebruarySecondFortnigh()?>" required>
                                <label for="february_second_fortnigh">Valor carpa segunda quincena febrero</label>
                            </div>                                                   
                        </div>
                        
                        <div class="subtitle">                            
                            <i class="material-icons left">chevron_right</i>
                            <h2>
                                Sombrilla
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="parasol" type="number" name="parasol" class="validate" value="<?= $cfg->getPriceParasol()?>" required>
                                <label for="parasol">Valor sombrilla</label>                                 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Actualizar
                                    <i class="material-icons right">update</i>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>    