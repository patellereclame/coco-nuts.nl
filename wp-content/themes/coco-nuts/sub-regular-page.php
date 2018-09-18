<?php /* Template Name: sub-regular */ ?>

<?php get_header()?>

  <div class="top-layer">
    <div class="container no-yellow">
      <div class="row">
        <div class="image-layer">
          <img class="col-md-12" src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/logo.png"/>

        </div>
      </div>
    </div>
  </div>




<div id="content" class="site-content top-less">
 		<div class="container shadow-on">

      <div class="row">
      <div class="sub-menu">
<?php wp_nav_menu( array( 'theme_location' => 'new-menu', 'container_class' => 'new_menu_class' ) ); ?>

  </div>
</div>



 			<div class="row">
 				<div class="content">

          <div class="col-md-12">
 			<!--loop begins here -->
 <?php

		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;


		endwhile;
?>


</div>



    <img class="phone" src="<?php echo get_stylesheet_directory_uri();?>/imgs/phone.png" width="40%" height="auto"/>


</div>

          </div>
 				</div>
 			</div>



<?php get_footer(); ?>
