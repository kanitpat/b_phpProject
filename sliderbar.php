 <!-- Sidebar -->
 <?php

  if ($_SESSION['Status'] == 0) {
      ?>			
 <ul class="sidebar navbar-nav ">
    <li class="nav-item ">
      <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=Dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
   
    <li class="nav-item ">
      <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=กราฟ">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>กราฟ</span></a>
    </li>

    <li class="nav-item">
          <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=ตาราง">
            <i class="fas fa-fw fa-table"></i>
            <span>ตาราง</span></a>
        </li>
  </ul>
        <?php
  } else {
        ?>

        <ul class="sidebar navbar-nav ">
    <li class="nav-item ">
      <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=Dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
   
    <li class="nav-item ">
      <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=กราฟ">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>กราฟ</span></a>
    </li>

    <li class="nav-item">
          <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=ตาราง">
            <i class="fas fa-fw fa-table"></i>
            <span>ตาราง</span></a>
        </li>

    <li class="nav-item">
          <a class="nav-link" href="http://localhost/b_phpProject/index.php?cont=ตั้งค่า">
            <i class="fa fa-fw fa-wrench"></i>
            <span>ตั้งค่าระยะเซนเซอร์</span></a>
        </li>    
  </ul>

<?php
    }

      ?>