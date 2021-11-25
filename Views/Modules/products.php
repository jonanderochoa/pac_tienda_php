<?php
require_once "Utils/utils.php";
$baseUrl = 'index.php?route=products';
security(true);

if(isset($_GET['id'])) {
  $controller = new ProductController();
  $controller->delete($_GET['id']);
}
if(!isset($controller)){
  $controller = new ProductController();
}
$total = $controller->getNumProducts();
?>
<div class="container mt-5">
  <h1>PRODUCTOS</h1>
  <br>
  <?php echo showProductButton() ?>
  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col" class="col-sm-1"><a href="<?php echo $baseUrl ?>&order=ProductID">Id</a></th>
        <th scope="col" class="col-sm-3"><a href="<?php echo $baseUrl ?>&order=name">Nombre</a></th>
        <th scope="col" class="col-sm-2"><a href="<?php echo $baseUrl ?>&order=cost">Coste</a></th>
        <th scope="col" class="col-sm-2"><a href="<?php echo $baseUrl ?>&order=price">Precio</a></th>
        <th scope="col" class="col-sm-2"><a href="<?php echo $baseUrl ?>&order=categoryID">Categoria</a></th>
        <?php echo showTableThActions() ?>
      </tr>
    </thead>
    <tbody>
      <?php
      $prod = new ProductController();
      $prod->loadTable();
      paginationButtons(getPagina(), $total, 10, $baseUrl);
      ?>
    </tbody>
  </table>
</div>