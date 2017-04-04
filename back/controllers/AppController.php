<?php

class AppController
{
	public $model;
    public $nameField = [
        'title'         => 'Titre de la section',
        'sub_title'     => 'Sous-titre',
        'txt_block_1'   => 'Contenu du premier bloc de texte',
        'txt_block_2'   => 'Contenu du deuxième bloc de texte',
        'txt_block_3'   => 'Contenu du troisième bloc de texte',
        'txt_distance'  => 'Distance de marche',
        'txt_address'   => 'Adresse du centre',
        'txt_mail'      => 'Mail de contact',
        'txt_number'    => 'Téléphone de contact'
    ];
	public $unsetField = [];


	public function __construct($model)
	{
		$this->setModel($model);
	}

	/**
	 * [emptyForm description]
	 * @param  [array]         $data   [data to verif]
	 * @param  [array|null]    $unset  [except field for verification]
	 * @return [bool]                  [return false if one data is empty]
	 */
    public function emptyForm($data, $unset = null)
	{
        // default $unset = array
		if ($unset !== null)
		{
			foreach ($data as $key => $value)
			{
				if (empty($value) && !in_array($key, $unset))
					return false;
			}
		}
		else
		{
			foreach ($data as $key => $value)
			{
				if (empty($value))
					return false;
			}
		}
		return true;
	}

	private function setModel($model)
	{
		$this->model = $model;
		return $this;
	}

	public function setUnsetField($field)
	{
		foreach ($field as $key)
			$this->unsetField[] = $key;

		return $this;
	}

	public function getUnsetField()
	{
		return $this->unsetField;
	}
}

?>
