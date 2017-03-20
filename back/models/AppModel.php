<?php

class AppModel
{
	public function getContent()
	{
		global $bdd;

		$currentPage = 'content_'.strtolower(get_called_class());
		$sql = "SELECT * FROM $currentPage";
		return $bdd->query($sql)->fetchAll()[0];
	}

	public function UpdateContent($data)
	{
		global $bdd;

		array_pop($data); // Remove last entrance (button submit)
		$table = 'content_'.strtolower(get_called_class());

		$sql = "UPDATE $table SET";
		foreach ($data as $column => $value)
			$sql .= " $column = :$column,";

		$sql = substr($sql, 0, -1);

		$req = $bdd->prepare($sql);
		foreach ($data as $column => $value)
			$req->bindValue($column, $value, PDO::PARAM_STR);

		return $req->execute();
	}

	public static function getTxtBlock($nb)
	{
		global $bdd;

		$column = 'txt_block_'.$nb;
		$table = 'content_'.strtolower(get_called_class());

		$sql = "SELECT $column FROM $table";
		return nl2br($bdd->query($sql)->fetch()->$column);
	}

	public static function getTitle()
	{
		global $bdd;

		$table = 'content_'.strtolower(get_called_class());

		$sql = "SELECT title FROM $table";
		return $bdd->query($sql)->fetch()->title;
	}
}

?>
