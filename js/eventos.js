$.ajaxSetup({cache: false});
var eventos = eventos || {};

//Desactivar  F12
    window.addEventListener("keydown", keyListener, false);
    function keyListener(e) {
    if(e.keyCode == 123) {
      e.returnValue = false;
    }
    }
//Cierra Desactivar  F12

//Desactivar Click Derecho
    $(window).bind('mousewheel DOMMouseScroll', function (event) {
           if (event.ctrlKey == true) {
           event.preventDefault();
           }
    });
// Cierra Desactivar Click Derecho

$(document).ready(function(){

  //Escuchadores De Clicks
   $("#btnLogin").on("click",BuscarUsuario);
   $("#btnDestruirSesion").on("click",DestruirSesion);

   $("#btn-perfil").click(function(event) {
          $('#js-Tabla-Solicitudes').hide();
          $('#form-perfil').show();
          tablaPerfil();
          $('#js-Tabla-Perfil').show();
          $("#btn-NuevaS").hide();
    });

   $("#btn-solicitudes").click(function(event) {
          $('#form-perfil').hide();
          $('#js-Tabla-Perfil').hide();
          $('#js-Tabla-Solicitudes').show();
          tablaSolicitudes();
          $("#btn-NuevaS").show();
    });

    $("#btn-NuevaS").on("click",function(event){NuevaSolicitud();});
});//Cierre Document Ready

//Valida Si Se Entró Al Index Para Cargar Los Datos Del Perfil Del Usuario.
window.onload = (function(){
  var path = window.location.pathname;
  var page = path.split("/").pop();
  if (page == 'index.php') {
    tablaPerfil();
    $('#js-Tabla-Perfil').show();
  }
});

//Función Para Validar Usuarios
function BuscarUsuario(){
  var usuario = $('#inp-usuario').val();
  var correo = $('#inp-correo').val();

var sUrl="opcion=BuscarUsuario&correo="+correo+"&usuario="+usuario;
      $.ajax(
      {
         type: 'POST',
         async: true,
         dataType: 'json',
         url: "php/funciones.php",
         data: sUrl,
         success: function(respuesta){
            if(respuesta.estado == 0 || respuesta.estado == 1){              
              window.location='index.php';
              tablaPerfil();
            }else{alert('');}
         },    
         error: function(){alert('No se encontro Usuario');}
      });
}//Cierra Función Valida Usuarios

//Función Para Destruir La Sesión Creada
function DestruirSesion(){

  var sUrl="opcion=DestruirSesion";
      $.ajax(
      {
         type: 'POST',
         async: true,
         dataType: 'json',
         url: "php/funciones.php",
         data: sUrl,
         success: function(){
            window.location='login.php';
         },    
         error: function(){alert('No Se Destruyo Sesion');}
      });
}//Termina Función Destruir Sesion

//Función Encargada de Llenar Los Datos Del Perfil
function tablaPerfil(){
  //Crea Tabla
  var tabla =`<table class="table table-hover" id="tabla-perfil">
  <thead>
    <tr>
      <th scope="col">Nom. Usuario</th>
      <th scope="col">Correo</th>
      <th scope="col">Estado</th>
      <th scope="col">Cantidad</th>   
      <th scope="col">Fecha Solicitado</th>    
    </tr>
  </thead>
  </table>`;


  var nombreus = $('#inp-usuario').val();
  //Llena La Tabla Consultando Los Datos Por PHP
  var sUrl="opcion=LlenarPerfil";
  $.ajax(
      {
         type: 'POST',
         async: true,
         dataType: 'json',
         url: "php/funciones.php",
         data: sUrl,
         success: function(respuesta){ //En Caso de Tener Existo Al Consultar Los Datos,LLena La Tabla
          if (respuesta.estado == 0) {
          $('#js-Tabla-Perfil').html(tabla);
            $.each(respuesta.values,function(key,value){
           
            var fila="<tr><td>"+value['nom_user']+"</td><td>"+value['correo']+"</td><td>"+value['estado']+"</td><td>"+value['cantidad']+"</td><td>"+value['fecha_solicitud']+"</td></tr>";
            var btn = document.createElement("TR");
            btn.classList.add("view-h");
            btn.innerHTML=fila;
            document.getElementById("tabla-perfil").appendChild(btn);
            //Llena Los Input De Perfil
            $('#inp-perfil-name').val(value['nom_user']);
            $('#inp-perfil-correo').val(value['correo']);
          })
          }else if(respuesta.estado == -1){
            console.log(respuesta.values[0].nom_user);
            $('#inp-perfil-name').val(respuesta.values[0].nom_user);
            $('#inp-perfil-correo').val(respuesta.values[0].correo);
          }

         },    
         error: function(){}
  });//Termina Ajax LlenaTabla
}//Termina Función Tabla Perfil

//Función Llenado De Tabla Historia
function tablaSolicitudes(){

var tabla =`<table class="table table-hover" id="tabla-solicitudes">
  <thead>
    <tr>
      <th scope="col">Folio</th>
      <th scope="col">Estado</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Fecha Solicitado</th>    
    </tr>
  </thead>
  </table>`;

  $('#js-Tabla-Solicitudes').html(tabla);

  //Este Ajax Trae Los Datos De La Tabla Solicitudes De PHP
  var sUrl="opcion=LlenarSolicitudes";
  $.ajax(
      {
         type: 'POST',
         async: true,
         dataType: 'json',
         url: "php/funciones.php",
         data: sUrl,
         success: function(respuesta){
          $.each(respuesta.values,function(key,value){
            var fila="<tr><td>"+value['folio_solicitud']+"</td><td>"+value['estado']+"</td><td>"+value['cantidad']+"</td><td>"+value['fecha_solicitud']+"</td></tr>";
            var btn = document.createElement("TR");
            btn.classList.add("view-h");
            btn.innerHTML=fila;
            document.getElementById("tabla-solicitudes").appendChild(btn);
          })
         },    
         error: function(){}
  });//Termina Ajax LlenaTabla
}//Termina Tabla Solicitud

//Función Para Crear Nueva Solicitud
function NuevaSolicitud(){
var total = 0;
var tarjeta = '';
var mensualidades = 0;
var edad = 0;

//Modal Nueva Solicitud
$.confirm({
    title: '<label id="modal-titulo">Nueva Solicitud</label>',
    content: '' +
    '<form action="" class="formName" id="modal-nueva-sol">' +
    '<div class="form-group form-modal">' +
    '<label >Monto a Solicitar:</label>' +
    '<input type="text" class="name form-control" required id="inp-monto" />' +
    '<label >Edad:</label>' +
    '<input type="text" class="name form-control" required id="inp-edad"/>' +
    '<input type="checkbox" name="TC" value="" id="modal-check"> Tengo Tarjeta de Credito <br>'+
    '<form action="" >'+
    '<input id="modal-radio" type="radio" name="pagos" value="3"> 3 Pagos <br>'+
    '<input type="radio" name="pagos" value="6"> 6 Pagos <br>'+
    '<input type="radio" name="pagos" value="9"> 9 Pagos'+
    '</form>'+
    '</div>' +
    '</form>',
    buttons: {
        formSubmit: {
            text: 'Solicitar',
            btnClass: 'btn-green',
            action: function () {//En Caso De Presionar Botón Solicitar
                if ( $('#modal-check').prop('checked') ){
                   tarjeta = 'si';
                }else{
                   tarjeta = 'no';
                }
               mensualidades = $('input:radio[name=pagos]:checked').val();
               monto         = $('#inp-monto').val();
               edad          = $('#inp-edad').val();
               
               if (mensualidades == 3) {
                 total       = (monto*1.05);
               }else if (mensualidades == 6) {
                 total       = (monto*1.07);
               }else {
                 total       = (monto*1.12);
               }
               //Confirmación De Nueva Solicitud, Mostrando El Monto Total
                $.confirm({
                    title: '<label id="modal-titulo">Nueva Solicitud</label>',
                    content: '' +
                    '<form action="" class="formName" id="modal-nueva-sol">' +
                    '<div class="form-group form-modal">' +
                    '<label >Monto a Solicitar: '+total+'</label>' +
                    '</form>'+
                    '</div>' +
                    '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Solicitar',
                            btnClass: 'btn-green',
                            action: function () {//En Caso De Presionar Botón Solicitar
                                var sUrl="opcion=NuevaSolicitud&monto="+total+"&tarjeta="+tarjeta+"&mensualidades="+mensualidades+"&edad="+edad;
                                $.ajax({
                                         type: 'POST',
                                         async: true,
                                         dataType: 'json',
                                         url: "php/funciones.php",
                                         data: sUrl,
                                         success: function(respuesta){
                                            if (respuesta.estado == 0) {
                                              alert('Se Creo Solicitud');  
                                            }else{
                                              alert('Algo Salio Mal Al Registrar Tu Solicitud');
                                            }
                                         },    
                                         error: function(){alert('Error En Solicitud');}
                                  });//Termina Ajax LlenaTabla
                            }
                        },
                        cancel: function () {},
                    },
                    onContentReady: function () {
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // Si El Usuario Presiona Enter En El Campo
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); 
                        });
                    }
                });
            }
        },
        cancel: function () {},
    },
    onContentReady: function () {
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // Si El Usuario Presiona Enter En El Campo
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); 
        });
    }
});
}//Termina Función Nueva Solicitud