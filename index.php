<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// HTMLを表示するルート
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write(file_get_contents(__DIR__ . '/index.html'));
    return $response;
});

// ルーカス数を計算するルート
$app->post('/calculate', function (Request $request, Response $response, $args) {
    $data = json_decode($request->getBody(), true);
    $n = intval($data['n']);

    $start_time = microtime(true);
    $result = calculateLucas($n);
    $end_time = microtime(true);

    $process_time = ($end_time - $start_time) * 1000; // ミリ秒に変換

    $response->getBody()->write(json_encode([
        'result' => $result,
        'process_time' => $process_time
    ]));
    return $response->withHeader('Content-Type', 'application/json');
});

// ルーカス数を計算する関数
function calculateLucas($n) {
    // 基本ケース
    if ($n == 0) return 2;
    if ($n == 1) return 1;
    
    // 再帰呼び出し
    return calculateLucas($n - 1) + calculateLucas($n - 2);
}
$app->run();