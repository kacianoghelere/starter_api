<?php

class RouteConfig {

    private $app;

    public function __construct(Slim\App &$app, $route_file) {
        $this->app = $app;
        $file = file_get_contents($route_file);
        $routes = json_decode($file, true);
        $array = [];
        $this->mapRoutes($routes);
        // print_r($this->app);
    }

    /**
     * Método recursivo de mapeamento de rotas
     * @param  array  $group Informações do grupo de rotas
     * @param  string $root  Raiz do caminho
     */
    private function mapRoutes($group, $root = "/") {
        $group_path = "{$root}{$group['name']}";
        error_log("GROUP => \"{$group_path}\"");

        $controller = $group['controller'];
        foreach ($group['routes'] as $route) {
            $route_path = !empty($route['path']) ? "/{$route['path']}" : "";
            $real_path = "{$group_path}{$route_path}";
            $callback = "{$controller}:{$route['callback']}";
            error_log("ROUTE ({$route['method']}) "
                . "-> \"{$group_path}{$route_path}\" "
                . "=> [{$callback}]");
            $this->app->map([$route['method']], $real_path, $callback);
        }
        foreach ($group['groups'] as $subgroup) {
            $this->mapRoutes($subgroup, $group_path);
        }
    }
}