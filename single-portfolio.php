<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<main>
    <div>
        <div class="container-fluid" id="content" tabindex="-1">

	        <?php while ( have_posts() ) : the_post(); ?>
		        <?php //understrap_post_nav(); ?>

                <div id="portfolio-single" class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 carma__portfolio-prev text-left">
                                <?php
                                    $prevLink = get_adjacent_post(false,'',false)->ID;
                                    if($prevLink !== NULL): ?>
                                    <a itemprop="url" href="<?php echo get_permalink( get_adjacent_post(false,'',false)->ID ) ?>" ><i class="close material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="col-4 carma__portfolio-back text-center">
                                <a aria-label="back to home" href="<?php echo home_url('/#portfolio') ?>">
<span class="qodef-ps-back-btn-icon">
<svg fill="currentColor" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 18 18"
     enable-background="new 0 0 18 18" xml:space="preserve">
<rect width="7" height="7"></rect>
<rect x="11" width="7" height="7"></rect>
<rect y="11" width="7" height="7"></rect>
<rect x="11" y="11" width="7" height="7"></rect>
</svg>
</span>
                                </a>
                            </div>
                            <div class="col-4 carma__portfolio-next text-right">
                                <?php
                                    $nextLink =get_adjacent_post(false,'',true)->ID;
                                    if($nextLink !== NULL):?>
                                    <a href="<?php echo get_permalink( get_adjacent_post(false,'',true)->ID ) ?>" ><i class="close material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></i></a>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <div class="row">
                                    <div class="col-12 carma__headline">
                                        <h1>O projekte</h1>
                                    </div>
                                    <div class="col-12 carma-about__text balance-text">
                                        <?php echo get_field('content'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 carma-about__table">
                                        <div class="row">
                                            <div class="col-md-12 carma-about__table-item">
                                                <div><span><?php echo get_field('title') ?></span><?php echo get_field('title_text') ?></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 carma-about__table-item">
                                                <div><span><?php echo get_field('created_by') ?></span><?php echo get_field('created_by_text') ?></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 carma-about__table-item">
                                                <div><span><?php echo get_field('category') ?></span>
                                                    <?php

                                                        $cats = get_the_term_list(get_the_ID(), 'portfolio-cats', '', ', ', '');
                                                        $cats = strip_tags($cats);
                                                        echo $cats;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
	                                    <?php $link = get_field('project_url_text'); ?>
                                        <?php if($link): ?>
                                        <div class="row">
                                            <div class="col-md-12 carma-about__table-item">
                                                <div><span><?php echo get_field('project_url') ?></span>

                                                    <a rel="noopener" target="<?php echo $link['target']; ?>" title="<?php echo $link['title']; ?>" class="" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-12 carma-about__table-item">
                                                <div class="no-border"><span><?php echo get_field('year') ?></span><?php echo get_field('year_text') ?></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-5 d-flex align-items-center justify-content-center">
                                <div class="row">
                                    <div class="col-12">
                                        <img alt="<?php echo get_field('featured_img')["description"] ?>" class="img-fluid" src="<?php echo get_field('featured_img')['url'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    <div class="col-12 carma__headline">
                                        <h1>Galéria</h1>
                                    </div>
                                    <div class="col-12 " >
                                        <div class="row carma__gallery" id="carma__gallery">
	                                        <?php $gallery = get_field('gallery') ?>
	                                        <?php if(!empty($gallery)): ?>
		                                        <?php foreach ($gallery as $item): ?>
                                                    <a class="col-6 col-lg-3 carma__gallery-item" href="<?php echo $item['url'] ?>">
                                                        <img alt="<?php echo $item['description'] ?>" class="img-fluid" src="<?php echo $item['sizes']['large'] ?>">
                                                        <div class="carma__gallery-poster">
                                                            <img alt="<?php echo $item['description'] ?>" src="<?php echo get_template_directory_uri() ?>/img/zoom.png">
                                                        </div>
                                                    </a>
		                                        <?php endforeach;?>
	                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
	        <?php endwhile; // end of the loop. ?>


        </div><!-- #content -->
    </div>
</main>

<?php get_footer(); ?>
