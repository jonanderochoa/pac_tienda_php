<header class="mb-auto text-white bg-dark fixed-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">WestStore</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?php
          session_start();
          if (isset($_SESSION['superAdmin']) && $_SESSION['superAdmin']) {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="index.php?route=users">Usuarios</a>
            </li>
            ';
          }
          if (isset($_SESSION['registered']) && $_SESSION['registered']) {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="index.php?route=products">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?route=exit">Logout</a>
            </li>
            ';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>