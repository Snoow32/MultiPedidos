<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT m.*, c.name as `category` from `subcategory_list` m inner join category_list c on m.category_id = c.id where m.id = '{$_GET['id']}' and m.delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
		echo '<script>alert("O ID do item é invalido."); location.replace("./?page=menus")</script>';
	}
}else{
	echo '<script>alert("Requer o ID do item."); location.replace("./?page=menus")</script>';
}
?>
<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>
<div class="container-fluid">
	<dl>
		<dt class="text-muted">Categoria Primaria</dt>
		<dd class="pl-4"><?= isset($category) ? $category : "" ?></dd>
		<dt class="text-muted">Sub categoria</dt>
		<dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>	
		<dt class="text-muted">Status</dt>
		<dd class="pl-4">
			<?php if($status == 1): ?>
				<span class="badge badge-success px-3 rounded-pill">Ativo</span>
			<?php else: ?>
				<span class="badge badge-danger px-3 rounded-pill">Inativo</span>
			<?php endif; ?>
		</dd>
	</dl>
</div>
<hr class="mx-n3">
<div class="text-right pt-1">
	<button class="btn btn-sm btn-flat btn-light bg-gradient-light border" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Sair</button>
</div>