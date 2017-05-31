<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiendacoches</title>
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="js/bootstrap.js" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>

      <div class="col-md-12" id="container" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;">
        <div style="width:40%; margin: 0 auto;">
          <form method="POST" action="installer.php">
            <legend style="margin-top: 20px;">
              Instalador
            </legend>
            <input type="checkbox" name="dbcreate" id="dbcreate" /><label for="dbcreate"> Crear base de datos</label><br />
            <span>Si ya se tiene la base de datos creada, no seleccione la opción de arriba.</span><br />
            <span>Si existe, tiene que estar vacia.</span><br />
            <label for="dbname">Escriba el nombre para la base de datos</label><br />
            <input type="text" name="dbname" id="dbname" required/><br />
            <label for="dburl">Escriba el enlace para la base de datos</label><br />
            <input type="text" name="dburl" id="dburl" required/><br />
            <label for="dbuser">Escriba el usuario para la base de datos</label><br />
            <input type="text" name="dbuser" id="dbuser" required/><br />
            <label for="dbpass">Escriba la contraseña para la base de datos</label><br />
            <input type="text" name="dbpass" id="dbpass" /><br />
            <label for="appadmin">Escriba el nick para el administrador de la aplicación</label><br />
            <input type="text" name="appadmin" id="appadmin" required/><br />
            <label for="apppass">Escriba la contraseña para el administrador de la aplicación</label><br />
            <input type="text" name="apppass" id="apppass" required/><br />
            <label>Seleccione los elementos que desea cargar</label><br />
            <input type="checkbox" name="coches" id="coches" /><label for="coches">Coches</label><br />
            <input type="checkbox" name="usuarios" id="usuarios" /><label for="usuarios">Usuarios de prueba</label><br />
            <br />
            <button>Guardar</button>
          </form>
        </div>
      </div>
    </body>
</html>
