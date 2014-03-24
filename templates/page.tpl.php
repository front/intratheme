<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<!-- Menu for mobile -->
<nav class="tab-bar show-for-small">
  <section class="left-small">
    <a class="left-off-canvas-toggle menu-icon"><span></span></a>
  </section>

  <section class="middle tab-bar-section">
    <h1 class="title">
      <?php if (!empty($site_name)): ?>
        <?php print $site_name; ?>
      <?php endif; ?>
    </h1>
  </section>

  <section class="right-small">
    <a class="right-off-canvas-toggle menu-icon"><span></span></a>
  </section>
</nav>

<?php
// Get only 1st level children for mobile menu.
if (is_array($primary_nav)) {
  $primary_nav_items = reset($primary_nav);
  $primary_nav_mobile = $primary_nav_items['#below'];
}

if (is_array($secondary_nav)) {
  $secondary_nav_items = reset($secondary_nav);
  $secondary_nav_mobile = $secondary_nav_items['#below'];
}
?>

<?php if (!empty($primary_nav_mobile)): ?>
  <aside class="left-off-canvas-menu">
    <ul class="off-canvas-list">
      <?php print render($primary_nav_mobile); ?>
    </ul>
  </aside>
<?php endif; ?>

<?php if (!empty($secondary_nav_mobile)): ?>
  <aside class="right-off-canvas-menu">
    <ul class="off-canvas-list">
      <?php print render($secondary_nav_mobile); ?>
    </ul>
  </aside>
<?php endif; ?>
<!-- End menu for mobile -->

<a class="exit-off-canvas"></a>

<!-- Menu for non mobile -->
<nav class="top-bar hide-for-small" data-topbar="">
  <ul class="title-area">
    <li class="name">
      <h1>
        <?php if (!empty($site_name)): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
        <?php endif; ?>
      </h1>
    </li>
  </ul>

  <section class="top-bar-section">
    <ul class="right">
      <?php if (!empty($secondary_nav)): ?>
        <?php print render($secondary_nav); ?>
      <?php endif; ?>
    </ul>

    <ul class="right">
      <?php if (!empty($primary_nav)): ?>
        <?php print render($primary_nav); ?>
      <?php endif; ?>
    </ul>
  </section>
</nav>
<!-- End menu for non mobile -->

<?php if (!empty($title)): ?>
  <h1 class="page-header"><?php print $title; ?></h1>
<?php endif; ?>

<?php print render($title_suffix); ?>

<?php print $messages; ?>

<?php if (!empty($tabs)): ?>
  <?php print render($tabs); ?>
<?php endif; ?>

<?php print render($page['content']); ?>

<footer class="footer container">
  <?php print render($page['footer']); ?>
</footer>
