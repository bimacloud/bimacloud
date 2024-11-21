<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fe;
        }
        .registration-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 6px;
        }
        .btn-register {
            width: 100%;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="registration-form">
        <h3 class="text-center">Registrasi</h3>
        <form action="<?= site_url('Auth/register'); ?>" method="post">
            <!-- First Name -->
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <!-- Last Name -->
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Nomer Whatsapp -->
            <div class="mb-3">
                <label for="whatsapp" class="form-label">Nomer Whatsapp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Repeat Password -->
            <div class="mb-3">
                <label for="repeat_password" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-register">Register</button>
        </form>
    </div>
</div>

<!-- Link Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
