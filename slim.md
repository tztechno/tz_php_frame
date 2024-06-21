
---
```
index.htmlの表示まではOK
Ajax通信は失敗
```
```
cd myapp
composer require slim/slim:"^4.0"
composer require slim/psr7


myapp/
|-- public/
|   |-- index.php
|   |-- index.html
|-- src/
|   |-- routes.php
|-- vendor/
|-- composer.json
|-- composer.lock

cd myapp
php -S localhost:8000 -t public

http://localhost:8000

```

---

Slimフレームワークを使用して、`public/index.html`をホストする方法を説明します。

### 1. ディレクトリ構造

まず、以下のようなディレクトリ構造を作成します：

```
myapp/
|-- public/
|   |-- index.php
|   |-- index.html
|-- src/
|   |-- routes.php
|-- vendor/
|-- composer.json
|-- composer.lock
```

### 2. `public/index.php` の作成

`public/index.php`ファイルを作成して、Slimアプリケーションの設定を行います。

```php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

// ルーティングの設定
(require __DIR__ . '/../src/routes.php')($app);

$app->run();
```

### 3. `src/routes.php` の作成

次に、`src/routes.php`ファイルを作成し、ルーティングを定義します。

```php
<?php

use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response, $args) {
        // index.html の内容を読み込んでレスポンスとして返す
        $response->getBody()->write(file_get_contents(__DIR__ . '/../public/index.html'));
        return $response;
    });
};
```

### 4. サーバーの起動

Composerで必要なパッケージをインストールした後、以下のコマンドを使用して組み込みのPHP開発サーバーを起動します。

```bash
php -S localhost:8000 -t public
```

### 5. 動作確認

ブラウザで `http://localhost:8000` にアクセスすると、`public/index.html`の内容が表示されるはずです。

### まとめ

これで、Slimフレームワークを使用して`public/index.html`をホストする準備が整いました。Slimを使うことで、シンプルで効率的なPHPアプリケーションを構築することができます。

---
