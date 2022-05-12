<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package flatsome
 */

?>

<section class="no-results not-found">
	<header class="page-title">
		<h1 class="page-title"><?php esc_html_e( 'Danh mục chưa có bài viết! Vui lòng truy cập sau!', 'flatsome' ); ?></h1>
	</header><!-- .page-title -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Viết bài viết đầu tiên của bạn nhé? <a href="%1$s">Bắt đầu</a>.', 'flatsome' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Xin lỗi, không tìm thấy dữ liệu bạn cần, vui lòng thử lại với từ khóa khác!', 'flatsome' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'Có vẻ như chúng tôi không thể tìm thấy những gì bạn đang tìm kiếm. Bạn thử tìm lại nhé!', 'flatsome' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->