<?php

use FastRoute\RouteCollector;

class Routing {

    private $c;

    public function __construct(ContainerDI $c){
        //ss('Routing');
        
        $this->c = $c;
        $this->app = $c->get('App');

        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];


        if (false !== $pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }


        $this->uri = rawurldecode($this->uri);


    }

    public function dispatch($dispatcher, $httpMethod, $uri) {
        // ss($httpMethod, $uri);
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        // ss($routeInfo[0]);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                $this->c->get('App')->apiResult->send('NOT FOUND', false);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ssd('hein');    
                // ... 405 Method Not Allowed
                ss($allowedMethods);
                $this->c->get('App')->apiResult->send('METHOD NOT ALLOWED', false);
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ssd($vars);
                $vars['params'] = $this->setRouteUserParams($httpMethod,$uri,$vars);
                call_user_func($handler, $vars);
                break;
        }
    }

        // Récupération des données passées via la route selon la méthode HTTP
        public function setRouteUserParams($httpMethod,$uri = null,$vars = null) {

            switch($httpMethod) {
      
              case 'POST':
                return $_POST;
                break;
      
              case 'PUT':
              case 'PATCH':
                return json_decode(file_get_contents('php://input'), true);
                break;
      
              case 'HEAD':
              case 'OPTIONS':
                if (strpos($uri, '/upload') === 0) {
                  return null;
                  
                }
                break;

              default:
                return isset($vars['params']) ? $vars['params'] : null;
            }
      
          }

    public function dispatcher() {
        $dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
            $r->addRoute('GET', '/{class}/{method}[/{params:[0-9a-zA-Z]+}]', function($vars) {
                $class = $vars['class'];
                $method = $vars['method'];
                $params = $vars['params'];
                if (isset($vars['params'])) {
                    $params = filter_var($vars['params'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $this->c->get($class)->$method($params);
                } else {
                    $this->c->get($class)->$method();
                }
            });
            $r->addRoute('POST', '/{class}/{method}', function($vars) {
                $class = $vars['class'];
                $method = $vars['method'];
                $params = json_decode(file_get_contents('php://input'), true);
                $this->checkPostData($params);
                $this->app->get($class)->$method($params);
            });
        });

        return $dispatcher;
    }




    public function checkPostData($data){
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
        }
        
        if (is_array($data)) {
            array_walk_recursive($data, function (&$value) {
                $value = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            });
        } else {
            // Handle error: expected array, got something else
           // ss('Corupt data.');
        }
    }
}

