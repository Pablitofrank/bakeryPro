<!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BakeryPro</title>
    <link rel="stylesheet" href="vista/style/styles.css">
    <link rel="shortcut icon" href="./vista/img/logo.svg" type="image/x-icon">

</head>

<body>
    <div class="login">
        <div class="form-container">
            
            <h1 class="title">Iniciar Sesión</h1>
            <img src="./vista/img/login.svg" alt="imagen de inicio de sesion" class="loginImg">

            <form action="controlador/login/validar.php" method="post" class="form">
                    <label for="password" class="label">Cedula</label>
                    <input type="number" placeholder="ingrese su cédula" name="cedula" class="input" required></><br>
                    
                    <label for="new-password" class="label">Password</label>
                    <input type="password" placeholder="ingrese su contraseña" name="Password" class="input" required></p><br>
                
                    <input type="submit" value="Ingresar" class="btn">
            </form>
        </div>
    </div>
</body>
</html>