<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="container">
        <div class="form-box login <?= ($active === 'login') ? 'active' : '' ?>">

            <form action="/login" method="POST">
                <h1>Connexion</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email"  required>
                    <i class='bx bxs-user'></i>
                </div>
                <?php if(isset($error)): ?>
                    <p style="color"><?= $error ?></p>
                <?php endif; ?>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div> 
                <div class="forgot-link">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <p>Ou se connecter via les réseaux sociaux</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google-plus'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div> 

        <div class="form-box register <?= ($active === 'register') ? 'active' : '' ?>">
            <form action="/register" method="POST">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" name="name" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div> 
                <button type="submit" class="btn">Resgister</button>
                <p>Or register with social platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google-plus'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div> 

        <div class="toggle-box">
            <div class="toggle-panel toggle-left <?= ($active === 'register') ? 'active' : '' ?>">
                <h1>Hello, Welcome !</h1>
                <p>Vous n'avez pas de compte ?</p>
                <button class="btn register-btn">Resgister</button>
            </div>
            <div class="toggle-panel toggle-right <?= ($active === 'login') ? 'active' : '' ?>">
                <h1>Welcome back !</h1>
                <p>Already have an account ?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>


    <script src="scripts.js"></script>
</body>
</html>