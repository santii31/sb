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
                                <select name="stay" id="stay-select">
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
                            <div class="input-field col s4">                                                            
                                <?php if (isset($inputs["start"])): ?>              
                                <input id="start" type="date" name="start" class="validate" value="<?= $inputs["start"]; ?>" required>
                                <?php else: ?>
                                <input id="start" type="date" name="start" class="validate" required>
                                <?php endif; ?>
                                <label for="start">Fecha de ingreso</label>
                            </div>

                            <div class="input-field col s4">
                                <?php if (isset($inputs["end"])): ?>         
                                <input id="end" type="date" name="end" class="validate" value="<?= $inputs["end"]; ?>" required>
                                <?php else: ?>
                                <input id="end" type="date" name="end" class="validate" required>
                                <?php endif; ?>                                
                                <label for="end">Fecha de egreso</label>
                            </div>                            
                        </div>      

                        <div class="row">                        
                            <div class="input-field col s6">
                                <?php if (isset($inputs["name"])): ?>         
                                <input id="name" type="text" name="name" class="validate" value="<?= $inputs["name"]; ?>" required>
                                <?php else: ?>
                                <input id="name" type="text" name="name" class="validate" required>
                                <?php endif; ?>                                   
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <?php if (isset($inputs["l_name"])): ?>         
                                <input id="l_name" type="text" name="l_name" class="validate" value="<?= $inputs["l_name"]; ?>" required>
                                <?php else: ?>
                                <input id="l_name" type="text" name="l_name" class="validate" required>
                                <?php endif; ?>                                                             
                                <label for="l_name">Apellido</label>
                            </div>                                                                          
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <?php if (isset($inputs["addr"])): ?>         
                                <input id="addr" type="text" name="addr" class="validate" value="<?= $inputs["addr"]; ?>" required>
                                <?php else: ?>
                                <input id="addr" type="text" name="addr" class="validate" required>
                                <?php endif; ?>                                                                                         
                                <label for="addr">Domicilio</label>
                            </div>
                            <div class="input-field col s4">
                                <?php if (isset($inputs["city"])): ?>         
                                <input id="city" type="text" name="city" class="validate" value="<?= $inputs["city"]; ?>" required>
                                <?php else: ?>
                                <input id="city" type="text" name="city" class="validate" required>
                                <?php endif; ?>                                                                           
                                <label for="city">Ciudad</label>
                            </div>
                            <div class="input-field col s4">
                            <?php if (isset($inputs["cp"])): ?>         
                                <input id="cp" type="number" name="cp" class="validate" value="<?= $inputs["cp"]; ?>" required>
                                <?php else: ?>
                                <input id="cp" type="number" name="cp" class="validate" required>
                                <?php endif; ?>                                                                           
                                <label for="cp">Codigo Postal</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                            <?php if (isset($inputs["email"])): ?>         
                                <input id="email" type="email" name="email" class="validate" value="<?= $inputs["email"]; ?>" required>
                                <?php else: ?>
                                <input id="email" type="email" name="email" class="validate" required>
                                <?php endif; ?>                                                                           
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                            <?php if (isset($inputs["phone"])): ?>         
                                <input id="phone" type="number" name="phone" class="validate" value="<?= $inputs["phone"]; ?>" required>
                                <?php else: ?>
                                <input id="phone" type="number" name="phone" class="validate" required>
                                <?php endif; ?>                                                                           
                                <label for="phone">Telefono</label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                            <?php if (isset($inputs["fam"])): ?>         
                                <input id="fam" type="text" name="fam" class="validate" value="<?= $inputs["fam"]; ?>" required>
                                <?php else: ?>
                                <input id="fam" type="text" name="fam" class="validate" required>
                                <?php endif; ?>                                                                           
                                <label for="fam">Grupo familiar</label>
                            </div>       


                            <div class="input-field col s6">
                            <?php if (isset($inputs["aux_phone"])): ?>         
                                <input id="phone2" type="number" name="auxiliary_phone" class="validate" value="<?= $inputs["aux_phone"]; ?>" required>
                                <?php else: ?>
                                <input id="phone2" type="number" name="auxiliary_phone" class="validate" required>
                                <?php endif; ?>                                                                           
                                <label for="phone2">Telefono auxiliar</label>
                            </div>                                  
                        </div>

                        <div class="row">
                            <div class="input-field col s3">
                                <label>Tipo de vehiculo:</label>
                            </div>
                            <div class="input-field col s3">
                                <p>
                                    <label>
                                        <input id="vehicle" type="radio" name="vehicle" class="with-gap" value="car">
                                        <span>Auto</span>
                                    </label>
                                </p>                                        
                            </div>
                            
                            <div class="input-field col s3">
                                <p>
                                    <label>
                                        <input id="vehicle" type="radio" name="vehicle" class="with-gap" value="van">
                                        <span>Camioneta</span>
                                    </label>
                                </p>
                            </div>
                            
                            <div class="input-field col s3">
                                <p>
                                    <label>
                                        <input id="vehicle" type="radio" name="vehicle" class="with-gap" value="motorcycle">
                                        <span>Moto</span>
                                    </label>
                                </p>
                            </div>                                                                

                        </div>

                        <?php if (isset($inputs["tent"])): ?>     
                        <input type="hidden" name="tent" value="<?= $inputs["tent"]; ?>">
                        <?php else: ?>                        
                        <input type="hidden" name="tent" value="<?= $id_tent; ?>">
                        <?php endif; ?>                        

                        <div class="row">
                            <div class="input-field col s12">
                            <?php if (isset($inputs["price"])): ?>         
                            <input id="price" type="number" name="price" class="validate" value="<?= $inputs["price"]; ?>" required>
                            <?php else: ?>
                            <input id="price" type="number" name="price" class="validate" required>
                            <?php endif; ?>                                                                           
                            <label for="price">Precio</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Añadir
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                        <br><br>                        
                    </form>                
                    
                    <div class="row">
                        <div class="col s4">
                            <span>
                                • Fecha inicio temporada: <?= date("d-m-Y" , strtotime($config->getDateStartSeason())); ?>
                            </span>
                        </div>
                        <div class="col s4">
                            <span>
                                • Fecha fin temporada: <?= date("d-m-Y" , strtotime($config->getDateEndSeason())); ?>
                            </span>
                        </div>
                        <div class="col s4">
                            <span>
                                • Precio carpa temporada: $<?= $config->getPriceTentSeason(); ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <span>
                                • Precio carpa enero: $<?= $config->getPriceTentJanuary(); ?>
                            </span>
                        </div>
                        <div class="col s4">
                            <span>
                                • Precio por dia en enero: $<?= $config->getPriceTentJanuaryDay(); ?>
                            </span>
                        </div>
                        <div class="col s4">
                            <span>
                                • Precio por quincena en enero: $<?= $config->getPriceTentJanuaryFortnigh(); ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <span>
                                • Precio carpa febrero: $<?= $config->getPriceTentFebruary(); ?>
                            </span>
                        </div>
                        <div class="col s4">
                            <span>
                                • Precio por dia en febrero: $<?= $config->getPriceTentFebruaryDay(); ?>
                            </span>
                        </div>
                        <div class="col s4">
                            <span>
                                • Precio primera quincena en febrero: $<?= $config->getPriceTentFebruaryFirstFortnigh(); ?>
                            </span>
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="col s4">
                            <span>
                                • Precio segunda quincena en febrero: $<?= $config->getPriceTentFebruarySecondFortnigh(); ?>
                            </span>
                        </div> 
                        <div class="col s4">
                            <span>
                                • Precio sombrilla: $<?= $config->getPriceParasol(); ?>
                            </span>
                        </div> 
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    
    const selectStay = document.getElementById('stay-select');    
    const dateStart = document.getElementById('start'); 
    const dateEnd = document.getElementById('end'); 

    selectStay.addEventListener('change', (e)=> {
        if (selectStay.value === 'enero' ) {     
                   
            const date = new Date();
            date.setMonth(0);
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);                               
            
            const f_day = firstDay.toISOString().slice(0, 10);            
            const l_day = lastDay.toISOString().slice(0, 10);            

            dateStart.value = f_day;            
            dateEnd.value = l_day;            

        } else if (selectStay.value == 'febrero' ) {
            
            const date = new Date();
            date.setMonth(1);
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);                               
            
            const f_day = firstDay.toISOString().slice(0, 10);            
            const l_day = lastDay.toISOString().slice(0, 10);            

            dateStart.value = f_day;            
            dateEnd.value = l_day; 

        } else {

            dateStart.value = 0;            
            dateEnd.value = 0; 
            
        }
    });    

</script>