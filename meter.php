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
    <link href="css/datepicker.css" rel="stylesheet">

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
            <li class="active"><a href="meter.php">Gestionar turnos <span class="sr-only">(current)</span></a></li>
            <li><a href="addwaiter.php">Añadir garzón</a></li>
            <li><a href="seewaiter.php">Ver garzones</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Bienvenido <?php echo $_SESSION['usuario'] ?></h1>

          <h2 class="sub-header">Gestionar turnos</h2>
          <div class="row">
              <div class="span4 col-md-4" id="input-datepicker">
                <input type="text" name="fecha" class="form-control" placeholder="Fecha">
              </div>
              <div class="span3 col-md-3">
                <select class="form-control" id="turno">
                      <option value="1">Primer turno</option>
                      <option value="2">Segundo turno</option>
                  </select>
              </div>
              <div class="span3 col-md-3">
                <button id="addpersonal" type="button" class="btn btn-success">Agregar personal</button>
                <button id="seepersonal" type="button" class="btn btn-primary">Ver personal</button>
              </div>
              
          </div>
          <div class="row">
            <div class="table-responsive addtable">
              </div>
          </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <script type="text/JavaScript">
    $('#input-datepicker input').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
    });

    $("#seepersonal").click(function(){
        $( ".alert-danger" ).remove();
        turno = $( "select#turno option:selected").val();
        fecha  = $( "input[name='fecha']" ).val();

        url = "include/seepersonallist.php";

        var posting = $.post( url, { fecha:fecha, turno:turno } );
        posting.done(function( data ) {
            console.log(data);
            $( ".addpersonal-form" ).remove();
            $( ".list-waiters" ).remove();
            $(".addtable").append(data);
        });

    });

    $("#addpersonal").click(function(){
        $( ".list-waiters" ).remove();
        $( ".alert-danger" ).remove();
        turno = $( "select#turno option:selected").val();
        fecha  = $( "input[name='fecha']" ).val();

        url = "include/addpersonallist.php";

        var posting = $.post( url, { fecha:fecha, turno:turno } );
        posting.done(function( data ) {
            $( ".addpersonal-form" ).remove();
            $(".addtable").append(data);

            $("#addtoturn").click(function(){
                toPost = [];
                $(".row-personal").each(function(index, element){

                    if($(this).find("#toSelect").is(':checked')){
                        var rut = $(this).find("#rut").text();
                        var labor = $(this).find("#porcentaje").val();
                        var person = { rut: rut, labor:labor }
                        toPost.push(person);
                        $(this).remove();
                    }
                    
                });
                console.log(toPost);
                url = "include/addtoturn.php";
                var posting = $.post( url, { fecha:fecha, turno:turno, personal: toPost } );
                posting.done(function( data ) {

                });

            });
        });
    });

    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>