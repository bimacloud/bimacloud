<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background color */
        body {
            background-color: #F8F9FE;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            padding: 1rem; /* Add padding for smaller screens */
        }
        /* Container styling */
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        /* Form control styling */
        .form-control {
            border-radius: 50px;
            padding: 0.75rem 1rem;
        }
        /* Button styling */
        .btn-primary {
            width: 100%;
            border-radius: 50px;
            padding: 0.75rem;
            font-weight: bold;
            background: #2575fc;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #1a59c6;
            box-shadow: 0 4px 10px rgba(37, 117, 252, 0.3);
        }
        /* Additional styling */
        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2575fc;
            margin-bottom: 1rem;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .text-muted {
            color: #6c757d;
        }

        /* Responsive styling */
        @media (max-width: 576px) {
            .login-container {
                padding: 1.5rem;
                box-shadow: none;
            }
            .login-title {
                font-size: 1.25rem;
            }
            .btn-primary {
                padding: 0.6rem;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h3 class="login-title">Welcome Back</h3>
    
    <!-- Error Message -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post" action="<?= site_url('Auth/process_login'); ?>">
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <p class="text-center mt-4 text-muted">Don't have an account? <a href="#" class="text-decoration-none" style="color: #2575fc;">Sign up</a></p>
</div>

<!-- Link Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
