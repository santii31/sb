<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700&display=swap" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= CSS_PATH ?>materialize.min.css"  media="screen,projection"/>
    <!--Import custom style-->
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
</head>
<body>
        
    <section class="login-section">
        <div class="login-container z-depth-2">            
            <div class="login-img"></div>
            <div class="login-form">
                <form action="<?= FRONT_ROOT ?>user/login" method="post">
                    <div class="row">
                        <div class="input-field col s12">    
                            <img src="<?= IMG_PATH ?>logo.png" alt="Logo" class="logo-brand">                        
                            <h3 class="title-1">Ingrese sus datos</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">                            
                            <input id="email" type="email" class="validate" required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" required>
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        Conectarse
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </section>
    
    <script type="text/javascript" src="<?= JS_PATH ?>materialize.min.js"></script>
</body>
</html>