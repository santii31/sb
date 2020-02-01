        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>reservation/update" method="post" class="col s10 form-test">

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
                         
                        <input type="hidden" name="id_rsv" value="<?= $id_rsv; ?>">                        
                        <input type="hidden" name="id_parasol" value="<?= $id_parasol; ?>">

                        <div class="row">
                            <div class="input-field col s3">
                                <select name="stay" id="stay-select" required>
                                    <option value="" disabled selected>Seleccione su opcion</option>                                    
                                    <option value="temporada">Temporada</option>                                    
                                    <option value="enero">Enero</option>
                                    <option value="enero_dia">Enero - Dia</option>
                                    <option value="enero_quincena">Enero - Quincena</option>
                                    <option value="febrero">Febrero</option>
                                    <option value="febrero_dia">Febrero - Dia</option>
                                    <option value="febero_primer_quincena">Febrero - Primer quincena</option>
                                    <option value="febrero_segunda_quincena">Febrero - Segunda quincena</option>
                                    <option value="diario">Día</option>
                                    <option value="periodo">Periodo</option>
                                    <option value="fin_semana">Fin de semana</option>
                                </select>
                                <label>Estadia</label>   
                            </div>  
                            <div class="input-field col s3">
                                <input id="start" type="date" name="start" class="validate" value="<?= $reservation->getDateStart(); ?>" required>
                                <label for="start">Fecha de ingreso</label>
                            </div>

                            <div class="input-field col s3">
                                <input id="end" type="date" name="end" class="validate" value="<?= $reservation->getDateEnd(); ?>" required>
                                <label for="end">Fecha de egreso</label>
                            </div>     

                            <div class="input-field col s3">
                                <input id="price" type="number" name="price" min="0" class="validate" value="<?= $reservation->getPrice(); ?>" required>
                                <label for="price">Precio</label>
                            </div>                           
                        </div>                                                                   
                                                                    
                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Modificar
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
    