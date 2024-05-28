/**********************************************************************/
$(document).ready(function(){
             $('#tabla_proveedores').jtable({
                          title: 'Lista de Proveedores',
                          paging: true,
                          sorting: true,
				          pageSize: 20,
                          pageSizeChangeArea: false,
                          defaultSorting: 'nit ASC',
                          gotoPageArea: 'none',
                          //selecting: true,
                          //multiselect: true, //Allow multiple selecting
                          //selectingCheckboxes: true,
                          actions: {
                                   listAction: 'busca_proveedores.php',
                                   updateAction: 'update_proveedores.php',
                                   deleteAction:'eliminar_proveedor.php',
                                   createAction:'add_proveedor.php',
                                   },
                          fields: {
                                  nit: {
                                   title: 'Nit',
                                   width: '10%',
                                   key: true,
                                   list: true,
								   create: true,
                                     },
                                  proveedor: {
                                   title: 'Proveedor',
                                   width: '30%',
                                   list: true,
                                   create: true,
                                   edit: true
                                     },
                                  direccion: {
                                   title: 'Direccion',
                                   width: '10%',
                                   list: true,
                                   create: true,
                                   edit: true
                                     },
                                  telefono: {
                                   title: 'Telefono',
                                   width: '10%',
                                   list: true,
                                   create: true,
                                   edit: true
                                   },
                                  correo: {
                                    title: 'Correo',
                                    width: '10%',
                                    list: true,
                                    create: true,
                                    edit: true
                                  },
								  saldo: {
                                    title: 'Saldo',
                                    width: '10%',
                                    list: true,
                                    create: true,
                                    edit: true
                                  }
                                  }
                               });

            //Re-load records when user click 'load records' button.
             $('#CargarRegistros').click(function (e){
             e.preventDefault();
             $('#tabla_proveedores').jtable('load', {
                nombre: $('#name').val()
            });
        });

        //Cargar todos los registros cuando se muestre por primera vez
        $('#CargarRegistros').click();
         });
/**********************************************************************/