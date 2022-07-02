<?php
 	include('Product.php');
	include('ActionService.php');

	function run() {
		$input = fopen('php://stdin', 'rb');
		echo "Enter filename ";
		$fileName = trim(fgets($input));
		
		if (file_exists($fileName)) {			
			echo "Enter action ";		
			$action = trim(fgets($input));		
			$actionService = new ActionService();

			switch ($action) {
				case 'add':
					echo "Enter product name ";
					$name = trim(fgets($input));
					echo "Enter product price ";
					$price = trim(fgets($input));
					echo $actionService->add('data.txt', new Product($name, $price));
					break;
				case 'edit':
					echo "Enter product number ";
					$productNumber = trim(fgets($input));
					echo $actionService->edit($fileName, $productNumber);				
					break;
				case 'delete':
					echo "Enter product number ";
					$productNumber = trim(fgets($input));
					echo $actionService->delete($fileName, $productNumber);
					break;
				case 'sum':
					echo $actionService->sum($fileName);					
					break;
				default:
					echo "Incorrect action $action";
					break;
			}

			fclose($input);
		} else {
			echo "There is no file $fileName";
		}

	};

	run();
 ?>