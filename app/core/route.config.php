<?php

/**
 * Utilitário de leitura e configuração de arquivos de rotas.
 * Para que o arquivo possa ser lido, ele deve ser .json e formatado de maneira
 * correta
 */
class RouteConfig {

    private $app;

    /**
     * Construtor do utiliário
     * @param Slim\App &$app       Instancia do Slim
     */
    public function __construct(Slim\App &$app) {
        $this->app = $app;
    }

    /**
     * Carrega rotas do arquivo
     * @param string $route_file Caminho do arquivo de rodas (.json)
     */
    public function load($route_file) {
        $routes = json_decode(file_get_contents($route_file), true);
        $this->mapRoutes($routes);
    }

    /**
     * Método recursivo de mapeamento de rotas
     * @param  array  $group Informações do grupo de rotas
     * @param  string $root  Raiz do caminho
     */
    private function mapRoutes($group, $root = "/") {
        $group_path = "{$root}{$group['name']}";
        $controller = $group['controller'];

        // Percore e mapeia as rotas do grupo atual
        foreach ($group['routes'] as $route) {
            $route_path = !empty($route['path']) ? "/{$route['path']}" : "";
            $real_path = "{$group_path}{$route_path}";
            $callback = "{$controller}:{$route['callback']}";
            $this->app->map([$route['method']], $real_path, $callback);
        }

        // Percore e mapeia os subgrupos do grupo atual
        foreach ($group['groups'] as $subgroup) {
            $this->mapRoutes($subgroup, $group_path);
        }
    }
}