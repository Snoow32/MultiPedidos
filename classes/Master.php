<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = " Categoria ja existe.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['cid'] = $cid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Nova categoria salvada.";
			else
				$resp['msg'] = " Categoria salva com sucesso.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
			return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `category_list` WHERE id = $id");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Categoria deletada com sucesso.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_sub_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `subcategory_list` where delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if(empty($id)){
			$sql = "INSERT INTO `subcategory_list` set {$data} ";
		}else{
			$sql = "UPDATE `subcategory_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$iid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['iid'] = $iid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Novo item salvo com sucesso.";
			else
				$resp['msg'] = " Itens atualizados com sucesso.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
			return json_encode($resp);
	}
	function delete_sub_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `subcategory_list` where id = $id");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Item deletado com sucesso.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_menu(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = htmlspecialchars($this->conn->real_escape_string($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `menu_list` where `code` = '{$code}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Codigo do item ja existe.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `menu_list` set {$data} ";
		}else{
			$sql = "UPDATE `menu_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$iid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['iid'] = $iid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Novo item salvo com sucesso.";
			else
				$resp['msg'] = " Itens atualizados com sucesso.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
			return json_encode($resp);
	}
	function delete_menu(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM menu_list where id = $id");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Item deletado com sucesso.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function place_order(){
		$prefix = date("Ymd");
		$code = sprintf("%'.05d", 1);
		while(true){
			$check = $this->conn->query("SELECT * FROM `order_list` where code = '{$prefix}{$code}'")->num_rows;
			if($check > 0){
				$code = sprintf("%'.05d",abs($code)+ 1);
			}else{
				$_POST['code'] = $prefix.$code;
				$_POST['queue'] = $code;
				break;
			}
		}
		$_POST['user_id'] = $this->settings->userdata('id');
		extract($_POST);
		$order_fields = ['code', 'queue', 'total_amount', 'tendered_amount', 'user_id'];
		$data = "";
		foreach($_POST as $k=> $v){
			if(in_array($k, $order_fields) && !is_array($_POST[$k])){
				$v = addslashes(htmlspecialchars($this->conn->real_escape_string($v)));
				if(!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}
		$sql = "INSERT INTO `order_list` set {$data}";
		$save = $this->conn->query($sql);
		if($save){
			$oid = $this->conn->insert_id;
			$resp['oid'] = $oid;
			$data = '';
			foreach($menu_id as $k=>$v){
				if(!empty($data)) $data .= ", ";
				$data .= "('{$oid}', '{$menu_id[$k]}', '{$price[$k]}', '{$quantity[$k]}')";
			}
			$sql2 = "INSERT INTO `order_items` (`order_id`, `menu_id`, `price`, `quantity`) VALUES {$data}";
			$save2 = $this->conn->query($sql2);
			if($save2){
				$resp['status'] = 'success';
				$resp['msg'] = ' O pedido foi feito';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = " O pedido falhou ao salvar, devido a algum motivo.";
				$resp['err'] = $this->conn->error;
				$resp['sql'] = $sql2;
				$this->conn->query("DELETE FROM `order_list` where id = '{$oid}'");
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = " O pedido falhou ao salvar, devido a algum motivo.";
			$resp['err'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		return json_encode($resp);
	}
	function delete_order(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `carrinho` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Pedido foi cancelado com sucesso.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
    function get_order(){
		extract($_POST);
	
		$swhere = "";
		if (isset($listed) && count($listed) > 0) {
			$swhere = " and id not in (" . implode(",", $listed) . ")";
		}
		$nameQuery = $this->conn->query("SELECT COUNT(*) as count FROM `carrinho` WHERE `nome` IS NOT NULL AND `nome` != ''");
		$nameRow = $nameQuery->fetch_assoc();
		$nameCount = $nameRow['count'];
	
		if ($nameCount == 0) {
			$resp['status'] = 'error';
			$resp['message'] = 'O campo de nome está vazio ou definido como NULL na tabela.';
			return json_encode($resp);
		}
	
		$orders = $this->conn->query("SELECT id, `queue`, `status_info`, `menvio` FROM `carrinho` WHERE `status` IN (0, 1) {$swhere}");
		$data = [];
		while ($row = $orders->fetch_assoc()) {
			$items = $this->conn->query("SELECT * FROM `carrinho` WHERE id = '{$row['id']}'");
			$item_arr = [];
			while ($irow = $items->fetch_assoc()) {
				$item_arr[] = array(
					'product_name' => explode(", ", $irow['product_name']),
					'id' => explode(", ", $irow['id']),
					'quantity' => explode(", ", $irow['quantity'])
				);
			}
			$row['item_arr'] = $item_arr;
			$data[] = $row;
		}
	
		$resp['status'] = 'success';
		$resp['data'] = $data;
		return json_encode($resp);
	}
	function serve_order(){
        extract($_POST);
        $statusQuery = $this->conn->query("SELECT `status` FROM `carrinho` WHERE id = '{$id}'");
        $statusRow = $statusQuery->fetch_assoc();
        $currentStatus = $statusRow['status'];
    
        if ($currentStatus == 1) {
            $newStatus = 2;
            $newStatusInfo = 'Entregue';
            $newStatusOrder = 'Entregue';
        } else {
            $newStatus = 1;
            $newStatusInfo = 'Pedido pronto';
            $newStatusOrder = 'Aceito';
        }
    
        $update = $this->conn->query("UPDATE `carrinho` SET `status` = '{$newStatus}', `status_info` = '{$newStatusInfo}', `status_order` = '{$newStatusOrder}' WHERE id = '{$id}'");
    
        $resp = array();
    
        if($update){
            $resp['status'] = 'success';
            $resp['status_order'] = $newStatusOrder;
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
    
        echo json_encode($resp);
        exit;
    }

}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'save_sub_category':
		echo $Master->save_sub_category();
	break;
	case 'delete_sub_category':
		echo $Master->delete_sub_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_menu':
		echo $Master->save_menu();
	break;
	case 'delete_menu':
		echo $Master->delete_menu();
	break;
	case 'place_order':
		echo $Master->place_order();
	break;
	case 'delete_order':
		echo $Master->delete_order();
	break;
	case 'get_order':
		echo $Master->get_order();
	break;
	case 'serve_order':
		echo $Master->serve_order();
	break;
	default:
		break;
}
