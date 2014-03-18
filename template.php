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
 * Overrides theme_menu_link().
 */
function intratheme_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#attributes']['class'][] = 'has-dropdown';
      $element['#attributes']['class'][] = 'not-click';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements hook_page_alter().
 */
function intratheme_page_alter(&$page) {
  // Adds theme logo on user login form.
  if (isset($page['content']['system_main']['form_id']) && $form_id = $page['content']['system_main']['form_id']) {
    if ($form_id['#value'] == 'user_login') {
      if ($logo = theme_get_setting('logo')) {
        $page['page_top']['login_logo'] = array(
          '#markup' => '<div class="user-login-logo"><img src="' . $logo . '" alt="" /></div>'
        );
      }
    }
  }
}
