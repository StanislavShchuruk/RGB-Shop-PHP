<?php 
	//head
	header('Content-type: text/html; charset=UTF-8');
	include_once("Shop_Model.php");
	$Data = new GoodsDatabase();
	include_once("Busket_Styles.php");
?>
	<script>
		function CalcSum(id)
		{
			var totalSum = document.getElementById(id + "tp");
			var price = document.getElementById(id + "p");
			var num = document.getElementById(id + "q");
			var maxQuantity = document.getElementById(id + "mq");

			if(num.style.background == "pink")
			{
				num.style.background = "white";
			}

			if (Number(num.value) < 0) num.value = 0;

			if (Number(num.value) > Number(maxQuantity.value))
			{
			 	num.value = maxQuantity.value;
			 	num.style.background = "pink";
			}

			totalSum.childNodes[0].nodeValue = price.childNodes[0].nodeValue * num.value;
			CalcTotalSum();
		}
		function CalcTotalSum()
		{
			var i = 0;
			var totalSum = 0;
			var objTotalSum = document.getElementById("total_sum");
			var sum = document.getElementById(i + "tp")
			while(sum != null)
			{
				totalSum += Number(sum.childNodes[0].nodeValue);
				++i;
				sum = document.getElementById(i + "tp")
			}
			objTotalSum.childNodes[0].nodeValue = totalSum;
		}
	</script>
	<?php
	//start php logic
		if (isset($_POST["remove_good_id"]))
		{
			$hash_id = $Data->GetHashId($_GET["hash"]);
			$Data->RemoveGoodFromBusket($hash_id, $_POST["remove_good_id"]);
		}
	?>
	<head>
	  <meta charset="utf-8">
	  <title>RGB Shop</title>
	</head>
		<body>
		<!--Forms-->
		<form id="main" action="index.php" method="POST">
			<input type="hidden" name="order" value="true"/>
		</form> 

		<div style="position: absolute;">
			<?php echo 'hash: '.$_GET["hash"]; ?>
		</div>
		<div class="main_page_return_div">
			<a href="index.php"><- Вернуться на главную страницу</a>
		</div>
		<div class="goods_main_div_alt">
			<?php
				$hash_id = $Data->GetHashId($_GET["hash"]);
				$goods_ides = $Data->GetGoodsIdRelatedHashId($hash_id);
				$sum = 0;
				for($j = 0; $j < 1; $j++) {
				for ($i = count($goods_ides) - 1; $i >= 0; --$i)
				{
					$good = $Data->GetGoodById($goods_ides[$i]["good_id"]);
					if ($good["quantity"] > 0) $buy_quantity = 1;
					else $buy_quantity = 0;
					echo 
					'
						<div class="good_div_alt">
							<div class="good_img_min_div_alt">
								<img src="'.$good["picture"].'" class="good_img_min_alt">
							</div>
							<div class="good_info" id="div'.$i.'">
								<div class="good_name_div_alt">
									<p class="good_name_alt">'.$good["name"].'</p>
								</div>
								<form action="Busket.php?hash='.$_GET["hash"].'" method="POST"	
									  style="margin:0; display: inline-block; float: right;">

									<input type="hidden" name="remove_good_id" value="'.$good["id"].'"/>
									<button class="btn_remove" title="Убрать продукт из корзины">
										Х
									</button>

								</form>
								<div class="price_div_alt">
									<p class="good_price_alt">Цена: 
										<span class="price_span_alt" id="'.$i.'p">'.$good["price"].'</span> грн.
									</p>
								</div>
								<div class="price_div_alt good_total">
									<p class="good_price_alt">Сумма: 
										<span class="price_span_alt" id="'.$i.'tp">'.$good["price"].'</span> грн.
									</p>
								</div>
								<br>
								<div class="quantity_div_alt">
									Количество: 
									<input id="'.$i.'q" type="text" name="'.$good["id"].'_quantity" 
										   value="'.$buy_quantity.'" class="inpt_quant" 
										   onchange="CalcSum('.$i.')" form="main"/>
									<br>
									<input id="'.$i.'mq" type="hidden" name="max_quantity" 
											value="'.$good["quantity"].'" />
									<div style="font-size: 14pt">В наличии: '.$good["quantity"].'</div>
								</div>
							</div>
						</div>
						<script>
							CalcSum('.$i.');
						</script>
					';
				} }
			?>
			<div class="total_sum_div">
				<p class="total_sum_p">Итого:   
					<span class="total_sum_span" id="total_sum"><?php echo $sum ?></span> грн.
				</p>
			</div>
			<script>
				CalcTotalSum();
			</script>
			<button class="btn_order" form="main">Оформить заказ</button>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>
	</body>
