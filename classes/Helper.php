<?php

namespace Classes;


class Helper
{
	public static function displayDrinks($drinks = [])
	{
		if ($drinks) {
			echo '<table width="100%" border="1" style="border-collapse:collapse">';
			echo '<tr>';
			echo '<th width="10%">Drink</th>';
			echo '<th width="50%">Description</th>';
			echo '<th width="30%">Ingredients</th>';
			echo '<th width="10%">TotalPrice</th>';
			echo '</tr>';

			foreach ($drinks as $drink) {
				echo "<td>{$drink['drink']['name']}</td>";
				echo "<td>{$drink['drink']['description']}</td>";
				echo '<td>' . implode(',', array_column($drink['ingredients'], 'name')) . '</td>';
				echo "<td>{$drink['totalPrice']}</td>";
				echo '</tr>';
			}
			echo '</table>';
		}
	}
}