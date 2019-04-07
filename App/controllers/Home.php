<?php

class Home extends Controller {

    public function index() {
        # Passing the view and data into the main layout
        $this->view('home/index', [
                'value1' => 123,
                'value2' => 'Hello from Home/Index'
            ]);
    }

}























