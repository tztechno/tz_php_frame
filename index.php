<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->setBasePath('/');

// エラーハンドリング
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// ルーティングとミドルウェアを設定
require __DIR__ . '/src/routes/api.php';

$app->run();
