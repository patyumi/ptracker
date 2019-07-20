<div class="block">

  <!-- Barra Horizontal com logo -->
  <div class="mHorizontal shadow-sm p-3 mb-5 bg-white rounded">
      <!-- Logo -->
      <h3 class="float-left logoText"><img src="<?php echo base_url('assets/img/logo.png'); ?>" class="logoImg"/>p-tracker</h3>
      <h3 class="tituloPag">| <?php echo $titulo; ?> </h3>
      <!-- Botão sair -->
      <a class=" float-right nav-link" href="<?php echo base_url('setup/Logout'); ?>">Sair</a>
  </div>

  <!-- Barra vertical com o menu -->
  <div class="mVertical align-middle">
      <ul class="nav flex-column">
        <li class="nav-item firstLi">

            <div class="float-left imgUser">
            <img src="<?php echo base_url('assets/img/usuario.png'); ?>"/>
            </div>

            <div class="text-center">
            <h6> Seja bem-vindo, </h6>
            <h5><?php echo $usuario; ?></h5>
            </div>
        </li>

        <li class="nav-item" id="menu-dash">
            <a class="nav-link" href="<?php echo base_url('home'); ?>"> <img src="<?php echo base_url('assets/img/dash-white.png'); ?>"/> Dashboard</a>
        </li>

        <li class="nav-item" id="menu-ativos">
            <a class="nav-link" href="<?php echo base_url('ativos'); ?>"> <img src="<?php echo base_url('assets/img/gas.png'); ?>"/> Ativos</a>
        </li>

        <li class="nav-item" id="menu-fornecedores">
            <a class="nav-link" href="<?php echo base_url('fornecedores'); ?>"> <img src="<?php echo base_url('assets/img/fornecedores.png'); ?>"/> Fornecedores</a>
        </li>

        <li class="nav-item" id="menu-clientes">
            <a class="nav-link" href="<?php echo base_url('clientes'); ?>"> <img src="<?php echo base_url('assets/img/clientes.png'); ?>"/> Clientes</a>
        </li>
      </ul>
    </div>
<!-- Menu End -->
</div>