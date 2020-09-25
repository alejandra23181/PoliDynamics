<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Login.php");
    exit;
}
?>

<?php 
    include('C:\xampp\htdocs\polidynamics\database\db.php');    
    $Query = "SELECT * FROM tarea TA
    INNER JOIN SOLICITUD SO ON TA.SOLICITUD = SO.ID_SOLICITUD
    INNER JOIN TIPO_TAREA TP ON TA.TIPO_TAREA = TP.ID_TIPO_TAREA 
    INNER JOIN USUARIO US ON SO.USUARIO = US.ID_USUARIO
    INNER JOIN ESTADO ES ON SO.ESTADO = ES.ID_ESTADO
    WHERE username = '".$_SESSION['username']."' ";
	$Resultado = mysqli_query($link, $Query);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PoliDynamics</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="icon" href="/PoliDynamics/style/image/IconoPoli.png" />
    <link rel="stylesheet" href="/PoliDynamics/views/docente/style/General.css" type="text/css" >
</head>
<body>

    <section id="sidebar"> 
    <div class="white-label">
    </div> 
  <nav class="menu">
  <div id="sidebar-nav">   
    <ul id="Secciones">
    <li class="active"><a href="#"> Home</a></li>
      <li><a href="#"> Gestión de tareas</a></li>
      <li><a href="#"> Gestión de prestamos</a></li>
      <li><a href="#"> Gestión de disponibilidad</a></li>
      <li><a href="#"> Administración de prestamos</a></li>
      <li><a href="#"> Administración de solicitudes</a></li>
      <li><a href="#"> Administración de usuarios</a></li>
      <li><a href="#"> Administración de inventario</a></li>
      <li><a href="#"> Auditoria</a></li>
      <li><a href="#"> Reportes</a></li>
      <li><a href="#"> Manual de usuario</a></li>     
      <li><a href="/polidynamics/views/login/Login.php"> Cerrar sesión</a></li>
      
    </ul>

  </div>
</nav>
    </section>

   
    <section id="content">

    <div id="header">
    <div class="header-nav">

      <div class="nav">
        <ul>
          <li class="nav-profile">
            <div class="nav-profile-image">
              <img src="/PoliDynamics/style/image/User.png" alt="profile-img" alt="profile image">
              <div class="nav-profile-name"><?php echo htmlspecialchars($_SESSION["username"]); ?></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <h1>GESTIÓN DE TAREAS</h1>

  <button type="button" class="btn btn-warning" style="background-color: #F1C40F;border-color: #F1C40F;"><a href="CrearSolicitudes.php">Nueva tarea</a></button>

  <br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">Id. tarea</th>
                <th scope="col">Id. solicitud</th>
				<th scope="col">Detalle tarea</th>
				<th scope="col">Tipo de tarea</th>
				<th scope="col">Fecha de solución</th>
				<th scope="col">Hora inicio</th>
                <th scope="col">Hora fin</th>
                <th scope="col">Acciones</th>

			</tr>
		</thead>
		<tbody>
			<?php while($Filas = $Resultado->fetch_assoc()) {	

			?>
			<tr>
				<th scope="row"><?php echo $Filas['ID_TAREA'] ?></th>
                <td><?php echo $Filas['SOLICITUD'] ?></td>
				<td><?php echo $Filas['DETALLE'] ?></td>
				<td><?php echo $Filas['DESCRIPCION_TAREA'] ?></td>
				<td><?php echo $Filas['FECHA_INICIO'] ?></td>
                <td><?php echo $Filas['HORA_INICIO'] ?></td>
                <td><?php echo $Filas['HORA_FINAL'] ?></td>
                <td>
					<button type="button" class="btn btn-primary" ><a href="EditarTareas.php?ID_TAREA=<?php echo $Filas['ID_TAREA'] ?>">Modificar</a></button>
					<button type="button" class="btn btn-danger" ><a href="metodos/MetodoEliminar.php?ID_TAREA=<?php echo $Filas['ID_TAREA'] ?>">Desactivar</a></button>			
				</td>
        
			</tr>
			<?php } ?>
		</tbody>
	</table>
  
      
  </section>


</body>
</html>