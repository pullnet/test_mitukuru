<?php
// ログイン済みの場合はマイページにリダイレクト
if (is_user_logged_in()) {
	wp_safe_redirect(home_url('/mypage/'));
	exit;
}

if (! defined('ABSPATH')) exit;
get_header();




if (is_front_page()) :
	SWELL_Theme::get_parts('tmp/front');
else :
	while (have_posts()) :
		the_post();
		$the_id = get_the_ID();

		// 固定ページではサイズ指定を無視して「大」を表示
		$show_pr_notation = SWELL_Theme::get_pr_notation_size($the_id, 'show_pr_notation_page');
?>
		<style>
			#top_title_area {
				display: none;
			}

			.login-username label,
			.login-password label {
				display: block;
				font-size: 13.5px;
				font-weight: 700;
				color: #2B2B2B;
				margin-bottom: 8px;
			}

			#loginform input[type="text"],
			#loginform input[type="password"] {
				margin-bottom: 20px;
				width: 100%;
				font-family: inherit;
				font-size: 15px;
				color: #2B2B2B;
				background: #ffffff;
				border: 1.5px solid #DCE5D0;
				border-radius: 8px;
				padding: 13px 15px;
				outline: none;
				transition: border-color .15s ease, box-shadow .15s ease;
			}

			#loginform .login-remember label {
				display: flex;
				align-items: center;
				gap: 9px;
				font-size: 14px;
				color: #374151;
				cursor: pointer;
				margin-bottom: 26px;
			}

			#loginform .login-remember input {
				accent-color: #7CB342;
				width: 17px;
				height: 17px;
			}

			#loginform .login-submit input {
				width: 100%;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				gap: 10px;
				background: #7CB342;
				color: #ffffff;
				font-family: inherit;
				font-size: 16px;
				font-weight: 800;
				border: none;
				cursor: pointer;
				padding: 16px 32px;
				border-radius: 9999px;
				box-shadow: 0 10px 26px rgba(124, 179, 66, 0.34);
				text-decoration: none;
				transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
			}

			#loginform .login-submit input:hover {
				background: #689A38;
				transform: translateY(-2px);
				box-shadow: 0 16px 36px rgba(124, 179, 66, 0.40);
			}
		</style>
		<main id="main_content" class="l-mainContent l-article">
			<div class="l-mainContent__inner" data-clarity-region="article">
				<?php SWELL_Theme::get_parts('parts/page_head'); ?>
				<?php if ($show_pr_notation) : ?>
					<?php SWELL_Theme::pluggable_parts('pr_notation'); ?>
				<?php endif; ?>
				<div class="<?= esc_attr(apply_filters('swell_post_content_class', 'post_content')) ?>">
					<?php the_content(); ?>
					<div style="width: 100vw; margin: 0 calc(50% - 50vw);">



						<!-- ============ ログイン本体 ============ -->
						<div style="flex: 1; position: relative; overflow: hidden; background: #EFF6E4; display: flex; align-items: center; justify-content: center; padding: 80px 24px;">
							<div style="position: absolute; top: -100px; right: -60px; width: 320px; height: 320px; border-radius: 50%; background: rgba(124,179,66,0.10); pointer-events: none;"></div>
							<div style="position: absolute; bottom: -120px; left: -50px; width: 260px; height: 260px; border-radius: 50%; background: rgba(124,179,66,0.08); pointer-events: none;"></div>
							<div style="position: absolute; top: 60px; left: 120px; width: 120px; height: 120px; border-radius: 50%; border: 1.5px solid rgba(124,179,66,0.16); pointer-events: none;"></div>

							<?php

							if (
								isset($_POST['custom_login']) &&
								wp_verify_nonce($_POST['custom_login_nonce'], 'custom_login')
							) {

								$creds = array(
									'user_login'    => sanitize_text_field($_POST['log']),
									'user_password' => $_POST['pwd'],
									'remember'      => !empty($_POST['rememberme']),
								);

								$user = wp_signon($creds, false);

								if (is_wp_error($user)) {

									echo '<p class="error">' . esc_html($user->get_error_message()) . '</p>';
								} else {

									wp_safe_redirect(home_url('/mypage/'));
									exit;
								}
							}
							?>

							<div style="position: relative; z-index: 1; width: 100%; max-width: 420px;">
								<form action="" method="post" style="background: #ffffff; border-radius: 22px; padding: 44px 40px; box-shadow: 0 18px 50px rgba(104,154,56,0.16);">
									<?php wp_nonce_field('custom_login', 'custom_login_nonce'); ?>

									<div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 30px;">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top/logo.png" alt="ミツクル" style="height: 38px; width: auto; display: block; margin-bottom: 22px;">
										<h1 style="font-size: 22px; font-weight: 900; margin: 0;">マイページにログイン</h1>
									</div>

									<!-- メール -->
									<div style="margin-bottom: 20px;">
										<label style="display: block; font-size: 13.5px; font-weight: 700; color: #2B2B2B; margin-bottom: 8px;">メールアドレス</label>
										<input id="user_login" name="log" class="ff-input" type="email" placeholder="example@mitsukuru.jp" autocomplete="username">
									</div>

									<!-- パスワード -->
									<div style="margin-bottom: 18px;">
										<label style="display: block; font-size: 13.5px; font-weight: 700; color: #2B2B2B; margin-bottom: 8px;">パスワード</label>
										<div style="position: relative;">
											<input class="ff-input" id="user_pass" name="pwd" type="password" placeholder="••••••••" autocomplete="current-password" style="padding-right: 64px;">
											<button id="toggle-password" type="button" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); font-family: inherit; font-size: 12.5px; font-weight: 700; color: #5F9233; background: #EFF6E4; border: none; border-radius: 6px; padding: 6px 11px; cursor: pointer; transition: background .15s ease;" style-hover="background: #E2EFCD;">表示</button>
										</div>
									</div>

									<!-- 保持 -->
									<label style="display: flex; align-items: center; gap: 9px; font-size: 14px; color: #374151; cursor: pointer; margin-bottom: 26px;">
										<input type="checkbox" name="rememberme" style="accent-color: #7CB342; width: 17px; height: 17px;">
										ログイン状態を保持する
									</label>

									<!-- ログインボタン -->
									<button type="submit" name="custom_login" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: #7CB342; color: #ffffff; font-family: inherit; font-size: 16px; font-weight: 800; border: none; cursor: pointer; padding: 16px 32px; border-radius: 9999px; box-shadow: 0 10px 26px rgba(124,179,66,0.34); text-decoration: none; transition: background .2s ease, transform .2s ease, box-shadow .2s ease;" style-hover="background: #689A38; transform: translateY(-2px); box-shadow: 0 16px 36px rgba(124,179,66,0.40);">
										ログイン
									</button>

									<!-- パスワード再発行 -->
									<div style="text-align: center; margin-top: 20px;">
										<a href="<?php echo esc_url(wp_lostpassword_url()); ?>" style="font-size: 13px; font-weight: 600; color: #5F9233; text-decoration: none;" style-hover="text-decoration: underline;">パスワードをお忘れですか？</a>
									</div>

									<!-- 区切り + 新規 -->
									<div style="border-top: 1px solid #F0F2EC; margin-top: 28px; padding-top: 24px; text-align: center; font-size: 14px; color: #6B7280;">
										アカウントをお持ちでない方は <a href="hearing.html" style="font-weight: 700; color: #5F9233; text-decoration: none; border-bottom: 1.5px solid #C9E3A6;" style-hover="border-color: #7CB342;">無料で始める</a>
									</div>

								</form>
							</div>

							<!-- パスワード表示切替 -->
							<script>
								document.addEventListener('DOMContentLoaded', () => {

									const pass = document.getElementById('user_pass');
									const btn = document.getElementById('toggle-password');

									btn.addEventListener('click', () => {

										if (pass.type === 'password') {
											pass.type = 'text';
											btn.textContent = '非表示';
										} else {
											pass.type = 'password';
											btn.textContent = '表示';
										}

									});

								});
							</script>
						</div>

					</div>

				</div>
				<?php
				// 改ページナビゲーション
				$defaults = [
					'before'           => '<div class="c-pagination -post">',
					'after'            => '</div>',
					'next_or_number'   => 'number',
					// 'pagelink'      => '<span>%</span>',
				];
				wp_link_pages($defaults);

				// ページ下部ウィジェット
				SWELL_Theme::outuput_content_widget('page', 'bottom');
				?>
			</div>
			<?php if (SWELL_Theme::is_show_comments($the_id)) comments_template(); ?>
		</main>
<?php
	endwhile; // End loop
endif;
get_footer();
