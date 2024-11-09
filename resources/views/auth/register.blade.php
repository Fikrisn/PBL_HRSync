<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Pengguna</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ url('polinema.png') }}" type="image/png">
    <style>
        body {
            position: relative; /* Position relative for the pseudo-element */
            height: 100vh; /* Full viewport height */
            margin: 0; /* Removes default margin */
            overflow: hidden; /* Prevents any overflow */
        }

        body::before {
            content: ''; /* Required to create a pseudo-element */
            position: absolute; /* Position it absolutely within the body */
            top: 0; /* Align to the top */
            left: 0; /* Align to the left */
            right: 0; /* Align to the right */
            bottom: 0; /* Align to the bottom */
            background-image: url('img/jtiblur.png'); /* Background image */
            background-size: cover; /* Ensures the image covers the entire area */
            background-position: center; /* Centers the background image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            filter: blur(1px); /* Adjust blur amount here (increase or decrease as needed) */
            z-index: -1; /* Send to the back */
        }

        .content {
            display: flex; /* Use flexbox for positioning */
            justify-content: flex-end; /* Align items to the right */
            align-items: center; /* Center vertically */
            height: 100vh; /* Full height */
            color: white; /* Change text color for better visibility */
            position: relative; /* Ensures content appears above the blurred background */
        }
        .login-box {
            width: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.85); /* Set background semi-transparan */
        }
    
        /* Card styling */
        .card {
            border-radius: 0;
            overflow: hidden;
        }
    
        .card-header {
            background: linear-gradient(to right, #007bff, #6f42c1);
            color: white;
        }
    
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    
        .error-text {
            font-size: 0.9rem;
            margin-top: 5px;
        }
    
        .login-box-msg {
            margin-bottom: 15px;
        }
    
        /* Animasi input focus */
        .input-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center"><a href="{{ url('/') }}" class="h1"><b>HRSync</b></a></div>
            <div class="card-body">
                <p class="login-box-msg">Registrasi Pengguna Baru</p>
                <form method="POST" action="{{ url('/register') }}" id="form-register">
                    @csrf
                    <div class="input-group mb-3">
                        <select class="form-control" id="id_jenis_pengguna" name="id_jenis_pengguna" required>
                            <option value="">- Pilih Jenis Pengguna -</option>
                            @foreach ($jenisPengguna as $item)
                                <option value="{{ $item->id_jenis_pengguna }}">{{ $item->nama_jenis_pengguna }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-layer-group"></span>
                            </div>
                        </div>
                        @error('id_jenis_pengguna')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                        @error('nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="NIP" name="NIP" class="form-control" placeholder="NIP (opsional)" value="{{ old('NIP') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-badge"></span>
                            </div>
                        </div>
                        @error('NIP')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <p>Sudah punya akun? <a href="{{ url('login') }}">Login</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ url('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#form-register").on("submit", function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            // Show success message with SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil',
                                text: 'Akun Anda telah berhasil dibuat.',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to login page after clicking OK
                                    window.location.href = "{{ url('login') }}";
                                }
                            });
                        } else {
                            // Handle registration failure
                            Swal.fire({
                                icon: 'error',
                                title: 'Registrasi Gagal',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
