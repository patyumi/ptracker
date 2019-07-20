<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
        <?php $this->load->view('menus/header'); ?>

        <!-- Carrega CSS da página de login -->
        <link rel="stylesheet" type="text/css" href=" <?php echo base_url('assets/css/login.css'); ?> "/>
    </head>

    <body>
        <!-- Barra lareal de informações -->
        <div class="sidenav">
            <div class="login-main-text">
                <!-- Logo -->
                <h3 class="logoText"><img src="<?php echo base_url('assets/img/logo.png'); ?>" class="logoImg"/>p-tracker</h3>

                <h3>Fazer Login</h3>
                <p>Não possui acesso? Comunique o seu gestor!</p>
            </div>
        </div>
      
        <!-- Contém o formulário para login -->
        <div class="main">
            <div class="col-md-6 col-sm-12">
            
                <!-- Formulário -->
                <div class="login-form">
                    <form method="post" action=" <?php echo base_url('Setup/Login'); ?>">

                        <!-- Inserir e-mail -->
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" placeholder="Ex.: jane@hotmail.com">
                            <span> <?php echo form_error('email'); ?></span>
                        </div>

                        <!-- Inserir senha -->
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="senha" class="form-control">
                            <span> <?php echo form_error('senha'); ?></span>
                        </div>

                        <!-- Botão para fazen login -->
                        <button type="submit" class="btn btn-black">Entrar</button>                        
                    </form>
                </div>
                <!-- Formulário End -->
                
            </div>
        </div>

    <!-- Body End -->
    </body>
</html>