<?php
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <title>Atma Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: url('https://img.freepik.com/free-photo/abstract-blur-defocused-bookshelflibrary_1203-9640.jpg?w=900&t=st=1698697077~exp=1698697677~hmac=1a12d710da0136a68f348da615842a1d1f70266855cd129d10e3e012bf782d16');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.8);
            /* Mengatur latar belakang transparan */
            border: 1px solid #ccc;
            /* Garis tepi */
            border-radius: 10px;
            /* Sudut membulat */
            padding: 15px;
        }

        .carousel-caption {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            height: 90px;
            text-align: center;
        }

        .text-black {
            color: black;
        }

        .title-container {
            background-color: rgba(121, 235, 184, 0.7); 
            padding-left: 2rem; 
            padding-right: 2rem;
            border-radius: 10px;
        }

        .main-container {
            background-color: rgba(255, 255, 255, 0.8);
            margin-top: 2rem;
            margin-left: 5rem;
            margin-right: 5rem;
            padding: 1.5rem;
            border-radius: 10px;
            height: calc(100vh / 1.2);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="text-center">
            <h4><b>Atma Library</b></h4>
            <h6>{{ date('Y-m-d') }}</h6>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul></ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home <span class="sronly"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('buku')}}">Buku Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pinjam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kembalikan</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a>210711446</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        ariahaspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" arialabelledby="userDropdown">
                        <div class="text-center">
                            <img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSMjxrXB1_f7gJSVEILGF4NxM54SgzMMXfqpjS6jeLxIW-N6Y7p" class="rounded-circle mb-3"
                                style="width:100px;" alt="Avatar" />
                            <h5 class="mb-2"><strong>{{ Auth::user()->username }}</strong></h5>
                            <p class="text-muted">{{ Auth::user()->email}}</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user"></i> 
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{route('actionLogout') }}">
                                <i class="fa fa-user"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div>
        <div class="main-container">
            <div class="d-flex justify-content-center">
                <div class="title-container mt-3">
                    <h4>Tambah Buku Saya</h4>
                </div>
            </div>

            <div class="mt-4">
                <form method="post" action="{{route('actionTambah')}}">
                    @csrf
                    <div class="col-md-6">
                        <label><strong>Judul Buku</strong></label>
                        <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul Buku">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label><strong>Penulis</strong></label>
                        <input type="text" class="form-control" name="penulis" placeholder="Masukkan Penulis">
                    </div>

                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!--Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // window.onload = function() {
        //     // Menghapus riwayat perambanan
        //     window.history.pushState({}, '', '/'); // Mengganti URL ke halaman login
        // }
    </script>
</body