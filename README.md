Este projeto é uma API REST construída utilizando o Slim Framework.
As dependencias do Composer não estão embutidas.

Existe um arquivo dentro da raiz chamado routes.json, ele serve como um auxilio para o mapeamento das rotas da API.
O modelo de declaração é mais ou menos o seguinte:
```json
{
  "name": "NOME_DO_GRUPO", 
  "controller": "CLASSE_DO_CONTROLLER",
  "groups": [],
  "routes": [
    { "callback": "FUNCAO_NO_CONTROLE", "method": "METODO_HTTP", "path": "CAMINHO_DA_ROTA" }
  ]
}
```
por exemplo:
```json
{
  "name": "test",
  "controller": "TestController",
  "groups": [],
  "routes": [
    { "callback": "index", "method": "GET", "path": "{nome}" }
  ]
}
```
gera uma rota `(GET)` -> `"/test"` => `TestController:index($nome)`