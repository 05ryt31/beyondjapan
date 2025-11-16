# ウェブサイトパフォーマンス最適化プラン

## 現在の問題
- **83リクエスト** (目標: 20以下)
- 画像: 66リクエスト
- JavaScript: 7リクエスト  
- CSS: 10リクエスト

## 優先度別最適化案

### 🔥 高優先度: 画像最適化 (66→15リクエスト削減)

1. **CSS Spritesの実装**
   - アイコン類を1つのスプライト画像に統合
   - support_ico01-15.png → support-icons-sprite.webp
   - kv_ico01-03.png → kv-icons-sprite.webp

2. **重複画像の除去**
   - バナー画像の重複読み込み修正 (front-page.php:38-50)
   - 22リクエスト削減可能

3. **画像フォーマット変更**
   - PNG → WebP (圧縮率60-80%向上)
   - 次世代フォーマット対応

4. **遅延読み込み実装**
   ```html
   <img loading="lazy" src="..." alt="...">
   ```

### 🔸 中優先度: CSS最適化 (10→3リクエスト)

1. **CSSファイル統合**
   ```php
   // 統合前
   <link rel="stylesheet" href=".../style_basic.css">
   <link rel="stylesheet" href=".../common.css">
   <link rel="stylesheet" href=".../form.css">
   
   // 統合後
   <link rel="stylesheet" href=".../combined.min.css">
   ```

2. **外部CSS削減**
   - CDNライブラリをローカル化
   - 必要な部分のみ抽出

### 🔹 低優先度: JavaScript最適化 (7→3リクエスト)

1. **ファイル統合とミニファイ**
2. **非同期読み込み**
   ```html
   <script async defer src="..."></script>
   ```

### 📦 追加最適化

1. **Gzip/Brotli圧縮有効化**
2. **ブラウザキャッシュ設定**
3. **CDN導入検討**

## 実装優先順位
1. バナー重複除去 (即座に22リクエスト削減)
2. アイコンスプライト化 
3. CSS統合
4. 画像WebP化
5. 遅延読み込み

## 期待効果
- **60%リクエスト削減** (83→33)
- **40%読み込み時間短縮**
- **Core Web Vitals改善**