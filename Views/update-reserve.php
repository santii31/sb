        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>reservation/addReservation" method="post" class="col s10 form-test">

                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
                            <h2>
                                <?= $title ?>
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

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

                        <div class="row">
                            <div class="input-field col s4">
                                <select name="stay">
                                    <option value="" disabled selected>Seleccione su opcion</option>                                    
                                        <option value="season">
                                            Temporada
                                        </option>                                    
                                        <option value="day">
                                            Diario
                                        </option>
                                        <option value="january">
                                            Enero
                                        </option>
                                        <option value="rest">
                                            Feriados
                                        </option>
                                        <option value="period">
                                            Periodo
                                        </option>
                                        <!-- <option value="fortnight">
                                            Quincena
                                        </option> -->
                                </select>
                                <label>Estadia</label>  
                            </div>  
                            <div class="input-field col s4">
                                <input id="start" type="Date" name="start" class="validate" value="<?= $reservation->getDateStart(); ?>" required>
                                <label for="start">Fecha de ingreso</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="end" type="Date" name="end" class="validate" value="<?= $reservation->getDateEnd(); ?>" required>
                                <label for="end">Fecha de egreso</label>
                            </div>                            
                        </div>                                                                   
                                                
                        <input type="hidden" name="tent" value="<?= $id_tent ?>">

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Añadir
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    