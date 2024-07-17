<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Slimのファクトリを使用してアプリケーションインスタンスを生成
$app = AppFactory::create();

// app.phpで定義したクロージャを読み込み、$appを渡す
(require __DIR__ . '/../src/app.php')($app);

// アプリケーションを実行
$app->run();
