<!-- Navigation -->
<nav class="navbar navbar-default 	 navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Berpindah Navigasi</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="fa fa-heartbeat fa-lg"></i> UDD PMI Kota Padang</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="kontak.php"><i class="fa fa-envelope"></i> Hubungi Kami</a></li>

                <?php
                    if(empty($_SESSION['level']))
                    {
                ?>
                    <li><a href="" data-toggle="modal" data-target="#myModal">Register</a></li>
                    <li><a href="" data-toggle="modal" data-target="#login">Login</a></li>
                <?php
                    }
                    else
                    {
                ?>
                        <li><a href="logout.php">Logout</a></li>
                <?php
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>