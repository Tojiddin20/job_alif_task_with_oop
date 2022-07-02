<?php 
	class ActionService {
		public function add(string $fileName, Product $product): string {
			$fp = fopen($fileName, "a");
			fwrite($fp, $product->getNameDashPrice());
			fclose($fp);
			return "Added product {$product->getNameDashPrice()}";
		}

		public function edit(string $fileName, int $productNumber): string {
			$data = file($fileName);
			$products = [];

			foreach($data as $key => $line) {
			    if ($key + 1 == $productNumber) {
			    	$input = fopen("php://stdin", "rb");
			    	echo "Enter product name ";
			    	$name = trim(fgets($input));
			    	echo "Enter product price ";
			    	$price = trim(fgets($input));
			    	fclose($input);
			        $products[] = (new Product($name, $price))->getNameDashPrice();
			    } else {
			    	$products[] = $line;			    
			    }
			}

			$fp = fopen($fileName, "w+");
			foreach($products as $line) fwrite($fp, $line);
			fclose($fp);  

			return "Edited product with number $productNumber";
		}

		public function delete(string $fileName, int $productNumber): string {
			 $data = file($fileName);
			 $products = [];

			 foreach($data as $key => $line) {
			     if($key + 1 != $productNumber) {
			         $products[] = $line;
			     }
			 }

			 $fp = fopen($fileName, "w+");
			 foreach($products as $line) fwrite($fp, $line);
			 fclose($fp);  

			 return "Deleted product with number $productNumber";
		}

		public function sum(string $fileName): string {
			$data = file($fileName);
			$sum = 0;

			foreach($data as $key => $line) {
				$explode = explode(" ", trim($line));
				$sum += end($explode);
			}

			return "Sum of all product prices is $sum";
		}
	}
 ?>