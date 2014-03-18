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
    }
  }
})(jQuery, Drupal);