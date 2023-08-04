<style>
  #system-cover{
    width:100%;
    height:45em;
    object-fit:cover;
    object-position:center center;
  }
  
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: orange;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<h1 class="">Bem vindo, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!</h1>
<hr>
<div class="row">
    
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-hamburger"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Produtos</span>
        <span class="info-box-number text-right h5">
          <?php 
            $menus = $conn->query("SELECT id FROM menu_list where delete_flag = 0 and `status` = 1")->num_rows;
            echo format_num($menus);
          ?>
          <?php ?>
        </span>
      </div>
    </div>
  </div>
  
  <?php if($_settings->userdata('type') !=2): ?>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fa fa-list-ul"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pedidos na fila</span>
        <span class="info-box-number text-right h5">
          <?php 
            $orders = $conn->query("SELECT id FROM carrinho where `status` = 0")->num_rows;
            echo format_num($orders);
          ?>
          <?php ?>
        </span>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if($_settings->userdata('type') ==1): ?>
  <div class="col-12 col-sm-4 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fa fa-list-ul"></i></span>
      <div class="info-box-content">
      <span class="info-box-text">Total de vendas do mes</span>
      <span class="info-box-number text-right h5">
        <?php 
            $query = "SELECT SUM(total_valor_total) AS total_sum FROM carrinho WHERE total_valor_total > 0";
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total = $row['total_sum'];
                $formattedTotal = number_format($total, 2, ',', '.');
                echo $formattedTotal;
            } else {
                echo '0,00';
            }
        ?>
      </span>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>
<div class="container-fluid text-center">
  <img src="<?= validate_image($_settings->info('cover')) ?>" alt="system-cover" id="system-cover" class="img-fluid">
</div>