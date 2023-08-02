<?php
 if (!isset($_SESSION["user_id"])){
     include "header.php";
}
else {
        ?>
        <div class='nav-name'>
            Hi, <?php echo $_SESSION["full_name"] ?>
        </div>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-user"></i>Das-hboard
            </a>
        </li>
        <div class="nav-vl"></div>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </li>
    <?
}
?>