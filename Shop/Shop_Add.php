<?php
	//head
	header('Content-type: text/html; charset=UTF-8');
	include_once("Shop_Model.php");

	$Data = new GoodsDatabase();
?>



<?php
	//logic
	if (isset($_POST["id_edit"]))
	{
		$good = $Data->GetGoodById($_POST["id_edit"]);
	}
	else if (isset($_POST["id_del"]))
	{
		$good = $Data->GetGoodById($_POST["id_del"]);
	}

?>

<!--body-->
<?php include_once("Shop_Add_Styles.php"); ?>
<head>
  <meta charset="utf-8">
  <title>RGB Shop</title>
</head>
<body>
	<div class="main_page_return_div">
		<a href="Shop.php"><- Вернуться на главную страницу</a>
	</div>
	<div class="goods_add_div">
		<form class="form_s" enctype="multipart/form-data" action="Shop.php" method="POST">
			Тип:  
			<select name="type" required>
				<?php
					$rows = $Data->GetData("SELECT id, name FROM GoodsTypes");
					for ($i = 0; $i < count($rows); ++$i)
					{
						$selected = ($rows[$i]["id"] == $good["type"])
									? "selected" 
									: "";
						echo 
						'
							<option '.$selected.'>'.$rows[$i]["name"].'</option>
						';
					}
				?>
			</select>
			<br>
			Бренд: 
			<select name="brand" required>
	  			<?php
					$rows = $Data->GetData("SELECT id, name FROM Brands");
					for ($i = 0; $i < count($rows); ++$i)
					{
						$selected = ($rows[$i]["id"] == $good["brand"])
									? "selected" 
									: "";
						echo 
						'
							<option '.$selected.'>'.$rows[$i]["name"].'</option>
						';
					}
				?>
			</select>
			<br>
			Название: <input type="text" name="name" size="50" class="inpt_text"
						<?php echo 'value="'.$good["name"].'"' ?> 
						required/>
			<br>
			<input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
			Отправить картинку: <input name="picture" type="file" accept="image/*"
								  class="inpt_file"/>
			<br>
			Описание 
			<br>
			<textarea class="decr_txt" name="description" required>
						<?php echo $good["description"] ?>		
			</textarea>
			<br>
			Цена: <input type="text" name="price" size="6" class="inpt_text"
						  <?php echo 'value="'.$good["price"].'"' ?> 
						  required/>
			<br>
			Количество: <input type="text" name="quantity" size="6" class="inpt_text"
								<?php echo 'value="'.$good["quantity"].'"' ?> 
								required/>
			<br>
			<?php
				if (isset($_POST["id_edit"]))
				{
					echo 
					'
						<input type="hidden" name="id_edit" value="'.$_POST["id_edit"].'"/>
						<input type="hidden" name="picture" value="'.$good["picture"].'"/>
					';
				}
				else if (isset($_POST["id_del"]))
				{
					echo 
					'
						<input type="hidden" name="id_del" value="'.$_POST["id_del"].'"/>
						<input type="hidden" name="picture" value="'.$good["picture"].'"/>
					';
				}
			?>
	    	<input type="submit"
	    		<?php 
	    			if (isset($_POST["id_edit"])) echo 'class="button btn_action" value="Сохранить" ';
	    			else if (isset($_POST["id_del"])) echo 'class="button btn_action del" value="Удалить" ';
				    else echo 'class="button btn_action" value="Добавить" ';
	    		?>
	    	/>
		<form>
	</div>
</body>