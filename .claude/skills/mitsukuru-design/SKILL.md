---
name: mitsukuru-design
description: みつくる（mitukuru.com）のデザインシステム。LP・静的サイトをこのブランドで実装するときに従う、カラートークン・タイポgrafィ・余白・コンポーネント・レスポンシブの規約。新しいページやセクションを作るとき、既存の見た目に合わせるときに参照する。
---

# みつくる デザインシステム

トーンは **薄いグリーン基調 × やわらかい（丸み・余白多め・親しみ・手軽さ）**。
コピーは丁寧・親切な「〜できます／〜いただけます」調。言いきりのAIっぽい見出しは避ける。
※本システムは既存プロトタイプ `mitukuru-top.html` / `HANDOFF.md` から抽出した確定仕様。

## カラートークン（CSS変数）

```css
:root{
  /* ブランド・グリーン */
  --color-primary:        #1F8A4D; /* ボタン・アクセント（濃いグリーン） */
  --color-primary-dark:   #14633A; /* 見出し補助・ホバー・ゴースト文字 */
  --color-primary-darker: #0C3F26; /* 主要見出しテキスト */
  --color-primary-050:    #E8F5ED; /* ごく薄い面・チップ背景・入力モック */
  --color-primary-100:    #C4E7D1; /* eyebrow背景・薄い面 */
  --color-primary-200:    #8FCBA6; /* ボーダー・ゴースト枠・スクロールバー */
  --color-teal-050:       #E1F2EC; /* サブ面 */
  --color-teal-700:       #0F6E56; /* サブアイコン */
  /* ニュートラル */
  --color-ink:    #243027; /* 本文 */
  --color-muted:  #566159; /* 補足文 */
  --color-hint:   #82897F; /* キャプション・ラベル */
  --color-line:   rgba(0,0,0,.10);
  --color-line-2: rgba(0,0,0,.16);
  --color-bg:      #FFFFFF; /* 既定背景 */
  --color-bg-soft: #EFF6F0; /* 交互セクションの薄グリーン背景 */
  --color-footer:  #2C2C2A; /* フッター地色 */
}
```

セクション背景は白 ⇄ `--color-bg-soft`（薄グリーン）を**交互**に。
パートナー写真・事例サムネのプレースホルダーは緑系グラデーション
（例 `linear-gradient(140deg,#4FB477,#1F8A4D)` ／ ティール・オリーブ等でバリエーション）。

## タイポグラフィ

- 書体は見出し・本文とも **Noto Sans JP**（丸ゴシックは不採用）。
  `--font: "Noto Sans JP", system-ui, -apple-system, sans-serif;`
- ウェイトは 400 / 500 / 700。本文 `line-height:1.8`、見出し `1.5`。
- スケール目安（モバイル→デスクトップ）:
  - h1（ヒーロー）: 23px → 34px / 700
  - h2（セクション）: 22px → 28px / 700・中央寄せ
  - h3・カード見出し: 15–19px / 700
  - 本文: 15–16px、補足: 12.5–14px、キャプション: 10.5–12px

## シグネチャ要素

- **セクション見出し（h2）の下に手描き風の波線アンダーライン**（data-URI SVG、`--color-primary`）。
- ブランドの核 **「届く」** を `.mark`（薄グリーンのマーカーハイライト `rgba(143,203,166,.6)` + 700）で強調。
- 角丸: `--radius:12px` / カード16–18px / ピル99px。余白は広め。

## コンポーネント規約

- **ボタン** `.btn`：角丸8px、`padding:14px 28px`、`font-weight:500`。
  - `.btn-primary`：背景 `--color-primary`／文字白／hoverで `opacity:.92`。
  - `.btn-ghost`：白地／文字 `--color-primary-dark`／枠 `--color-primary-200`。
- **eyebrow**：`--color-primary-100` 背景＋`--color-primary-dark` 文字の小ピル。
- **カード**：白地・`1px` ライン・角丸16px・控えめなグリーン影
  `0 6px 20px rgba(31,138,77,.05)`。hoverで `translateY(-4px)`＋影強調（任意）。
- **アイコン**：Tablerスタイルの線画SVG（`stroke=currentColor`、`stroke-width:1.6–2`）。
  繰り返すものは `<symbol>` スプライト＋`<use>` で参照。絵文字は使わない。
- **アクセシビリティ**：`:focus-visible` で2pxアウトライン可視化、`prefers-reduced-motion` 尊重、
  装飾SVGは `aria-hidden="true"`。

## レイアウト & レスポンシブ

- コンテナ最大幅 `--maxw:1080px`、左右パディング24px。
- **モバイルファースト**。ブレークポイントは **768px（タブレット）/ 1024px（デスクトップ）**。
  - グリッドは既定1列 →768pxで2列 →1024pxで3〜4列。
  - ヘッダーは <768px でハンバーガー、≥768px で水平ナビ。
  - ヒーローは <1024px で縦積み、≥1024px で「テキスト左＋イラスト右」。
  - パートナーは全幅で横スクロール（フリック）カルーセル。
- モーション：スクロールでセクションを淡くフェードアップ、カードのhover浮き上がり（控えめ）。

## アセット

- 画像は `assets/` に置き、**相対パス**で参照。
- ロゴ：`assets/logo.svg`（自社ホスティングのワードマーク）。フッターでは
  `filter:brightness(0) invert(1)` で白抜き。
- ヒーローイラスト `assets/hero-illust.png`、パートナー `assets/partner-1〜8.png`。

## 標準セクション順（LP）

ヘッダー → ヒーロー → お悩み → 作れるもの → 選ばれる理由 → 使い方の流れ →
事例 → パートナー → よくある質問 → 末尾CTA → フッター
