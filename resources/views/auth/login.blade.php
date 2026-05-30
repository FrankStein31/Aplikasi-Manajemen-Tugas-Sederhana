<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="M-Tugas - Login">
    <title>M-Tugas | Login</title>

    <!-- Font Awesome -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%); display: flex !important; align-items: center; justify-content: center; min-height: 400px;">
                                <div class="text-center text-white p-4">
                                    <i class="fas fa-tasks fa-5x mb-3"></i>
                                    <h2 class="font-weight-bold">M-Tugas</h2>
                                    <p>Aplikasi Manajemen Tugas</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <i class="fas fa-tasks text-primary"></i> M-Tugas | Login
                                        </h1>
                                    </div>

                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    @if(session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                placeholder="Masukkan Email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                placeholder="Masukkan Password">
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" id="btnLogin" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <small class="text-muted">Kembali Ke Beranda ?
                                            <a href="{{ route('landing') }}">Klik Disini</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
