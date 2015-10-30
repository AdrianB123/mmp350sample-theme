<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sample_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
            
            <?php while (have_posts() ) : the_post();?>
            <?php query_posts('posts_per_page=1'); ?>
              <?php //get_template_part('template-parts/content','littleBuddy');?> 
            
       <?php $do_not_duplicate ?>
       <?php /* The first Loop */ ?>
        <?php query_posts('tah=template');?>
                                
			<?php while ( have_posts() ) : the_post(); ?>
$do_not_duplicate =$post->ID;
            
            <div class="theImportantDiv">
            </div>
				<?php //get_templatep_part('template-parts/content','littleBuddy'); ?>
            <?php endwhile; ?>
            
            <?php /* The second loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php if ($post->ID == $do_not_duplicate) continue; ?>
            <?php get_template_part('template-parts/content','littleBuddy');?>
            <?php endwhile; ?>

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>
            
            
            
            
            <?php rewind_posts();?>
            <?php
             
             $args = array('post_type'=> 'portfolio_item', 'posts_per_page' => 10);
             $loop = new WP_Query($args);
             while( $loop->have_posts()) : $loop->the_post();
              the_title();
              echo'<div class="ab-entry-content">';
              the_content();
              echo'</div>';
            endwhile;
            ?>
 



            
            

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
