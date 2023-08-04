<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
	img#cimg2{
		height: 50vh;
		width: 100%;
		object-fit: contain;
	}
	.switch {
		position: relative;
		display: block;
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
<div class="col-lg-12">
	<div class="card card-outline rounded-0 card-warning">
		<div class="card-header">
			<h5 class="card-title">Configurações do site</h5>
		</div>
		<div class="card-body">
			<form action="" id="system-frm">
				<div id="msg" class="form-group"></div>
				<div class="form-group">
					<label for="name" class="control-label">Nome do sistema</label>
					<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $_settings->info('name') ?>">
				</div>
			<div class="form-group">
				<label for="" class="control-label">Logo do sistema (logo que fica no topo da pagina)</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile1" name="img" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile1">Enviar arquivo</label>
	            </div>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Logo do site (logo que fica no site)</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile1" name="img_site" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile1">Enviar arquivo</label>
	            </div>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Banner do site (banner que fica no site)</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile2" name="banner_site" onchange="displayImg2(this,$(this))">
	              <label class="custom-file-label" for="customFile2">Enviar arquivo</label>
	            </div>
			</div>
			<div>
				<label for="name" class="control-label">Status do sistema</label>
				<label class="switch">
					<input id="switch-input" type="checkbox">
					<span class="slider round"></span>
				</label>	
			</div>
			<div>
				<label for="name" class="control-label">Horario de funcionamento</label>
			</div>
			</form>
			<h2 style="font-size: 1.3rem; color: black; font-weight: 200; margin-top: 2em;">Personalizações</h2>
			<div id="msg" class="form-group"></div>
				<div class="form-group">
					<label for="name" class="control-label">Cor do site</label>
					<br>
					<input type="color" id="head" name="color" value="#fa3e3e">
				</div>
			</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="system-frm">Salvar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg3(input,_this) {
		var fnames = [];
		Object.keys(input.files).map(function(k){
			fnames.push(input.files[k].name)

		})
		_this.siblings('.custom-file-label').html(fnames.join(", "))
	}
	function delete_img($path){
        start_loader()
        
        $.ajax({
            url: _base_url_+'classes/Master.php?f=delete_img',
            data:{path:$path},
            method:'POST',
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Um erro ocorreu ao tentar excluir a imagen.","error");
                end_loader()
            },
            success:function(resp){
                $('.modal').modal('hide')
                if(typeof resp =='object' && resp.status == 'success'){
                    $('[data-path="'+$path+'"]').closest('.img-item').hide('slow',function(){
                        $('[data-path="'+$path+'"]').closest('.img-item').remove()
                    })
                    alert_toast("Imagen excluida com sucesso.","success");
                }else{
                    console.log(resp)
                    alert_toast("Um erro ocorreu ao tentar excluir a imagen","error");
                }
                end_loader()
            }
        })
    }
	$(document).ready(function(){
		$('.rem_img').click(function(){
            _conf("Voce tem certeza que deseja exluir permanentemete essa imagen?",'delete_img',["'"+$(this).attr('data-path')+"'"])
        })
		 $('.summernote').summernote({
			height: 200,
			toolbar: [
				[ 'style', [ 'style' ] ],
				[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
				[ 'fontname', [ 'fontname' ] ],
				[ 'fontsize', [ 'fontsize' ] ],
				[ 'color', [ 'color' ] ],
				[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
				[ 'table', [ 'table' ] ],
				[ 'view', [ 'undo', 'redo', 'fullscreen', 'help' ] ]
			]
		})
	})
</script>
<script>
  $(document).ready(function(){
    function getStatusFromDatabase() {
      $.ajax({
        url: 'obter_status.php',
        method: 'GET',
        success: function(response) {
          var status = parseInt(response);
          if (status === 1) {
            $('#switch-input').prop('checked', true);
          } else {
            $('#switch-input').prop('checked', false);
          }
        },
        error: function() {
        }
      });
    }
    getStatusFromDatabase();

    $('#switch-input').click(function(){
      if ($(this).prop('checked')) {
        Swal.fire({
          title: 'Ativar site',
          text: 'Ao clicar em continuar, você estará ligando o seu site ao público. Deseja continuar?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Continuar',
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.isConfirmed) {
            atualizarSwitchStatus(1);
            Swal.fire('Sucesso!', 'Seu site está online!', 'success');
          } else {
            $(this).prop('checked', false);
          }
        });
      } else {
        Swal.fire({
          title: 'Desativar site',
          text: 'Ao clicar em continuar, você estará desligando o seu site para manutenção. Deseja continuar?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Continuar',
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.isConfirmed) {
            atualizarSwitchStatus(0);
            Swal.fire('Sucesso!', 'Seu site está offline!', 'success');
          } else {
            $(this).prop('checked', true);
          }
        });
      }
    });

    function atualizarSwitchStatus(status) {
      $.ajax({
        url: 'atualizar_status.php',
        method: 'POST',
        data: { status: status },
        success: function(response) {
        },
        error: function() {
        }
      });
    }
  });
</script>