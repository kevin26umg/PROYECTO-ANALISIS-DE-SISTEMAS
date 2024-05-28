    <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo $_SESSION['sucursal2']; ?></span>
    </a>
<!-- Header Navbar -->
  <?php
  error_reporting(0);
   $fp = fopen("contador.txt","r"); // Abrimos el fichero donde guardaremos y leeremos las visitas
   $visitas = intval(fgets($fp)); // Leemos las visitas y usamos intval para asegurarnos de que devuelve un entero
   ?>
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
         <a href="#" name="btnside" class="sidebar-toggle" data-toggle="offcanvas" role="button"> 
		  <span class="sr-only">Toggle navigation</span> 
		  <span class="hidden-xs">
		      <span class="hidden-xs"></span>
          </a> 
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
     
        
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="imagenes/<?php 
            
              
                  $file = 'imagenes/'.$_SESSION['foto'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $_SESSION['foto']!='') {
   echo $_SESSION['foto'];
} else {
    
     echo "userlg1.png";
}
              
              ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $_SESSION['nombre_de_usuario']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="imagenes/<?php 
            
              
                  $file = 'imagenes/'.$_SESSION['foto'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $_SESSION['foto']!='') {
   echo $_SESSION['foto'];
} else {
    
     echo "userlg1.png";
}
              
              ?>" class="img-circle" alt="User Image">
                    <p>
                      Usuario: <?php echo $_SESSION['nombre_de_usuario']; ?>
	                 <!--<small>Member since Nov. 2012</small>-->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                 <!--     <a href="#!" class="btn btn-info btn-block"><i class='fa fa-unlock'></i>Cambiar Pass</a>
                    <form action="valida_clave.php" method="post" autocomplete="off">
                    <INPUT type=password class="text text-warning btn-block" placeholder='Actual' required="" name="actual"> <INPUT type=password class="text text-warning btn-block" placeholder='Nuevo' required="" name="nuevo">
                    <p class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">Cambiar Password</button>        
                    </p>
                    </form>-->
                    <a href="index.php" class="btn btn-danger btn-block btn-exit-system"><i class='fa fa-power-off'></i> Salir</a>
                    
                  </li>
                </ul>
              </li>
              
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
