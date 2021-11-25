<?php
require_once "Utils/utils.php";
security(false, false, true);
$text = dinamicFormText("USUARIO");

$controller = new UserController();
if (isset($_GET['id'])) {
  $user = $controller->get($_GET['id']);
}
$id = isset($user) ? (int)$user->UserID : "";
$name = isset($user) ? $user->FullName : "";
$pass = isset($user) ? $user->Password : "";
$email = isset($user) ? $user->Email : "";
$lastAccess = isset($user) ? $user->LastAccess : "";
$enabled = isset($user) && (bool)$user->Enabled ? "checked"  : "";
?>
<div class="container mt-5 w-50">
  <h1><?php echo $text['title']  ?></h1>
  <br>
  <form method="post">
  <div class="form-group row pb-3">
    <label for="id" class="col-sm-2 col-form-label">Id</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="id" name="id" placeholder="Id" value="<?php echo $id ?>" disabled>
    </div>
  </div>
  <div class="form-group row pb-3">
    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="<?php echo $name ?>" required>
    </div>
  </div>
  <div class="form-group row pb-3">
    <label for="pass" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" value="<?php echo $pass ?>" required>
    </div>
  </div>
  <div class="form-group row pb-3">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email ?>" required>
    </div>
  </div>
  <div class="form-group row pb-3">
    <label for="lastAccess" class="col-sm-2 col-form-label">Último Acceso</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="lastAccess" name="lastAccess" placeholder="dd/mm/yyyy" value="<?php echo $lastAccess ?>" required>
    </div>
  </div>
  <div class="form-group row pb-3">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <div class="form-check">
      <label class="form-check-label" for="enabled">
        <input class="form-check-input" type="checkbox" name="enabled" value="enabled" <?php echo $enabled ?>>
          Autorizado
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row pb-3 float-end">
    <div>
      <button type="submit" class="btn btn-primary"><?php echo $text['button'] ?></button>
      <a role="button" class="btn btn-danger" href="index.php?route=users">Cancel</a>
    </div>
  </div>
</form>
</div>
<?php
$controller->createOrUpdate();