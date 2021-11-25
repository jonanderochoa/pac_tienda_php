<?php
function dinamicFormText($element = 'PRODUCTO') {
    if(!isset($_GET['action'])) {
        return array(
            'title' => 'NUEVO ' . $element, 
            'button' => 'Crear');
    }
    if($_GET['action'] == 'edit'){
        return array(
            'title' => 'EDITAR ' . $element, 
            'button' => 'Editar');
    }
}

function disableFormInputs() {
    return isset($_GET['action']) && ($_GET['action'] == 'delete') ? "disabled" : "";
}

function showProductButton()
{
    return $_SESSION['superAdmin'] || $_SESSION['autorized']
        ? '<a class="btn btn-success" href="index.php?route=product" role="button">Nuevo Producto</a>' : '';
}

function securityOld($permiso)
{
    if (!$_SESSION[$permiso]) {
        header("location:index.php?route=login.php");
        exit();
    }
}

function security($registered = false, $autorized = false, $admin = false)
{
    $permisos = true;
    if ($registered) {
        $permisos = !$_SESSION['registered'];
    }
    if ($autorized) {
        $permisos = $permisos && !$_SESSION['autorized'];
    }
    if ($admin) {
        $permisos = $permisos && !$_SESSION['superAdmin'];
    }
    if ($permisos) {
        header("location:index.php?route=login.php");
        exit();
    }
}

function showTableThActions()
{
    return $_SESSION['superAdmin']  ?
        '<th scope="col" class="col-sm-2" colspan="2">Acciones</th>' : '';
}

function getPagina()
{
    if (isset($_GET['pag'])) {
        $pagina = $_GET['pag'];
    } else {
        $pagina = 1;
    }
    return $pagina;
}

function paginationButtons($pag, $maxItems, $elementByPag, $routeBase)
{
    $routeBase .= isset($_GET['order']) ? '&order=' . $_GET['order'] : '';
    $numeroPaginas = ceil($maxItems / $elementByPag);
    $paginasMax = ($pag * $elementByPag) < $maxItems;
    $previous = ($pag > 1) ? 'href="' . $routeBase . '&pag=' . $pag - 1 . '"' : "";
    $next = $paginasMax ? 'href="' . $routeBase . '&pag=' . $pag + 1 . '"' : "";

    $disabledPrev = ($pag > 1) ? "" : "disabled";
    $disabledNext = $paginasMax ? "" : "disabled";

    $pageLinks = '';
    for ($i = 1; $i <= $numeroPaginas; $i++) {
        $isActive = $pag == $i ? "active" : "";
        $pageLinks .= '<li class="page-item ' . $isActive . '"><a class="page-link" href="' . $routeBase . '&pag=' . $i . '">' . $i . '</a></li>';
    }
    echo '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item ' . $disabledPrev . '">
      <a class="page-link" ' . $previous . '>Previous</a>
    </li>' . $pageLinks .
        '<li class="page-item ' . $disabledNext . '">
      <a class="page-link" ' . $next . '>Next</a>
    </li>
  </ul>
</nav>';
}
