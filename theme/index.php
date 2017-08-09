<?php get_header(); ?>

<p>LOOP</p>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry">
<h1 class="entrytitle"><?php the_title(); ?></h1>
<?php the_content(); ?>
</div><!-- ENTRY END -->
<div class="entry-footer">
<p>posted: <?php the_time('Y.m.d'); ?></p>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>