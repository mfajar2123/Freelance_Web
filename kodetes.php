<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="tambahpekerjaan.php" class="btn btn-primary">Tambah Pekerjaan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Explore</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/img/menu.png" alt="" width="32" height="32" class="rounded-circle">

            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="freelance_order.php">Orders</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li><a class="dropdown-item"
                        href="profile_freelance.php?user_id=<?php echo $_SESSION['user_id']; ?>">Profile</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
            </ul>
        </li>
    </ul>
</div>
</div>
</nav>