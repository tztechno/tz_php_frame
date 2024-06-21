###
# Slim
###

---

---

---

---

PHPフレームワークであるSlimを使用して、同様の機能を実現する方法について説明します。Slimは軽量で柔軟なPHPマイクロフレームワークであり、RESTfulなWebアプリケーションを簡単に構築するのに適しています。

まず、SlimをインストールするためにComposerを使用します。Composerがインストールされていない場合は、[Composerのインストール手順](https://getcomposer.org/download/)を参照してください。

以下の手順に従って、Slimを使ったLucas数の計算を行うアプリケーションを構築します。

### 1. Composerを使用してSlimをインストールする

まず、ターミナルでプロジェクトのルートディレクトリで以下のコマンドを実行します：

```bash
composer require slim/slim "^4.0"
```

これにより、Slimフレームワークがインストールされます。

### 2. プロジェクトのディレクトリ構造を準備する

プロジェクトのディレクトリ構造を次のように設定します：

```
project-root/
  |- public/
      |- index.html
  |- src/
      |- routes/
          |- api.php
      |- helpers.php
  |- composer.json
  |- composer.lock
  |- index.php
```

### 3. index.phpを設定する

`index.php`ファイルを作成し、Slimアプリケーションを初期化します。

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

// ミドルウェアとルーティングを設定
require __DIR__ . '/src/routes/api.php';

$app->run();
```

### 4. APIルートを設定する

`src/routes/api.php`にAPIルートを設定します。

```php
<?php
use Slim\Psr7\Request;
use Slim\Psr7\Response;

// Lucas数を計算する関数
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

// POSTリクエスト '/calculate' を処理する
$app->post('/calculate', function (Request $request, Response $response, $args) {
    $data = json_decode($request->getBody(), true);
    $n = $data['n'];

    // 計算開始時刻を記録
    $startTime = microtime(true);

    // Lucas数を計算
    $result = calculateLucasNumber($n);

    // 計算終了時刻を記録し、処理時間を計算
    $endTime = microtime(true);
    $processTime = ($endTime - $startTime) * 1000; // ミリ秒単位で計算時間を取得

    // 結果と処理時間をJSON形式で返す
    $response->getBody()->write(json_encode(['result' => $result, 'process_time' => $processTime]));
    return $response->withHeader('Content-Type', 'application/json');
});
```

### 5. index.htmlを用意する

`public/index.html`はそのまま使用します。

```html
<!DOCTYPE html>
<html>

<head>
    <title>Lucas Number Calculator</title>
</head>

<body>
    <p>AJAX Lucas Number</p>
    <input type="number" id="inputN" placeholder="Enter a number">
    <button onclick="sendRequest()">Calculate</button>
    <div id="result"></div>
    <div id="time"></div>

    <script>
        function sendRequest() {
            const n = document.getElementById('inputN').value;
            fetch('/calculate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ n })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('result').innerText = `Lucas Number L${n} = ${data.result}`;
                    document.getElementById('time').innerText = `Time: ${(data.process_time / 1000).toFixed(3)} sec`;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>
```

### 6. サーバーを起動する

Slimフレームワークを使用してPHPのビルトインサーバーを起動します。

```bash
php -S localhost:3000 -t public
```

これで、Slimを使用したPHPアプリケーションが完成しました。`http://localhost:3000`にアクセスすると、`public/index.html`が表示され、Lucas数の計算を行うことができます。

Slimを使用することで、PHPで簡潔で効率的なWebアプリケーションを構築することができます。

---
