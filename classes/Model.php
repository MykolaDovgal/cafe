<?php

namespace Classes;

use voku\db\DB;

class Model
{
	private $db;

	private $tableNames = [
		'Ingredients' => 'Ingredients',
		'Drinks' => 'Drinks',
		'IngredientToDrink' => 'IngredientToDrink',
	];

	public function __construct()
	{
		$this->db = DB::getInstance('localhost', 'root', '', 'cafe');
	}

	public function addIngredient($data = [])
	{
		$newId = $this->db->insert($this->tableNames['Ingredients'], $data);
		return $newId;
	}

	public function addDrink($data = [], $ingredients = [])
	{
		$drinkId = $this->db->insert($this->tableNames['Drinks'], $data);

		$ingredientIds = [];
		if (count($ingredients) > 0) {
			foreach ($ingredients as $ingredient) {
				$ingredientIds[] = $this->addIngredient($ingredient);
			}
		}

		$this->joinIngredientToDrink($drinkId, $ingredientIds);


		return $drinkId;
	}

	private function joinIngredientToDrink($drinkId = 0, $ingredientIds = [])
	{
		if ($drinkId > 0 && count($ingredientIds) > 0) {
			foreach ($ingredientIds as $ingredientId) {
				$insertData = [
					'drinkId' => $drinkId,
					'ingredientId' => $ingredientId
				];
				$this->db->insert($this->tableNames['IngredientToDrink'], $insertData);
			}
		}
	}

	public function getDrink($drinkId = 0)
	{
		$result = [];
		if ($drinkId > 0) {
			$where = [
				'id' => $drinkId
			];
			$drink = $this->db->select($this->tableNames['Drinks'], $where)->first();

			$result['drink'] = $drink;

			$ingredients = $this->getIngredients($drinkId);

			$result['ingredients'] = $ingredients;

			$totalPrice = array_sum(array_column($ingredients, 'price'));

			$result['totalPrice'] = $totalPrice;
		}

		return $result;
	}

	public function getDrinks()
	{
		$drinks = [];
		$drinkIds = $this->db->select($this->tableNames['Drinks'])->fetchAllColumn('id');

		foreach ($drinkIds as $drinkId) {
			$drinks[] = $this->getDrink($drinkId);
		}

		return $drinks;

	}

	public function getIngredients($drinkId = 0)
	{
		$ingredientData = [];
		if ($drinkId) {
			$where = [
				'drinkId' => $drinkId
			];
			$ingredientToDrink = $this->db->select($this->tableNames['IngredientToDrink'], $where);

			$ingredientIds = [];
			foreach ($ingredientToDrink as $data) {
				$ingredientIds[] = $data['ingredientId'];
			}

			if (count($ingredientIds) > 0) {
				$where = [
					'id IN' => $ingredientIds
				];

				$ingredientDatas = $this->db->select($this->tableNames['Ingredients'], $where);

				foreach ($ingredientDatas as $ingredient) {
					$ingredientData[] = $ingredient;
				}
			}

		}

		return $ingredientData;
	}


}