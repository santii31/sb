        <!-- Main content  -->
        <div class="col s12 m8 l10">
            <div class="main-content table-container">
                <div class="subtitle">
                    <i class="material-icons left">chevron_right</i>
                    <h2>
                        Proveedores
                    </h2>
                </div>
                <div class="divider mb-divider"></div>
                <nav class="search-container">                
                    <div class="nav-wrapper s-color">                    
                        <div class="input-field">
                            <input id="search" type="search" placeholder="Filtrar por nombre...">
                            <label class="label-icon" for="search">
                                <i class="material-icons" >search</i>
                            </label>                            
                        </div>                    
                    </div>
                </nav>                 
                <div class="row">    
                    <table class="responsive-table" id="table-filter">
                        <thead>                            
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Direccion</th>
                                <th>Mas informacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                                               
                        <tbody>
                            <tr>
                                <td>Alvin</td>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons left">arrow_forward</i>Ver mas
                                            </div>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <li>• Numero de CUIL: 123124</li>
                                                    <li>• Razon social: rs x</li>
                                                    <li>• Tipo de facturacion: A</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>                                      
                                </td>                                
                                <td class="actions">
                                    <a class="waves-effect waves-light btn-small btn-danger">
                                        <i class="material-icons left">delete_forever</i>
                                        Deshabilitar
                                    </a>
                                    <a class="waves-effect waves-light btn-small">
                                        <i class="material-icons left">build</i>
                                        Modificar
                                    </a>                                                                                            
                                </td>

                            </tr>
                            <tr>
                                <td>Alvin</td>
                                <td>Pepe</td>
                                <td>Eclair</td>
                                <td>$0.87</td>
                                <td>Alvin</td>
                                <td>Eclair</td>
                                <td>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons left">arrow_forward</i>Ver mas
                                            </div>
                                            <div class="collapsible-body">
                                                <ul>
                                                    <li>• Numero de CUIL: 123124</li>
                                                    <li>• Razon social: rs x</li>
                                                    <li>• Tipo de facturacion: A</li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>                                      
                                </td>                                
                                <td class="actions">
                                    <a class="waves-effect waves-light btn-small btn-danger">
                                        <i class="material-icons left">delete_forever</i>
                                        Deshabilitar
                                    </a>
                                    <a class="waves-effect waves-light btn-small">
                                        <i class="material-icons left">build</i>
                                        Modificar
                                    </a>                                                                                            
                                </td>

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