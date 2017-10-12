
<style>
	a{
		text-decoration: none;
		display: block;
		background: blue;
	}
	.goods_main_div {
		position: absolute;
		display: inline-block;
		width: 68%;
		left: 15%;
		top: 300px;
		//background: lightblue;
		border-top: 1px solid lightblue;
		border-left: 1px solid lightblue;
	}
	.good_div {
		display: inline-block;
		width: 24.5%;
		//background: lightgreen;
		margin: 3px 0 0 2px;
		vertical-align: top;
		border-right: 1px solid lightblue;
		border-bottom: 1px solid lightblue;
	}
	.good_img_min_div{
		height: 350px;
	}
	.good_img_min {
		display: block;
		width: 100%;
		margin: 0px;
		margin-bottom: 5px;
	}
	.good_name_div{
		height: 75px;
	}
	.good_name{
		font-size: 16pt;
		margin: 10px 5px 5px 5px;
		color: darkblue;
	}
	.good_price{
		display: inline-block;
		width: 170px;
		font-size: 14pt;
		color: darkgreen;
	}
	.price_span{
		font-size: 24pt;
		color: green;
	}
	.price_div{
		margin: 5px 5px 10px 5px;
	}
	.quantity_div{
		float: right;
		margin: 10px 20px 5px 5px;
		color: green;
	}
	.good_descr{
		background: white;
		display: none;
		font-size: 12pt;
		margin: 40px 0 0 0;
		width: 205%;
	}
	.good_div:hover{
		box-shadow: 0 0 15px;
	}
	.good_div:hover .good_descr{
		//display: block;
		border: 2px solid lightblue;
	}
	.button{
		background: #226CB4;
		border-radius: 5px;
		border: 0px;
		border-bottom: 5px solid #0E2943;
		font-size: 16pt;
		color: white;
		cursor: pointer;
	}
	.button:hover {
		//background: #0CA720;
		background: #1D5891;
	}
	.button:disabled {
		background: lightgray;
	}
	.button:disabled:hover {
		background: lightgray;
	}
	.btn_add{
		display: inline;
		position: absolute;
		left: 15%;
		top: 200px;
		width: 150px;
		height: 50px;
		margin: 5px 5px 5px 25px;
	}
	.btn_edit{
		display: inline;
		width: 50px;
		height: 30px;
		font-size: 12pt;
		margin: 0 0 0 5px;
		border: 0;
	}
	.btn_del{
		display: inline;
		width: 40px;
		height: 30px;
		font-size: 12pt;
		margin: 0 0 0 5px;
		border: 0;
		background: #BE2727;
	}
	.btn_del:hover{
		background: #A41919;
	}
	.btn_busket{
		display: inline;
		width: 100px;
		height: 40px;
		font-size: 14pt;
		background: green;
		border-bottom: 4px solid #162B08;
	}
	.btn_busket:hover{
		background: darkgreen;
	}
	.clicked {
		border: 0;

	}
	.bask_enter{
		position: absolute;
		left: 70%;
		top: 200px;
		font-size: 16pt;
		border-bottom: 5px solid #162B08;
		width: 150px;
		height: 50px;
		margin: 5px 5px 5px 70px;
	}
	//For Shop_add.php
	select{
	font-size: 14pt;
	margin: 25px 10px 25px 10px;
	}

	.goods_add_div{
		display: inline-block;
		width: 40%;
		margin-left: 15%;
		margin-top: 50px;
		color: #3F4642;
	}
	.form_s {
		font-size: 18pt;
		margin: 25px 10px 25px 10px;
	}
	.inpt_text{
		font-size: 16pt;
		margin: 25px 10px 25px 10px;
	}
	.inpt_file{
		font-size: 14pt;
		margin: 25px 10px 25px 10px;
	}
	.decr_txt{
		width: 90%;
		height: 200px;
		font-size: 12pt;
		margin: 25px 10px 25px 10px;
	}
	.button:hover {
		//background: #0CA720;
		background: #1D5891;
	}
	.btn_action{
		width: 150px;
		height: 50px;
	}

	.del{
		background: #BE2727;
		border-bottom: 5px solid #270707;
	}

	.del:hover{
		background: #A41919;
	}
</style>