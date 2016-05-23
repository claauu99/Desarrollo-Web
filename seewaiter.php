<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Administración</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
      session_start();
      if(!isset($_SESSION['usuario'])) {
        header('Location: index.php'); 
        exit();
        if($_SESSION["tipo"] != 2){
          session_destroy();
          header('Location: index.php'); 
        }
      }

    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Panel de administración</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="include/logout.php">Cerrar Sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="meter.php">Gestionar turnos <span class="sr-only">(current)</span></a></li>
            <li><a href="addwaiter.php">Añadir garzón</a></li>
            <li class="active"><a href="seewaiter.php">Ver garzones</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Bienvenido <?php echo $_SESSION['usuario'] ?></h1>

          <h2 class="sub-header">Ver garzones</h2>
          <div class="table-responsive">
            <?php
              include("include/connect.php");

              $see = mysql_query("SELECT * FROM garzones");
              if(mysql_num_rows($see) > 0){

                $html = '
                <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>RUT</th>
                          <th>Nombre</th>
                          <th>Código</th>
                          <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                ';
                $i = 1;
                while ($row = mysql_fetch_assoc($see) ) {
                  $html .= '
                  <tr>
                    <td>'.$i.'</td>
                    <td>'.$row["rut"].'</td>
                    <td>'.$row["nombre"] . " " . $row["apellido"].'</td>
                    <td>'.$row["codigo"].'</td>
                    <td><a href="editwaiter.php?u='.$row["rut"].'"><button type="button" class="btn btn-primary">Editar</button></a>
                    <button type="button" class="btn btn-danger deletewaiter" data-rut="'.$row["rut"].'" >Eliminar</button></td>
                  </tr>
                  ';
                  $i++; 
                }
                
                $html .= '
                </tbody>
                </table>
                ';

                echo $html;
              }
              else{
                echo "No existen usuarios de este tipo";
              }
              ?>
          </div>
          
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>