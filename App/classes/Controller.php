<?php

# Abstract parent class with the common methods for the other controllers
abstract class Controller {

    # Requiring the model's file with the new model's object
    protected function model($model) {
        require_once 'App/models/' . $model . '.php'; 
        return new $model;
    }

    /**
     * Passing the view and the values into the main layout
     * requiring the main layout
     */
    protected function view($setView, $data = []) {
        $view = 'App/views/' . $setView . '.php';
        require_once 'App/views/layouts/main.php';
    }

}