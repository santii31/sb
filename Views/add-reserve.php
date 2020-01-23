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
                                    <option value="season">Temporada</option>                                    
                                    <option value="january">Enero</option>
                                    <option value="january_day">Enero - Dia</option>
                                    <option value="january_fortnigh">Enero - Quincena</option>
                                    <option value="february">Febrero</option>
                                    <option value="february_day">Febrero - Dia</option>
                                    <option value="february_first_fortnigh">Febrero - Primer quincena</option>
                                    <option value="february_second_fortnigh">Febrero - Segunda quincena</option>
                                </select>
                                <label>Estadia</label>  
                            </div>  
                            <div class="input-field col s4">
                                <input id="start" type="date" name="start" class="validate" required>
                                <label for="start">Fecha de ingreso</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="end" type="date" name="end" class="validate" required>
                                <label for="end">Fecha de egreso</label>
                            </div>                            
                        </div>      

                        <div class="row">                        
                            <div class="input-field col s6">
                                <input id="name" type="text" name="name" class="validate" required>
                                <label for="name">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="l_name" type="text" name="l_name" class="validate" required>
                                <label for="l_name">Apellido</label>
                            </div>                                                                          
                        </div>

                        <div class="row">
                            <div class="input-field col s4">
                                <input id="addr" type="text" name="addr" class="validate" required>
                                <label for="addr">Domicilio</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="city" type="text" name="city" class="validate" required>
                                <label for="city">Ciudad</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="cp" type="number" name="cp" class="validate" required>
                                <label for="cp">Codigo Postal</label>
                            </div>                                                        
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="phone" type="number" name="phone" class="validate" required>
                                <label for="phone">Telefono</label>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="fam" type="text" name="fam" class="validate" required>
                                <label for="fam">Grupo familiar</label>
                            </div>       

                            <div class="input-field col s4">
                                <select name="payment_method">
                                    <option value="" disabled selected>Seleccione su opcion</option>
                                    <option value="cash">Efectivo</option>
                                    <option value="check">Cheque</option>
                                </select>
                                <label>Metodo de pago</label>
                            </div>

                            <div class="input-field col s4">
                                <input id="phone2" type="number" name="auxiliary_phone" class="validate">
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

                        <input type="hidden" name="tent" value="<?= $id_tent ?>">

                        <div class="input-field col s4">
                                <input id="price" type="number" name="price" class="validate">
                                <label for="price">Precio</label>
                        </div>

                        <div class="row">
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Añadir
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>

                        

                    </form>
                    <div class="row">

                            
                    <table class="responsive-table centered" id="table-filter">
                        <thead>                            
                            <tr>
                                <th>Fecha inicio de temporada.</th>
                                <th>Fecha fin de temporada.</th>
                                <th>Precio de carpa por temporada.</th>
                                <th>Precio por enero.</th>
                                <th>Precio por dia en enero.</th>
                                <th>Precio por quincena en enero.</th>
                                <th>Precio por febrero.</th>
                                <th>Precio por dia en febrero.</th>
                                <th>Precio por primera quincena en febrero.</th>
                                <th>Precio por segunda quincena en febrero.</th>
                                <th>Precio sombrilla.</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <tr>
                                <td> <?= "$" . $config->getDateStartSeason(); ?> </td>
                                <td> <?= "$" . $config->getDateEndSeason(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentSeason(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentJanuary(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentJanuaryDay(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentJanuaryFortnigh(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentFebruary(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentFebruaryDay(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentFebruaryFirstFortnigh(); ?> </td>
                                <td> <?= "$" . $config->getPriceTentFebruarySecondFortnigh(); ?> </td>
                                <td> <?= "$" . $config->getPriceParasol(); ?> </td>
                            </tr>
                                     
                        </tbody>
                    </table>            
                            

                                                        
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
        if (selectStay.value === 'january' ) {
            
            const date = new Date();
            date.setMonth(0);
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);                               
            
            const f_day = firstDay.toISOString().slice(0,10);            
            const l_day = lastDay.toISOString().slice(0,10);            

            dateStart.value = f_day;            
            dateEnd.value = l_day;            

        } else if (selectStay.value == 'february' ) {
            
            const date = new Date();
            date.setMonth(1);
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);                               
            
            const f_day = firstDay.toISOString().slice(0,10);            
            const l_day = lastDay.toISOString().slice(0,10);            

            dateStart.value = f_day;            
            dateEnd.value = l_day; 

        } else {

            dateStart.value = 0;            
            dateEnd.value = 0; 
            
        }
    });    

</script>