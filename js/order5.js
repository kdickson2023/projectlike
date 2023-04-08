$(document).ready(function(){

    var html = '<tr><td><b id="number">1</b></td><td><select name="pid[]" class="form-control form-control-sm" required><option>Washing Machine</option></select></td><td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td><td><input name="qty[]" type="text" class="form-control form-control-sm" required></td><td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td><td>Rs.1540</td><td><input class="btn btn-danger" type="button" name="remove" id="remove" value="remove"></td></tr>';



    var max =20;
    var x = 1;

    $("#add").click(function(){
        if(x<=max){
            $("#invoice_item").append(html);
            x++;
        }				
    });
    
    $("#invoice_item").on( 'click', '#remove' ,function(){
        $(this).closest('tr').remove();	
        x--;				
    });


});