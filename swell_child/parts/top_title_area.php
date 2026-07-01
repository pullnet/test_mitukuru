<?php
if (! defined('ABSPATH')) exit;

/**
 * SWELL_Theme::is_show_ttltop()が true の時のみ呼び出される。
 * タームアーカイブ / 固定ページ / 投稿ページの３種類で呼び出される可能性があることに注意。
 */
$SETTING = SWELL_Theme::get_setting();

// タイトル・背景画像を取得
if (SWELL_Theme::is_term()) {
	// タームアーカイブの場合
	$term_id   = get_queried_object_id();
	$ttlbg_id  = SWELL_Theme::get_term_ttlbg_id($term_id);
	$ttlbg_url = '';
	if (is_string($ttlbg_id)) {
		$ttlbg_url = $ttlbg_id; // 昔はURLデータを保存してた
	}
} else {
	// 投稿ページ・固定ページの場合
	$the_id    = get_queried_object_id();  // ※ get_the_ID() は is_home でアウト
	$ttlbg_id  = SWELL_Theme::get_post_ttlbg_id($the_id);
	$ttlbg_url = '';
	if (is_string($ttlbg_id)) {
		$ttlbg_url = $ttlbg_id; // 昔はURLデータを保存してた
	}
}

// 背景画像へのフィルター
$filter_name  = $SETTING['title_bg_filter'];
$filter_class = ('nofilter' === $filter_name) ? '' : "c-filterLayer -$filter_name";
?>
<div id="top_title_area" class="l-topTitleArea <?= esc_attr($filter_class) ?>">
	<?php
	if ($ttlbg_url) {
		echo '<img src="' . esc_attr($ttlbg_url) . '" class="l-topTitleArea__img c-filterLayer__img u-obf-cover" decoding="async">';
	} elseif ($ttlbg_id) {
		SWELL_Theme::get_image($ttlbg_id, [
			'class'       => 'l-topTitleArea__img c-filterLayer__img u-obf-cover',
			'alt'         => '',
			'loading'     => apply_filters('swell_top_area_lazy_off', true) ? 'none' : SWELL_Theme::$lazy_type,
			'aria-hidden' => 'true',
			'decoding'    => 'async',
			'echo'        => true,
		]);
	}
	?>
	<div style="position: absolute; top: -90px; right: -50px; width: 280px; height: 280px; border-radius: 50%; background: rgba(124,179,66,0.10); pointer-events: none;"></div>
	<div style="position: absolute; bottom: -110px; right: 160px; width: 200px; height: 200px; border-radius: 50%; background: rgba(124,179,66,0.07); pointer-events: none;"></div>
	<div style="position: absolute; bottom: -70px; left: -40px; width: 170px; height: 170px; border-radius: 50%; border: 1.5px solid rgba(124,179,66,0.16); pointer-events: none;"></div>

	<div class="l-topTitleArea__body l-container">
		<?php
		SWELL_Theme::get_parts('parts/breadcrumb');
		?>
		<div style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #5C8A2E; font-size: 12.5px; font-weight: 700; padding: 7px 15px; border-radius: 9999px; margin-bottom: 18px; box-shadow: 0 2px 10px rgba(104,154,56,0.10); text-transform: uppercase;">
			<span style="width: 7px; height: 7px; border-radius: 50%; background: #7CB342;"></span>
			<?php
			echo get_post_field('post_name', get_the_ID());
			?>
		</div>
		<?php

		if (SWELL_Theme::is_term()) {

			SWELL_Theme::pluggable_parts('term_title', [
				'term_id'   => $term_id,
				'has_inner' => false,
			]);

			SWELL_PARTS::the_term_navigation($term_id);
		} elseif (is_single()) {

			SWELL_Theme::get_parts('parts/single/post_head');
		} elseif (is_page() || is_home()) {
		?>

		<?php
			// タイトル
			SWELL_Theme::pluggable_parts('page_title', [
				'title'     => get_the_title($the_id),
				'subtitle'  => get_post_meta($the_id, 'swell_meta_subttl', true),
				'has_inner' => false,
			]);

			// 抜粋文
			$post_data = get_post($the_id);
			$excerpt   = $post_data->post_excerpt;
			if ($excerpt) {
				echo '<div class="c-pageExcerpt">' . wp_kses($excerpt, SWELL_Theme::$allowed_text_html) . '</div>';
			}
		}
		?>
	</div>
</div>