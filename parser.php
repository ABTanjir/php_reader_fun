<?php 
ob_start();
    //you must include the root file from here
    include 'a.php';
ob_end_clean();
    
    
    read_php('a.php');

    function read_php($path){
        foreach(file($path) as $line) {
            $included_ = null;
            // echo included_files($line);
            echo show_line($line) . '<br>';
            $included_ = has_include($line);
            if($included_){
                read_php($included_);
            }
        }
    }

    function has_include($str){
        $included_files = get_included_files();
        foreach ($included_files as $filePath) {
            $filename = file_name($filePath);
            
            if (strpos($str, $filename) !== false) {
                return $filePath;
            }
        }
        return false;
    }

    function file_name($path){
        $file = basename($path);
        $filename = basename($file);
        return $filename;
    }

    function show_line($line){
        //sanitize lines here :p
        $finds = array('<?php', '?>');
        $replace = array('', '');
        return str_replace($finds, $replace, $line);
    }

?>