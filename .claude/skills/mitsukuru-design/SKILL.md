---
name: mitsukuru-design
description: ミツクル（mitukuru / WEBマーケティング ワンストップ支援）のデザインシステム。LP・静的サイトをこのブランドで実装するときに従う、カラートークン・タイポgrafィ・余白・コンポーネント・レスポンシブの規約。新しいページやセクションを作るとき、既存の見た目に合わせるときに参照する。
---

# ミツクル デザインシステム

ヒアリング型マッチング。「**みつける → つくる → 試す**」をひとつのサービスで支援。
トーンは **ライトグリーン × 親しみやすく・誠実**。丸ピル・やわらかい緑シャドウ・広め余白。
コピーは丁寧・前向きな「〜できます／〜まで」調。
※本システムは公式ハンドオフバンドル `ミツクル.dc.html`（Design Component）から抽出した確定仕様。

## カラートークン（CSS変数）

```css
:root{
  --green:        #7CB342; /* 主要アクセント・ボタン */
  --green-dark:   #689A38; /* ボタンhover・濃い面 */
  --green-deep:   #5F9233; /* グラデ終点・強調文字 */
  --green-deeper: #5C8A2E; /* 白地ボタンの文字 */
  --green-mid:    #9CC766; /* 矢印・補助線 */
  --green-soft:   #A8D26C; /* グラデ・アクセントライン */
  --green-050:    #FAFBF7; /* ページ薄背景 */
  --green-100:    #EFF6E4; /* バッジ/淡セクション背景・タグ */
  --green-150:    #F6FAEF; /* 画像下地 */
  --green-200:    #E4F0D2; /* 大きな番号(01/02/03) */
  --line:    #E5E7EB;      /* 罫線 */
  --line-2:  #EAEFE0;      /* カード罫線(緑寄り) */
  --line-3:  #F0F2EC;      /* 区切り線(薄) */
  --ink:    #2B2B2B;       /* 見出し・本文濃 */
  --muted:  #6B7280;       /* 本文・補足 */
  --hint:   #9CA3AF;       /* キャプション */
}
/* ::selection { background:#C9E3A6 } */
```

セクション背景は 白 ⇄ `--green-050` / `--green-100` を交互に。
画像枠の下地は `--green-150`。事例・パートナーカードは白＋緑シャドウ。

## タイポグラフィ

- 書体は **Noto Sans JP**（`400;500;700;900`）。`font-family:"Noto Sans JP",sans-serif`。
- **見出しは 900（ブラック）**、本文 `line-height:1.8〜1.9`、見出し `1.45〜1.55`。
- スケール目安（モバイル→デスクトップ）:
  - h1（ヒーロー）: 30 → 40px / 900
  - セクションh2: 27 → 34px / 900
  - 末尾CTA h2: 30 → 38px / 900
  - カード見出し: 15〜18px / 700、本文 14〜17px、キャプション 12.5〜13px
- セクション見出しの上に英語ラベル（eyebrow）: 14px / 700 / `--green` / `letter-spacing:.08em`（例 `CHALLENGES` `WHAT YOU CAN MAKE`）。

## コンポーネント規約

- **ボタン**：角丸ピル `border-radius:9999px`、`font-weight:700/800`。
  - primary：`background:var(--green)`／白文字／緑シャドウ `0 8px 22px rgba(124,179,66,.35)`／hover `--green-dark`＋少し浮く。
  - ghost：白地／`1.5px` ライン枠／文字 ink／hover で枠＆文字を緑に。
  - 白地CTA（緑背景上）：白地／文字 `--green-deeper`。
- **カード**：白地・角丸18px・`box-shadow:0 6px 24px rgba(104,154,56,.10)`（または `0 4px 20px rgba(0,0,0,.06)`）。hoverで `translateY(-4〜5px)`＋影強調 `rgba(124,179,66,.20)`。
- **アイコン**：線画SVG（緑の円バッジ `linear-gradient(135deg,#8FC74F,#689A38)` に白アイコン）。`stroke-width≈2`。
- **アクセント円**：番号 01/02/03 は `--green-200` の特大数字を右上に。価値バナー/末尾CTAは緑グラデ＋白い装飾円。
- **アクセシビリティ**：`:focus-visible` で可視アウトライン、`prefers-reduced-motion` 尊重、装飾SVG/画像は `aria-hidden`/`alt=""`。

## レイアウト & レスポンシブ

- コンテナ最大幅 **1180px**、左右パディング 32px（モバイル 20px）。
- **モバイルファースト**。ブレークポイント **768px / 1024px**（補助 600px）。
  - グリッドは `repeat(auto-fit,minmax(280–300px,1fr))` を基本に、モバイル1列 → 自然に多列へ。
  - ヘッダーは <768px でハンバーガー、≥768px で水平ナビ。
  - ヒーローは <1024px で縦積み（テキスト→イラスト）、≥1024px で「テキスト左＋イラスト右（0.92fr/1.15fr）」。
  - 使い方は 2×2＋矢印（≤600px で縦積み・矢印を下向きに回転）。
  - パートナーは 4列 →(900/768) 2列。
- モーション：カードhoverの浮き上がり、スクロールの淡いフェードアップ（控えめ）。

## アセット

- 画像は `assets/` に置き **相対パス**で参照。
- `logo.png`（ワードマーク。フッターでもそのまま使用）／`hero-illustration-trim.png`。
- 作れるもの `make-{web,lp,product,sns,video,photo}.png`／お悩み `pain-1〜3.png`／
  選ばれる理由 `why-1〜3.png`／使い方 `step-01〜04.png`／事例 `case-1〜3.png`／
  パートナー `partner-{designer,director,ec,ad,marketer,influencer,video,ai}.png`。

## 標準セクション順（LP）

ヘッダー → ヒーロー → お悩み(＋価値バナー) → 作れるもの → 選ばれる理由 →
使い方の流れ → 事例 → パートナー → よくある質問 → 末尾CTA → フッター
