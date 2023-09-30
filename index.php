<?php

include 'Product.php';

// Написать консольную команду, которая получает два аргумента — «Имя файла», «Действие». Файл, который нужно открыть, содержит строки, имеющие формат: «Наименование» — «Цена» Например: Огурцы — 50 Помидоры — 40 Масло — 40 Реализовать следующие действия: Добавить в список Изменить запись в списке Удалить из списка Вычесть общую сумму В решении желательно использовать ООП подход.

$filename = readline('Enter file name: ');
$action = readline("Actions (1: Add, 2: Update, 3: Delete): ");

$product = new Product($filename);

if ($action == 1) {
	$product_name = readline('Enter product name: ');
	$product_price = readline('Enter product price: ');
	$product->add($product_name, $product_price);
} else if ($action == 2) {
	$old_name = readline('Enter old product name: ');
	$new_name = readline('Enter new product name: ');
	$product->updateName($old_name, $new_name);
} else if ($action == 3) {
	$product_name = readline('Enter product name: ');
	$product->remove($product_name);
}
