function obterLocalizacao(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(exibirPosicao);
    }else{
        alert('Erro ao obter localização. Versão do navegador incopatível!');
    }

    function exibirPosicao(position){
        $('#longitude').val(position.coords.longitude);
        $('#latitude').val(position.coords.latitude);
             
  }
    
}

function liberaCampos(){
    if ($('#status').val() == "Comodato"){
        $('#clientes').removeClass('d-none');
    }else{
        $('#clientes').addClass('d-none');
    }
}

function liberaCodigo(){
    var link = $('#qrcode').attr('src');

    if (link === "#"){
        $('#qr').addClass('d-none');
    }
}

function loaded(){
    liberaCampos();
    liberaCodigo();
}
