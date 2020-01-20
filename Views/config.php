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

                        <div class="row">                            
                            <div class="input-field col s6">
                                <input id="date_f" type="date" name="date_f" class="validate" required>
                                <label for="date_f">Fecha fin de temporada</label>                                 
                            </div>
                            <div class="input-field col s6">
                                <input id="season" type="number" name="season" class="validate" required>
                                <label for="season">Valor carpa por temporada</label>
                            </div>                                                   
                        </div>           

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="day" type="number" name="day" class="validate" required>
                                <label for="day">Valor carpa por dia</label>                                 
                            </div>
             
                            <div class="input-field col s6">
                                <input id="january" type="number" name="january" class="validate" required>
                                <label for="january">Valor carpa enero</label>
                            </div>                                                   
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="rest" type="number" name="rest" class="validate" required>
                                <label for="rest">Valor carpa feriados</label>                                 
                            </div>
                            <div class="input-field col s4">
                                <input id="period" type="number" name="period" class="validate" required>
                                <label for="period">Valor carpa periodos</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="fortnigh" type="number" name="fortnigh" class="validate" required>
                                <label for="fortnigh">Valor carpa quincena</label>
                            </div>                                       
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="parasol" type="number" name="parasol" class="validate" required>
                                <label for="parasol">Valor sombrilla</label>                                 
                            </div>
             
                            <div class="input-field col s6">
                                <input id="parking" type="number" name="parking" class="validate" required>
                                <label for="parking">Valor estacionamiento</label>
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