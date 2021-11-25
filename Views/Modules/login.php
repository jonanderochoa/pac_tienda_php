<div class="container mt-5 w-50">
  <h1>INGRESAR</h1>
  <br>
  <br>
  <?php
    $controller = new LoginController();
    $valid = $controller->tryLogIn();
    if(!$valid) {
      echo '<div class="alert alert-danger" role="alert">Error al ingresar</div>';
    }
  ?>
  <form method="post">
    <div class="form-group row p-3 required">
      <label for="name" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre completo" required>
      </div>
    </div>
    <div class="form-group row p-3 required">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
      </div>
    </div>
    <div class="form-group row p-3 float-end">
    <div>
      <button type="submit" class="btn btn-success">Ingresar</button>
    </div>
  </div>
  </form>
</div>
