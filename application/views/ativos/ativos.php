<!DOCTYPE html>
<html>
  <head>
    <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
    <?php $this->load->view('menus/header'); ?>
    
    <!-- Carrega CSS da página de ativos -->    
    <link rel="stylesheet" type="text/css" href=' <?php echo base_url('assets/css/ativos.css'); ?>'>
  </head>

  <body>
     <!-- Carrega o MENU principal comum a todas as páginas -->
     <?php $this->load->view('menus/menuPrincipal'); ?> 

      <!-- Conteúdo da página -->
      <!-- Menu de ações -->
      <div class="d-flex flex-column conteudo">
        <ul class="nav nav-tabs">

          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url('ativos/'); ?>" id="principal">Listar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('ativos/cadastrar'); ?>">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('ativos/editar'); ?>">Buscar</a>
          </li>

        </ul>
      </div>
      <!-- Menu de ações end-->
      
      <!-- Corpo da página -->
      <div class="d-flex flex-column corpoAba">

            <!-- Tabela com os ativos cadastrados -->
            <table class="table table-hover table-sm text-center">
              <!-- Cabeçalho da tabela -->
              <thead class="table-active">
                <tr>
                  <th scope="col">Id.</th>
                  <th scope="col">Serial</th>
                  <th scope="col">Ano de Fabricação</th>
                  <th scope="col">Status</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <!-- Corpo da tabela -->
              <tbody>
                <?php                  
                  $contador = 0;
                  foreach ($ativos as $ativo)
                  {        
                      echo '<tr scope="row">';
                        echo '<td>'.$ativo->cod.'</td>'; 
                        echo '<td>'.$ativo->serial.'</td>'; 
                        echo '<td>'.$ativo->fabricacao.'</td>'; 
                        echo '<td>'.$ativo->status.'</td>'; 
                        echo '<td >';
                          echo '<a href="'.base_url('ativos/buscar/'.$ativo->cod.'').'"title="Editar cadastro" class="btn btn-secondary"><img src="'.base_url('assets/img/editar.png').'"></a>';
                          echo ' <a href="'.base_url('ativos/excluir/'.$ativo->cod.'').'"title="Apagar cadastro" class="btn btn-danger"><img src="'.base_url('assets/img/excluir.png').'"/></a>';
                        echo '</td>'; 
                      echo '</tr>';
                  $contador++;
                  }
                ?>
              </tbody>
            </table>
            <!-- Tabela End -->

            <!-- Exibe quantidade de registros que foram encontrados -->
            <div class="row">
              <div class="col-md-12">
                Todal de Registros: <?php echo $contador ?>
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
            <?php } ?>
            <?php if($this->session->has_userdata('error')){ ?>
              <div class="form-row">
                <!-- Mensagem -->
                <div class="form-group col-md-8 alert alert-secondary">
                  <?php echo $this->session->userdata('error'); ?>
                </div>
              </div>
            <?php } ?>        
        <!-- Corpo da página End-->
        </div>
    <!-- Body end-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </body>
</html>