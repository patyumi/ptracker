<!DOCTYPE html>
<html>
  <head>
    <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
    <?php $this->load->view('menus/header'); ?>
    
    <!-- Carrega CSS da página de ativos -->
    <link rel="stylesheet" type="text/css" href=' <?php echo base_url('assets/css/fornecedores.css'); ?>'>
  </head>

  <body>
     <!-- Carrega o MENU principal comum a todas as páginas (contém o menu) -->
     <?php $this->load->view('menus/menuPrincipal'); ?>   

      <!-- Conteúdo da página -->

      <!-- Menu aba -->
      <div class="d-flex flex-column conteudo">

        <ul class="nav nav-tabs">

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('fornecedores/'); ?>">Listar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('fornecedores/cadastrar'); ?>">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url('fornecedores/editar'); ?>" id="principal">Buscar</a>
          </li>
          
        </ul>
      </div>
      
      <!-- Corpo aba -->
      <div class="d-flex flex-column corpoAba">    

        <!-- Formulário de busca -->
        <form method="post" action=" <?php echo base_url('fornecedores/buscar/');?>">
          <div class="form-row">
            <!-- Input Codigo -->
              <div class="form-group col-md-2">
                <label for="cod">ID</label>
                <div class="input-group mb-3">
                      <input 
                      type="text" 
                      class="form-control" 
                      id="cod" 
                      name="cod" 
                      value="<?php if ($fornecedor != null) echo $fornecedor->cod; ?>"
                  >
                  <div class="input-group-append">
                    <input type="submit" value="Buscar" class="btn btn-outline-secondary" id="buscar" name="buscar">
                  </div>
                </div>
              <!-- Form group End-->
              </div>
            <!-- Form row End-->
            </div>

            <!-- Alertas -->
            <?php if($this->session->has_userdata('error')){ ?>
              <div class="form-row">
                <!-- Mensagem -->
                <div class="form-group col-md-4 alert alert-secondary">
                  <?php echo $this->session->userdata('error'); ?>
                </div>
              </div>
            <?php } ?>        
        </form>

        <!-- Formulário de cadastro -->  
        <form method="post" action=" <?php echo base_url('fornecedores/alterar'); ?>">                 

          <div class="form-row">
          <!-- recupera codigo -->
          <div class="d-none">
              <label for="cod">ID</label>
                <input 
                type="text" 
                id="cod" 
                name="cod" 
                value="<?php if ($fornecedor != null) echo $fornecedor->cod; echo ""; ?>"
              >
          </div>
          <!-- Input CNPJ -->
            <div class="form-group col-md-4">
              <label for="cnpj">CNPJ</label>
              <input 
                required
                type="text" 
                class="form-control" 
                id="cnpj" 
                name="cnpj" 
                <?php if ($fornecedor == null) echo "readonly"; ?>
                value="<?php if ($fornecedor != null) echo $fornecedor->cnpj; echo "";?>"
              >
            </div>

            <!-- Input Nome Fantasia -->
            <div class="form-group col-md-4">
              <label for="nomeFantasia">Nome Fantasia</label>
              <input 
                required
                type="nomeFantasia" 
                class="form-control" 
                id="nomeFantasia" 
                name="nomeFantasia" 
                <?php if ($fornecedor == null) echo "readonly"; ?>
                value="<?php if ($fornecedor != null) echo $fornecedor->nomeFantasia; echo "";?>"
              >
            </div>
          </div>
          
        <div class="form-row">
          <!-- Input Endereço -->
          <div class="form-group col-md-8">
            <label for="endereco">Endereço</label>
            <input 
              required
              type="text" 
              class="form-control" 
              id="endereco" 
              name="endereco" 
              placeholder="Ex.: Rua Um, nº 23 - Bairro Betim, Belo Horizonte (MG)" 
              <?php if ($fornecedor == null) echo "readonly"; ?>
              value="<?php if ($fornecedor != null) echo $fornecedor->endereco; echo "";?>"
            >
          </div>
        </div>

        <div class="form-row">
          <!-- Input Telefone -->
          <div class="form-group col-md-4">
            <label for="telefone">Telefone</label>
            <input 
              required
              type="text" 
              class="form-control" 
              id="telefone" 
              name="telefone" 
              <?php if ($fornecedor == null) echo "readonly"; ?>
              value="<?php if ($fornecedor != null) echo $fornecedor->telefone; echo "";?>"
              >
          </div>

          <!-- Input E-mail -->
          <div class="form-group col-md-4">
            <label for="email">E-mail</label>
            <input 
              required
              type="text" 
              class="form-control" 
              id="email" 
              name="email" 
              <?php if ($fornecedor == null) echo "readonly"; ?>
              value="<?php if ($fornecedor != null) echo $fornecedor->email; echo "";?>"
            >
          </div>
        </div>

         <!-- Alertas -->
         <?php if($this->session->has_userdata('success')){ ?>
            <div class="form-row">
            <!-- Mensagem -->
              <div class="form-group col-md-8 alert alert-success">
                <?php echo $this->session->userdata('success'); ?>
              </div>
            </div>
            </div>
          <?php } ?>
          <?php if($this->session->has_userdata('error')){ ?>
            <div class="form-row">
              <!-- Mensagem -->
              <div class="form-group col-md-8 alert alert-secondary">
                <?php echo $this->session->userdata('error'); ?>
              </div>
            </div>
          <?php } ?>        

        <div class="form-row">
          <div class="form-group col-md-8">
            <a href="<?php echo base_url('fornecedores'); ?>"class="btn btn-secondary">Voltar</a>
            <a href="<?php if ($fornecedor != null) echo base_url('fornecedores/excluir/'.$fornecedor->cod); echo "#"; ?>"class="btn btn-danger">Excluir</a>
            <input type="submit" value="Confirmar" class="btn btn-secondary" id="salvar" name="salvar">
          </div>
        <div>
      </form>
    </div>
    <!-- Body end-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </body>
</html>