###
# Lumen
###

---

---

---

---

---

Lumenは、Laravelから派生した軽量なPHPマイクロフレームワークで、APIやマイクロサービスの開発に最適です。Lumenのインストール方法を以下に示します。

### 前提条件

- PHP 7.3以降
- Composerがインストールされている

### インストール手順

1. **Composerのインストール（必要な場合）**

   ComposerはPHPの依存関係管理ツールです。まだインストールしていない場合は、以下のコマンドを実行してインストールしてください。

   ```bash
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   ```

2. **Lumenプロジェクトの作成**

   Composerを使用してLumenプロジェクトを新規作成します。

   ```bash
   composer create-project --prefer-dist laravel/lumen my_lumen_app
   ```

   このコマンドで、`my_lumen_app`という名前の新しいディレクトリが作成され、その中にLumenのプロジェクトファイルがインストールされます。

3. **ディレクトリに移動**

   プロジェクトディレクトリに移動します。

   ```bash
   cd my_lumen_app
   ```

4. **サーバーの起動**

   PHPの組み込みサーバーを使用してLumenアプリケーションを起動します。

   ```bash
   php -S localhost:8000 -t public
   ```

   これで、ブラウザで`http://localhost:8000`にアクセスすることでLumenアプリケーションを確認できます。

### 簡単なルートの追加

初期設定が完了したら、簡単なルートを追加して動作を確認してみましょう。`routes/web.php`ファイルを開いて、以下の内容を追加します。

```php
$router->get('/', function () use ($router) {
    return 'Hello, Lumen!';
});
```

これで、ブラウザで`http://localhost:8000`にアクセスすると「Hello, Lumen!」というメッセージが表示されるはずです。

### まとめ

Lumenのインストール手順は非常にシンプルで、Composerを使用して数分でセットアップが完了します。Lumenは軽量で高速なフレームワークなので、シンプルなAPIやマイクロサービスの構築に最適です。


---
