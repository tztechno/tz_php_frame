<?php
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

function calculateLucasNumber($n) {
    if ($n === 0) return 2;
    if ($n === 1) return 1;
    $a = 2;
    $b = 1;
    $temp = 0;
    for ($i = 2; $i <= $n; $i++) {
        $temp = $a + $b;
        $a = $b;
        $b = $temp;
    }
    return $b;
}

$app->group('/api', function (RouteCollectorProxy $group) {
    $group->post('/calculate', function (Request $request, Response $response) {
        $data = json_decode($request->getBody()->getContents(), true);
        
        // デバッグ用ログ出力
        error_log(print_r($data, true));
        
        if (isset($data['n'])) {
            $n = $data['n'];
            $startTime = microtime(true);
            $result = calculateLucasNumber((int)$n);
            $endTime = microtime(true);
            $processTime = ($endTime - $startTime) * 1000; // ミリ秒単位で計算時間を取得
            
            $payload = json_encode(['result' => $result, 'process_time' => $processTime]);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write(json_encode(['error' => 'Invalid input']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    });
});
