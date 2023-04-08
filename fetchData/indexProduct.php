
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">

     <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

   <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
    
    <script type="text/javascript" src="./main.js"></script>

    <title>Manage Product</title>
  </head>
  <body>
    <div class="container-fluid">
    <h2 class="text-center">Manage Product</h2>
    <p class="datatable design text-center">Welcome Manage Product</p>
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="producttables" class="table">
              <thead>
               <th>SN</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Cost</th>
                <th>Category</th>
                <th>Ex_Date</th>
        
              </thead>    
              <tbody>
       <!--          <tr>
                <td>1</td>
                <td>vita milk</td>
                <td>50</td>
                <td>25</td>
                <td>15</td>
                <td>milk</td>
                <td>25/5/2022</td>
                <td>1/1/2022</td>
                  <td><a class="btn">Edit</a><a href="">Delete</a></td>
              </tr>  -->
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>