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
        if($_SESSION["tipo"] != 1){
          session_destroy();
          header('Location: index.php'); 
        }
      }

    ?>
    <?php
      $user = $_GET["u"];
      include("include/connect.php");
      $getuser = mysql_query("SELECT * FROM usuario WHERE rut='$user'");

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
            <li><a href="dashboard.php">Inicios de sesión <span class="sr-only">(current)</span></a></li>
            <li class="active"><a href="adduser.php">Añadir usuario</a></li>
            <li><a href="seeuser.php">Ver usuarios</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Bienvenido</h1>
          <?php 
          if(mysql_num_rows($getuser)){
            while ($row = mysql_fetch_assoc($getuser) ) {
          ?>
          <h2 class="sub-header">Editar Usuario</h2>
          <div class="alert alert-success" role="alert" style="margin-bottom:10px; display:none;">Exito! Usuario agregado correctamente</div>
            <div class="alert alert-danger" role="alert" style="margin-bottom:10px; display:none;">Error! Verifique los campos e intentelo Nuevamente</div>
            <form id="edituser" name="edituser"  role="form" data-toggle="validator" method="post" action="include/edituser.php">
                <div class="form-group">
                  <label for="rut">RUT</label>
                  <input type="text" name="rut" id="rut" class="form-control" readonly="readonly" placeholder="RUT" value="<?php echo $row['rut'];?>"/>
                </div>
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="password" name="password" id="password" class="form-control" value="<?php echo $row['password'];?>" placeholder="Contraseña" required/>
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $row['nombre'];?>" placeholder="Nombre" required/>
                </div>
                <div class="form-group">
                  <label for="apellido">Apellido</label>
                  <input type="text" name="apellido" name="apellido" class="form-control" value="<?php echo $row['apellido'];?>" placeholder="Apellido" required/>
                </div>
                <div class="form-group">
                  <label for="codigo">Código</label>
                  <input type="text" class="form-control" pattern="^(?:\+|-)?\d+$" name="codigo"  data-minlength="3" data-maxlength="3" id="codigo" placeholder="Código" value="<?php echo $row['codigo'];?>"required/>
                  <span class="help-block">Ingrese un código de 3 digitos</span>
                </div>
                
               <button type="submit" class="btn btn-success">Guardar Campos</button>    
            </form>        
        </div>
        <?php
          } 
        }
        ?>

      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validator.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
        $('#edit').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
          // handle the invalid form...
        } else {
      
 
        // Stop form from submitting normally
        event.preventDefault();
        var $form = $( this ),
        nombre = $form.find( "input[name='nombre']" ).val(),
        rut = $form.find( "input[name='rut']" ).val(),
        apellido = $form.find( "input[name='apellido']" ).val(),
        password = $form.find( "input[name='password']" ).val(),
        codigo = $form.find( "input[name='codigo']" ).val(),
        url = $form.attr( "action" );

        var posting = $.post( url, { rut:rut, nombre:nombre, apellido:apellido, codigo:codigo, password:password } );

        posting.done(function( data ) {
          if(data == "Exito"){
            window.location = "seeuser.php"
            }
          }
          else{
            $(".alert-danger").fadeIn("slow", function(){
              $(this).fadeOut("slow");
            });
          }
        });
      }

     
    </script>
  </body>
</html>