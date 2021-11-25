<?php
require_once "Utils/utils.php";
$baseUrl = 'index.php?route=users';
security(false, false, true);

if(isset($_GET['id'])) {
  $controller = new UserController();
  $controller->delete($_GET['id']);
}
if(!isset($controller)){
  $controller = new UserController();
}
$total = $controller->getNumUsers();
?>
<div class="container mt-5">
  <h1>USUARIOS</h1>
  <br>
  <a class="btn btn-success" href="index.php?route=user" role="button">Nuevo Usuario</a>
  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" class="col-sm-1"><a href="<?php echo $baseUrl ?>&order=UserID">Id</a></th>
        <th scope="col" class="col-sm-3"><a href="<?php echo $baseUrl ?>&order=FullName">Nombre</a></th>
        <th scope="col" class="col-sm-3"><a href="<?php echo $baseUrl ?>&order=Email">Email</a></th>
        <th scope="col" class="col-sm-2"><a href="<?php echo $baseUrl ?>&order=LastAccess">Ultimo acceso</a></th>
        <th scope="col" class="col-sm-1"><a href="<?php echo $baseUrl ?>&order=Enabled">Activo</a></th>
        <th scope="col" class="col-sm-2" colspan="2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $prod = new UserController();
      $prod->loadTable();
      paginationButtons(getPagina(), $total, 10, $baseUrl);
      ?>
    </tbody>
  </table>
</div>