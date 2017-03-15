<?php

class Upload
{
	public static $file, $name, $size, $ext, $dir, $source, $max_size, $error, $filename, $errors;
	public static $allowedExts = ['png', 'jpg', 'gif', 'jpeg'];

	public static function process($dir, $filename = null, $size = 8192)
	{
		ini_set('post_max_size', '20M');
		ini_set('upload_max_filesize', '20M');

		if (!is_null($filename))
			self::$filename 	= $filename;


		self::$file     = $_FILES;
		self::$dir      = $dir;
		self::$source   = $_FILES['upload']['tmp_name'];
		self::$max_size = self::convert($size);

		self::checkStatus();
		return self::startUpload();
	}

	public static function rename()
	{
		if (is_null(self::$filename))
			return uniqid().'_'.hash('crc32b', self::$name);
		else
			return self::$filename;
	}

	public static function convert($size)
	{ return $size * 1024; }

	public static function checkStatus()
	{
		self::$name   = self::$file['upload']['name'];
		self::$size   = self::$file['upload']['size'];
		self::$error  = self::$file['upload']['error'];

		$ext = end(explode('.', self::$name));
		//invalid format
		if(!in_array($ext, self::$allowedExts))
			self::$errors[] = ["message" => "Format invalide"];
		else
			self::$ext = $ext;

		//invalid size
		if(self::$size > self::$max_size)
			self::$errors[] = ['message' => "Taille invalide"];
	}

	public static function startUpload()
	{
		if (!empty(self::$errors))
			return self::$errors;
		else
		{
			if(self::$error == UPLOAD_ERR_OK)
			{
				$name = self::rename();

				move_uploaded_file(self::$source, self::$dir.'/'.$name.'.'.self::$ext);
				return $name.'.'.self::$ext;
			}
			else
				return false;
		}
	}
}
?>