<?php
    /* Classe RouterController que extende Controller,
    *  é a classe que ira redirecionar a url para poder chamar o controller apropriado
    *  Parametros:
    *   - Protected $controller, é a variavel objeto a ser guardada.
    */
    class RouterController extends Controller
    {
        
        protected $controller;
        
        public function process($params)
        {
        
            $parsedUrl = $this->parseUrl($params[0]);
        
            while($this->base > 0)
            {
                array_shift($parsedUrl);
                $this->base--;  
            }
    
            if(empty($parsedUrl[0]))
            {
                $this->redirect('exemplo');
            }
            
            $controllerClass = $this->dashesToCamel(array_shift($parsedUrl)). 'Controller';

            if(file_exists("controllers/$controllerClass.php")){
                $this->controller = new $controllerClass;

            }else{
                $this->redirect('erro');
            }

            $this->controller->process($parsedUrl);

            $this->data['title'] = $this->controller->head['title'];
            $this->data['description'] = $this->controller->head['description'];

            $this->view = 'layout';
        }
        public function parseUrl($url){
         
            $parsedUrl = parse_url($url);
         
            $parsedUrl["path"] = ltrim($parsedUrl["path"], "/");
         
            $parsedUrl["path"] = trim($parsedUrl["path"]);
         
            return $explodedUrl = explode("/", $parsedUrl["path"]);   
        }
        public function dashesToCamel($text){
            $text = str_replace('-', ' ', $text);
            $text = ucwords($text);
            return $text = str_replace(' ', '', $text);
        }
    }
?>
