<?php
/**
 * Template Name: Homepage
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
    <main>
        <div id="banner" class="section">
           <div class="container">
               <div class="row">
                   <div class="col-12 carma__banner">
                       <div class="carma__banner-wrapper">
                           <div class="carma__banner-wrapper__headline">
                               <p>ANDREJ</p>
                               <p>SZABO</p>
                           </div>
                           <div class=" carma__banner-wrapper__text">
                               <span class="">web developer, freelancer</span>
                           </div>
                           <div class="carma__banner-wrapper__links">
                               <a class="waves-effect waves-light btn btn-large carma__button" href="#portfolio">portfólio</a>
                               <a class="waves-effect waves-light btn btn-large carma__button last-link" href="#contact">napíšte mi</a>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
        <div id="o-mne" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 carma__headline">
                                <h1><?php echo get_field('about_title'); ?></h1>
                            </div>
                            <div class="col-12 carma-about__text balance-text">
                                <?php echo get_field('about_text'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 carma-about__table">
	                            <?php

	                            // check if the repeater field has rows of data
	                            if( have_rows('about_table') ):
                                    $row_numm = count(get_field('about_table'));
	                                $counter = 1;
		                            // loop through the rows of data
		                            while ( have_rows('about_table') ) : the_row();?>
                                        <div class="row">
                                            <div class="col-md-12 carma-about__table-item">
                                                <div <?php if($counter === $row_numm){ echo 'class="no-border"';} ?>><span><?php echo get_sub_field('name') ?></span><?php echo get_sub_field('value') ?></div>
                                            </div>
                                        </div>

		                           <?php $counter++; endwhile;
	                            endif;
	                            ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php $cv = get_field('about_download_button'); ?>
                                <a class="waves-effect waves-light btn btn-large carma__button" target="<?php echo $cv['target']; ?>"  rel="noopener"  title="<?php echo $cv['title'] ?>" href="<?php echo $cv['url']; ?>"><?php echo $cv['title']; ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="row">
                            <div class="col-12 carma__headline">
                                <h1><?php echo get_field('edu_title'); ?></h1>
                            </div>
                            <div class="col-12">
				                <?php echo get_field('edu_text'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 carma-edu__table">
                                <ul class="collection">
	                                <?php

	                                // check if the repeater field has rows of data
	                                if( have_rows('edu_repater') ):

		                                // loop through the rows of data
		                                while ( have_rows('edu_repater') ) : the_row();?>
                                            <li class="collection-item avatar">
                                                <i class="circle material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg></i>
                                                <span class="title"><?php echo get_sub_field('title') ?></span>
                                                <p><?php if( get_sub_field('degree')){ echo get_sub_field('degree').'<br>';}?>
	                                                <?php echo get_sub_field('duration') ?>
                                                </p>
                                            </li>
		                                <?php endwhile;
	                                endif;
	                                ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="o-zrucnosti" class="section section-dark">
            <div class="container">
                <div class="row">
                    <div class="col-12 carma__headline">
                        <h1><?php echo get_field('skills_title'); ?></h1>
                    </div>
		            <?php

		            // check if the repeater field has rows of data
		            if( have_rows('skills_repeater') ):
			            $row_numm = count(get_field('skills_repeater'));
			            $counter = 0;
			            // loop through the rows of data
			            while ( have_rows('skills_repeater') ) : the_row();?>
				            <?php if($counter % 3 === 0):?>
                                <div class="col-12">
                                <div class="row">
				            <?php endif;?>

                            <div class="col-12 col-sm-3 skill__item">
                                <span><?php echo get_sub_field('name'); ?></span>
                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo get_sub_field('percentacge'); ?>">

                                    </div>
                                </div>
                            </div>

				            <?php if($counter % 3 === 2 || $counter == ($row_numm -1)):?>
                                </div>
                                </div>
				            <?php endif;?>
				            <?php $counter++; endwhile;
		            endif;

		            ?>
                </div>
                <div class="row">
                    <div class="col-12 carma__headline">
                        <h1><?php echo get_field('work_skills_title'); ?></h1>
                    </div>
                </div>
                <div class="row">
		            <?php

		            // check if the repeater field has rows of data
		            if( have_rows('work_skills_repeater') ):

			            // loop through the rows of data
			            while ( have_rows('work_skills_repeater') ) : the_row();?>
                            <div class="col-12 col-md-3 work__item">
                                <div class="work__item-inner">
                                    <span class="work__item-title"><?php echo get_sub_field('title') ?></span>
                                    <span class="work__item-sub-title"><?php echo get_sub_field('sub_title') ?></span>
                                    <span class="work__item-year"><?php echo get_sub_field('year') ?></span>
                                </div>
                            </div>
			            <?php endwhile;
		            endif;
		            ?>
                </div>
            </div>
        </div>
        <div id="portfolio" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 carma__headline">
                        <h1><?php echo get_field('portfolio_title'); ?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="filter">
                            <div class="filter-inner">
                                <div class="filter-btn-group">
								    <?php
								    $term_args = array(
									    'taxonomy'               => 'portfolio-cats',
									    'hide_empty'             => false,
									    'count'                  => true,
									    'orderby'       =>  'id',
									    'order'         =>  'DESC',
								    );
								    $term_query = new WP_Term_Query( $term_args );
								    ?>
                                    <button data-filter="*" class="active"><?php echo get_field('portfolio_all_text'); ?></button>
								    <?php foreach ( $term_query->terms as $term ):?>
                                        <button data-filter=".pf-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></button>
								    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="pf-grid pf-container" data-popup="type1" data-view="grid">
                            <div class="pf-grid-sizer"></div>
						    <?php
						    // WP_Query arguments
						    $args = array(
							    'post_type'              => array( 'portfolio' ),
							    'post_status'            => array( 'publish' ),
							    'posts_per_page'   => -1,
							    'meta_key' => 'year_text',
							    'orderby' => 'meta_value_num',
							    'order' => 'DESC'
						    );

						    // The Query
						    $portfolio_items = new WP_Query( $args );
						    $counterGallery = 0;
						    // The Loop
						    if ( $portfolio_items->have_posts() ) {
							    while ( $portfolio_items->have_posts() ) {
								    $portfolio_items->the_post();
								    $f_img = get_field('field_5cc04bfb3d277',get_the_ID());
								    $f_img2 = get_field('field_5ccf3b7d7c795',get_the_ID());
								    $counter = 1;
								    $cats = wp_get_post_terms(get_the_ID(), 'portfolio-cats' );
								    $cats_len = count($cats);


								    $cat_pattern = ' pf-';
								    $cats_string ='';
								    $cats_name_strings ='';
								    foreach ($cats as $cat)
								    {
									    $cats_string.= $cat_pattern.$cat->term_id;
									    $cats_name_strings.= $cat->name;
									    if($cats_len !== $counter)
									    {
										    $cats_name_strings.= ', ';
									    }
									    $counter++;
								    }
								    ?>

                                    <div class="pf-grid-item<?php echo  $cats_string; ?>">

                                        <a aria-label="<?php echo get_the_title() ?>" href="<?php echo get_permalink() ?>" class="pf-item pf-item<?php echo get_the_ID(); ?> lazyload"  data-bg="<?php echo $f_img2['url'] ?>" >
                                            <div class="pf-item-cont text-left clear-mrg">
                                                <h2 class="pf-item-title"><?php echo get_the_title() ?></h2>
                                            </div>
                                        </a>
                                    </div>
								    <?php $counterGallery++;
							    }
						    } else {
							    // no posts found
						    }

						    // Restore original Post Data
						    wp_reset_postdata();
						    ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="contact" class="section section-dark">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12 carma__headline">
                                <h1><?php echo get_field('contact_title'); ?></h1>
                            </div>

                            <form class="col-12 contact-form">
	                            <?php wp_nonce_field( 'contact_form'); ?>
                                <input type="hidden" name="action" value="contact_form">
                                <div class="row">
                                    <div class="input-field col-12 col-md-6">
                                        <input required id="first_name_last_name" name="first_name_last_name" type="text" class="validate">
                                        <label for="first_name_last_name"><?php echo get_field('name_title'); ?></label>
                                    </div>
                                    <div class="input-field col-12 col-md-6">
                                        <input required id="email" name="email" type="email" class="validate">
                                        <label for="email"><?php echo get_field('e-mail_title'); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col-12">
                                        <input required id="subject" name="subject" type="text" class="validate">
                                        <label for="subject"><?php echo get_field('subject_title'); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col-12">
                                        <textarea required id="message" name="message" class="materialize-textarea validate"></textarea>
                                        <label for="message"><?php echo get_field('message_title'); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col-12">
                                        <button class="waves-effect waves-light btn btn-large carma__button contact-form-submit" type="submit"><?php echo get_field('submit_button_text'); ?></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-9">
                                        <div class="contact-form-response z-depth-1">
                                            <span class="chip-text"></span>
                                            <i class="close material-icons">close</i>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 contact-img">

                        <picture>
                            <source  data-srcset="/wp-content/uploads/carma-contact.webp" type="image/webp">
                            <img alt="carma contact image" class="img-fluid lazyload" data-src="/wp-content/uploads/carma-contact.png">
                        </picture>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer();
