<?php
class PhilosophieController extends AppController
{
    public function __construct()
	{
		// Set except field to verif for empty
		$this->setUnsetField([
			'updateForm',
			'sub_title'
		]);
	}
}
?>
