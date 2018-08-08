<?php
    class EnlacesModels
    {
        public static function enlacesModel($enlaces)
        {
            $directorio = 'view/php/';
            $array_basename = $paginador = array();
            $scanned_directory = array_diff(scandir($directorio), array('..', '.'));
            foreach ($scanned_directory as $key => $value) {
                $array_basename[] =  $directorio.$value.'/';
            }

            foreach ($array_basename as $value) {
                foreach(glob($value.'*.php') as $filename){
                    $file = explode("/",$filename);
                    end($file);
                    $file = explode(".", pos($file));
                    $index = reset($file);
                    $paginador = array_merge($paginador, [$index => $filename] );
                }
            }

            if(array_key_exists($enlaces, $paginador))
                return $paginador[$enlaces];
            else
                return $array_basename[1].'direccionLogin.php';
        }
    }
?>