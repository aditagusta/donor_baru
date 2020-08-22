<?php
    session_start();
    require_once "functions.php";
    require_once "config.php";
?>

<!DOCTYPE html>

<html lang="en">
<?php include "head.php"; ?>

<body>

    <?php include "menu_navigasi_atas.php"; ?>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <marquee scrollamount=5 onmouseover="this.stop(); onmouseover" this.start()>
            <b><i>Selamat Datang Di Website Kami, Mari Bantu Saudara Kita Dengan Melakukan Donor Darah Untuk Keberlangsungan Hidup Mereka Yang Lebih Baik</b></i>
        </marquee>
        <!-- Wrapper for slides -->
        <div class=" carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/s1.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/s2.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/s3.jpeg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-primary">
                    UDD PMI Kota Padang
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-user"></i> Pendaftaran Pendonor</h4>
                    </div>
                    <div class="panel-body">
                        <p>Pernahkah Anda membayangkan kerabat Anda atau teman dekat anda memerlukan darah dalam keadaan mendesak? , ketika rumah sakit mengatakan kehabisan stok, donor darah dalam keadaan mendesak tidak akan bisa terjadi, maka dari itu dengan adanya kami saat ini anda dapat mulai menabung kantong darah bagi mereka.</p>
                        <a href="registrasi_donor.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-medkit"></i> Butuh Darah</h4>
                    </div>
                    <div class="panel-body">
                        <p>Setiap 2 detik seseorang membutuhkan darah anda, Darah Anda membantu lebih dari satu kehidupan sekaligus seperti korban kecelakaan, bayi prematur, pasien yang menjalani operasi besar akan membutuhkan darah yang cukup, pastikan darah Anda setelah pengujian digunakan secara langsung agar saudara kita dapat menggunakannya.</p>
                        <a href="butuh_darah.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-search"></i>Cari Darah </h4>
                    </div>
                    <div class="panel-body">
                        <p>Beberapa orang yang mengalami cedera serius memerlukan transfusi darah untuk menggantikan darah yang hilang selama cedera. Dengan melakukan donor darah secara rutin akan memastikan bahwa pasokan darah yang aman dan berlimpah tersedia kapan pun dan di mana pun dibutuhkan untuk membantu saudara - saudara kita yang membutuhkannya.</p>
                        <a href="cari_donor.php" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header  text-primary">Kegiatan Donor Darah</h2>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-thumbnail img-hover" src="images/picture.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-thumbnail img-hover" src="images/p2.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-thumbnail img-hover" src="images/p3.jpeg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-thumbnail img-hover" src="images/gambar.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-thumbnail img-hover" src="images/foto.jpg" alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="#">
                    <img class="img-responsive img-portfolio img-thumbnail img-hover" src="images/donor.jpg" alt="">
                </a>
            </div>
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header  text-primary">Mengapa Donor Darah Itu Penting?</h2>
            </div>
            <div class="col-md-6">


                <ul>
                    <li>Mendonorkan darah untuk menyelamatkan nyawa saudara kita. Darah yang Anda berikan adalah nyawa bagi mereka dalam keadaan darurat dan untuk orang yang membutuhkan pengobatan jangka panjang.</li>

                    <li>Banyak orang tidak akan hidup hari ini jika darah tidak tersedia bagi yang membutuhkan.</li>

                    <li>Kami membutuhkan lebih dari 200 lebih kantong darah setiap harinya untuk merawat pasien yang membutuhkan di seluruh kota Padang. Itulah sebabnya kami membutuhkan darah dari anda untuk kesehatan mereka.</li>

                    <li>Setiap tahun kami membutuhkan sekitar 200.000 kantong darah, karena kebutuhan darah meningkat setiap tahunnya.</li>

                    <li>Sebagian besar orang berusia antara 17-65 dapat memberikan darah. </li>

                    <li>Sekitar setengah dari pendonor kami saat ini berusia di atas 45 tahun. Itulah sebabnya kami membutuhkan lebih banyak orang muda (di atas usia 17) untuk mulai mendonorkan darah, sehingga kami dapat memastikan bahwa kami memiliki cukup darah di masa mendatang.</li>

                </ul>
            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="images/contact.jpeg" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr>
        <div class="container">
            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header  text-primary">Tentang kami UDD PMI Kota Padang
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Intro Content -->
            <div class="row">
                <div class="col-md-6">
                    <img class="img-responsive" src="images/images.jpeg" alt="">
                </div>
                <div class="col-md-6">
                    <h2 class="text-primary">UDD PMI Kota Padang </h2>
                    <p>UDD PMI Kota Padang merupakan tempat pelayanan donor darah yang meliputi pengerahan dan pelestarian donor, pengambilan darah, pengolahan komponen darah, uji saring infeksi, penyimpanan dan pendistribusian darah ke Bank Darah RS (BDRS) atau Rumah Sakit (RS). Untuk mencapai pemenuhan kebutuhan darah, PMI telah melakukan peningkatan rekrutmen donor, jejaring penyediaan darah antar UDD PMI serta ikatan kerjasama antara UDD PMI dengan BDRS.

                        Peningkatan rekrutmen donor dilaksanakan melalui kampanye di berbagai media baik elektronik maupun cetak serta kerjasama dengan beberapa Lembaga Swadaya Masyarakat (LSM) yang peduli atas donor darah. Sedangkan jejaring penyediaan darah di UDD PMI dilaksanakan dengan jalan memperluas penerapan Sistim Informasi Manajemen (SIM) sehingga komunikasi antar UDD PMI terkait penyediaan darah menjadi lebih mudah.
                    </p>

                </div>
            </div>
            <!-- Call to Action Section -->
            <div class="well">
                <div class="row">
                    <div class="col-md-8">
                        <p>Kami mengharapkan kesediaan Anda untuk meningkatkan standar kehidupan saudara saudara kita. Untuk pertanyaan dan detail lebih lanjut silahkan hubungi pelayanan kami...</p>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-primary btn-block" href="kontak.php"><i class="fa fa-phone"></i> Kontak Pelayanan</a>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Footer -->
            <?php include "registrasi_pendonor.php"; ?>
            <?php include "footer.php"; ?>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Script to Activate the Carousel -->
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })

            $(".img-portfolio").click(function() {
                var a = $(this).attr("src");
                $("#ModalImg").attr("src", a);
                $('#myModal').modal();
            });
        </script>
        

</body>

</html>