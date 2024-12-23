<?php
  

  include "konek.php";
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function encrypt($data, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        
        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        
        return base64_encode($iv . $encryptedData);
    }
    $key = 'iniAdalahKunciRahasia1234567890123456';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $encryptedPassword = encrypt($password, $key);

    $query = "INSERT INTO password VALUES('', '$email','$encryptedPassword')";
    $result = mysqli_query($konek, $query) or die(mysqli_error($konek));

    if($result){
        header("location:login.php?pesan=tambah");
    } else {
        echo "Proses Input gagal";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #ffffff;
        }

        .header {
            background-color: #87CEFA;
            height: 50px; 
            width: 100%;
        }

        .custom-card {
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
        }

        img {
            animation: float 3s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="header"></div><br><br>
        <div class="text-center mb-4">
            <h2 class="fw-bold">Lets Register Your Account</h2>
            <p class="text-muted">Hello User, you have a grateful journey!</p>
        </div><br><br>
        <div class="d-flex justify-content-center align-items-center">
            <div class="custom-card p-5" style="width: 400px;">
                <form method="POST" action="" autocomplete="off">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" autofocus required placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autofocus required placeholder="Enter your password" required>
                    </div>
                    <div class="mb-5">
                        <button type="submit" class="btn btn-dark w-100 mb-3">Sign Up</button>
                    </div>
                </form>
                <p class="text-center text-muted">Already have an account? <a href="login.php" class="text-decoration-none">Login</a></p>
            </div>
            <div class="ms-5 d-flex align-items-center">
                <img src="foto/register.png" alt="Illustration" class="img-fluid" style="max-height: 400px;">
            </div>
        </div><br><br>
    <div class="header mt-4"></div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>