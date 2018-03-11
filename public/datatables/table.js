var editor;
var table_obj;

$(document).ready(function() {
  editor = new $.fn.dataTable.Editor( {
    ajax: dataurl,
    table: table,
    template: template,
    fields: form_fields,
    i18n: i18n,
    language: language

  } );

  var btns;

  $.each(buttons, function(key, value){
    buttons[key].editor = editor;
  });

  table_obj = $(table).DataTable( {
    dom: "Bfrtip",
    ajax: {
            url: dataurl,
            type: "POST"
    },
    language: language,
    serverSide: true,
    processing: true,
    select: {
         			style:    'multi',
         			selector: 'td:first-child'
         		},
    columns: columns,
    buttons: buttons

  } );

  if(table == "#Userstable"){
    table_obj.on( 'select deselect', function () {
         var selectedRows = table_obj.rows( { selected: true } ).count();

         table_obj.button( 3 ).enable( selectedRows > 0 );
         table_obj.button( 4 ).enable( selectedRows > 0 );
     } );
  }


} );
