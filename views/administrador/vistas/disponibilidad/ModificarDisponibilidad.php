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
    $id = $_GET['ID_AULA'];
    $QuerySQL = "SELECT * FROM aula AU 
    INNER JOIN DISPONIBILIDAD DI ON AU.DISPONIBILIDAD = ID_DISPONIBILIDAD
    WHERE ID_AULA = '".$id."'";
    
    $Resultado = mysqli_query($link, $QuerySQL);
     while($Filas = $Resultado->fetch_assoc()) {	
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PoliDynamics</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="icon" href="/PoliDynamics/style/image/IconoPoli.png" />
    <link rel="stylesheet" href="/PoliDynamics/views/docente/style/CrearSolicitudes.css" type="text/css" >
</head>
<body>

    <section id="sidebar"> 
    <div class="white-label">
    </div> 
  <nav class="menu">
  <div id="sidebar-nav">   
  <ul id="Secciones">
      <li ><a href="\PoliDynamics\views\administrador\Index.php"> Home</a></li>
      <li  ><a href="\PoliDynamics\views\administrador\vistas\tareas\ListarTareas.php"> Gestión de tareas</a></li>
      <li class="active"><a href="\PoliDynamics\views\administrador\vistas\disponibilidad\ListarDisponibilidad.php"> Gestión de disponibilidad</a></li>
      <li><a href="\PoliDynamics\views\administrador\vistas\prestamo\ListarPrestamos.php"> Administración de prestamos</a></li>
      <li  ><a href="\PoliDynamics\views\administrador\vistas\solicitudes\ListarSolicitudes.php"> Administración de solicitudes</a></li>
      <li><a href="\PoliDynamics\views\administrador\vistas\usuarios\ListarUsuarios.php"> Administración de usuarios</a></li>
      <li><a href="\PoliDynamics\views\administrador\vistas\inventario\ListarInventario.php"> Administración de inventario</a></li>
      <li ><a href="\PoliDynamics\views\administrador\vistas\ListarAuditoria.php"> Auditoria</a></li>
      <li><a href="\PoliDynamics\views\administrador\vistas\ListarReportes.php"> Reportes</a></li>
      <li><a href="\PoliDynamics\views\administrador\vistas\ManualTecnico.php"> Manual de usuario</a></li>     
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

  <h1>MODIFICAR DISPONIBILIDAD</h1>
  <br>

  <form  action = "metodos/MetodoActualizar.php">
        <div class="form-group">
        <input type="hidden" name="ID_AULA" value="<?php echo $Filas['ID_AULA'] ?>">
            <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Bloque:</label><br>   
                        <input type="text" class="form-control" name="BLOQUE" value="<?php echo $Filas['BLOQUE'] ?>" readonly>   
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Número aula:</label><br>   
                        <input type="text" name="NUMERO_AULA"  class="form-control" value="<?php echo $Filas['NUMERO_AULA'] ?>" readonly>

                    </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                                       
                    <div class="col-md-6 mb-3">

                    <label>Disponibilidad:</label><br>
                    <select name="DISPONIBILIDAD" class="form-control">
                    <option value="<?php echo $Filas['DISPONIBILIDAD'] ?>" disabled selected hidden><?php echo $Filas['DESCRIPCION'] ?></option>
                        <?php 
                            $Query = "SELECT * FROM DISPONIBILIDAD";
                            $Resultado = mysqli_query($link, $Query);
                            while($Filas = $Resultado->fetch_assoc()){
                                echo '<option value="'.$Filas["ID_DISPONIBILIDAD"].'">'.$Filas["DESCRIPCION"].'</option>';   
                            }
                        ?>
                    </select>
            </div>
        </div>
      </div>
    
    <br>
    <button class="btn btn-primary" type="submit"><strong> Actualizar disponibilidad</strong></button>


    </form>
    <?php } ?>
  </section>


</body>
</html>