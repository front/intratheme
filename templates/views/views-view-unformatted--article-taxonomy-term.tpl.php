<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<nav class="row">
<?php foreach ($rows as $id => $row): ?>
  <div class="small-6 medium-3 columns">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</nav>