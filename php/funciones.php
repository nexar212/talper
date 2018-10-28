<?php
function conectaBD() {
  $server = 'localhost';
  $user = 'postgres';
  $pass = '123';
  $bd = 'postgres';
  $connec = pg_connect("host=".$server." dbname=".$bd." user=".$user." password=".$pass." ") or die ("Error de conexion servidor ".$server." BD ".$bd." Error ".pg_last_error());
    return $connec;
}

function FnBuscarUsuario(){
  $estado = 1;
  $usuario = $_POST['usuario'];
  $correo = $_POST['correo'];
  $con = conectaBD();

  if ($con) {
    $consulta     = "select * from user_acceso('".$usuario."','".$correo."')";
    $respuesta    = pg_query($con,$consulta);
    $datos        = pg_fetch_array($respuesta);

    if ($respuesta) {
        if ($datos['estado'] == 0 || $datos['estado'] == 1) {
            session_start();
            $_SESSION['NombreUsuario'] = $correo;
            $_SESSION['Nombre']        = $usuario;
        }
            $estado   = $datos['estado'];
            $mensaje  = $datos['mensaje'];   
    }
  pg_close();
  }else{
    $mensaje = "Error En la Conexion";
  }

  $salidaJSON = array('estado' => $estado,'mensaje' => $mensaje,'correo' => $correo,'session' => $_SESSION['NombreUsuario']);
  print json_encode($salidaJSON);
}

function FnDestruirSesion(){
   session_start();
   session_destroy();
   $estado = 0;
   $mensaje   = 'Se Destruyo Sesion';
 $salidaJSON = array('estado' => $estado,'mensaje' => $mensaje,'session' => $_SESSION['NombreUsuario']);
  print json_encode($salidaJSON);
}

function FnLlenadoPerfil(){
   session_start();
  $correo   = $_SESSION['NombreUsuario'];
  $nom_user = $_SESSION['Nombre'];
  $connect = conectaBD();

  $consulta = "select a.nom_user,a.correo,b.estado,b.cantidad,b.fecha_solicitud
              from usuarios a
              inner join solicitudes b on a.correo = b.correo and b.estado = 'pendiente' and a.correo ='".$correo."';";     
  if($connect){
      $respuesta=pg_query($connect,$consulta);
      $data=array();

     if (pg_num_rows($respuesta) >0 ) {
        while ($info=pg_fetch_array($respuesta)){
          $estado = 0;
          $mensaje = 'OK';
          /*1*/$data['nom_user'] = trim($info[0]);
          /*2*/$data['correo'] = trim($info[1]);
          /*3*/$data['estado'] = trim($info[2]);
          /*4*/$data['cantidad'] = trim($info[3]);
          /*5*/$data['fecha_solicitud'] = trim($info[4]);
          $values[] = array_map('utf8_encode',$data);
        }
      }else{
        $estado = -1;
        $data['nom_user'] = trim($nom_user);
        $data['correo']   = trim($correo);
        $data['estado']   = trim($estado);
        $values[] = array_map('utf8_encode',$data);
      }

      pg_close($connect);
    }else{
      $estado = -10;  
      $mensaje = 'No hay conexión al servidor. Intente de nuevo más tarde';}      
    $salidaJSON = array('estado' => $estado, 'values'=>$values);
    print json_encode($salidaJSON);
}

function FnLlenadoSolicitudes(){
   session_start();
    $correo   = $_SESSION['NombreUsuario'];
    $estado   = -10;
    $mensaje = 'NO HAY INFORMACION';
    $connect = conectaBD();

    $consulta = "select * from consulta_solicitudes('".$correo."');";     
    if($connect){
        $respuesta=pg_query($connect,$consulta);
        $data=array();
      while ($info=pg_fetch_array($respuesta)){
        $estado = 0;
        $mensaje = 'OK';
        /*1*/$data['folio_solicitud'] = trim($info[0]);
        /*2*/$data['estado'] = trim($info[1]);
        /*3*/$data['cantidad'] = trim($info[2]);
        /*4*/$data['fecha_solicitud'] = trim($info[3]);
        $values[] = array_map('utf8_encode',$data);
        }
        pg_close($connect);
      }else{
        $estado = -10;  
        $mensaje = 'No hay conexión al servidor. Intente de nuevo más tarde';}      
      $salidaJSON = array('estado' => $estado,'mensaje' => $mensaje, 'values'=>$values);
      print json_encode($salidaJSON);
}

function FnNuevaSolicitud(){
  $estado   = -1;
  $mensaje  = 'No Se Creo Solicitud';

  session_start();
  $correo   = $_SESSION['NombreUsuario']; 
  $monto    = $_POST['monto'];
  $tarjeta  = $_POST['tarjeta'];
  $mensualidades    = $_POST['mensualidades'];
  $edad     = $_POST['edad'];
  $connect = conectaBD();

  $consulta     = "select * from nueva_solicitud('".$correo."','".$monto."','".$tarjeta."','".$mensualidades."',".$edad.");";
  if($connect){
    $respuesta  = pg_query($connect,$consulta);
    $datos      = pg_fetch_array($respuesta);
    if ($respuesta) {
      $estado   = 0;
      $mensaje  ='Se Creo Nueva Solicitud';
    }
  pg_close($connect);
  }
  $salidaJSON = array('estado' => $estado,'mensaje' => $mensaje);
  print json_encode($salidaJSON);
}

$tipo_opcion = $_POST['opcion'];
switch ($tipo_opcion) {
    case 'BuscarUsuario':
        FnBuscarUsuario();
        break;
    case 'DestruirSesion':
        FnDestruirSesion();
        break;
    case 'LlenarPerfil':
        FnLlenadoPerfil();
        break;
    case 'LlenarSolicitudes':
        FnLlenadoSolicitudes();
        break;
    case 'NuevaSolicitud':
        FnNuevaSolicitud();
        break;
}
?>

