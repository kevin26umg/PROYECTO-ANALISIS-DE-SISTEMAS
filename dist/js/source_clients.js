$(document).ready(function(){
             $('#tabla_clientes').jtable({
                          title: 'Lista de Clientes',
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
                                   listAction: 'busca_clientes.php',
                                   updateAction: 'update_clientes.php',
                                   deleteAction:'eliminar_cliente.php',
                                   createAction:'add_cliente.php',
                                   },
                          fields: {
                                  nit: {
                                   title: 'Nit',
                                   width: '10%',
                                   key: true,
                                   list: true,
								   create: true
                                     },
                                  cliente: {
                                   title: 'Nombre Cliente',
                                   width: '30%',
                                   list: true,
                                   create: true,
                                   edit: true
                                     },
                                  direccion: {
                                   title: 'Direcci\u00f3n',
                                   width: '10%',
                                   list: true,
                                   create: true,
                                   edit: true
                                     },
                                  telefono: {
                                   title: 'Tel\u00e9fono',
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
                                  },
								  limite_saldo: {
                                    title: 'Limite de Saldo',
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
             $('#tabla_clientes').jtable('load', {
                cliente: $('#name').val()
            });
        });

        //Cargar todos los registros cuando se muestre por primera vez
        $('#CargarRegistros').click();
         });