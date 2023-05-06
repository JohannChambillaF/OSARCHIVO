<!--LINKS DE CONEXION-->
<?php include 'conexion/conexion.php'; ?>
<!--LINKS DE JS Y CSS ESTAN EN LINKS.PHP-->
<?php include('proyecto/componentes/links.php') ?>
  </head>
  <body>
  <main>
<!--TODO EL SIDEBARS SE CARGA DESDE SIDEBARS.PHP-->
  <?php include('proyecto/componentes/sidebars.php') ?>

  <div class="b-example-divider"></div>
  <div class="col-sm-10">
    <div id="resultado">
      <div style="background:#2C3E50; height:100px;">
          <h4 style="font-family: 'Roboto',sans-serif; font-weight: 700; color:white; text-align:right; padding:30px;">OFICINA DE SERVICIOS ACADEMICOS</h4>
      </div>
      <!-- Masthead-->
      <header class="masthead bg-primary text-white text-center">
        <div class="d-flex align-items-center flex-column" style="background: #1ABC9C; height:600px;">
            <!-- Masthead Avatar Image-->
            <img style="margin-top: 100px; filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.9));" src="librerias/img/avatar.png" width="220" height="250"/>
            <!-- Masthead Heading-->
            <h1 style="font-size: 4rem; font-family: 'Roboto',sans-serif; font-weight: 700; margin-top: 50px;">BIENVENIDO</h1>
            <span class="fs-4 ms-2">Administrador</span>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
        </div>
      </header>
      <div class="row" style="width: 1570px; padding:50px; ">
        <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card border-start border-4" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.6));border-color: #6200EA;--bs-border-color: #6200EA;">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">
                            <?php
                                $sql = "SELECT * FROM registro	WHERE tipo = 'CONFORMIDAD' && estado = 'COMPLETO'";
                                $query = mysqli_query($conexion, $sql);
                                $total   = mysqli_num_rows($query);
                                echo"$total";
                            ?>    
                            </div>
                            <div class="card-text" style="color:#656565;">Conformidad de Documentos</div>
                        </div>
                        <div class="text-white text-center" style=" width: 50px; height: 50px; border-radius: 50%; background-color: #6200EA;">
                            <img style="margin-top: 10px; width: 25px; height: 30px; " src="librerias/img/check.png"/>
                        </div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-arrow-up-long icon-xs text-success" style="padding:5px;"></i>
                            <div class="caption text-success fw-500 me-2" style="font-size: 12px;">2019-2023</div>
                            <div class="caption" style="font-size: 12px;color:#656565;">Presencial y Semipresencial</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card border-start border-4" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.6));border-color: #FFB300;--bs-border-color: #FFB300;">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">
                            <?php
                                $sql = "SELECT * FROM registro	WHERE tipo = 'OFICIO' && estado = 'COMPLETO'";
                                $query = mysqli_query($conexion, $sql);
                                $total   = mysqli_num_rows($query);
                                echo"$total";
                            ?>    
                            </div>
                            <div class="card-text" style="color:#656565;">Expedientes</div>
                        </div>
                        <div class="text-white text-center" style=" width: 50px; height: 50px; border-radius: 50%; background-color: #FFB300;">
                            <img style="margin-top: 12px; width: 25px; height: 25px; " src="librerias/img/box.png"/>
                        </div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-arrow-up-long icon-xs text-success" style="padding:5px;"></i>
                            <div class="caption text-success fw-500 me-2" style="font-size: 12px;">2019-2023</div>
                            <div class="caption" style="font-size: 12px;color:#656565;">Presencial y Semipresencial</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card border-start border-4" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.6));border-color: #9C27B0;--bs-border-color: #9C27B0;">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">
                            <?php
                                $sql = "SELECT * FROM registro	WHERE tipo = 'CONFORMIDAD' && estado = 'OBSERVADO'";
                                $query = mysqli_query($conexion, $sql);
                                $total   = mysqli_num_rows($query);
                                echo"$total";
                            ?>    
                            </div>
                            <div class="card-text" style="color:#656565;">Cartas</div>
                        </div>
                        <div class="text-white text-center" style=" width: 50px; height: 50px; border-radius: 50%; background-color: #9C27B0;">
                            <img style="margin-top: 11px; width: 28px; height: 28px; " src="librerias/img/error.png"/>
                        </div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-arrow-up-long icon-xs text-success" style="padding:5px;"></i>
                            <div class="caption text-success fw-500 me-2" style="font-size: 12px;">2019-2023</div>
                            <div class="caption" style="font-size: 12px;color:#656565;">Presencial y Semipresencial</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 mb-5">
            <div class="card border-start border-4" style="filter: drop-shadow(0px 0px 5px rgba(0, 0, 0, 0.6));border-color: #26A69A;--bs-border-color: #26A69A;">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="me-2">
                            <div class="display-5">
                            <?php
                                $sql = "SELECT * FROM registro	WHERE tipo = 'CONFORMIDAD' && estado = 'COMPLETO'";
                                $query = mysqli_query($conexion, $sql);
                                $total   = mysqli_num_rows($query);
                                echo"$total";
                            ?>    
                            </div>
                            <div class="card-text" style="color:#656565;">Resoluciones</div>
                        </div>
                        <div class="text-white text-center" style=" width: 50px; height: 50px; border-radius: 50%; background-color: #26A69A;">
                            <img style="margin-top: 10px; width: 30px; height: 30px; " src="librerias/img/lupa.png"/>
                        </div>
                    </div>
                    <div class="card-text">
                        <div class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-arrow-up-long icon-xs text-success" style="padding:5px;"></i>
                            <div class="caption text-success fw-500 me-2" style="font-size: 12px;">2019-2023</div>
                            <div class="caption" style="font-size: 12px;color:#656565;">Presencial y Semipresencial</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
      </div>
    </div>
  </div>
</div>
</main>
</body>
</html>