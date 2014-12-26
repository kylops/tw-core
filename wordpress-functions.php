<?php
/**
 * Wordpress Functions
 *
 */

/******************************************************
************* Theme Support Functions ****************
******************************************************/

/**
 * Registers Menu and Theme Support options
 */
if(!function_exists('tw_theme_support')){
  function tw_theme_support() {
  	add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
  	//set_post_thumbnail_size(125, 125, true);   // default thumb size
  	//add_theme_support( 'custom-background' );  // wp custom background
  	add_theme_support('automatic-feed-links'); // rss thingy

  	add_theme_support( 'menus' );            // wp menus
  	register_nav_menus(                      // wp3+ menus
  		array(
    		'top' => 'Top Menu',
    		'mobile' => 'Mobile Menu',    // mobile main navigation
    		'primary' => 'Primary Menu',  // main nav in header
  			'footer' => 'Footer Menu'     // secondary nav in footer
  		)
  	);
  }
  add_action('after_setup_theme','tw_theme_support');
}

/**
 * Registers Post Formats
 */
if(!function_exists('tw_post_formats')){
  function tw_post_formats(){
    //$mh_theme_blog_post_formats = get_option('mh_theme_blog_post_formats');
    $post_formats = array(
  			'aside',   // title less blurb
  			'gallery', // gallery of images
  			'link',    // quick link to other site
  			'image',   // an image
  			'quote',   // a quick quote
  			'status',  // a Facebook like status update
  			'video',   // video
  			'audio',   // audio
  			'chat'     // chat transcript
  		);
    //$enabled_post_formats = array();
    //foreach($post_formats as $pf){
    //  if($mh_theme_blog_post_formats[$pf]){
    //    $enabled_post_formats[] = $pf;
    //  }
    //}
    //add_theme_support( 'post-formats',$enabled_post_formats);
    add_theme_support( 'post-formats',$post_formats);
  }
  add_action('after_setup_theme','tw_post_formats');
}

/******************************************************
******************* User Functions ********************
******************************************************/

/**
 * Sets extra contact info to Wordpress Users
 * @param  array $contactmethods
 * @return array $contactmethods
 */
if(!function_exists('tw_extra_contact_info')){
  function tw_extra_contact_info($contactmethods) {
      unset($contactmethods['aim']);
      unset($contactmethods['yim']);
      unset($contactmethods['jabber']);
      $contactmethods['facebook']   = 'Facebook';
      $contactmethods['twitter']    = 'Twitter';
      $contactmethods['googleplus'] = 'Google+';
      $contactmethods['linkedin']   = 'LinkedIn';
      $contactmethods['flickr']     = 'Flickr';
      $contactmethods['pinterest']  = 'Pinterest';
      $contactmethods['instagram']  = 'Instagram';
      $contactmethods['youtube']    = 'Youtube';
      $contactmethods['soundcloud'] = 'SoundCloud';

      return $contactmethods;
  }
  add_filter('user_contactmethods', 'tw_extra_contact_info');
}



/******************************************************
***************** Header Functions ********************
******************************************************/

/**
 * Sets favicon url in header
 */
if(!function_exists('tw_favicon')){
  function tw_favicon(){?>
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.png" />
  <?php
  }
  add_action( 'wp_head', 'tw_favicon', 10 );
}

/***** Add apple icons ****/
/**
 * Sets Apple iOS icons url in header
 */
if(!function_exists('tw_apple_icon')){
  function tw_apple_icon() { ?>
    		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/apple-touch-icon.png" />
      <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/apple-touch-icon-72x72.png" />
      <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/apple-touch-icon-114x114.png" />
      <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/apple-touch-icon-144x144.png" />
  	<?php
  }
  add_action( 'wp_head', 'tw_apple_icon', 10 );
}

/******************************************************
******************* Post Functions ********************
******************************************************/

/**
 * Sets excerpt length
 * @param  integer  $length
 * @return string hex
 */
if(!function_exists('tw_excerpt_length')){
  function tw_excerpt_length( $length ) {
  	return 30;
  }
  add_filter( 'excerpt_length', 'tw_excerpt_length', 999 );
}

/**
 * Sets excerpt more postfix to ...
 * @param  string  $more
 * @return string $more
 */
if(!function_exists('tw_excerpt_more')){
  function tw_excerpt_more( $more ) {
  	return '... ';
  }
  add_filter('excerpt_more', 'tw_excerpt_more');
}

/**
 * Echo's post navigation
 */
if(!function_exists('tw_post_nav')){
  function tw_post_nav() {
  	global $post;

  	// Don't print empty markup if there's nowhere to navigate.
  	$previous = get_adjacent_post( false, '', true );
  	$next     = get_adjacent_post( false, '', false );

  	if ( ! $next && ! $previous )
  		return;
  	?>
  	<nav class="navigation post-navigation" role="navigation">
  		<h3 class="sr-only"><?php _e( 'Post navigation', 'tw' ); ?></h3>
      <ul class="pager nav-links">
        <?php
          if($previous){
            previous_post_link( '<li class="previous">%link</li>', _x( '<i class="fa fa-chevron-circle-left"></i> %title', 'Previous Article', 'tw' ) );
          }

          if($next){
            next_post_link( '<li class="next">%link</li>', _x( '%title <i class="fa fa-chevron-circle-right"></i>', 'Next Article', 'tw' ) );
          }
			  ?>
      </ul>
  	</nav><!-- .navigation -->
  	<?php
  }
}



/******************************************************
********************* Comments ************************
******************************************************/

/**
 * Returns user avatar class with Bootstrap cirle classes
 * @param string $class
 * @return string $class
 */
add_filter('get_avatar','tw_round_avatar_css');
function tw_round_avatar_css($class) {
  $class = str_replace("class='avatar", "class='avatar img-circle media-object", $class) ;
  return $class;
}

/**
 * Returns comment reply link with Bootstrap button classes
 * @param string $class
 * @return string $class
 */
add_filter('comment_reply_link', 'tw_reply_link_class');
function tw_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link btn btn-primary btn-xs", $class);
    return $class;
}


/**
 * Echos comment layout
 * @param $comments
 * @param $args
 * @param $depth
 */
if(!function_exists('tw_comments')){
  function tw_comments($comment, $args, $depth) {
     $GLOBALS['comment'] = $comment; ?>
     <li id="comment-<?php comment_ID(); ?>" class="comment-author vcard clearfix media">
        <a href="<?php echo get_comment_author_url();?>" title="<?php echo get_comment_author() ;?>" target="_blank" class="pull-left" >
          <?php echo get_avatar( $comment, $size='75' ); ?>
        </a>
        <div class="media-body">
          <?php printf('<h4 class="media-heading">%s</h4>', get_comment_author_link()) ?>
          <?php if ($comment->comment_approved == '0') : ?>
      				<div class="alert alert-success">
          				<p><?php _e('Your comment is awaiting moderation.','tw') ?></p>
      				</div>
          <?php endif; ?>
  				<?php comment_text() ?>

  				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>

  				<div class="row comment-options">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 comment-reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 comment-edit">
              <?php edit_comment_link(__('Edit','tw'),'<span class="edit-comment btn btn-xs btn-default"><i class="fa fa-edit"></i> ','</span>') ?></div>
  				</div>
        </div>
      <!-- </li> is added by wordpress automatically -->
  <?php
  }
}

/**
 * Echos comment placeholders
 * @param $fields
 */
if(!function_exists('tw_comment_placeholders')){
  function tw_comment_placeholders( $fields ){
      error_log('placeholders');
      $fields['author'] = str_replace( '<input', '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input placeholder="'
              . _x( 'First and last name or a nick name *', 'comment form placeholder', 'tw' ) . '"', $fields['author'] );
      $fields['author'] = str_replace( '<p class="comment-form-author">', '<p class="comment-form-author form-group">', $fields['author'] );
      $fields['author'] = str_replace( '</p>', '</div></p>', $fields['author'] );
      $fields['author'] = str_replace( '<label ', '<label class="sr-only"', $fields['author'] );

      $fields['email'] = str_replace( '<input id="email" name="email" type="text"', '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="email" placeholder="contact@example.com *"  id="email" name="email"', $fields['email'] );
      $fields['email'] = str_replace( '<p class="comment-form-email">', '<p class="comment-form-email form-group">', $fields['email'] );
      $fields['email'] = str_replace( '</p>', '</div></p>', $fields['email'] );
      $fields['email'] = str_replace( '<label ', '<label class="sr-only"', $fields['email'] );

      $fields['url'] = str_replace( '<input id="url" name="url" type="text"', '<div class="input-group"><span class="input-group-addon"><i class="fa fa-link"></i></span><input placeholder="http://example.com" id="url" name="url" type="url"', $fields['url'] );
      $fields['url'] = str_replace( '<p class="comment-form-url">', '<p class="comment-form-url form-group">', $fields['url'] );
      $fields['url'] = str_replace( '</p>', '</div></p>', $fields['url'] );
      $fields['url'] = str_replace( '<label ', '<label class="sr-only"', $fields['url'] );
      return $fields;
  }
  add_filter( 'comment_form_default_fields', 'tw_comment_placeholders' );
}


/******************************************************
***************** Pagination ************************
******************************************************/
if(!function_exists('tw_pagination')){
  function tw_pagination($pages = '', $range = 4){
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == ''){
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages){ $pages = 1; }
     }

     if(1 != $pages){
         echo "<ul class=\"pagination\">";
         //echo "<span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";

         for ($i=1; $i <= $pages; $i++){
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                 echo ($paged == $i)? "<li class=\"active\"><a href='".get_pagenum_link($i)."'>".$i."</a></li>":
                                      "<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
         echo "</ul>\n";
     }
  }
}



/******************************************************
*********************** Footer ************************
******************************************************/
if(!function_exists('tw_credit')){
  function tw_credit(){
    echo 'Designed & Developed by <a href="http://www.thirdwunder.com/" title="Third Wunder">Third Wunder</a>';
  }
}

if(!function_exists('tw_copyright')){
	function tw_copyright(){
	  echo '&copy; '.date('Y').' '.get_bloginfo('name').' '.__('All Rights Reserved','tw');
	}
}