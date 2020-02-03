        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content">
                <div class="row">
                    <form action="<?= FRONT_ROOT ?>additionalService/addOpenParkingPrice" method="post" class="col s10 form-test">                
                        <div class="subtitle">
                            <i class="material-icons left">add_circle_outline</i>
                            <h2>
                                <?= $title ?>
                            </h2>
                        </div>
                        <div class="divider mb-divider"></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="price" type="number" name="price" min="0" class="validate" required>
                                <label for="price">Precio</label>
                            </div>
                        </div>    
                        
                        <input type="hidden" name="id_reservation" value="<?= $id_reservation; ?>" >
                        
                        <?php if (isset($fromList)): ?>                        
                        <input type="hidden" name="fromList" value="<?= $fromList ?>">
                        <?php endif; ?>

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