<?php

class Evreux extends AppModel
{
    public static function getDistance()
    {
		global $bdd;

        $table = 'content_'.strtolower(get_called_class());

		$sql = "SELECT txt_distance FROM $table";

		return nl2br($bdd->query($sql)->fetch()->txt_distance);
    }

	public static function getAddress()
	{
		global $bdd;

        $table = 'content_'.strtolower(get_called_class());

		$sql = "SELECT txt_address FROM $table";

		return nl2br($bdd->query($sql)->fetch()->txt_address);
	}

	public static function getEmail()
	{
		global $bdd;

        $table = 'content_'.strtolower(get_called_class());

		$sql = "SELECT txt_mail FROM $table";

		return nl2br($bdd->query($sql)->fetch()->txt_mail);
	}

	public static function getTel()
	{
		global $bdd;

        $table = 'content_'.strtolower(get_called_class());

		$sql = "SELECT txt_number FROM $table";

		return nl2br($bdd->query($sql)->fetch()->txt_number);
	}
}
