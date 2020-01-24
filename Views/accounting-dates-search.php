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
      
                <form action="<?= FRONT_ROOT ?>accounting/search" method="post" class="col s12 form-test">

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