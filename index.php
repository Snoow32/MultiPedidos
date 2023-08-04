<!-- 
  
* Sistema criado por snoow, todos os direitos reservados.

* Qualquer problema, pergunte no github do projeto original.

-->

<?php
  session_start();
  @include 'config.php';

  if (!isset($_SESSION['cart_id'])) {
    $_SESSION['cart_id'] = session_id();
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-3FKXP959GB"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-3FKXP959GB');
  </script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css">
  <link rel="stylesheet" href="static/css/services/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/services/bootstrap/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
  <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
  <link rel="stylesheet" href="static/css/global/style.css">
  <link rel="stylesheet" href="static/css/global/media.css">
  <style>
    .swal2-popup {
    background: white;
    font-size: 1.5em;
    }

    .swal2-title {
      background: white;
      font-size: 1.5em;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="container">
    <nav class="navbar navbar-dark fixed-top headerb" id="bk">
      <p class="version">V2.1.8</p>
      <div class="container-fluid justify-content-evenly">
        <a class="navbar-brand" id="name-emp">Verggilios</a>
      </div>
    </nav>
  </div>

  <!-- Imagens header -->
  <div class="col container" id="banner">
    <div class="text-center">
      <img src="uploads/bannerNovo.png" class="img-fluid col-md-12 col-lg-10 col-xxl-10" id="banner" alt="verggilios-banner">
      <img src="uploads/Logo2.png" class="img-fluid col-4 col-sm-4 col-lg-3" id="logo" alt="verggilios-logo">
    </div>
  </div>

  <!-- Inf -->
  <div class="container">
    <div class="d-flex justify-content-evenly">
      <div class="bloco1">
        <h2 class="inftxt">Entrega</h2>
        <h2 class="inftxt">15 - 45 min</h2>
      </div>
      <div class="bloco2">
        <h2 class="inftxt">Retirada</h2>
        <h2 class="inftxt">15 min</h2>
      </div>
    </div>
    <div class="d-flex justify-content-around">
      <div class="bloco3 d-flex flex-column align-items-center">
        <h2 class="inftxt">Pagamentos</h2>
        <i class="bi bi-credit-card tm-inf" data-bs-toggle="modal" data-bs-target="#inf-pag"></i>
      </div>
      <div class="bloco4 d-flex flex-column align-items-center">
        <h2 class="inftxt">Horários</h2>
        <i class="bi bi-clock tm-inf" data-bs-toggle="modal" data-bs-target="#inf-hor"></i>
      </div>
      <div class="bloco5 d-flex flex-column align-items-center">
        <h2 class="inftxt">Informações</h2>
        <i class="bi bi-plus-circle tm-inf" data-bs-toggle="modal" data-bs-target="#inf-mais"></i>
      </div>
    </div>
  </div>

  <!-- Barra cardapio -->
  <div class="barra d-flex col-xxl-8" id="barra-cardapio">
    <?php
    $select_categories = mysqli_query($conn, "SELECT * FROM `category_list` WHERE status = 1");
    $first_button = true;

    while ($fetch_category = mysqli_fetch_assoc($select_categories)) {
      $category_id = $fetch_category['id'];

      $button_class = ($first_button) ? 'btn-custom btn-primary flex-fill btn-red' : 'btn-custom btn-primary flex-fill';

      $button_style = ($first_button) ? '' : 'border-bottom: none;';

    ?>
        <button type="button" class="<?php echo $button_class; ?> category-button col-xxl-8" style="<?php echo $button_style; ?>" data-category-id="<?php echo $category_id; ?>"><?php echo strtoupper($fetch_category['name']); ?></button>
    <?php
      $first_button = false;
    }
    ?>
  </div>

  <!-- inf-Pagamento -->
  <div class="modal fade" id="inf-pag" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center justify-content-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-dismiss="modal" aria-label="Close" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Formas de pagamento</h2>
        </div>
        <div class="modal-body">
          <div class="container d-inline-flex align-items-center">
            <i class="bi bi-cash-stack tm-icon-pag"></i>
            <h2 class="font-p-inf">Dinheiro</h2>
          </div>
          <hr>
          <div class="container d-inline-flex align-items-center">
            <i class="bi bi-credit-card tm-icon-pag"></i>
            <h2 class="font-p-inf">Cartões</h2>
          </div>
          <div class="container d-inline-flex align-items-center" style="margin-left: 45px;">
            <i class="bi bi-credit-card-2-front tm-icon-pag"></i>
            <h2 class="font-p-inf">Mastercard</h2>
          </div>
          <div class="container d-inline-flex align-items-center" style="margin-left: 45px;">
            <i class="bi bi-credit-card-2-front tm-icon-pag"></i>
            <h2 class="font-p-inf">Visa</h2>
          </div>
          <hr>
          <div class="container d-inline-flex align-items-center">
            <i class="bi bi-x-diamond-fill tm-icon-pag"></i>
            <h2 class="font-p-inf">Pix</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- inf-Horarios -->
  <div class="modal fade" id="inf-hor" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center justify-content-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-dismiss="modal" aria-label="Close" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Horários de atendimento</h2>
        </div>
        <div class="modal-body">
          <div class="container d-flex justify-content-between">
            <h1>DOMINGO</h1>
            <h3>FECHADO</h3>
          </div>
          <hr>
          <div class="container d-flex justify-content-between">
            <h1>SEGUNDA</h1>
            <h3>9:00h - 18:00h</h3>
          </div>
          <hr>
          <div class="container d-flex justify-content-between">
            <h1>TERÇA</h1>
            <h3>9:00h - 18:00h</h3>
          </div>
          <hr>
          <div class="container d-flex justify-content-between">
            <h1>QUARTA</h1>
            <h3>9:00h - 18:00h</h3>
          </div>
          <hr>
          <div class="container d-flex justify-content-between">
            <h1>QUINTA</h1>
            <h3>9:00h - 18:00h</h3>
          </div>
          <hr>
          <div class="container d-flex justify-content-between">
            <h1>SEXTA</h1>
            <h3>9:00h - 18:00h</h3>
          </div>
          <hr>
          <div class="container d-flex justify-content-between">
            <h1>SABADO</h1>
            <h3>10:00h - 16:00h</h3>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>

  <!-- inf-extra-inf -->
  <div class="modal fade" id="inf-mais" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center justify-content-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-dismiss="modal" aria-label="Close" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Mais Informações</h2>
        </div>
        <div class="modal-body">
          <div class="container d-inline-flex align-items-center">
            <i class="bi bi-geo-alt tm-icon-pag"></i>
            <a class="tm-final" href="https://goo.gl/maps/VdYYSpfwstt5JWG9A" target="_blank">
              Rua contenda - 51 </br>
              Sítio Cercado - Curitiba / PR
            </a>
          </div>
          <hr>
          <div class="container d-inline-flex align-items-center">
            <i class="bi bi-whatsapp tm-icon-pag"></i>
            <a class="tm-final" href="https://wa.me/5541991486760" target="_blank">&#40;41&#41; 9 9148-6760</a>
          </div>
          <hr>
          <div class="container d-inline-flex align-items-center">
            <h2 class="tm-final"></h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3600.090930735525!2d-49.27406012375855!3d-25.53534783706987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dcfb9b07f1a645%3A0x7734e147e38fa157!2sR.%20Contenda%2C%2051%20-%20S%C3%ADtio%20Cercado%2C%20Curitiba%20-%20PR%2C%2081910-100!5e0!3m2!1sen!2sbr!4v1684094551481!5m2!1sen!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Categorias / Produtos -->
  <div class="cardapio_global_all container" id="cardapio_global">
    <section class="products">
      <div class="box-container">
        <?php
        $select_categories = mysqli_query($conn, "SELECT * FROM `category_list` WHERE status = 1");
        while ($fetch_category = mysqli_fetch_assoc($select_categories)) {
          $category_id = $fetch_category['id'];
          ?>
          <h1 id="category-<?php echo $category_id; ?>" class="box-title-id"><?php echo $fetch_category['name']; ?></h1>
          <div class="hr-category"></div>
          <?php
          $select_subcategories = mysqli_query($conn, "SELECT * FROM `subcategory_list` WHERE `category_id` = $category_id");
          if (mysqli_num_rows($select_subcategories) > 0) {
            while ($fetch_subcategory = mysqli_fetch_assoc($select_subcategories)) {
              $subcategory_id = $fetch_subcategory['id'];
              ?>
              <form action="" method="post">
                  <div class="box cat-box justify-content-around" data-bs-toggle="modal" data-bs-target="#carrinho-<?php echo $subcategory_id; ?>" data-subcategory-id="<?php echo $subcategory_id; ?>">
                    <h3><?php echo $fetch_subcategory['name']; ?></h3>
                    <i class="bi bi-cart-check tm-icon"></i>
                    <input type="hidden" name="subcategory_id" value="<?php echo $subcategory_id; ?>">
                  </div>
                </form>

                <!-- Modal Carrinho -->
                <div class="modal fade" id="carrinho-<?php echo $subcategory_id; ?>" tabindex="-1" aria-labelledby="carrinhoLabel" aria-hidden="true">
                  <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                      <div class="modal-header d-flex align-items-center justify-content-center" id="bkheader">
                        <i class="bi bi-chevron-left col-0 order-1" data-bs-dismiss="modal" aria-label="Close" id="closeCard" style="font-size: 20px;"></i>
                        <h3 class="mx-auto order-2" id="text-carrinho"><?php echo $fetch_subcategory['name']; ?></h3>
                      </div>
                      <div class="modal-body">
                        <h1 class="text-center" style="margin-top: 10px;">Sabores</h1>
                        <h2 class="text-center">Pedido mínimo: R$ 5,00</h2>
                        <hr>
                        <div class="container">
                          <?php
                          $products = mysqli_query($conn, "SELECT * FROM `menu_list` WHERE `category_id` = '{$fetch_subcategory['id']}'");
                          if (mysqli_num_rows($products) > 0) {
                            while ($fetch_product = mysqli_fetch_assoc($products)) {
                          ?>
                              <div class="container d-flex justify-content-between">
                                <div>
                                  <h3 class="name-menu"><?php echo $fetch_product['code']; ?> - </h3>
                                  <h3 class="name"><?php echo $fetch_product['name']; ?></h3>
                                  <h4 class="price-menu"><?php echo $fetch_product['description']; ?></h4>
                                  <h3 class="name-menu price-menu-p" id="valor_produto">R$ <?php echo number_format(floatval($fetch_product['price']), 2, ',', '.'); ?></h3>
                                  <input type="hidden" name="product_name[]" value="<?php echo $fetch_product['name']; ?>">
                                  <input type="hidden" name="product_price[]" value="<?php echo $fetch_product['price']; ?>">
                                </div>
                                <div>
                                  <i class="bi bi-dash-lg tm menos hidden" id="menos-<?php echo $fetch_product['id']; ?>"></i>
                                  <span class="num hidden" id="qty-<?php echo $fetch_product['id']; ?>" style="cursor: pointer; font-size: 4em; margin: 25px 8px 0px 8px; vertical-align: text-top;"></span>
                                  <i class="bi bi-plus-lg tm mais" id="mais-<?php echo $fetch_product['id']; ?>"></i>
                                </div>
                              </div>
                          <?php
                            }
                          }
                          ?>
                        </div>
                      </div>
                      <form method="post" id="form_all">
                        <div class="modal-footer justify-content-start" id="bkfooter">
                          <h1>Total: R$<span class="valor_total">0.00</span></h1>
                          <h2 class="col-12">Produtos:</h2>
                          <h2 class="col-12"><span class="produtos_adicionados"></span></h2>
                          <input type="hidden" name="carrinho" id="carrinho-input">
                          <button type="button" class="btn btn-danger disabled" id="proximo" data-bs-toggle="modal" data-bs-target="#finalizar_pedido_label">Próximo<i class="bi bi-chevron-right"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
        </div>
        <?php } } ?>
      <?php } ?>
    </div>
    </section>
  </div>

  <!-- Login -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-login modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="avatar">
            <img src="uploads/Logo2.png" alt="Avatar">
          </div>
          <h4 class="d-inline-block modal-title">Faça seu login</h4>
          <button type="button" class="close" id="bkclose" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <form id="login">
            <div class="form-group user-input">
              <input type="text" name="email" class="form-control form-font" id="email" placeholder="Digite seu email: " required>
            </div>
            <div class="form-group user-input">
              <input type="password" name="senha" class="form-control form-font" id="senha" autocomplete="on" placeholder="Digite a senha: " required>
            </div>
            <div id="btnlogin" class="form-group1 col-6 mx-auto-edit">
              <input type="submit" class="btn btn-primary btn-lg btn-block container-fluid" id="login-usuario-btn" value="Acessar">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a class="container-fluid justify-content-center form-font-2" id="cadlink" data-bs-toggle="modal" data-bs-target="#myModal" href="#">Clique aqui para criar sua conta.</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal registro -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-login modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="avatar">
            <img src="uploads/Logo2.png" alt="Avatar">
          </div>
          <h4 class="modal-title">Cadastro verggilios</h4>
          <button type="button" class="close" id="bkclose" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <form id="register" action="index.php" method="post" onsubmit="submitForm(event)">
            <div class="alert alert-info" id="error-message" style="display: none;"></div>
            <div class="form-group user-input">
              <input type="text" class="form-control required form-font" name="nome" placeholder="Usuario" required>
            </div>
            <div class="form-group user-input">
              <input type="text" class="form-control required form-font" name="email" placeholder="Email" required>
            </div>
            <div class="form-group user-input">
              <input type="password" class="form-control required form-font" name="senha" placeholder="Senha" required>
            </div>
            <div class="form-group user-input">
              <input type="password" class="form-control required form-font" name="repetir_senha" placeholder="Repita sua senha:" required>
            </div>
            <div id="btnlogin" class="form-group col-6 mx-auto">
              <input type="submit" class="btn btn-primary btn-lg btn-block container-fluid" id="register_submit" value="Registrar" name="login"></input>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Área do cliente -->
  <div class="modal fade" id="perfil" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content d-flex flex-column">
        <div class="modal-header d-flex align-items-center justify-content-center text-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-dismiss="modal" aria-label="Close" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Área do cliente</h2>
        </div>
        <div class="modal-body d-flex flex-column">
          <div class="text-center">
            <img class="logo_config_user" src="uploads/user.png" alt="Logo_user">
            <h3 style="font-size: 3em; margin-top: 15px;"><?php include('get_db_user.php'); echo strtoupper(obterNomeUsuario($_SESSION['user_id'])); ?></h3>
          </div>
          <div class="text-center config_options">
            <div class="d-flex align-items-center options" data-bs-toggle="modal" data-bs-target="#enderecos">
              <i class="bi bi-geo-alt"></i>
              <h2 class="config_space">Endereços</h2>
            </div>
            <div class="d-flex align-items-center options" data-bs-toggle="modal" data-bs-target="#historicos">
              <i class="bi bi-clock-history"></i>
              <h2 class="config_space">Historico de pedidos</h2>
            </div>
            <div class="d-flex align-items-center options" data-bs-toggle="modal" data-bs-target="#descontos">
              <i class="bi bi-coin"></i>
              <h2 class="config_space">Descontos</h2>
            </div>
            <div class="d-flex align-items-center options" data-bs-toggle="modal" data-bs-target="#configuracoes">
            <i class="bi bi-gear"></i>
              <h2 class="config_space">Configuracoes</h2>
            </div>
          </div>
          <div class="flex-grow-1"></div>
          <div class="d-flex flex-column align-items-center">
            <h2 class="">ID DO USUARIO:</h2>
            <h3><?php echo $_SESSION['cart_id']; ?></h3>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <?php if (isset($_SESSION['user_id'])) { ?>
            <button type="button" class="btn btn-sm btn-danger" id="sair" style="width: auto;">SAIR DA CONTA</button>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Enderecos -->
  <div class="modal fade" id="enderecos" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content d-flex flex-column">
        <div class="modal-header d-flex align-items-center justify-content-center text-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-toggle="modal" data-bs-target="#perfil" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Enderecos</h2>
        </div>
        <div class="modal-body d-flex flex-column">
          
        </div>
        <div class="modal-footer d-flex justify-content-center">
          
        </div>
      </div>
    </div>
  </div>

  <!-- Historico -->
  <div class="modal fade" id="historicos" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content d-flex flex-column">
        <div class="modal-header d-flex align-items-center justify-content-center text-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-toggle="modal" data-bs-target="#perfil" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Historico de pedidos</h2>
        </div>
        <div class="modal-body d-flex flex-column">
          
        </div>
        <div class="modal-footer d-flex justify-content-center">
          
        </div>
      </div>
    </div>
  </div>

  <!-- Descontos -->
  <div class="modal fade" id="descontos" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content d-flex flex-column">
        <div class="modal-header d-flex align-items-center justify-content-center text-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-toggle="modal" data-bs-target="#perfil" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Descontos</h2>
        </div>
        <div class="modal-body d-flex flex-column">
          
        </div>
        <div class="modal-footer d-flex justify-content-center">
          
        </div>
      </div>
    </div>
  </div>

  <!-- Configuracoes -->
  <div class="modal fade" id="configuracoes" tabindex="-1" aria-labelledby="inf-pagLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content d-flex flex-column">
        <div class="modal-header d-flex align-items-center justify-content-center text-center" id="bkheader">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-toggle="modal" data-bs-target="#perfil" id="closeCard" style="font-size: 20px;"></i>
          <h2 class="mx-auto order-2">Configuracoes</h2>
        </div>
        <div class="modal-body d-flex flex-column">
          
        </div>
        <div class="modal-footer d-flex justify-content-center">
          
        </div>
      </div>
    </div>
  </div>

  <!-- Footer menu -->
  <div class="container">
    <nav class="navbar navbar-dark fixed-bottom" id="bk">
      <div class="container-fluid justify-content-evenly">
        <!-- Menu -->
        <div class="col-md-4 text-center">
          <i class="bi bi-house text-light btn-icon" id="iconuser1" style="font-size: 30px; cursor: pointer; color: white;"></i>
          <p id="textuser1" class="mb-0">Menu</p>
        </div>
        <!-- Login/Register -->
        <div class="col-md-4 text-center" <?php if (isset($_SESSION['user_id'])) { ?> style="display: none;" <?php } ?>>
          <i class="bi bi-person-circle btn-icon" data-bs-toggle="modal" data-bs-target="#loginModal" id="iconuser2" style="font-size: 30px; cursor: pointer; color: white;"></i>
          <p id="textuser2" class="mb-0" style="display: none;">Login</p>
        </div>

        <!-- Config do perfil -->
        <div class="col-md-4 text-center" <?php if (!isset($_SESSION['user_id'])) { ?> style="display: none;" <?php } ?>>
          <i class="bi bi-gear btn-icon" data-bs-toggle="modal" data-bs-target="#perfil" id="iconuser3" style="font-size: 30px; cursor: pointer; color: white;"></i>
          <p id="textuser3" class="mb-0" style="display: none;">Configuracoes</p>
        </div>
      </div>
    </nav>
  </div>

  <!-- Bug do footer fixed -->
  <div class="footer_none">
    <footer style="background-color: white;">
      <div class="container">
        <section>
          <div class="espace"></div>
        </section>
      </div>
    </footer>
  </div>

  <!-- Modal Finalizar Pedido -->
  <div class="modal fade" id="finalizar_pedido_label" tabindex="-1" aria-labelledby="finalizar_pedido_label" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <!-- header -->
        <div class="modal-header d-flex align-items-center justify-content-center" id="bkheader" style="padding: 9px;">
          <i class="bi bi-chevron-left col-0 order-1" data-bs-dismiss="modal" aria-label="Fechar" style="font-size: 20px; cursor: pointer;"></i>
          <h3 class="mx-auto order-2" id="text-carrinho">Finalizar Pedido</h3>
        </div>
          
        <!-- body -->
        <div class="modal-body final">
          <!-- Section entrega -->
          <section class="button-entrega justify-content-between" id="entrega" style="background-color: red;">
            <div class="d-flex justify-content-between">
                <div class="icon-inner texto-preto" style="position: relative;">
                    <svg class="texto-preto" id="Capa_1" enable-background="new 0 0 512 512" height="25" viewBox="0 0 512 512" width="25" xmlns="http://www.w3.org/2000/svg" class="s-ion-icon" style="margin-left: 15px;"><g><path d="m449.649 307.262-18.956-101.095h29.976v-30h-35.601l-5.625-30.002h-117.452v30h31.907l25.911 190.012h-84.69l-28.814-65.109c14.379-7.521 24.22-22.576 24.22-39.896 0-24.814-20.188-45.002-45.002-45.002h-35.173v-160.35h-190.35v190.349h50.173v60.004h51.771c-19.485 19.073-31.598 45.648-31.598 75.003v15h31.509c6.968 34.194 37.273 60.004 73.495 60.004s66.526-25.81 73.495-60.004h114.658c6.968 34.194 37.273 60.004 73.494 60.004 41.357 0 75.004-33.646 75.004-75.004-.001-37.043-27.002-67.88-62.352-73.914zm-419.649-91.093v-130.349h130.349v130.349zm50.173 60.004v-30.004h145.349c8.272 0 15.002 6.73 15.002 15.002s-6.73 15.002-15.002 15.002zm95.176 30h40.408l26.555 60.003h-140.46c6.967-34.196 37.274-60.003 73.497-60.003zm0 120.007c-19.557 0-36.232-12.543-42.424-30.004h84.848c-6.192 17.461-22.867 30.004-42.424 30.004zm219.196-250.015 24.775 132.132c-13.215 3.206-25.068 9.917-34.523 19.096l-20.622-151.227h30.37zm42.451 250.015c-24.815 0-45.003-20.188-45.003-45.004 0-24.815 20.188-45.003 45.003-45.003s45.004 20.188 45.004 45.003c0 24.816-20.188 45.004-45.004 45.004z" fill="white"></path></g></svg>
                    <h1 class="entrega-text texto-preto">Entrega</h1>
                </div>
                <i class="bi bi-clock clock-ajust texto-preto" style="color: white; font-size: 2em"><h1 class="entrega-text-2 texto-preto">30m a 50m</h1></i>
            </div>
          </section>

          <!-- Section retirar -->
          <section class="button-entrega justify-content-between" id="retirar" style="background-color: white;">
              <div class="d-flex justify-content-between">
                  <div class="icon-inner" style="position: relative;">
                      <i class="bi bi-shop texto-branco" style="font-size: 2.5em; color: black; margin-left: 16px;"></i>
                      <h1 class="entrega-text texto-branco" style="color: black;">Retirar</h1>
                  </div>
                  <i class="bi bi-clock clock-ajust texto-branco" style="color: black; font-size: 2em"><h1 class="entrega-text-2 texto-branco" style="color: black;">15m a 30m</h1></i>
              </div>
          </section>
            
          <form id="entrega-formr">
          <!-- Formulario entrega -->
            <section class="checkout-form checkout-form-pai" id="entrega-form">
            <div class="d-block">
            <div class="inputBox">
              <input type="text" placeholder="Nome (Obrigatorio)" name="nome" required>
            </div>
            <div class="inputBox">
              <input type="tel" placeholder="Whatsapp" name="tel" maxlength="15" onkeyup="handlePhone(event)" required>
            </div>
            <div class="inputBox">
              <input type="tel" placeholder="CEP" name="cep" required>
            </div>
            <div class="inputBox">
              <input type="text" placeholder="Endereco" name="endereco" style="width: 89%;" required>
              <input type="text" placeholder="Nº" name="residencia" style="width: 9.7%;" required>
            </div>
            <div class="inputBox">
              <input type="text" placeholder="Bairro" name="bairro" required>
            </div>
            <div class="inputBox hidden">
              <input type="text" placeholder="Cidade" name="cidade" required>
            </div>
            <div class="inputBox hidden">
              <input type="text" placeholder="Estado" name="estado" required>
            </div>
            <div class="inputBox">
              <textarea class="text_area" name="observacao" id="observacao" placeholder="Observacoes" style="width: 100%;"></textarea>
            </div>
            <div class="inputBox">
                <select name="method" required>
                    <option value="selecione" selected>Forma de pagamento</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="cartao de credito ou debito">Cartão de débito ou crédito</option>
                </select>
            </div>
            <div class="inputBox hidden disabled">
                <input id="menvio_e" type="text" placeholder="ENTREGA" value="ENTREGA" name="menvio" required>
            </div>
            </div>
            </section>
          </form>

          <form id="retirar-formr">
            <!-- Formulario retirar -->
            <section class="checkout-form checkout-form-pai disabled hidden" id="retirar-form">
              <div class="d-block">
                <div class="inputBox">
                  <input type="text" placeholder="Nome (Obrigatorio) " name="nome" required>
                </div>
                <div class="inputBox">
                  <input type="tel" placeholder="Whatsapp" name="tel" maxlength="15" onkeyup="handlePhone(event)" required>
                </div>
                <div class="inputBox">
                  <textarea class="text_area" name="observacao" id="observacao" placeholder="Observacoes" style="width: 100%;"></textarea>
                </div>
                <div class="inputBox hidden disabled">
                  <input id="menvio_r" type="text" placeholder="RETIRAR" value="RETIRAR" name="menvio" required>
                </div>
              </div>
            </section>
          </form>
        </div>
          
        <!-- footer -->
        <div class="modal-footer d-inline-block ultima_finalizar" id="bkfooter-2">
            <input type="hidden" name="carrinho" id="carrinho-input">
            <div class="btn-toolbar justify-content-evenly" role="toolbar">
                <h1>Total: R$<span class="valor_total">0.00</span></h1>
                <h2 class="col-12">Produtos:</h2>
                <h2 class="col-12"><span class="produtos_adicionados"></span></h2>
                <input type="hidden" name="carrinho" id="carrinho-input">
                <div class="btn-group" style="width: 47%;">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Fechar" id="adicionar_mais" style="background-color: red;" onclick="deletarDados()"><i class="bi bi-plus"></i>Adicionar mais</button>
                  </div>
                <div class="btn-group" style="width: 47%;">
                  <button type="submit" class="btn btn-danger" id="finalizar_pedido" style="background-color: red;">Finalizar pedido<i class="bi bi-chevron-compact-right"></i></button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/uuid@8.3.2/dist/umd/uuidv4.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="static/js/services/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  
  <!-- Scripts globais -->
  <script src="static/js/global/barra_cat.js"></script>
  <script src="static/js/global/global.js"></script>
  <script src="static/js/global/l_r.js"></script>
  <script src="static/js/global/format.js"></script>
  <script src="static/js/global/carrinho.js"></script>
  <script src="static/js/global/form.js"></script>
  <script src="static/js/global/sair.js"></script>
  <script src="static/js/global/cep.js"></script>
  <!--<script src="static/js/global/status.js"></script>-->
</body>
</html>