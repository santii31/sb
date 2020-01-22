  <!-- Main content  -->
  <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>reserve/add" method="post" class="col s10 form-test">

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

                            
                        <table>
                            <thead>
                            <tr>
                                <th>Valor por dia</th>
                                <th>Valor por quincena de enero</th>
                                <th>Valor por febrero</th>
                                <th>Valor por primer quincena de febrero</th>
                                <th>Valor por segunda quincena de febrero</th>
                                <th>Valor por temporada completa</th>
                                <th>Valor por febrero</th>
                                <th>Valor por dia(sombrilla)</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>Jonathan</td>
                                <td>Lollipop</td>
                                <td>$7.00</td>
                            </tr>
                            </tbody>
                        </table>
                            

                                                        
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="price" type="number" name="price" class="validate" required>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    