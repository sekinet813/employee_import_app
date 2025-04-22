# employee_import_app
Laravel + Vue.js による従業員データのCSVインポート機能を提供するアプリケーションです。  
本プロジェクトは Docker コンテナ環境で構築・実行できます。

---

## 構成

- Laravel (PHP 8.3)
- MySQL 8.0
- Node.js 20.x + npm (Vite + Vue.js)
- Breeze (Bladeテンプレート)

---

## Docker を使った構築

### ディレクトリ構成

```
.
├── README.md
├── docker
│   └── Dockerfile
├── docker-compose.yml
├── src    ← Laravel プロジェクト一式
└── test   ← 従業員テストデータ
```

### 初回セットアップ

#### Laravel プロジェクトを作成

```bash
docker-compose run --rm app composer create-project laravel/laravel .
```

補足: すでに src/ ディレクトリに Laravel プロジェクトがある場合はこの手順は不要です。

#### コンテナのビルドと起動

ビルド
```bash
docker-compose build
```

開発サーバ起動
```bash
docker-compose up -d
```

#### Breeze インストール & Vue セットアップ

```bash
docker-compose exec app composer require laravel/breeze --dev
docker-compose exec app php artisan breeze:install blade
docker-compose exec app npm install
docker-compose exec app npm install vue
docker-compose exec app npm install -D @vitejs/plugin-vue
```

#### 起動確認

ブラウザで起動していることを確認
http://localhost:8000

### コマンド例
### Laravel バージョン確認
```bash
docker-compose exec app php artisan --version
```

### データベースマイグレーション
```bash
docker-compose exec app php artisan migrate
```