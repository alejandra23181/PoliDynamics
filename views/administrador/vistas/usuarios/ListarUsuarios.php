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
    $Query = "SELECT *
	FROM USUARIO US
	INNER JOIN GENERO GE ON US.GENERO = GE.ID_GENERO
	INNER JOIN PERFIL_USUARIO PE ON US.PERFIL = PE.ID_PERFIL";
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

  <h1>LISTAR USUARIOS</h1>

  <button type="button" class="btn btn-warning" style="background-color: #F1C40F;border-color: #F1C40F;"><a href="./CrearUsuarios.php">Nuevo usuario</a></button>
  
	<table class="table table-bordered">
		<thead>
			<tr>
       <th scope="col">Nombre </th>
        <th scope="col">Apellido </th>
        <th scope="col">Telefono</th>
        <th scope="col">Email</th>
        <th scope="col">Genero</th>
        <th scope="col">Perfil</th>
        <th scope="col">Identificacion</th>
        <th scope="col">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while($Filas = $Resultado->fetch_assoc()) {	

			?>
			<tr>
				<td><?php echo $Filas['PRIMER_NOMBRE_USUARIO'] ?></td>
				<td><?php echo $Filas['PRIMER_APELLIDO_USUARIO'] ?></td>
				<td><?php echo $Filas['TELEFONO'] ?></td>
				<td><?php echo $Filas['EMAIL'] ?></td>
				<td><?php echo $Filas['DESCRIPCION_GENERO'] ?></td>
				<td><?php echo $Filas['DESCRIPCION_PERFIL'] ?></td>
        <td><?php echo $Filas['IDENTIFICACION'] ?></td>
				<td>
					<button type="button" class="btn btn-primary" ><a href="EditarUsuarios.php?ID_USUARIO=<?php echo $Filas['ID_USUARIO'] ?>">Modificar</a></button>
					<button type="button" class="btn btn-danger" ><a href="metodos/MetodoEliminar.php?ID_USUARIO=<?php echo $Filas['ID_USUARIO'] ?>">Desactivar</a></button>			
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
  
      
  </section>


</body>
</html>