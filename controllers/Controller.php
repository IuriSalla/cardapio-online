<?php
    abstract class Controller{
     
        protected  $data = array();
        protected  $view = '';
        protected  $head = array('title' => '', 'description' => '');
     
        protected $base = 1; 
     
        public $baseUrl = "cardapio_online/"; 
     
        abstract function process($params);
     
        public function renderView(){
     
            if($this->view){
                extract($this->data);
                extract($this->data, EXTR_PREFIX_ALL, "");
                require "views/$this->view.phtml";
            }
        }
     
        public function redirect($url){
     
            $url = $this->baseUrl . $url;
            header("Location: /$url");
            header("Connection: close");
            exit;
        }
    }
?>
