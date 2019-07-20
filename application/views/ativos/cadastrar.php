<!DOCTYPE html>
<html>
  <head>
    <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
    <?php $this->load->view('menus/header'); ?>
    
    <!-- Carrega CSS da página de ativos -->
    <link rel="stylesheet" type="text/css" href=' <?php echo base_url('assets/css/ativos.css'); ?>'>
    <script type="text/javascript" src='<?php echo base_url('assets/js/ativos.js'); ?>'></script>
  </head>

  <body>
     <!-- Carrega o MENU principal comum a todas as páginas (contém o menu) -->
     <?php $this->load->view('menus/menuPrincipal'); ?>   

      <!-- Conteúdo da página -->
      <!-- Menu aba -->
      <div class="d-flex flex-column conteudo">
        <ul class="nav nav-tabs">

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('ativos/'); ?>">Listar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url('ativos/cadastrar'); ?>" id="principal">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('ativos/editar'); ?>">Buscar</a>
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
                Preencha o formulário para cadastrar novo ativo.
                <br>
                Não se esqueça de completar todos os campos!
              </p>
            </div>
        </div>

        <!-- Formulário de cadastro -->  
        <form method="post" action=" <?php echo base_url('ativos/salvar'); ?>">
                    
          <div class="form-row">
          <!-- Exibe nome do produto -->
          <div class="form-group col-md-3">
              <label for="produto">Produto</label>
              <input type="text" class="form-control" id="produto" name="produto" readonly value="CILINDRO DE GÁS BRANCO 190KG">
            </div>
            <!-- Input serial -->
            <div class="form-group col-md-3">
              <label for="serial">Nº Serial</label>
              <input required type="text" class="form-control" id="serial" name="serial">
            </div>

            <!-- Input ano de fabricacao -->
            <div class="form-group col-md-2">
              <label for="ano">Ano de Fabricação</label>
              <input required type="month" class="form-control" id="ano" name="ano">
            </div>            
          </div>
          
        <div class="form-row">
          <!-- Input longitude -->
          <div class="form-group col-md-3">
            <label for="longitude">Longitude</label>
            <input required type="text" class="form-control" id="longitude" name="longitude">
          </div>

          <!-- Input latitude -->
          <div class="form-group col-md-3">
            <label for="latitude">Latitude</label>
            <input required type="text" class="form-control" id="latitude" name="latitude">
          </div>

          <div class="form-group col-md-3 form-inline">
            <button type="button" class="btn btn-secondary mb-2 btnLocal" onClick="obterLocalizacao()"><img src="<?php echo base_url('assets/img/localizacao.png'); ?>"/> Atualizar Localização</button>
          </div>
        </div>

        <div class="form-row">
          <!-- Input fornecedor -->
          <div class="form-group col-md-3">
              <label for="fornecedor">Fornecedor</label>
              <select required id="fornecedor" class="form-control" name="fornecedor">
                <option selected>Selecionar...</option>
                <?php
                foreach ($fornecedores as $fornecedor)
                  {        
                    echo '<option value="'.$fornecedor->cod.'">'.ucfirst($fornecedor->nomeFantasia).'</option>';
                  }
                ?>
              </select>
            </div>
          <!-- Input status -->
          <div class="form-group col-md-3">
            <label for="status">Status</label>
            <select required id="status" class="form-control" name="status" onChange="liberaCampos()">
              <option selected>Selecionar...</option>
              <option value="Em estoque">Em estoque</option>
              <option value="Comodato">Comodato</option>
            </select>
          </div>
        </div>

        <!-- Input cliente -->
        <div class="form-row d-none" id="clientes">
        <div class="form-group col-md-3">
            <label for="cliente">Cliente</label>
            <select id="cliente" class="form-control" name="cliente">
              <option selected>Selecionar...</option>
              <?php
              foreach ($clientes as $cliente)
                {        
                  echo '<option value="'.$cliente->cod.'">'.ucfirst($cliente->nomeFantasia).'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Input data de comodato -->
          <div class="form-group col-md-3">
              <label for="data">Data do comodato</label>
              <input type="date" class="form-control" id="data" name="data">
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
              <div class="form-group col-md-8 alert alert-success">
                <?php echo $this->session->userdata('error'); ?>
              </div>
            </div>
          <?php } ?>        

        <div class="form-row">
          <div class="form-group col-md-8">
            <a href="<?php echo base_url('ativos'); ?>"class="btn btn-secondary">Voltar</a>
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