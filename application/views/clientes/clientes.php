<!DOCTYPE html>
<html>
  <head>
    <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
    <?php $this->load->view('menus/header'); ?>
    
    <!-- Carrega CSS da página de ativos -->
    <link rel="stylesheet" type="text/css" href=' <?php echo base_url('assets/css/clientes.css'); ?>'>
  </head>

  <body>
     <!-- Carrega o MENU principal comum a todas as páginas -->
     <?php $this->load->view('menus/menuPrincipal'); ?> 

      <!-- Conteúdo da página -->
      <!-- Menu de ações -->
      <div class="d-flex flex-column conteudo">
        <ul class="nav nav-tabs">

          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url('clientes/'); ?>" id="principal">Listar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('clientes/cadastrar'); ?>">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('clientes/editar'); ?>">Buscar</a>
          </li>

        </ul>
      </div>
      <!-- Menu de ações end-->
      
      <!-- Corpo da página -->
      <div class="d-flex flex-column corpoAba">

            <!-- Tabela com os clientes cadastrados -->
            <table class="table table-hover table-sm text-center">
              <!-- Cabeçalho da tabela -->
              <thead class="table-active">
                <tr>
                  <th scope="col">Id.</th>
                  <th scope="col">Nome Fantasia</th>
                  <th scope="col">CNPJ</th>
                  <th scope="col">Endereço</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <!-- Corpo da tabela -->
              <tbody>
                <?php                  
                  $contador = 0;
                  foreach ($clientes as $cliente)
                  {        
                      echo '<tr scope="row">';
                        echo '<td>'.$cliente->cod.'</td>'; 
                        echo '<td>'.ucfirst($cliente->nomeFantasia).'</td>'; 
                        echo '<td>'.$cliente->cnpj.'</td>'; 
                        echo '<td>'.$cliente->endereco.'</td>'; 
                        echo '<td>'.$cliente->telefone.'</td>'; 
                        echo '<td >';
                          echo '<a href="'.base_url('clientes/buscar/'.$cliente->cod.'').'"title="Editar cadastro" class="btn btn-secondary"><img src="'.base_url('assets/img/editar.png').'"></a>';
                          echo ' <a href="'.base_url('clientes/excluir/'.$cliente->cod.'').'"title="Apagar cadastro" class="btn btn-danger"><img src="'.base_url('assets/img/excluir.png').'"/></a>';
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

        <!-- Corpo da página End-->
        </div>
    <!-- Body end-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </body>
</html>