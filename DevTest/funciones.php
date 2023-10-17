<?php
    include_once("conexion.php");
    if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
        $funcion = htmlentities($_POST['funcion']);
        $nom_region = filter_var(($_POST['nom_region']),FILTER_SANITIZE_STRING); 

        //dependiendo del parametro funcion se ejecutan los distintos llamados
        switch($funcion) {
            case 'region': 
                cargarRegion();
                break;
            case 'comuna': 
                buscarComuna($nom_region);
                break;
            case 'candidatos':
                buscarCandidatos();
                break;
            case 'registrar':
                $nom_comuna = filter_var(($_POST['nom_comuna']), FILTER_SANITIZE_STRING);//FILTER_SANITIZE_STRING limpia el string en caso de intento de inyección SQL
                $nombre = filter_var(($_POST['nombre']), FILTER_SANITIZE_STRING);
                $alias = filter_var(($_POST['alias']), FILTER_SANITIZE_STRING);
                $rut= filter_var(($_POST['rut']), FILTER_SANITIZE_STRING);
                $mail = filter_var(($_POST['mail']), FILTER_SANITIZE_EMAIL);
                $web  = ($_POST['web']);
                $tv  = ($_POST['tv']);
                $rrss  = ($_POST['rrss']);
                $amigo  = ($_POST['amigo']);
                $candidato = ($_POST['candidato']);
                //echo validarExistencia($rut);
                if(validarExistencia($rut)==0){ //aca validamos si el rut ya voto
                    registrar($nombre, $alias, $rut, $mail, $nom_comuna, $candidato, $web, $tv, $rrss, $amigo);
                   
                }else {
                    echo 'El rut ya ha votado, no puede votar nuevamente.';
                }
                break;
        }
    }
    function cargarRegion(){
        echo'<select id="cb_region" onchange="cargarComuna()" >';
        $query = 'SELECT id_region, nom_region FROM REGION';
        $conn = ConexionDB::ConexionBD();
        //$id = 0;
        foreach ($conn->query($query) as $row){
            $id=$row['id_region'];
            $nom_region = $row['nom_region'];
            //print $region;
            echo '
                <option value="'.$id.'">' .$row['nom_region']. '</option>
            ';
            //return $id;
            //print_r($row);
        };
        
    }

    function buscarComuna($nom_region){
        
        $query = "SELECT a.id_comuna, a.nom_comuna FROM COMUNA a join REGION b on a.id_region = b.id_region where b.id_region= ".$nom_region;
        $conn = ConexionDB::ConexionBD();
        foreach($conn->query($query) as $row){
            $id_comuna=$row['id_comuna'];
            $nom_comuna=$row['nom_comuna'];
            echo' <option value="'.$id_comuna.'"> '.$nom_comuna. '</option>';
            
        };
        echo'</select>';
    }
    function buscarCandidatos(){
        $query = "select id_candidato, nombre_cand, codigo_cand from CANDIDATO";
        $conn = ConexionDB::ConexionBD();
        foreach($conn->query($query) as $row){
            $id_candidato=$row['id_candidato'];
            $nombre_cand=$row['nombre_cand'];
            $codigo_cand=$row['codigo_cand'];
            echo' <option value="'.$id_candidato.'"> '.$nombre_cand. '</option>';
            
        };
        echo'</select>';
    }

    function registrar($nombre, $alias, $rut, $mail, $id_comuna, $candidato, $web, $tv, $rrss, $amigo){
        $query = "insert into voto (id_voto, rut, nombre, alias, mail, web, tv, rrss, amigo, id_comuna, id_candidato, fecha)
                values ((select isnull(max(a.id_voto),0)+1 from voto a ), ?, ?, ?, ?, ?, ?, ?, ?, 
                ?, ? , current_timestamp)";
        $conn = ConexionDB::ConexionBD();
       

        $insert= $conn->prepare($query);
        try{
            $res = $insert->execute([$rut, $nombre, $alias, $mail, $web, $tv, $rrss, $amigo, $id_comuna, $candidato ]);
            
        }catch(Exception $ex){
             $res= false;
        } 
        if ($res) {
            echo "Su voto ha sido registrado correctamente";
        } else {
            echo "Algo salió mal. Por favor reintente";
        }

    }
    function validarExistencia($rut){
        $query = "select count(*) as validador from voto where rut='$rut'";
        $conn = ConexionDB::ConexionBD();
        foreach($conn->query($query) as $row){
            $validador=$row['validador'];
            if($validador>0){  //Si el retorno es mayor a cero, entonces existe un registro de voto
                return -1;  
            }else{
                return 0; //si el retorno es cero, entonces no ha votado
            }       
        };      
    }
            
            
    ?>