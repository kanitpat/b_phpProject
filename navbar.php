<a class="navbar-brand mr-1" href="http://localhost/b_phpProject/index.php?cont=Dashboard">สวนวัฒนาเพาะพันธุ์มะพร้าว</a>
<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
  <i class="fas fa-bars"></i>
</button>

<!-- Navbar Search -->
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
  <div class="input-group">
    <!-- <input type="text" class="form-control" placeholder="ค้นหา" aria-label="Search" aria-describedby="basic-addon2"> -->
    <div class="input-group-append">
      <!-- <button class="btn btn-primary" type="button">
        <i class="fas fa-search"></i>
      </button> -->
    </div>
  </div>
</form>

<!-- Navbar -->
<ul class="navbar-nav ml-auto ml-md-0">
  
  <li class="nav-item dropdown no-arrow mx-1">
  </li>
  
   <!-- user menu -->
   <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-fw"></i>
      </a>
      <?php $userid = $_SESSION['userid'];
      $sql = "SELECT *
  FROM users 
  WHERE id = '$userid'";
    $query = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die('Query error');
    $resuelt = mysqli_fetch_assoc($query);
    $email_q = $resuelt['email'];
?>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="http://localhost/b_phpProject/index.php?cont=edit"><?php echo $email_q; ?></a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
      </div>
    </li>
</ul>