   <div style="height: 10px;background: #27aae1"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="" class="navbar-brand">Lalit App</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
                            aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a href="booking_admin.php" class="nav-link"><i class="fas fa-address-book text-success"></i> Booking Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="product_admin.php" class="nav-link"> <i class="fas fa-user text-success"></i> Product Admin</a>
                    </li>
                <?php if(!empty($_SESSION['AdminName'])){?>
                    <li class="nav-item">
                        <a href="admin_dashboard.php?report=" class="nav-link"><i class="fas fa-tools text-success"></i> Admin Dashboard</a>
                    </li>
                <?php }?>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item align-items-right">
                            <a href="Logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i> Logout</a>
                        </li>
                    </ul>
                </ul>
<!--                 <ul class="navbar-nav ml-auto">
                    <form class="form-check-inline" action="Blog.php">
                        <div class="form-check form-check-inline">
                            <input class="form-control" type="text" name="Search" placeholder="Search here" value="">
                        </div>
                        <div class="form-check form-check-inline">
                            <button type="button" class="btn btn-primary" name="SearchButton">Go</button>
                        </div>
                    </form>
                </ul> -->
            </div>
        </div>
    </nav>

    <div style="height: 10px;background: #27aae1"></div>
