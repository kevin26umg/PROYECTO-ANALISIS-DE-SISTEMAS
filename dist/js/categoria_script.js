$(document).ready(function(){
             $('#tabla_clientes').jtable({
                          title: 'Lista de Categor\u00edas',
                          paging: true,
                          sorting: true,
				          pageSize: 20,
                          pageSizeChangeArea: false,
                          defaultSorting: 'id ASC',
                          gotoPageArea: 'none',
                          //selecting: true,
                          //multiselect: true, //Allow multiple selecting
                          //selectingCheckboxes: true,
                          actions: {
                                   listAction: 'busca_categorias.php',
                                   updateAction: 'update_categorias.php',
                                  // deleteAction:'eliminar_categoria.php',
                                   createAction:'add_categoria.php',
                                   },
                          fields: {
                                  id: {
                                   title: 'Id',
                                   width: '10%',
                                   key: true,
                                   list: true
								  // create: true
                                     },
                                  categoria: {
                                   title: 'Categoria',
                                   width: '30%',
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
                categoria: $('#name').val()
            });
        });

        //Cargar todos los registros cuando se muestre por primera vez
        $('#CargarRegistros').click();
         });