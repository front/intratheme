/**
 * @file
 * intratheme.js
 *
 */

var Drupal = Drupal || {};

(function($, Drupal){
  "use strict";

  Drupal.behaviors.intratheme = {
    attach: function(context) {
      $(document).ready(function(){
        $(document).foundation();        
        FastClick.attach(document.body);
      });
      // No link behaviour.
      $('.no-link').click(function(e) {
        e.preventDefault();
      });
    }
  }
})(jQuery, Drupal);