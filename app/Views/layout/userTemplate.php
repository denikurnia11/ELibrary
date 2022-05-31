<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- My Script -->
    <script src="/js/script.js"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title><?= $title; ?></title>
</head>

<body>
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid ">
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
            <a class="navbar-brand fw-bold text-light fs-4 ms-4" href="/user">
                <img src="/img/logo.png" width="30" height="30" />
                <b class="judul">E-LIBRARY</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-5">
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                            <?= session()->username; ?>
                        </a>
                        <ul class="dropdown-menu dropdownContent" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="/user/profile">
                                    <i class="fas fa-user-circle"></i>
                                    My Profile</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--/.Navbar -->
    <!-- Sidebar -->
    <div class="side-bar">
        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>
        <div class="fotoProfileSidebar text-center">
            <div class="circular--portrait">
                <img src="/img/<?= session()->foto; ?>">
            </div>
            <h3><?= session()->nama; ?></h3>
        </div>

        <div class="menu">
            <div class="item">
                <hr class="bg-secondary" />
                <a href="/user"><i class="fas fa-desktop"></i>Dashboard</a>
                <hr class="bg-secondary" />
            </div>
            <div class="item">
                <a href="/user/buku" class="sub-item"><i class="fas fa-book-open me-2"></i>Daftar Buku</a>
                <hr class="bg-secondary" />
            </div>
            <div class="item">
                <a href="/logout" class="text-danger"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>
    </div>

    <!-- End Sidebar -->
    <!-- Content -->
    <div class="myProfile">
        <h3 class="myProfileText"></h3>
    </div>
    <section class="main">
        <div class="content">
            <!-- Isi Konten -->
            <?= $this->renderSection('content'); ?>
            <!-- End Isi Konten -->
        </div>
        <!-- Footer -->
        <div class="footer row">
            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05)">
                © 2021 Copyright: All Right Reserved
            </div>
            <!-- Copyright -->
        </div>
        <!-- End Footer -->
    </section>
    <!-- End Content -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>