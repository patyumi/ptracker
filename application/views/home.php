<!DOCTYPE html>
<html>

    <head>
        <!-- Carrega o conteúdo principal comum a todas as páginas (contém meta tags, links para CSS...) -->
        <?php $this->load->view('menus/header'); ?>

        <!-- Carrega CSS da página principal -->
        <link rel="stylesheet" type="text/css" href=' <?php echo base_url('assets/css/dashboard.css'); ?>'>
        <script type="text/javascript" src='<?php echo base_url('assets/js/dashboard.js'); ?>'></script> 
    </head>


    <body>
        <!-- Carrega o MENU principal comum a todas as páginas -->
        <?php $this->load->view('menus/menuPrincipal'); ?>

        <!-- Page Content -->

        <!-- 1ª linha -->
        <div class="d-flex justify-content-center align-items-center">
            <!-- Box: Total de ativos cadastrados -->
            <section class="p-2 shadow-sm num">
                <h6 class="text-center"> TOTAL DE ATIVOS CADASTRADOS </h6>
                <h1 class="text-center align-self-center" id="ativos"><?php echo $totalAtivos; ?></h1>
            </section>
            
            <!-- Box: Total de ativos em estoque -->
            <section class="p-2 shadow-sm num">
                <h6 class="text-center"> TOTAL DE ATIVOS EM ESTOQUE</h6>
                <h1 class="text-center align-self-center" id="estoque"><?php echo $estoque; ?></h1>                
                <h1 class="d-none" id="comodato"><?php echo $comodato; ?></h1>
            </section>

        </div>

        <!-- 2ª linha -->
        <div class="d-flex justify-content-center">
            <!-- Box: Gráfico -->
            <section class="p-2 shadow-sm">
                <div class="caja-pie"></div>

            </section>

            <!-- Box: Log -->
            <section class="p-2 shadow-sm">
            <table class="table table-hover table-sm text-center">
              <!-- Cabeçalho da tabela -->
              <thead class="table-active">
                <tr>
                  <th scope="col">Operação</th>
                  <th scope="col">Ativo</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <!-- Corpo da tabela -->
              <tbody>
                <?php                  
                  foreach ($historico as $historico)
                  {        
                      echo '<tr scope="row">';
                        echo '<td>'.$historico->operacao.'</td>'; 
                        echo '<td>'.$historico->ativo.'</td>'; 
                        echo '<td>'.$historico->data.'</td>'; 
                      echo '</tr>';
             
                  }
                ?>
              </tbody>
            </table>
            </section>
        </div>
        
        <div class="d-flex justify-content-center">
            <a href="https://play.google.com/store/apps/details?id=com.teacapps.barcodescanner&hl=pt_BR" class="btn btn-secondary" target="_blank">Baixar Leitor QR Code</a>
        </div>

        <script>
            $(function () {
            //paletas de colores
            var theme1 =  ['#90CAF9', '#FF8A65', '#CDDC39', '#FFEB3B', '#FFC107'];    
            var theme2 =  ['#EEEEEE', '#BDBDBD', '#9E9E9E', '#616161', '#212121'];
            
            Highcharts.theme = {
                //selecciona paleta de color
                colors:theme1,
            };                
            // Apply the theme
            Highcharts.setOptions(Highcharts.theme);
                
                $(document).ready(function () {
                    var estoque = parseFloat($("#estoque").html());
                    var comodato = parseFloat($("#comodato").html());

                    total = estoque+comodato;
                
                    // Build the chart
                    $('.caja-pie').highcharts({
                        chart: {
                            //color de fondo
                            backgroundColor: '#FFF',
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Gráfico - Ativos Cadastrados'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y}</b>'
                        },
                        plotOptions: {
                            pie: {
                                //color de los bordes
                                borderColor: 'rgba(255,255,255,0.5)',
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        
                        series: [{
                            name: 'Quantidade Total',
                            colorByPoint: true,
                            data: [{
                                name: 'Em estoque',
                                y: estoque                    
                            }, {
                                name: 'Comodato',
                                y: comodato,
                                sliced: true,
                                selected: true
                            }]
                        }]
                    });
                });
            });
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>

        

    <!-- Body end-->
    </body>
</html>