<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="entry">
<h1 class="entrytitle"><?php the_title(); ?></h1>
<?php the_content(); ?>
</section><!-- ENTRY END -->
<?php endwhile; endif; ?>

<ul>
<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
</ul>
<?php get_footer(); ?>