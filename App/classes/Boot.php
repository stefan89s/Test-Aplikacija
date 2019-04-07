<?php

class Boot {

    # The basic controller
    private $controller = 'home';

    # The basic method
    private $method = 'index';

    # Parameters from the URL
    private $params = [];

    # Rooting for the Application
    public function __construct() {

        # Storing the URL into a variable
        $url = $this->url();

        /** 
         * Setting the controller if the file exists
         * In the case the first value from the URL doesn't match with any file Name
         * We already set the default one, 'home', which will always exits in the file structure
         */
        if(file_exists('App/controllers/' . $url[0] . '.php')) {
            # Overriding the default value for the controller
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        # Requiring the file
        require 'App/controllers/' . $this->controller . '.php';

        # Instantiating the controller (creating the new object)
        $this->controller = new $this->controller;

        /**
         * Checking if the second value in the URL exists as a method in the controller's class
         * If not, we already set the default one, 'index', whihch will always exits in the class
         */
        if(isset($url[1])) {
            # If the value match with some method in the class
            # We are overriding the default value for the method
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        $this->params = $url ? array_values($url) : [];

        # Calling the values which will start/run the Application
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    # The method for returning the URL values
    protected function url() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}