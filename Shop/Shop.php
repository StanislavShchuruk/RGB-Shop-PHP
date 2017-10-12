<?php
	//head
	header('Content-type: text/html; charset=UTF-8');
	include_once("Shop_Model.php");

	$Data = new GoodsDatabase();

	if (isset($_COOKIE["userHash"]))
	{
		if($Data->GetHashId($_COOKIE["userHash"]) != null)
			$hash = $_COOKIE["userHash"];
	}
	else 
	{
		$hash = md5(mt_rand(10000,10000000));
		$Data->AddHash($hash);
	}

	setcookie("userHash", $hash);

	//logic
	$hash_id = $Data->GetHashId($hash);

	if(isset($_POST["order"]))
	{
		foreach ($_POST as $key => $value) {
			if($key == "order") continue;
			$Data->ChangeGoodQuantity((integer)$key, (-$value));
		}
		$Data->RemoveHashIdFromAllBuskets($hash_id);
	}

	if(isset($_POST["good_id"]))
	{
		$Data->AddInBasket($hash_id, $_POST["good_id"]);
	}

	if(isset($_FILES["picture"]))
	{
		$img_name = "pictures/".$_FILES["picture"]["name"];
		move_uploaded_file($_FILES["picture"]["tmp_name"], $img_name);
		
		$type_id = $Data->GetTypeIdByName($_POST["type"]);
		$brand_id = $Data->GetBrandIdByName($_POST["brand"]);

		if(isset($_POST["id_edit"]))
		{
			if($img_name == "pictures/") $img_name = $_POST["picture"];
			$Data->EditGood($_POST["id_edit"], $_POST["name"], $type_id, $brand_id, $img_name, 
					$_POST["description"], $_POST["price"], $_POST["quantity"]);
		}
		else if(isset($_POST["id_del"]))
		{
			if($img_name == "pictures/") $img_name = $_POST["picture"];
			$Data->RemoveGoodIdFromAllBuskets($_POST["id_del"]);
			$Data->DeleteGood($_POST["id_del"]);
		}
		else
		{
			$Data->AddGood($_POST["name"], $type_id, $brand_id, $img_name, 
					$_POST["description"], $_POST["price"], $_POST["quantity"]);
		}
	}
?>

<!--body-->

<?php include_once("Shop_Styles.php"); ?>

<head>
  <meta charset="utf-8">
  <title>RGB Shop</title>
</head>
<body>
	hash: <?php echo $hash ?>
	<form action="Shop_Add.php">
		<button class="button btn_add">Добавить</button>
	</form>
	<form action="Busket.php" method="GET">
		<input type="hidden" name="hash" value=<?php echo '"'.$hash.'"' ?>/>
		<button class="button btn_busket bask_enter">Корзина</button>
	</form>
	<div class="goods_main_div">
		<?php
			$rows = $Data->GetData("SELECT * FROM Goods");
			for($j = 0; $j < 1; $j++) {
			for ($i = count($rows) - 1; $i >= 0; --$i)
			{
				echo 
				'
					<div class="good_div">
						<div class="good_img_min_div">
							<img src="'.$rows[$i]["picture"].'" class="good_img_min">
						</div>
						<div class="good_name_div">
							<p class="good_name">'.$rows[$i]["name"].'</p>
						</div>
						<div class="price_div">
						<p class="good_price">Цена: 
								<span class="price_span">'.$rows[$i]["price"].'</span> грн.
						</p>
						<form action="Shop.php" method="POST" style="display: inline;">
							<input type="hidden" name="good_id" value="'.$rows[$i]["id"].'"/>
						';

						if ($Data->GetBasketRowId($hash_id, $rows[$i]["id"]) == null)
						{
							echo '<button class="button btn_busket">Купить</button>';
						}
						else
						{
							echo '<button class="button btn_busket clicked" disabled>
										В корзине
								  </button>';
						}

						echo 
						'
						</form>
						</div>
						<div ';
							if ($rows[$i]["quantity"] > 0)
							{
								echo 'class="quantity_div">В наличии: '.$rows[$i]["quantity"].'';
							}
							else
							{
								echo 'class="quantity_div color_red">Продано';
							}
						echo
						'
						</div>
						<form action="Shop_Add.php" method="POST" style="display: inline-block;">
							<input type="hidden" name="id_edit" value="'.$rows[$i]["id"].'"/>
							<button class="button btn_edit">Edit</button>
						</form>
						<form action="Shop_Add.php" method="POST" style="display: inline;">
							<input type="hidden" name="id_del" value="'.$rows[$i]["id"].'"/>
							<button class="button btn_del">Del</button>
						</form>
						<div class="good_descr">'.$rows[$i]["description"].'</div>
					</div>
				';
			} }
		?>

	</div>
	<div style="height: 500px"></div>
</body>
