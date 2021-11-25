<?php
require_once "Utils/utils.php";
security(false, true, true);
$text = dinamicFormText();

$controller = new ProductController();
if (isset($_GET['id'])) {
  $product = $controller->get($_GET['id']);
}
$id = isset($product) ? (int)$product->ProductID : "";
$categoryId = isset($product) ? (int)$product->CategoryID : "";
$name = isset($product) ? $product->Name : "";
$cost = isset($product) ? $product->Cost : "";
$price = isset($product) ? $product->Price : "";
?>
<br>
<div class="container mt-5 w-50">
  <h1><?php echo $text['title'] ?></h1>
  <br>
  <form method="post">
    <div class="form-group row pb-3">
      <label for="id" class="col-sm-2 col-form-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="id" name="id" placeholder="Id" value="<?php echo $id ?>" disabled>
      </div>
    </div>
    <div class="form-group row pb-3">
      <label for="categoryID" class="col-sm-2 col-form-label">Categoria</label>
      <div class="col-sm-10">
        <select name="categoryID" class="form-select" value="<?php echo $categoryId ?>" required>
          <option>Selecciona una opción</option>
          <?php
          $categories = new CategoryController();
          $categories->loadSelect($categoryId);
          ?>
        </select>
      </div>
    </div>
    <div class="form-group row pb-3">
      <label for="name" class="col-sm-2 col-form-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" placeholder="Nombre" required>
      </div>
    </div>
    <div class="form-group row pb-3">
      <label for="cost" class="col-sm-2 col-form-label">Coste</label>
      <div class="col-sm-10">
        <input type="number" step="any" class="form-control" id="cost" name="cost" value="<?php echo $cost ?>" placeholder="Coste" required>
      </div>
    </div>
    <div class="form-group row pb-3">
      <label for="price" class="col-sm-2 col-form-label">Precio</label>
      <div class="col-sm-10">
        <input type="number" step="any" class="form-control" id="price" name="price" value="<?php echo $price ?>" placeholder="Precio" required>
      </div>
    </div>
    <div class="form-group row pb-3 float-end">
      <div>
        <button type="submit" class="btn btn-primary"><?php echo $text['button'] ?></button>
        <a role="button" class="btn btn-danger" href="index.php?route=products">Cancel</a>
      </div>
    </div>
  </form>
</div>

<?php
$controller->createOrUpdate();
