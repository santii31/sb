         <!-- Main content  -->
         <div class="col s12 m8 l10">
            <div class="main-content table-container">
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>                        
                        <?= $subTitle ?>
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
                    <div class="col s6 center-align">
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Nuevo registro</a>
                        
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4>Nuevo registro</h4>
                                
                                <form action="<?= FRONT_ROOT ?>accounting/addDiary" method="post" class="col s12">                    
                                    
                                    <div class="row">                                                                        
                                        <div class="input-field col s6">
                                            <input id="date" type="date" name="start" class="validate" required>
                                            <label for="date">Fecha</label>
                                        </div>  
                                        <div class="input-field col s6">                                            
                                            <select name="type">
                                                <option value="" disabled selected>Seleccione su opcion</option>                                  
                                                <option value="ingreso">
                                                    Ingreso
                                                </option>
                                                <option value="salida">
                                                    Salida
                                                </option>
                                            </select>
                                            <label for="type">Tipo</label>
                                        </div>                                                                                            
                                    </div>                        

                                    <div class="row">
                                        <div class="input-field col s4">
                                            <select name="payment">
                                                <option value="" disabled selected>Seleccione su opcion</option>                                  
                                                <option value="efectivo">
                                                    Efectivo
                                                </option>
                                                <option value="tarjeta">
                                                    Tarjeta
                                                </option>
                                                <option value="cheque">
                                                    Cheque
                                                </option>
                                                <option value="otros">
                                                    Otros
                                                </option>
                                            </select>
                                            <label for="payment">Metodo de pago</label>
                                        </div>  
                                        <div class="input-field col s4">
                                            <input id="detail" type="text" name="detail" class="validate" required>
                                            <label for="detail">Detalles</label>
                                        </div>  
                                        <div class="input-field col s4">
                                            <input id="total" type="number" name="total" class="validate" required>
                                            <label for="total">Importe</label>
                                        </div>  
                                    </div>

                                    <div class="row">
                                        <div class="col s12 center-align">
                                            <button class="btn waves-effect waves-light" type="submit" name="action">Añadir
                                                <i class="material-icons right">add</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>  
                                
                            </div>                            
                        </div>

                    </div>

                    <div class="col s6 center-align">
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Buscar por fecha</a>
                        
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4>Buscar por fecha</h4>
                                
                                <form action="<?= FRONT_ROOT ?>accounting/diaryPath" method="post" class="col s12">                    
                                    
                                    <div class="row">                                                                        
                                        <div class="input-field col s12">
                                            <input id="date" type="date" name="start" class="validate" required>
                                            <label for="date">Fecha</label>
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
                                
                <nav class="search-container">                
                    <div class="nav-wrapper s-color">                    
                        <div class="input-field">
                            <input id="search" type="search" placeholder="Filtrar por tipo...">
                            <label class="label-icon" for="search">
                                <i class="material-icons" >search</i>
                            </label>                            
                        </div>                    
                    </div>
                </nav>                
                                
                <div class="row">                    
                    <table class="responsive-table striped centered" id="table-filter">
                        <thead>
                        <tr>                            
                            <th>Fecha</th>    
                            <th>Tipo</th>         
                            <th>Metodo de pago</th>                                           
                            <th>Detalles</th>
                            <th>Importe</th>                                                        
                        </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($diarys as $diary): ?>
                                <tr>                                    
                                    <td> <?= date("d-m-Y", strtotime($diary->getDate())); ?> </td>
                                    <td> <?= ucfirst( $diary->getType() ); ?> </td>
                                    <td> <?= ucfirst( $diary->getPayment() ); ?> </td>
                                    <td> <?= ucfirst( $diary->getDetail() ); ?> </td>
                                    <td> $<?= number_format($diary->getTotal(), 2, ',', '.'); ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <br><br><br>

                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>                        
                        Resumen del día
                    </h2>                    
                </div>
                <div class="divider mb-divider"></div>   

                <div class="row">                    
                    <table class="responsive-table striped centered" id="table-filter">
                        <thead>
                        <tr>                            
                            <th></th>    
                            <th>Efectivo</th>         
                            <th>Tarjeta</th>                                           
                            <th>Cheque</th>
                            <th>Otros</th>     
                            <th>TOTAL</th>                                                   
                        </tr>
                        </thead>                            
                        <tbody>
                            <tr>
                                <td class="table-double">Ingresos</td>
                                <td><?= number_format($values["inCash"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["inTarjet"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["inCheck"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["inOther"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["totalIn"], 2, ',', '.'); ?></td>                              
                            </tr>
                            <tr>
                                <td class="table-double">Salidas</td>
                                <td><?= number_format($values["outCash"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["outTarjet"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["outCheck"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["outOther"], 2, ',', '.'); ?></td>
                                <td><?= number_format($values["totalOut"], 2, ',', '.'); ?></td>                              
                            </tr>
                            <tr>
                                <td class="table-double">Saldo total</td>
                                <td><?= number_format($values["totalCash"], 2, ',', '.'); ?></td>                              
                                <td><?= number_format($values["totalTarjet"], 2, ',', '.'); ?></td>                              
                                <td><?= number_format($values["totalCheck"], 2, ',', '.'); ?></td>                              
                                <td><?= number_format($values["totalOther"], 2, ',', '.'); ?></td>                                   
                                <td class="table-double-total"><?= number_format($values["total"], 2, ',', '.'); ?></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script>

	let outerInput = document.getElementById('search');

    outerInput.addEventListener('keyup', function() {
        let innerInput, filter, table, tr, td, i, txtValue;
        innerInput = document.getElementById('search');
        filter = innerInput.value.toUpperCase();
        table = document.getElementById('table-filter');
        tr = table.getElementsByTagName('tr');
        
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    });

</script>