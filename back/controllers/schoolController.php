<?php
class SchoolController extends AppController
{
	public function submitForm($data)
	{
		foreach ($data as $key => $value)
		{
			if (empty($value) && $key !== 'updateForm')
				return false;
		}

		return true;
	}
}
?>
