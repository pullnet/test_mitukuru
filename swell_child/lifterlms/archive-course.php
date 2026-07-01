<?php

/**
 * Template for displaying course archives
 *
 * @author      LifterLMS
 * @package     LifterLMS/Templates
 * @since       1.0.0
 * @version     3.0.0
 */

defined('ABSPATH') || exit;

get_header('llms_loop'); ?>
<style>
    .page-title {
        display: none;
    }
</style>

<!-- ============ ページヘッダー（タイトル + パンくず）============ -->
<div style="width: 100vw; margin: 0 calc(50% - 50vw);">
    <section style="position: relative; overflow: hidden; background: #EFF6E4; border-bottom: 1px solid #E5E7EB;">
        <div style="position: absolute; top: -90px; right: -50px; width: 280px; height: 280px; border-radius: 50%; background: rgba(124,179,66,0.10); pointer-events: none;"></div>
        <div style="position: absolute; bottom: -110px; right: 160px; width: 200px; height: 200px; border-radius: 50%; background: rgba(124,179,66,0.07); pointer-events: none;"></div>
        <div style="position: absolute; bottom: -70px; left: -40px; width: 170px; height: 170px; border-radius: 50%; border: 1.5px solid rgba(124,179,66,0.16); pointer-events: none;"></div>
        <div style="position: relative; z-index: 1; max-width: 1180px; margin: 0 auto; padding: 56px 32px 60px;">
            <nav aria-label="パンくずリスト" style="display: flex; align-items: center; gap: 10px; font-size: 13.5px; font-weight: 500; color: #6B7280; margin-bottom: 22px;">
                <a href="<?php echo home_url(); ?>" style="color: #5F9233; text-decoration: none; font-weight: 700;" style-hover="text-decoration: underline;">ホーム</a>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9CC766" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="9 6 15 12 9 18"></polyline>
                </svg>
                <span style="color: #6B7280;">動画一覧</span>
            </nav>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #5C8A2E; font-size: 12.5px; font-weight: 700; padding: 7px 15px; border-radius: 9999px; margin-bottom: 18px; box-shadow: 0 2px 10px rgba(104,154,56,0.10);">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: #7CB342;"></span>
                MOVIE
            </div>
            <h1 style="font-size: 40px; font-weight: 900; line-height: 1.45; letter-spacing: 0.005em; margin: 0 0 16px;">動画一覧</h1>
            <p style="font-size: 16.5px; color: #6B7280; line-height: 1.9; margin: 0; max-width: 640px;">ミツクルの使い方やサービス紹介、活用のヒントを動画でご覧いただけます。</p>
        </div>
    </section>


    <!-- ============ 本文（タブ + カードグリッド）============ -->
    <section style="background: #ffffff;">
        <div style="max-width: 1180px; margin: 0 auto; padding: 56px 32px 88px;">
            <?php llms_get_template_part('loop', 'main'); ?>
        </div>
    </section>

    <!-- ============ 末尾CTA ============ -->
    <section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #7CB342 0%, #689A38 100%);">
        <div style="position: absolute; top: -120px; right: -80px; width: 360px; height: 360px; border-radius: 50%; background: rgba(255,255,255,0.08); pointer-events: none;"></div>
        <div style="position: absolute; bottom: -160px; left: -60px; width: 320px; height: 320px; border-radius: 50%; background: rgba(255,255,255,0.06); pointer-events: none;"></div>
        <div style="position: relative; z-index: 1; max-width: 760px; margin: 0 auto; padding: 88px 32px; text-align: center;">
            <h2 style="font-size: 34px; font-weight: 900; line-height: 1.45; color: #ffffff; margin: 0 0 20px;">気になったら、まず話してみませんか？</h2>
            <p style="font-size: 16.5px; line-height: 1.95; color: rgba(255,255,255,0.92); margin: 0 0 38px;">3分のシート記入で、提案・見積もり・面談まで。<br>発注するかどうかは、話してから決めて大丈夫です。</p>
            <a href="<?php echo home_url('/hearing'); ?>" style="display: inline-flex; align-items: center; gap: 10px; background: #ffffff; color: #5C8A2E; font-size: 17px; font-weight: 800; text-decoration: none; padding: 20px 44px; border-radius: 9999px; box-shadow: 0 12px 30px rgba(0,0,0,0.16); transition: transform .2s ease, box-shadow .2s ease;" style-hover="transform: translateY(-3px); box-shadow: 0 18px 40px rgba(0,0,0,0.22);">
                無料で始める
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="12" x2="19" y2="12"></line>
                    <polyline points="13 6 19 12 13 18"></polyline>
                </svg>
            </a>
        </div>
    </section>
</div>


<?php
get_footer();
