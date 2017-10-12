<?php

	Class GoodsDatabase
	{

		public $data = null;

		public function __construct() {
		    $this->data = new mysqli("localhost", "root", "", "mySQLInternetShop");
		}
	
		public function GetData($query)
		{
			$result = $this->data->query($query);
			while ($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
			return $rows;
		}
		public function GetGoodById($id)
		{
			$query = "SELECT * FROM Goods
					  WHERE Goods.id = $id";
			$result = $this->data->query($query);
			$good = $result->fetch_assoc();
			return $good;
		}

		public function GetTypeIdByName($type_name)
		{
			$query = "SELECT id FROM GoodsTypes
					  WHERE name = '$type_name'";
			$result = $this->data->query($query);
			$row = $result->fetch_assoc();
			return $row["id"];
		}

		public function GetBrandIdByName($brand_name)
		{
			$query = "SELECT id FROM Brands
					  WHERE name = '$brand_name'";
			$result = $this->data->query($query);
			$row = $result->fetch_assoc();
			return $row["id"];
		}

		public function AddData($query)
		{
			$query = 'INSERT INTO'.$table.'('.$insert.')
					  VALUES ('.$values.')';
			$this->data->query($query);
		}

		public function AddGood($name, $type, $brand, $picture, $description, $price, $quantity)
		{
			$query = "INSERT INTO Goods (name, type, brand, picture, description, price, quantity)
					  VALUES ('$name', $type, $brand, '$picture', '$description', $price, $quantity)";
			$this->data->query($query);
		}

		public function EditGood($id, $name, $type, $brand, $picture, $description, $price, $quantity)
		{
			$query = "UPDATE Goods
					  SET name = '$name', type = $type, brand = $brand,
					  	  picture = '$picture', description = '$description',
					  	  price = $price, quantity = $quantity
					  WHERE Goods.id = $id";
			$this->data->query($query);
		}

		public function DeleteGood($id)
		{
			$query = "DELETE FROM Goods
					  WHERE Goods.id = $id";
			$this->data->query($query);
		}

		public function ChangeGoodQuantity($id, $change_quantity)
		{
			$query = "UPDATE Goods
					  SET quantity = quantity + $change_quantity
					  WHERE Goods.id = $id";
			$this->data->query($query);
		}

		public function AddHash($hash)
		{
			$query = "INSERT INTO Hashes (hash)
					  VALUES ('$hash')";
			$this->data->query($query);
		}

		public function GetHashId($hash)
		{
			$query = "SELECT * FROM Hashes
					  WHERE hash = '$hash'";
			$result = $this->data->query($query);
			$row = $result->fetch_assoc();
			return $row['id'];
		}

		public function AddInBasket($hash_id, $good_id)
		{
			$query = "INSERT INTO Basket (hash_id, good_id)
					  VALUES ($hash_id, $good_id)";
			$this->data->query($query);
		}

		public function GetBasketRowId($hash_id, $good_id)
		{
			$query = "SELECT * FROM Basket
					  WHERE hash_id = $hash_id
					  AND good_id = $good_id";
			$result = $this->data->query($query);
			$row = $result->fetch_assoc();
			return $row['id'];
		}

		public function GetGoodsIdRelatedHashId($hash_id)
		{

			$query = "SELECT good_id
					  FROM Basket
					  WHERE hash_id = '$hash_id'";
			$result = $this->data->query($query);
			while ($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
			return $rows;
		}

		public function RemoveGoodFromBusket($hash_id, $good_id)
		{
			$query = "DELETE FROM Basket
					  WHERE hash_id = $hash_id
					  AND good_id = $good_id";
			$this->data->query($query);
		}

		public function RemoveGoodIdFromAllBuskets($good_id)
		{
			$query = "DELETE FROM Basket
					  WHERE good_id = $good_id";
			$this->data->query($query);
		}

		public function RemoveHashIdFromAllBuskets($hash_id)
		{
			$query = "DELETE FROM Basket
					  WHERE hash_id = $hash_id";
			$this->data->query($query);
		}

	} 

?>