    <?php

    class App
    {
        protected string $controller = '_404';
        protected string $method = 'index';
        public static string $page = '_404';

        function __construct()
        {
            $arr = $this->getURL();
            $filename = "../app/controllers/" .ucfirst($arr[0]).".php";
            if(file_exists($filename)){
            require $filename;
            $this->controller = $arr[0];
            self::$page = $arr[0];
            unset($arr[0]);
            }
        else{
            require "../app/controllers/" .$this->controller. ".php";
        }
        $myController = new $this->controller();
        $myMethod = $arr[1] ?? $this->method;

        if(!empty($arr[1])){
            if(method_exists($myController, strtolower($myMethod))){
                $this->method = strtolower($arr[1]);
                unset($arr[1]);
            }
        }
        $arr = array_values($arr);
        call_user_func_array([$myController,$this->method], $arr);
        }
        private function getURL(){
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $arr = explode("/", $url);
            return $arr;
        }
    }