<?php 
if(isset($_SESSION['check'])==1){
$sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
session_set_cookie_params($sessionTime);
 session_start();
 
}else
{
    session_start();
}
// $sessionTime = 365 * 24 * 60 * 60; // 1 año de duración
// session_set_cookie_params($sessionTime);
// session_start();
  date_default_timezone_set("America/Guatemala");
          if(isset($_SESSION['autorizado'])==1){
          if(($_SESSION['nombre_de_usuario']=="Carlos") || ($_SESSION['nombre_de_usuario']=="Edy")|| ($_SESSION['nombre_de_usuario']=="Marvin")){
            header("Location: Despachos2.php");
          }else
          {
              header("Location: Pedidos.php");
          }
    
  }else
  {
            //   header("Location: Cotizacion.php");
  }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>


    <!--<link rel="stylesheet" href="./css/main.css">-->

   <link  href="css/sweetalert2.css" rel="stylesheet"/>
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>-->
<!--<script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>-->


      <meta name="description" content="Bienvenid@s">

  <meta name="theme-color" content="#e20026">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="shortcut icon" type="image/png" href="./img/surtimax.png">
  <link rel="apple-touch-icon" href="./img/surtimax.png">
  <link rel="apple-touch-startup-image" href="./img/surtimax.png">
  <link rel="manifest" href="./manifest.json">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <style>
    
    #auth #auth-right {
   background: linear-gradient(90deg, #ff0000, #fff700) !important;
    /*background: url(assets/images/bg/48534335.png),linear-gradient(45deg, rgb(255 219 125) 0%, rgba(255 188 14) 50%, rgb(233 168 0) 100%);*/
    /*background-size: contain;*/
    height: 100%;
}

    #contenedorcarga{
    /*background: url(assets/images/bg/4853433.jpg),linear-gradient(90deg,#000,#000);*/
}

    .form-select.form-control-xl {
    font-size: 1.2rem;
    padding: 0.85rem 1rem;
}

    .MsjAjaxForm{
	display: none;
}

.form-control:focus {
 background-color: #fff!important;
    border-color: white!important;
    box-shadow: 0 0 0 0.25rem #ff8935;
    color: #607080!important;
}

.form-select:focus {
    border-color: #a1afdf;
    box-shadow: 0 0 0 0.25rem #ff8935;
    outline: 0;
}
   

 #auth-left {
/*background: url(assets/images/bg/4853433.jpg),linear-gradient(45deg, rgb(125 159 255) 0%, rgb(14 122 255) 50%, rgb(0 72 233) 100%);*/
  background:transparent!important;
    height: 100%;
}
 #auth {
/*background: url(assets/images/bg/4853433.jpg),linear-gradient(45deg, rgb(125 159 255) 0%, rgb(14 122 255) 50%, rgb(0 72 233) 100%);*/
  background:red!important;

}


 .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: #fff!important;
    }
    
    
    .btn-check:focus+.btn-primary, .btn-primary:focus, .btn-primary:hover {
 background-color: white!important;
    border-color: white!important;
    font-weight:bold!important;
     color: red!important;
    
    font-weight:bold!important;
}

.btn-primary {

     
    background-color: #dde000 !important;
    border-color: white!important;
    color:white!important;
    
    transition: background-color 0.5s ease;
   
    
}


    </style>

    
</head>

<body>

<?php if(!empty($message)): ?>
      <p style="display:none;"> <?= $message ?></p>
    <?php 
endif;?>

<div id="contenedorcarga">
<?php 
// require 'carga.php'
?>
</div>    

    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <!--<a href="index.php"><img src="images/logo/logo.png" alt="Logo"></a>-->
            </div>
            <h1 class="auth-title">Iniciar sesión.</h1>
            <!-- <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p> -->
<form action="valida_usr.php" method="post" class="AjaxForms" data-type-form="login" autocomplete="off">
            <!--<form action="index.php" method="post">-->
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="usuario" id="UserName" class="form-control form-control-xl" placeholder="Usuario" autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="pass" id="Pass" class="form-control form-control-xl" placeholder="Contraseña" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
               <fieldset class="form-group">
                                        <select class="form-select form-control-xl" id="empresa" name="empresa">
                                            <!--<option selected disabled>Sucursal</option>-->
                                            <option value="1">Tienda 1</option>
                                            <option value="2">Tienda 2</option>
                                            <option value="3">Tienda 3</option>
                                        </select>
                                    </fieldset>
                                    
                                    
                <div class="form-check form-check-lg d-flex align-items-end" style="display:none!important;">
                    <input class="form-check-input me-2" type="checkbox" value="1" name="check" id="check">
                    <label class="form-check-label text-gray-600" for="check">
                        Mantener sesión abierta.
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Iniciar sesión</button>
            </form>
            
<div class="MsjAjaxForm"></div>
            <!-- <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                        up</a>.</p>
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
            </div> -->
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" style="align-items: center;justify-content: center;display: flex;">
     <div>
    <img id="carga" src="imagenes/surtimax.png" class="me-4" width="450" style="" alt="audio">
    </div>
        </div>
    </div>
</div>

    </div>


<script src="./js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./js/bootstrap.min.js"></script>
<!-- Script AjaxForms-->
<!--<script src="./js/AjaxForms.js"></script>-->
<!-- Sweet Alert 2-->
<script src="./js/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/app.js"></script>
<!-- Script main-->
<script src="./js/main.js"></script>
                <script src="./script.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var MsjSending='<div class="responseProcess"><div class="container-loader"><div class="loader"><svg class="circular"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div><p class="text-center lead">Procesando... Un momento por favor</p></div></div>';
    $('.AjaxForms').submit(function(e) {
        e.preventDefault();
        var informacion=$(this).serialize();
        var metodo=$(this).attr('method');
        var peticion=$(this).attr('action');
        var type_form=$(this).attr('data-type-form');
        

        if(type_form==="login"){
            $.ajax({
                type: metodo,
                url: peticion,
                data:informacion,
                beforeSend: function(){
                    $('.MsjAjaxForm').html(MsjSending);
                },
                error: function() {
               
                    swal(
                      'Ocurrio un error inesperado',
                      'Recargue la página e intente nuevamente o presione F5',
                      'error'
                    );
                },
                success: function (data) {
                    $('.MsjAjaxForm').html(data);
                }
            });
            return false;
        }else{
            var title_alert;
            var text_alert;
            var type_alert;
            var confirmButtonColor_alert;
            var confirmButtonText_alert;
            var closeAlert;
            if(type_form==="save"){
                title_alert="¿Quieres almacenar los datos?";
                text_alert="Los datos se almacenaran en el sistema";
                type_alert="info";
                confirmButtonColor_alert="#3598D9";
                confirmButtonText_alert="Si, almacenar";
                closeAlert=false;
            }
            if(type_form==="delete"){
                title_alert="¿Quieres eliminar los datos?";
                text_alert="Al eliminar estos datos no podrás recuperarlos después";
                type_alert="warning";
                confirmButtonColor_alert="#C9302C";
                confirmButtonText_alert="Si, eliminar";
                closeAlert=false;
            }
            if(type_form==="update"){
                title_alert="¿Quieres actualizar los datos?";
                text_alert="Los datos se actualizaran y no podras recuperar los datos anteriores";
                type_alert="info";
                confirmButtonColor_alert="#16a085";
                confirmButtonText_alert="Si, actualizar";
                closeAlert=false;
            }
            swal({
                title: title_alert,   
                text: text_alert,   
                type: type_alert,   
                showCancelButton: true,   
                confirmButtonColor: confirmButtonColor_alert,   
                confirmButtonText: confirmButtonText_alert,
                cancelButtonText: "No, cancelar",
                closeOnConfirm: closeAlert,
                animation: "slide-from-top"
            }, function(){
                $.ajax({
                    type: metodo,
                    url: peticion,
                    data:informacion,
                    beforeSend: function(){
                        $('.MsjAjaxForm').html(MsjSending);
                    },
                    error: function() {
                        swal(
                          'Ocurrio un error inesperado',
                          'Recargue la página e intente nuevamente o presione F5',
                          'error'
                        );
                    },
                    success: function (data) {
                        $('.MsjAjaxForm').html(data);
                    }
                });
                return false;
            }); 
        }
    }); 
});
</script>

</body>

</html>
