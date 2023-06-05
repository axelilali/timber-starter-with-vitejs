<?php
/**
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
 require_once $composer_autoload;
 $timber = new Timber\Timber();
}

require_once get_template_directory() . '/inc/vite.php';

if (!class_exists('Timber')) {

 add_action(
  'admin_notices',
  function () {
   echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
  }
 );

 add_filter(
  'template_include',
  function ($template) {
   return get_stylesheet_directory() . '/public/no-timber.html';
  }
 );
 return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

class StarterSite extends Timber\Site

{
 /** Add timber support. */
 public function __construct()
 {
  add_action('after_setup_theme', array($this, 'theme_supports'));
  add_filter('timber/context', array($this, 'add_to_context'));
  add_filter('timber/twig', array($this, 'add_to_twig'));
  add_action('init', array($this, 'register_post_types'));
  add_action('init', array($this, 'register_taxonomies'));
  parent::__construct();
 }

 /** This is where you add some context
  *
  * @param string $context context['this'] Being the Twig's {{ this }}.
  */
 public function add_to_context($context)
 {
  $context['menu'] = new Timber\Menu();
  $context['site'] = $this;
  return $context;
 }

 public function theme_supports()
 {
  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support(
   'html5',
   array(
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
   )
  );
  add_theme_support(
   'post-formats',
   array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'audio',
   )
  );

  add_theme_support('menus');
 }

 /** This is where you can add your own functions to twig.
  *
  * @param string $twig get extension.
  */
 public function add_to_twig($twig)
 {
  $twig->addExtension(new Twig\Extension\StringLoaderExtension());
  return $twig;
 }

}

new StarterSite();
