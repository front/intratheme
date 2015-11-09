<?php

/**
 * @file
 * template.php
 */

/**
 * Overrides theme_menu_tree().
 */
function intratheme_menu_tree(&$variables) {
  return '<ul class="menu nav">' . $variables['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the primary menu links.
 */
function intratheme_menu_tree__primary(&$variables) {
  return '<li class="divider"></li>' . $variables['tree'];
}

/**
 * Bootstrap theme wrapper function for the secondary menu links.
 */
function intratheme_menu_tree__secondary(&$variables) {
  return '<li class="divider"></li>' . $variables['tree'];
}

/**
 * Theme wrapper function for the Home Menu.
 */
function intratheme_menu_tree__menu_home_menu(&$variables) {
  return '<nav class="row">' . $variables['tree'] . '</li>';
}

/**
 * Overrides Home Menu links output.
 */
function intratheme_menu_link__menu_home_menu(array $variables) {
  $element           = $variables['element'];
  // get link classes from the style attribute
  $default_classes = array('module', 'module-bordered', 'module-metro');
  $link_classes = empty($element['#localized_options']['attributes']['style']) ? array() : explode(' ', $element['#localized_options']['attributes']['style']);
  $link_classes = array_merge($link_classes, $default_classes);
  // link options
  $link_options      = array(
    'html'       => TRUE,
    'attributes' => array(
      'class' => $link_classes
    )
  );
  $link_icon_classes = NULL;
  $link_class_attribute      = empty($element['#localized_options']['attributes']['class']) ? NULL : $element['#localized_options']['attributes']['class'];
  if ( ! empty($link_class_attribute)) {
    foreach ($link_class_attribute as $class) {
      $link_icon_classes .= $class . ' ';
    }
  }
  $link_text = '<i class="glyphicon ' . $link_icon_classes . '"></i><h2>' . $element['#title'] . '</h2>';
  $output = l($link_text, $element['#href'], $link_options);
  return '<div class="small-6 medium-3 columns">' . $output . '</div>';
}

/**
 * Overrides theme_menu_link().
 */
function intratheme_menu_link(array $variables) {
  $element  = $variables['element'];
  $sub_menu = '';

  // Check access at the link level, if access is set.
  if (isset($element['#access']) && !$element['#access']) {
    return FALSE;
  }

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (( $element['#original_link']['menu_name'] == 'management' ) && ( module_exists('navbar') )) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif (( !empty( $element['#original_link']['depth'] ) ) && ( $element['#original_link']['depth'] == 1 )) {
      // Add our own wrapper.
      unset( $element['#below']['#theme_wrappers'] );
      $sub_menu = '<ul class="dropdown">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#attributes']['class'][]     = 'has-dropdown';
      $element['#attributes']['class'][]     = 'not-click';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][]     = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (( $element['#href'] == $_GET['q'] || ( $element['#href'] == '<front>' && drupal_is_front_page() ) ) && ( empty( $element['#localized_options']['language'] ) )) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements hook_page_alter().
 */
function intratheme_page_alter(&$page) {
  global $user;

  // Adds theme logo on user login form.
  if ($user->uid === 0) {
    if ($logo = theme_get_setting('logo')) {
      $page['page_top']['login_logo'] = array(
        '#markup' => '<div class="user-login-logo"><img src="' . $logo . '" alt="" /></div>'
      );
    }
  }
}

/**
 * Overrides facetapi active link theme.
 */
function intratheme_facetapi_link_active(&$vars) {
  $vars['options']['html'] = TRUE;
  return l('<span class="glyphicon glyphicon-remove"></span> ' . $vars['text'], $vars['path'], $vars['options']);
}
