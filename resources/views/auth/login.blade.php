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
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">
    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 48px 44px 36px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 10px 40px rgba(0,0,0,.15);
        }
        .login-title {
            text-align: center;
            font-size: 1.35rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 28px;
            letter-spacing: .3px;
        }
        .login-title i {
            color: #2d3748;
            margin-right: 6px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .input-pill {
            border-radius: 50px !important;
            border: 1.5px solid #ced4da;
            padding: 12px 20px;
            font-size: 14px;
            width: 100%;
            outline: none;
            transition: border-color .2s;
            background: #fff;
        }
        .input-pill:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78,115,223,.15);
        }
        .input-pill.is-invalid {
            border-color: #e74a3b;
        }
        .input-wrapper {
            position: relative;
        }
        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #e74a3b;
            font-size: 14px;
        }
        .error-msg {
            color: #e74a3b;
            font-size: 12px;
            margin-top: 5px;
            padding-left: 6px;
        }
        .btn-login {
            width: 100%;
            border-radius: 50px;
            background: #4e73df;
            color: #fff;
            border: none;
            padding: 13px;
            font-size: 15px;
            font-weight: 600;
            margin-top: 6px;
            cursor: pointer;
            transition: background .2s, transform .1s;
            letter-spacing: .3px;
        }
        .btn-login:hover {
            background: #3d5fc4;
        }
        .btn-login:active {
            transform: scale(.98);
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #718096;
        }
        .back-link a {
            color: #4e73df;
            font-weight: 600;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
        .alert-box {
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 13px;
            margin-bottom: 16px;
        }
        .alert-success-box { background: #d4edda; color: #155724; }
        .alert-danger-box  { background: #f8d7da; color: #721c24; }
    </style>
</head>

<body>
    <div class="login-card">

        <!-- Title -->
        <div class="login-title">
            <i class="fas fa-list-alt"></i> M-Tugas | Login
        </div>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="alert-box alert-success-box">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-box alert-danger-box">{{ session('error') }}</div>
        @endif

        <!-- Form -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <div class="input-wrapper">
                    <input
                        type="email"
                        name="email"
                        class="input-pill {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan Email"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <span class="input-icon"><i class="fas fa-exclamation-circle"></i></span>
                    @enderror
                </div>
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <div class="input-wrapper">
                    <input
                        type="password"
                        name="password"
                        class="input-pill {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan Password"
                    >
                    @error('password')
                        <span class="input-icon"><i class="fas fa-exclamation-circle"></i></span>
                    @enderror
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit" class="btn-login">Login</button>
        </form>

        <!-- Back link -->
        <div class="back-link">
            Kembali Ke Beranda ? <a href="{{ route('landing') }}">Klik Disini</a>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
