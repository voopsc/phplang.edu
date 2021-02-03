<?php

    /**
     *
     */
    class Router
    {

      private $routes;

      /** Constructor of routes path
      */
      function __construct()
      {
        $routesPath = ROOT . '/core/config/routes.php';
        if (file_exists($routesPath)) {
          $this->routes = include_once($routesPath);
        } else {
          die('error');
        }
      }

      /** Get requested uri and prepare it to comparison with router rule
      * (normalize uri value)
      * @return string
      */
      private function getURI()
      {

        if (!empty($_SERVER['REQUEST_URI'])) {

          $routeRule = trim($_SERVER['REQUEST_URI'], '/');

          // Get part of uri without GET request if it exist (ignore GET)
          if (preg_match('/\?/', $routeRule)) {
            // get rule for router which based on request uri
            $routeRule = explode('?', $routeRule);
            $routeRule = array_shift($routeRule);
            // normalize route rule
            $routeRule = trim($routeRule, '/');
          }
          return $routeRule;
        }
      }

      /** Get pair of router rule and router path (controller/action) by requested uri
      * @return array
      */
      private function checkURI()
      {
        // init vars
        $result = false;
        $uri = $this->getURI();
        $routesArray = $this->routes;

        // get existed rule for user requested uri
        foreach ($routesArray as $rulePattern => $path) {
          if (preg_match("~$rulePattern~i", $uri)) {
            $result = [$rulePattern, $path];
            return $result;
          }
        }
      }

      /** Initialization of router
      * @return callable
      */
      public function run()
      {
        $requestedURI = $this->getUri();
        $routeData = $this->checkURI();

        $developerMode = (int) ini_get('display_errors');

        if (isset($routeData) && !empty($routeData)) {
          $uriPattern = array_shift($routeData);
          $path = array_shift($routeData);

          // Set all variables for init controller and actions
          $iternalRoute = preg_replace("~$uriPattern~i", $path, $requestedURI);
          $segments = explode('/', $iternalRoute);
          $controllerName = array_shift($segments).'Controller';
          $controllerName = ucfirst($controllerName);

          $actionName = 'action'.ucfirst(array_shift($segments));
          $paramenters = $segments;

          $controllerFile = ROOT . '/core/controllers/' . $controllerName . '.php';

          // Call controller and action
          if (file_exists($controllerFile)) {
            include_once($controllerFile);
            $controllerObject = new $controllerName;

            // Call method
            if (method_exists($controllerObject, $actionName)) {
              $result = call_user_func_array(array($controllerObject, $actionName), $paramenters);
            } else {
              switch ($developerMode) {
                case 0: $this->errorRequest(); break;
                case 1: echo "Error x0003: there is no action in existed controller"; die;
              }
            }

          } else {
            switch ($developerMode) {
              case 0: $this->errorRequest(); break;
              case 1: echo "Error x0002: there is no controller file for this URI"; die;
            }
          }
          // end
        } else {
          switch ($developerMode) {
            case 0: $this->errorRequest(); break;
            case 1: echo "Error x0001: there is no route rule and controller/action for this URI"; die;
          }
        }
      }


      // end of class
    }
