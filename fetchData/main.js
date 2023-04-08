$(document).ready(function() {
      $('#datatables').DataTable({
        
          'serverSide': 'true',
          'processing': 'true',
          'paging': 'true',
          'order': [],
          'ajax':{
          'url': 'fetch_data.php',
          'type': 'POST',
                },
          "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('cid', aData[0]);
        },
          'columnDefs':[{
              'target':[0,5],
              'ordertable': false,
          }]

      });

      
    $('#producttables').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "fetch_product.php"
    
    });
    
   








    });