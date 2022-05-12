<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner <?php flatsome_blog_article_classes(); ?>">
		<?php
			if(flatsome_option('blog_post_style') == 'default' || flatsome_option('blog_post_style') == 'inline'){
				get_template_part('template-parts/posts/partials/entry-header', flatsome_option('blog_posts_header_style') );
			}
		?>
		<?php get_template_part( 'template-parts/posts/content', 'single' ); ?>

<div class="list-news"><?php
    $categories = get_the_category($post->ID);
    if ($categories) 
    {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
 
        $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>4, // Số bài viết bạn muốn hiển thị.
        'caller_get_posts'=>1
        );
        $my_query = new wp_query($args);
        if( $my_query->have_posts() ) 
        {
            echo '<h3>Bài viết cùng chuyên mục:</h3><ul class="list-news">';
            while ($my_query->have_posts())
            {
                $my_query->the_post();
                ?>
                <li>
                	<div class="new-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
                	<div class="item-list">
                		<h4  class="relative-post-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                	                	</div>
                </li>
                <?php
            }
            echo '</ul>';
        }
    }
?></div>

	</div><!-- .article-inner -->
</article><!-- #-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>