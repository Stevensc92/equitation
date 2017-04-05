<?php
class ServiceController extends AppController
{
    public function __construct()
	{
		$this->setUnsetField([
			'updateForm'
		]);
	}
}
?>
