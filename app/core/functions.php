 <?php

 use JetBrains\PhpStorm\NoReturn;

 function show($stuff): void
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}
function get_date($date)
{
    return date("jS M, Y", strtotime($date));
}

function set_value($key, $default = '')
{

    if(!empty($_POST[$key])){
        return $_POST[$key];
    }else if(!empty($default)){
        return $default;
    }
    return '';
}
 function set_select($key, $value, $default = '')
 {

     if(!empty($_POST[$key])){
         if($value == $_POST[$key]){
             return ' selected ';
         }
     }else if(!empty($default)){
         if($value == $default){
             return ' selected ';
         }
         return $default;
     }
     return '';
 }

function redirect($link): void
{
    header("Location: ". ROOT."/".$link);
    die;
}

function message($msg = '', $erase = false)
{
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }else{
        if(!empty($_SESSION['message'])){
            $msg = $_SESSION['message'];
            if($erase){
                unset($_SESSION['message']);
            }
            return $msg;
        }
    }
    return false;
}

 function esc($str): string
 {
    return nl2br(htmlspecialchars($str));
 }

 function str_to_url($url): array|string|null
 {
    $url = str_replace(" ", "-", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
    return $url;
 }


