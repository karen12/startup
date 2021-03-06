<?php
if(!empty($_POST)) {
    // validation errors
    $nombresError = null;
    $apellidosError = null;
    $identificadorError = null;
    $telefonoError = null;
    $correoError = null;
    $generoError = null;
    $aliasError = null;
    $contraseñaError = null;
    $confirmarError = null;
    // post values
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $identificador = $_POST['identificador'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $alias = $_POST['alias'];
    $fecha_nacimiento= date('Y-m-d', strtotime($_POST['fecha_nacimiento']));

    $contraseña = $_POST['contraseña'];
    // validate input
    $valid = true;
    if(empty($nombres)) {
        $nombresError = "Por favor ingrese los nombres.";
        $valid = false;
    }

    if(empty($apellidos)) {
        $apellidosError = "Por favor ingrese los apellidos.";
        $valid = false;
    }

    if(empty($identificador)) {
        $identificadorError = "Por favor ingrese la DUI.";
        $valid = false;
    }

    if(empty($telefono)) {
        $telefonosError = "Por favor ingrese el telefono.";
        $valid = false;
    }

    if(empty($correo)) {
        $correoError = "Por favor ingrese el correo.";
        $valid = false;
    }

    if(empty($sexo)) {
        $sexoError = "Por favor seleccione el sexo.";
        $valid = false;
    }

    if(empty($alias)) {
        $aliasError = "Por favor ingrese el alias.";
        $valid = false;
    }

    if(empty($contraseña)) {
        $contraseñaError = "Por favor ingrese la contraseña.";
        $valid = false;
    }

    // insert data
    if($valid) {
        require("bd.php");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO empleados(nombres, apellidos, identificador, telefono, correo, sexo, fecha_nacimiento) values(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $PDO->prepare($sql);
        $stmt->execute(array($nombres, $apellidos, $identificador, $telefono, $correo, $sexo,$fecha_nacimiento ));
        $PDO = null;
        header("Location: bienvenida.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!--ESTILOLS Y FUNCIONESVARIOS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="css/estilos.css">
    <!--SCRIPT Y ESTILOS DE BOOTSTRAP -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
    <!--SCRIPT DE VALIDACIONES-->
    <script type="text/javascript"  src="js/validaciones.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <!--SCRIPT DE DATETIMEPICKER -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

</head>
<body>
<div class="container2">
    <div class="row">
        <div class=" col-md-offset-3 col-md-6 ">
<img src="img_page/WineFun.png" alt="logo" height="140" width="160" />
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class=" col-md-offset-3 col-md-6 col-sm-6">
            <legend><i class="glyphicon glypshicon-list-alt"></i></a> PRIMER USUARIO</legend>
            <form action="#" method="post" class="form" role="form">
                <div class='form-group <?php print(!empty($nombresError)?"has-error":""); ?>'>
                <input class="form-control" name="nombres" placeholder="Nombres" required='required' id='nombres' type="text" autofocus value='<?php print(!empty($nombres)?$nombres:""); ?>'  />
                    <?php print(!empty($nombresError)?"<span class='help-block'>$nombresError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($apellidosError)?"has-error":""); ?>'>
                <input class="form-control" name="apellidos" placeholder="Apellidos" type="text" required='required' id='apellidos'  value='<?php print(!empty($apellidos)?$apellidos:""); ?>' />
                    <?php print(!empty($apellidosError)?"<span class='help-block'>$apellidosError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($identificadorError)?"has-error":""); ?>'>
                <input class="form-control" name="identificador" placeholder="DUI" type="text" required='required' id='identificador'  value='<?php print(!empty($identificador)?$identificador:""); ?>' />
                    <?php print(!empty($identificadorError)?"<span class='help-block'>$identificadorError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($telefonosError)?"has-error":""); ?>'>
                <input class="form-control" name="telefono" placeholder="Telefono" type="text" required='required' id='telefono'   value='<?php print(!empty($telefono)?$telefono:""); ?>'/>
                    <?php print(!empty($telefonosError)?"<span class='help-block'>$telefonosError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($correoError)?"has-error":""); ?>'>
                <input class="form-control" name="correo" placeholder="Correo" type="email" required='required' id='correo'  value='<?php print(!empty($correo)?$correo:""); ?>' />
                    <?php print(!empty($correoError)?"<span class='help-block'>$correoError</span>":""); ?>
                </div>
                <div class="form-group">
                        <div class="input-group input-append date" id="dateRangePicker">
                            <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly  value='<?php print(!empty($fecha_nacimiento)?$fecha_nacimiento:""); ?>'/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                </div>
                <div class='form-group <?php print(!empty($generoError)?"has-error":""); ?>'>
                    <select name='sexo' required='required' id='sexo' class='form-control'>
                        <option></option>
                        <option value='Masculino' <?php print(isset($sexo) && $sexo == "Masculino"?"selected":""); ?>>Masculino</option>
                        <option value='Femenino' <?php print(isset($sexo) && $sexo == "Femenino"?"selected":""); ?>>Femenino</option>
                    </select>
                    <?php print(!empty($generoError)?"<span class='help-block'>$generoError</span>":""); ?>
                </div>
                <div class='form-group'>
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled" id='foto' value='<?php print(!empty($foto)?$foto:""); ?>'> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Limpiar
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Buscar</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                    </div>
                </span>
                    </div>
                </div>
                <div class='form-group <?php print(!empty($aliasError)?"has-error":""); ?>'>
                <input class="form-control" name="alias" placeholder="Alias" type="text" required='required' id='nombres'  value='<?php print(!empty($nombres)?$nombres:""); ?>'/>
                    <?php print(!empty($aliasError)?"<span class='help-block'>$nombresError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($contraseñaError)?"has-error":""); ?>'>
                <input class="form-control" name="contraseña" placeholder="Contraseña" type="password" required='required' id='nombres' autofocus value='<?php print(!empty($nombres)?$nombres:""); ?>'/>
                    <?php print(!empty($contraseñaError)?"<span class='help-block'>$contraseñaError</span>":""); ?>
                </div>
                <div class='form-group <?php print(!empty($confirmarError)?"has-error":""); ?>'>
                <input class="form-control" name="confirmar" placeholder="Confirmar Contraseña" type="password" required='required' id='nombres' autofocus value='<?php print(!empty($nombres)?$nombres:""); ?>' />
                    <?php print(!empty($confirmarError)?"<span class='help-block'>$confirmarError</span>":""); ?>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Registrarse</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>