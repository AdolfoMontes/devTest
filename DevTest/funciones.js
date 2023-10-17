
function cargarComuna(){
    $.ajax({
        url: "funciones.php",
        method: "POST",
        data: "funcion=comuna&nom_region="+($('#cb_region option:selected').val()),
        dataType: "text",
        success: function(respuesta) {
            $('#cb_comuna').html(respuesta);
        }
    });
}
function cargarCandidatos(){
    $.ajax({
        url: "funciones.php",
        method: "POST",
        data: "funcion=candidatos",
        dataType: "text",
        success: function(respuesta) {
            $('#cb_candidato').html(respuesta);
        }
    });
}

function registrar(){
    if(validar()){
        $web= ($('input:checkbox[id=chk_web]:checked').val()) ? 1 : 0;
        $tv= ($('input:checkbox[id=chk_tv]:checked').val()) ? 1 : 0;
        $rrss= ($('input:checkbox[id=chk_rrss]:checked').val()) ? 1 : 0;
        $amigo= ($('input:checkbox[id=chk_amigo]:checked').val()) ? 1 : 0;
        $nom_region=($('#cb_region selected').text());
        $id_comuna=($('#cb_comuna option:selected').val());
        $nombre =  $('#txt_nombre').val();
        $alias = $('#txt_alias').val();
        $rut = $('#txt_rut').val();
        $mail = $('#txt_mail').val();
        $candidato = ($('#cb_candidato option:selected').val());
        $.ajax({
            url: "funciones.php",
            method: "POST",
            data: "funcion=registrar&nom_region="+$nom_region + "&nom_comuna=" + $id_comuna +"&nombre="+ $nombre
                + "&alias=" + $alias + "&rut=" + $rut + "&mail=" + $mail+ "&web=" + $web +
                "&tv=" + $tv + "&rrss="+ $rrss + "&amigo="+$amigo + "&candidato=" + $candidato ,
            dataType: "text",
            success: function(respuesta) {
                alert(respuesta);
            }
        });
    }

}   

function validar(){
    $validador = true;
    var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    let fAliasRegex = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
    web= ($('input:checkbox[id=chk_web]:checked').val()) ? 1 : 0;
    tv= ($('input:checkbox[id=chk_tv]:checked').val()) ? 1 : 0;
    rrss= ($('input:checkbox[id=chk_rrss]:checked').val()) ? 1 : 0;
    amigo= ($('input:checkbox[id=chk_amigo]:checked').val()) ? 1 : 0;
    $("#mensajes").empty();
    if($('#txt_nombre').val()==""){
        $validador = false;
        $("#mensajes").append('<li> Debe ingresar un nombre </li>');
    };
    if($('#txt_alias').val()==""){
        $validador = false;
        $("#mensajes").append('<li> Debe ingresar un alias </li>');
    };
    if($('#txt_mail').val()==""){
        $validador = false;
        $("#mensajes").append('<li> Debe ingresar un mail </li>');
    };
    if($('#txt_rut').val()==""){
        $validador = false;
        $("#mensajes").append('<li> Debe ingresar un RUT </li>');
    };
    if( !validEmail.test($('#txt_mail').val()) ){
        $validador = false;  
        $("#mensajes").append('<li> El mail no tiene un formato válido </li>');
	};
    if($('#txt_alias').val().length<=5 || fAliasRegex.test($('#txt_alias').val())===false){
        $validador = false;  
        $("#mensajes").append('<li> El alias debe tener sobre 5 caracteres y contener letras y números </li>');
    };
    if(!Fn.validaRut($('#txt_rut').val())){
        $validador = false;  
        $("#mensajes").append('<li> El RUT no es válido (formato XXXXXXX-X) </li>');
    };
    if((web + tv+ rrss + amigo)<2){
        $validador = false;  
        $("#mensajes").append('<li> Debes seleccionar dos o mas opciones en "como se enteró de nosotros"');
    };

    return $validador;
}

function test(){
    value=($('input:checkbox[id=chk_web]:checked').val());
    let fAliasRegex = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
    if (value){
        alert(fAliasRegex.test($('#txt_alias').val()))
    }
    

}



