<div class="d-flex flex-column flex-shrink-0 p-2 text-white" style="width: 280px; background:#2C3E50;">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="margin-top: 35px;" >
      <img src="librerias/img/libro.png" width="40" height="32"></svg>
      <span class="fs-4 ms-2">OSA ARCHIVO</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" onclick="CargarBusqueda()" class="nav-link text-white" aria-current="page" style="margin-top: 20px;" >
          <i class="fa-solid fa-magnifying-glass"></i>
          <span class="ms-2 d-none d-sm-inline">Busqueda</span>
        </a>
      </li>
      <!---------------------------------------------->  
      <li class="nav-item">
        <a href="#subconfor" data-bs-toggle="collapse" class="nav-link text-white" aria-current="page" style="margin-top: 10px;" >
          <i class="fa-solid fa-file-circle-check"></i>
          <span class="ms-2 d-none d-sm-inline">Conformidad Doc</span><i class="ms-2 fa-solid fa-angle-down"></i>
        </a>
        <ul class="collapse nav flex-column ms-1" id="subconfor" data-bs-parent="#menu">
            <li class="w-100">
                <a href="#" onclick="CargarConformidad()" class="nav-link text-white px-5" aria-current="page" style="margin-top: 5px;" >
                <i class="fa-regular fa-pen-to-square"></i>
                <span class="d-none d-sm-inline">Registrar Confor</span></a>
            </li>
            <li class="w-100">
            <a href="#" onclick="RevisarConformidad()" class="nav-link text-white px-5" aria-current="page" style="margin-top: 5px;" >
                <i class="fa-solid fa-list-check"></i>
                <span class="d-none d-sm-inline">Revisar Confor</span></a>
            </li>
        </ul>
      </li>
      <!---------------------------------------------->  
      <li class="nav-item">
        <a href="#suboficio" data-bs-toggle="collapse" class="nav-link text-white" aria-current="page" style="margin-top: 10px;" >
          <i class="fa-regular fa-folder-closed"></i>
          <span class="ms-2 d-none d-sm-inline">Solicitud Exp</span><i class="ms-2 fa-solid fa-angle-down"></i>
        </a>
        <ul class="collapse nav flex-column ms-1" id="suboficio" data-bs-parent="#menu">
            <li class="w-100">
                <a href="#" onclick="CargarOficio()" class="nav-link text-white px-5" aria-current="page" style="margin-top: 5px;" >
                <i class="fa-regular fa-pen-to-square"></i>
                <span class="d-none d-sm-inline">Registrar Oficio</span></a>
            </li>
            <li class="w-100">
            <a href="#" onclick="ExpRevisar()" class="nav-link text-white px-5" aria-current="page" style="margin-top: 5px;" >
                <i class="fa-solid fa-list-check"></i>
                <span class="d-none d-sm-inline">Revisar Expediente</span></a>
            </li>
        </ul>
      </li>
      <!---------------------------------------------->  
      <li>
        <a href="#" class="nav-link text-white" aria-current="page" style="margin-top: 10px;" >
          <i class="fa-solid fa-magnifying-glass"></i>
          <span class="ms-2 d-none d-sm-inline">Expedientes a Revisar</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <i class="fa fa-table"></i>
          <span class="ms-2 d-none d-sm-inline">Products</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <i class="fa fa-table"></i>
          <span class="ms-2 d-none d-sm-inline">Products</span>
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="librerias/img/ujcm.png" width="32" height="37">
        <h6 class="ms-2">Ing. Johann Chambilla</h6>
      </a>
    </div>
  </div>