<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="pt-br" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      backdrop-filter: contrast(1);
    }
    #page-title{
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
    }
    
    .link-user {
        color: white;
    }
    
    .link-user:hover {
        color: gray;
    }
  </style>
  <h1 class="text-center text-white px-4 py-5" id="page-title"><b><?php echo $_settings->info('name') ?></b></h1>
<div class="login-box">
  <div class="card card-warning my-2">
    <div class="card-body">
      <p class="login-box-msg">Entre com seus dados</p>
      <form id="login-frm" action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" autofocus placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control"  name="password" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Logar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

      <p class="mb-1">
        <a class="link-user" href="https://wa.me//554198203105?text=Eu%20esquecia%20minha%20senha,%20poderia%20me%20ajudar?">Esqueceu sua senha? clique aqui.</a>
      </p>

<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url ?>dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>