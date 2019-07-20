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
            <a class="nav-link active" href="<?php echo base_url('fornecedores/cadastrar'); ?>" id="principal">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('fornecedores/editar'); ?>">Buscar</a>
          </li>
          
        </ul>
      </div>
      
      <!-- Corpo aba -->
      <div class="d-flex flex-column corpoAba">    
                    
        <div class="form-row fistLine">
          <!-- Mensagem -->
            <div class="form-group col-md-8 bg-light">
              <p>
                <img src="<?php echo base_url('assets/img/atencao.png'); ?>" class="float-left"/>
                Preencha o formulário para cadastrar novo fornecedor.
                <br>
                Não se esqueça de completar todos os campos!
              </p>
            </div>
        </div>
        <!-- Formulário de cadastro -->  
        <form method="post" action=" <?php echo base_url('fornecedores/salvar'); ?>">
                    
          <div class="form-row">
          <!-- Input CNPJ -->
            <div class="form-group col-md-4">
              <label for="cnpj">CNPJ</label>
              <input required type="text" class="form-control" id="cnpj" name="cnpj">
            </div>
            <!-- Input Nome Fantasia -->
            <div class="form-group col-md-4">
              <label for="nomeFantasia">Nome Fantasia</label>
              <input required type="nomeFantasia" class="form-control" id="nomeFantasia" name="nomeFantasia">
            </div>

          </div>
          
        <div class="form-row">
          <!-- Input Endereço -->
          <div class="form-group col-md-8">
            <label for="endereco">Endereço</label>
            <input required type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex.: Rua Um, nº 23 - Bairro Betim, Belo Horizonte (MG)">
          </div>

        </div>

        <div class="form-row">
          <!-- Input Telefone -->
          <div class="form-group col-md-4">
            <label for="telefone">Telefone</label>
            <input required type="text" class="form-control" id="telefone" name="telefone">
          </div>
          <!-- Input E-mail -->
          <div class="form-group col-md-4">
            <label for="email">E-mail</label>
            <input required type="text" class="form-control" id="email" name="email">
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
            <input type="submit" value="Confirmar" class="btn btn-secondary" id="salvar" name="salvar">
          </div>
        <div>
        
      <!-- Form End -->
      </form>    
    <!-- Corpo da página End-->
    </div>
    <!-- Body end-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </body>
</html>