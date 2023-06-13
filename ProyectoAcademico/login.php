<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h3>Inicio de sesión</h3>
        <form action="logica/comprobar.php" method="POST">
            <label for="username">
                <span>Username</span>
                <input id="username" name="username" placeholder="Digite usuario" required autocomplete="off"/>
            </label>
            <label for="password">
                <span>Password</span>
                <input type="password" id="password" name="password" placeholder="Digite contraseña" required/>
            </label>
            <label for="checkbox" class="checkbox-label">
                <input type="checkbox" id="checkbox">
                <span>Recordar datos</span>
            </label>
            <button type="submit" class="submit-btn">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>