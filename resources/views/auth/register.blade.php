<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Register - Klinik Sehat</title>
    <style>
        /* Gambar latar belakang */
        body {
            /* background-image: url('https://ideogram.ai/assets/progressive-image/balanced/response/-3J7xNw2Q4KuGcJjR-ZavA'); URL gambar latar belakang */
            background-image: url('{{ asset('assets/img/logo_make_11_06_2023_239.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .register-container {
            margin-top: 100px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.85); /* Warna putih semi-transparan */
            padding: 20px;
        }

        .form-control {
            border-radius: 30px;
        }

        .btn-primary {
            background-color: #00a7d7;
            border-color: #00a7d7;
            border-radius: 30px;
        }

        .btn-primary:hover {
            background-color: #00a7d7;
            border-color: #00a7d7;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #00a7d7;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            color: white;
        }

        .header h1 {
            font-weight: bold;
            margin: 0;
        }

        .header img {
            width: 50px;
        }

        .icon-input {
            position: relative;
        }

        .icon-input .fa {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .form-control-icon {
            padding-left: 40px;
        }

        /* Ikon untuk toggle visibility password */
        .icon-eye {
            position: absolute;
            right: 10px;
            top: 75%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-8">
                <div class="register-container">
                    <div class="header">
                        <h1>KLINIK SEHAT</h1>
                    </div>
                    <div class="p-4">
                        <h2 class="text-center">Create Account</h2>
                        <form action="{{ url('/api/register') }}" method="POST">
                            @csrf
                            <div class="mb-3 icon-input">
                                <label for="name" class="form-label">Nama</label>
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control form-control-icon"
                                    placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="mb-3 icon-input">
                                <label for="email" class="form-label">Email</label>
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control form-control-icon"
                                    placeholder="Masukkan email Anda" required>
                            </div>
                            <!-- Password Field with Eye Icon -->
                            <div class="mb-3 icon-input">
                                <label for="password" class="form-label">Password</label>
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control form-control-icon"
                                    placeholder="Masukkan password Anda" id="password" required>
                                <i class="fas fa-eye icon-eye" id="togglePassword"></i>
                            </div>
                            <!-- Konfirmasi Password Field with Eye Icon -->
                            <div class="mb-4 icon-input">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password_confirmation" class="form-control form-control-icon"
                                    placeholder="Konfirmasi password Anda" id="password_confirmation" required>
                                <i class="fas fa-eye icon-eye" id="togglePasswordConfirmation"></i>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <p class="text-center">Already have an account? <a href="/login" style="color: #00a7d7">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script for toggling password visibility -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute between password and text
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            // Toggle the eye icon
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
        const passwordConfirmationField = document.querySelector('#password_confirmation');
        
        togglePasswordConfirmation.addEventListener('click', function () {
            const type = passwordConfirmationField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
