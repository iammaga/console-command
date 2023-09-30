<?php

class Product
{
	private string $file_name;

	public function __construct($file_name)
	{
		$this->file_name = $file_name;
	}

	public function setFileName($file_name)
	{
		$this->file_name = $file_name;
	}

	public function getFileName()
	{
		return $this->file_name;
	}

	public function add($product, $price)
	{
		$data = "$product - $price";

		$file = fopen($this->file_name, 'a');

		if (filesize($this->file_name) !== 0) {
			fwrite($file, " $data");
		} else {
			fwrite($file, $data);
		}

		fclose($file);
	}

	public function updateName($old_name, $new_name)
	{
		if (!file_exists($this->file_name)) {
			echo 'File not found. Please create your file and try again!';
			return;
		}

		$file = fopen($this->file_name, 'r');

		if (filesize($this->file_name) !== 0) {
			$file_data = fread($file, filesize($this->file_name));

			$pos = strpos($file_data, $old_name);

			if ($pos !== false) {
				for ($i = $pos; $i < strlen($file_data); $i++) {
					if ($file_data[$i] == ' ' && $file_data[$i + 1] == '-') {
						$new_data = substr($file_data, 0, $pos - 1) . " $new_name " . substr($file_data, $i + 1, strlen($file_data) - $i);

						$file = fopen($this->file_name, 'w');
						fwrite($file, $new_data);
						fclose($file);

						return;
					}
				}
			} else {
				echo 'Product not found!';
			}
		} else {
			echo 'Product not found!';
		}

		fclose($file);
	}

	public function remove($product)
	{
		if (!file_exists($this->file_name)) {
			echo "This file '$this->file_name' not found!";
			return;
		}

		$file = fopen($this->file_name, 'r');

		if (filesize($this->file_name) !== 0) {
			$file_data = fread($file, filesize($this->file_name));

			$pos = strpos($file_data, $product);

			if ($pos !== false) {
				for ($i = $pos; $i < strlen($file_data); $i++) {
					if ($file_data[$i] >= '0' && $file_data[$i] <= '9' && ($file_data[$i + 1] == ' ' || $i === strlen($file_data) - 1)) {
						$new_data = substr($file_data, 0, $pos - 1) . substr($file_data, $i + 1, strlen($file_data) - $i);

						$file = fopen($this->file_name, 'w');
						fwrite($file, $new_data);
						fclose($file);

						return;
					}
				}
			} else {
				echo 'Product not found!';
			}
		} else {
			echo 'Product not found!';
		}

		fclose($file);
	}
}
