<!DOCTYPE html>
<html>
  <head>
    <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
    <?php $this->load->view('menus/header'); ?>
    
    <!-- Carrega CSS da página de ativos -->
    <link rel="stylesheet" type="text/css" href=' <?php echo base_url('assets/css/ativos.css'); ?>'>
    <script type="text/javascript" src='<?php echo base_url('assets/js/ativos.js'); ?>'></script>    
  </head>

  <body onLoad="loaded()">
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
            <a class="nav-link" href="<?php echo base_url('ativos/cadastrar'); ?>">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url('ativos/editar'); ?>" id="principal">Buscar</a>
          </li>
          
        </ul>
      </div>
      
      <!-- Corpo aba -->
      <div class="d-flex flex-column corpoAba">    

        <div class="p-2" id="qr">                             
          <img id="qrcode" src="<?php if ($ativos != null) echo base_url('ativos/gerarCode/'.$ativos->cod); else echo '#';?>"/>       
              
          <div class="print">
            <button onClick="print()" class="btn btn-secondary"><img src="<?php echo base_url('assets/img/impressao.png'); ?>"/> Imprimir</button>            
          </div>
        </div>
      

        
      <div class="p-2">
        <!-- Formulário de busca -->
        <form method="post" action=" <?php echo base_url('ativos/buscar');?>">
          <div class="form-row">
            <!-- Input Codigo -->
              <div class="form-group col-md-3">
                <label for="cod">ID</label>
                <div class="input-group mb-3">
                      <input 
                      required
                      type="text" 
                      class="form-control" 
                      id="cod" 
                      name="cod" 
                      value="<?php if ($ativos != null) echo $ativos->cod; ?>">
                  <div class="input-group-append">
                    <input type="submit" value="Buscar" class="btn btn-outline-secondary" id="buscar" name="buscar">
                  </div>
                </div>
              <!-- Form group End-->
              </div>  

              <!-- Input exibe o produto -->
            <div class="form-group col-md-5">
                <label for="produto">Produto</label>
                <input type="text" class="form-control" id="produto" name="produto" readonly value="CILINDRO DE GÁS BRANCO 190KG">
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
        <form method="post" action=" <?php echo base_url('ativos/alterar'); ?>">        

          <div class="form-row">
            
            <!-- recupera codigo -->
            <div class="d-none">
              <label for="cod">ID</label>
                <input 
                type="text" 
                id="cod" 
                name="cod" 
                value="<?php if ($ativos != null) echo $ativos->cod; echo ""; ?>">
            </div>
            <!-- Input serial -->
            <div class="form-group col-md-3">
              <label for="serial">Nº Serial</label>
              <input 
                type="text" 
                class="form-control" 
                id="serial" 
                name="serial"
                <?php if ($ativos == null) echo "readonly"; ?>
                value="<?php if ($ativos != null) echo $ativos->serial; echo "";?>"
              >
            </div>
            <!-- Input ano de fabricacao -->
            <div class="form-group col-md-2">
              <label for="ano">Ano de Fabricação</label>
              <input 
                type="month" 
                class="form-control" 
                id="ano" 
                name="ano"
                <?php if ($ativos == null) echo "readonly"; ?>
                value="<?php if ($ativos != null) echo $ativos->fabricacao; echo "";?>"
              >
            </div>      

             <!-- Input fornecedor -->
            <div class="form-group col-md-3">
              <label for="fornecedor">Fornecedor</label>
              <select id="fornecedor" class="form-control" name="fornecedor" <?php if ($ativos == null) echo "disabled"; else echo "disabled"?>>
                <option selected>Selecionar...</option>
                <?php
                foreach ($fornecedores as $fornecedor)
                  {                     
                    echo '<option value="'.$fornecedor->nomeFantasia.'">'.ucfirst($fornecedor->nomeFantasia).'</option>';
                    if ($historico->fornecedor != null){
                      if ($fornecedor->cod == $historico->fornecedor) echo '<option selected value="'.$fornecedor->nomeFantasia.'">'.ucfirst($fornecedor->nomeFantasia).'</option>';                    
                    }
                  }
                ?>
              </select>
            </div>      
          </div>

          <div class="form-row"> 
            <div class="form-group col-md-3">
              <label for="local">Localização</label>
                <input                   
                  type="text" 
                  class="form-control" 
                  id="local" 
                  name="local"
                  readonly
                  value="<?php if ($ativos != null) { 
                    if ($ativos->status == "Em estoque") echo "Base Operacional"; 
                    if ($ativos->status == "Comodato") {
                      if ($historico != null) echo $historico->cliente;
                    }
                  } else echo "";?>"
                >
            </div>
            <!-- Input status -->
            <div class="form-group col-md-3">
                <label for="status">Status</label>
                <select required id="status" class="form-control" onChange="liberaCampos()" <?php if ($ativos == null) echo "disabled";?>>
                  <option selected>Selecionar...</option>
                  <option <?php if ($ativos->status == "Em estoque") echo "selected"; ?> value="Em estoque">Em estoque</option>
                  <option <?php if ($ativos->status == "Comodato") echo "selected"; ?> value="Comodato">Comodato</option>              
                </select>
              </div>
          </div>
          
          <div class="form-row">
            <!-- Input longitude -->
            <div class="form-group col-md-3">
              <label for="longitude">Longitude</label>
              <input 
                required
                type="text" 
                class="form-control" 
                id="longitude" 
                name="longitude"
                <?php if ($ativos == null) echo "readonly"; ?>
                value="<?php if ($ativos != null) echo $ativos->longitude; echo "";?>"
              >
            </div>
            <!-- Input latitude -->
            <div class="form-group col-md-3">
              <label for="latitude">Latitude</label>
              <input 
                required
                type="text" 
                class="form-control" 
                id="latitude" 
                name="latitude"
                <?php if ($ativos == null) echo "readonly"; ?>
                value="<?php if ($ativos != null) echo $ativos->latitude; echo "";?>"
              >
            </div>

            <div class="form-group col-md-3 form-inline">
              <button type="button" class="btn btn-secondary mb-2 btnLocal" onClick="obterLocalizacao()"><img src="<?php echo base_url('assets/img/localizacao.png'); ?>"/> Atualizar Localização</button>
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
                  echo '<option value="'.$cliente->nomeFantasia.'">'.ucfirst($cliente->nomeFantasia).'</option>';
                  if ($historico->cliente != null){
                    if ($cliente->cod == $historico->cliente) echo '<option selected value="'.$cliente->nomeFantasia.'">'.ucfirst($cliente->nomeFantasia).'</option>';                    
                  }
                }
                ?>
              </select>
            </div>

            <!-- Input data de comodato -->
            <div class="form-group col-md-3">
              <label for="data">Data do comodato</label>
              <input 
                type="date" 
                class="form-control" 
                id="data" 
                name="data"
                <?php if ($ativos == null) echo "readonly"; ?>
                value="<?php if ($historico != null) echo $historico->data; echo "";?>"
                >
            </div>   
          <!-- Input cliente End-->      
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

          <div class="form-row">
            <div class="form-group col-md-8">
              <a href="<?php echo base_url('ativos'); ?>"class="btn btn-secondary">Voltar</a>
              <a href="<?php if ($ativos != null) echo base_url('ativos/excluir/'.$ativos->cod); echo "#"; ?>"class="btn btn-danger">Excluir</a>
              <input type="submit" value="Confirmar" class="btn btn-secondary" id="salvar" name="salvar">
            </div>
          <div>

        </form>     
      
            
      </div>

      </div>

      <div class="p-2 flex-column justify-content-center">
            <div class="row">
              <div class="col">
              <h4> HISTÓRICO </h4>
               <!-- Tabela com os ativos cadastrados -->
                <table class="table table-hover table-sm text-center">
                  <!-- Cabeçalho da tabela -->
                  <thead class="table-active">
                    <tr>
                      <th scope="col">Operação</th>
                      <th scope="col">Data</th>
                      <th scope="col">Cliente</th>
                    </tr>
                  </thead>
                  <!-- Corpo da tabela -->
                  <tbody>
                    <?php                  
                      if($historico != null){
                       
                          echo '<tr scope="row">';
                            echo '<td>'.$historico->operacao.'</td>'; 
                            echo '<td>'.$historico->data.'</td>'; 
                            if ($historico->cliente != null){
                              foreach ($clientes as $cliente)
                                {                                             
                                  if ($cliente->cod == $historico->cliente) echo '<td>'.ucfirst($cliente->nomeFantasia).'</td>';                                                    
                                }
                            }           
                          echo '</tr>';
                        }                                        
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
      </div>
            
      
    <!-- Body end-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </body>
</html>