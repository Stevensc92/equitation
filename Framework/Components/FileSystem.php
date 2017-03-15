<?php

class FileSystem
{
     public static function browse($root , $id = null, $class = null)
     {
        $folder  = opendir($root);
        $folders = '';
        $files   = '';

        while(($file = readdir($folder)) != '')
            if(!preg_match('`^\.`', $file))
                if(strstr($file, '.'))
                    $files .= '<li><a href="'.$root.DS.$file.'" class="file">'.$file.'</a></li>';
                elseif(is_dir($root.DS.$file))
                    $folders .= '<li><strong><i class="fa fa-folder"></i> <a href="'.$root.DS.$file.'" class="folder">'.$file.'</a></strong></li>';

        $folder = closedir($folder);
        return '<ul'.(!is_null($id) ? ' id="'.$id.'"' : '').(!is_null($class) ? ' class="'.$class.'"' : '').'>'.$folders.$files.'</ul>';
    }
}

?>