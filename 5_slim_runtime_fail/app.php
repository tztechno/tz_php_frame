<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
    // Routing Middlewareを追加
    $app->addRoutingMiddleware();

    // ErrorMiddlewareを追加
    $app->addErrorMiddleware(true, true, true);

    // ルートの設定
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(file_get_contents(__DIR__ . '/../templates/index.html'));
        return $response;
    });

    // /calculateエンドポイントの設定
    $app->post('/calculate', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $inputData = $data['inputData'];
        $functionCode = $data['functionCode'];

        $start = microtime(true);

        try {
            ob_start();
            eval($functionCode);
            $output = ob_get_clean();
        } catch (Throwable $e) {
            $output = 'Error: ' . $e->getMessage();
            return $response->withJson(['error' => $output], 400);
        }

        $end = microtime(true);
        $process_time = ($end - $start) * 1000; // milliseconds

        $result = [
            'inputData' => $inputData,
            'result' => $output,
            'process_time' => $process_time
        ];

        return $response->withJson($result);
    });

    // 404エラーハンドリング
    $app->map(['GET', 'POST'], '/{routes:.+}', function (Request $request, Response $response) {
        throw new HttpNotFoundException($request);
    });
};
