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

### コンテナのビルドと起動

ビルド
```bash
docker-compose build
```

開発サーバ起動
```bash
docker-compose up -d
```

### 起動確認

ブラウザで起動していることを確認
http://localhost:8000

## コマンド例
### Laravel バージョン確認
```bash
docker-compose exec app php artisan --version
```

### データベースマイグレーション
```bash
docker-compose exec app php artisan migrate
```