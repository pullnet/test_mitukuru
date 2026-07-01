<?php
if (! defined('ABSPATH')) exit;

get_header();



if (SWELL_Theme::is_term()) :
	SWELL_Theme::get_parts('archive-term');
else :
	$archive_data     = SWELL_Theme::get_archive_data();
	$archive_title    = $archive_data['title'];
	$archive_subtitle = str_replace('pt_archive', 'archive', $archive_data['type']);

	// リストタイプ
	$list_type = apply_filters('swell_post_list_type_on_archive', SWELL_Theme::$list_type, $archive_data);
?>
	<style>
		.case-grid {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 26px;
		}

		.tabbar {
			display: flex;
			flex-wrap: wrap;
			gap: 12px;
		}

		.tabbar a {
			font-size: 14.5px;
			font-weight: 600;
			color: #5F7355;
			background: #F2F6EB;
			padding: 11px 24px;
			border-radius: 9999px;
			cursor: pointer;
			transition: background .18s ease, color .18s ease;
		}

		.tabbar a:hover {
			background: #E4F0D2;
			color: #5C8A2E;
		}

		.tabbar a.current {
			background: #7CB342;
			color: #ffffff;
			font-weight: 700;
			box-shadow: 0 4px 12px rgba(124, 179, 66, 0.30);
		}

		@media (max-width: 980px) {
			.case-grid {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		@media (max-width: 620px) {
			.case-grid {
				grid-template-columns: 1fr;
			}
		}
	</style>

	<main id="main_content" class="l-mainContent l-article">
		<div class="l-mainContent__inner">
			<div style="width: 100vw; margin: 0 calc(50% - 50vw);">

				<!-- ============ ページヘッダー（タイトル + パンくず）============ -->
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
							<span style="color: #6B7280;">制作事例</span>
						</nav>
						<div style="display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #5C8A2E; font-size: 12.5px; font-weight: 700; padding: 7px 15px; border-radius: 9999px; margin-bottom: 18px; box-shadow: 0 2px 10px rgba(104,154,56,0.10);">
							<span style="width: 7px; height: 7px; border-radius: 50%; background: #7CB342;"></span>
							CASE STUDIES
						</div>
						<h1 style="font-size: 40px; font-weight: 900; line-height: 1.45; letter-spacing: 0.005em; margin: 0 0 16px;">制作事例</h1>
						<p style="font-size: 16.5px; color: #6B7280; line-height: 1.9; margin: 0; max-width: 640px;">「なんとなく」から始まったご相談が、形になった例をご紹介します。</p>
					</div>
				</section>

				<!-- ============ 本文（タブ + カードグリッド）============ -->
				<section style="background: #ffffff;">
					<div style="max-width: 1180px; margin: 0 auto; padding: 56px 32px 88px;">

						<!-- カテゴリタブ -->
						<?php
						$terms = get_terms(array(
							'taxonomy'   => 'case_cate',
							'hide_empty' => true,
						));

						if (!empty($terms) && !is_wp_error($terms)) :
						?>
							<div class="tabbar" style="margin-bottom: 44px;">
								<a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="<?php echo is_post_type_archive('case') ? 'current' : ''; ?>">
									すべて
								</a>
								<?php foreach ($terms as $term) : ?>

									<a href="<?php echo esc_url(get_term_link($term)); ?>" class="<?php echo is_tax('case_cate', $term->slug) ? 'current' : ''; ?>">
										<?php echo esc_html($term->name); ?>
									</a>

								<?php endforeach; ?>
							</div>
						<?php endif; ?>


						<!-- カードグリッド -->
						<?php if (have_posts()) : ?>
							<div class="case-grid">
								<?php while (have_posts()) : the_post(); ?>

									<div style="display: flex; flex-direction: column; overflow: hidden; background: #ffffff; border-radius: 18px; box-shadow: 0 6px 24px rgba(104,154,56,0.10); transition: box-shadow .28s ease, transform .28s ease;" style-hover="box-shadow: 0 18px 40px rgba(124,179,66,0.22); transform: translateY(-5px);">
										<div style="width: 100%; aspect-ratio: 4 / 3; overflow: hidden; background: #F6FAEF;">
											<img src="<?php if (has_post_thumbnail()) : ?>
													<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>
												<?php endif; ?>" alt="<?php the_title(); ?>" style="width: 100%; height: 100%; object-fit: cover; object-position: top; display: block;">
										</div>
										<div style="padding: 26px 26px 28px;">
											<?php
											$terms = get_the_terms(get_the_ID(), 'case_cate');
											if ($terms && !is_wp_error($terms)) {
												foreach ($terms as $term) {
													echo '<span style="display: inline-block; font-size: 12px; font-weight: 700; color: #5F9233; background: #EFF6E4; border-radius: 999px; padding: 5px 14px; margin-bottom: 18px;">' . esc_html($term->name) . '</span>';
												}
											}
											?>
											<div style="display: flex; align-items: center; gap: 12px;">
												<div style="flex: 1;">
													<div style="font-size: 11px; font-weight: 700; letter-spacing: 0.06em; color: #B0B7A6; margin-bottom: 4px;">BEFORE</div>
													<div style="font-size: 14.5px; font-weight: 700; line-height: 1.5; color: #374151;"><?php the_field('before'); ?></div>
												</div>
												<svg style="flex: none;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9CC766" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
													<line x1="4" y1="12" x2="19" y2="12"></line>
													<polyline points="13 6 19 12 13 18"></polyline>
												</svg>
												<div style="flex: 1;">
													<div style="font-size: 11px; font-weight: 700; letter-spacing: 0.06em; color: #7CB342; margin-bottom: 4px;">AFTER</div>
													<div style="font-size: 14.5px; font-weight: 700; line-height: 1.5; color: #5F9233;"><?php the_field('after'); ?></div>
												</div>
											</div>
											<div style="border-top: 1px solid #F0F2EC; margin-top: 22px; padding-top: 16px; font-size: 12.5px; color: #9CA3AF;"><?php the_field('client'); ?></div>
										</div>
									</div>
								<?php endwhile; ?>
							</div>

							<?php the_posts_pagination(); ?>

						<?php else : ?>
							<p>記事がありません。</p>
						<?php endif; ?>

					</div>
				</section>

				<div class="p-archiveContent u-mt-40">
					<?php
					SWELL_Theme::get_parts('parts/post_list/item/pagination');
					?>
				</div>

				<!-- ============ 末尾CTA ============ -->
				<section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #7CB342 0%, #689A38 100%);">
					<div style="position: absolute; top: -120px; right: -80px; width: 360px; height: 360px; border-radius: 50%; background: rgba(255,255,255,0.08); pointer-events: none;"></div>
					<div style="position: absolute; bottom: -160px; left: -60px; width: 320px; height: 320px; border-radius: 50%; background: rgba(255,255,255,0.06); pointer-events: none;"></div>
					<div style="position: relative; z-index: 1; max-width: 760px; margin: 0 auto; padding: 88px 32px; text-align: center;">
						<h2 style="font-size: 34px; font-weight: 900; line-height: 1.45; color: #ffffff; margin: 0 0 20px;">あなたの課題も、相談してみませんか？</h2>
						<p style="font-size: 16.5px; line-height: 1.95; color: rgba(255,255,255,0.92); margin: 0 0 38px;">3分のシート記入で、提案・見積もり・面談まで。<br>発注するかどうかは、話してから決めて大丈夫です。</p>
						<a href="<?php echo esc_url(home_url('/hearing')); ?>" style="display: inline-flex; align-items: center; gap: 10px; background: #ffffff; color: #5C8A2E; font-size: 17px; font-weight: 800; text-decoration: none; padding: 20px 44px; border-radius: 9999px; box-shadow: 0 12px 30px rgba(0,0,0,0.16); transition: transform .2s ease, box-shadow .2s ease;" style-hover="transform: translateY(-3px); box-shadow: 0 18px 40px rgba(0,0,0,0.22);">
							無料で始める
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
								<line x1="4" y1="12" x2="19" y2="12"></line>
								<polyline points="13 6 19 12 13 18"></polyline>
							</svg>
						</a>
					</div>
				</section>

			</div>
		</div>
	</main>
<?php endif;
get_footer(); ?>