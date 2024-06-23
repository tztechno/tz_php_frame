<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// POSTメソッドでの /calculate エンドポイント
$app->post('/calculate', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
    $n = $data['n'];

    // 計算と計算時間の測定
    $start = microtime(true);
    $result = calculateLucasNumber($n);
    $end = microtime(true);
    $processTime = ($end - $start); // 秒単位の計算時間

    // 結果をJSON形式で返す
    $response_data = [
        'result' => $result,
        'process_time' => $processTime
    ];

    return $response->withJson($response_data);
});

// ルーカス数を計算する関数
function calculateLucasNumber($n) {
    if ($n == 0) return 2;
    if ($n == 1) return 1;
    return calculateLucasNumber($n - 1) + calculateLucasNumber($n - 2);
}

// Slimアプリケーションの実行
$app->run();
