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
            <li class="active"><a href="addwaiter.php">Añadir garzón</a></li>
            <li><a href="seewaiter.php">Ver garzones</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Bienvenido <?php echo $_SESSION['usuario'];?></h1>

          <h2 class="sub-header">Añadir garzón</h2>
          <div class="alert alert-success" role="alert" style="margin-bottom:10px; display:none;">Exito! Garzón agregado correctamente</div>
            <div class="alert alert-danger" role="alert" style="margin-bottom:10px; display:none;">Error! Verifique los campos e intentelo Nuevamente</div>
            <form id="addwaiter" name="addwaiter" role="form" data-toggle="validator" method="post" action="include/addwaiter.php">
                <div class="form-group">
                  <label for="rut">RUT</label>
                  <input type="text" pattern="^0*(\d{1,3}(\.?\d{3})*)\-?([\dkK])$" name="rut" id="rut" class="form-control" placeholder="RUT" required/>
                  <span class="help-block">Ingrese un rut válido</span>
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required/>
                </div>
                <div class="form-group">
                  <label for="apellido">Apellido</label>
                  <input type="text" name="apellido" name="apellido" class="form-control" placeholder="Apellido" required/>
                </div>
                <div class="form-group">
                  <label for="codigo">Código</label>
                  <input type="text" class="form-control" pattern="^(?:\+|-)?\d+$" name="codigo"  data-minlength="3" data-maxlength="3" id="codigo" placeholder="Código" required/>
                  <span class="help-block">Ingrese un código de 3 digitos</span>
                </div>
               <button type="submit" class="btn btn-success">Añadir garzón</button>    
            </form>        
        </div>

      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.Rut.js"></script>
    <script src="js/validator.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
      $('#rut').Rut({
        format_on: 'keyup',
      });

      $('#addwaiter').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
          // handle the invalid form...
        } else { 
 
        // Stop form from submitting normally
        event.preventDefault();
        var $form = $( this ),
        nombre = $form.find( "input[name='nombre']" ).val(),
        rut = $form.find( "input[name='rut']" ).val(),
        apellido = $form.find( "input[name='apellido']" ).val(),
        codigo = $form.find( "input[name='codigo']" ).val(),
        
        url = $form.attr( "action" );

        var posting = $.post( url, { nombre:nombre, rut:rut, apellido:apellido, codigo:codigo } );

        posting.done(function( data ) {
          if(data == "Exito"){
            $(".alert-danger").fadeOut();
            $(".alert-success").fadeIn("slow", function(){
              $(this).fadeOut("slow");
            });
          }
          else{
            $(".alert-success").fadeOut();
            $(".alert-danger").fadeIn("slow", function(){
              $(this).fadeOut("slow");
            });
          }
        });
        }

     
    </script>
  </body>
</html>
