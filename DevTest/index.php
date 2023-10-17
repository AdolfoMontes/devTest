<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="style.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="valida_rut.js"></script>
    <script type="text/javascript"></script>
</head>

<body>
    <script src="funciones.js"></script>
    
    <h2 class="title">FORMULARIO DE VOTACION:</h2>
    <hr></hr>
    <form>
    <div class="form-container">
        <div class="form-column">
            <label for="txt_nombre"> Nombre y apellido </label> 
            <label for="txt_alias"> Alias </label>
            <label for="txt_rut" > RUT </label>
            <label for="txt_mail"> E-Mail </label>
            <label for="cb_region"> Región </label>
            <label for="cb_comuna"> Comuna </label>
            <label for="cb_candidato"> Candidato </label>
        </div>
        <div class="form-column">
            <input type="text" maxlength="255" minlength="1" id="txt_nombre" required> 
            <input type="text" maxlength="255" minlength="5" id="txt_alias" required>
            <input type="text" maxlength="10" minlength="1" id="txt_rut" placeholder="XXXXXXXX-X" required> 
            <input type="mail" maxlength="255" minlength="1" id="txt_mail" placeholder="ejemplo@123.com"  required> 

            
            <?php
                include_once("funciones.php");
                cargarRegion();
                echo '<script>cargarComuna();</script>';
                echo '<script>cargarCandidatos();</script>';
            ?>
            </select>
                    
            <select id="cb_comuna" ></select>
            <select id="cb_candidato" ></select>
        </div>
    </div>
        <div id="div-options" >
            <label> Como se enteró de nosotros </label> 
            <input type="checkbox" id="chk_web">
            <label for="chk_web" > Web </label>
            <input type="checkbox" id="chk_tv">
            <label for="chk_tv"> TV </label>
            <input type="checkbox" id="chk_rrss">
            <label for="chk_rrss"> Redes Sociales </label>
            <input type="checkbox" id="chk_amigo">
            <label for="chk_amigo"> Amigo </label>
        </div>
        <hr></hr>
        <button id="enviar" type="button" onclick="registrar()">Votar</button>

        <ul id="mensajes"> </ul>
    </form>
    
</body>
</HTML>