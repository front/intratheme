<?php

/**
 * @file
 */
?>
<div id="google-drive-service-<?php print $variables['id']; ?>">
  <div class="google-drive-service-breadcrumbs">
    <?php print $breadcrumbs; ?>
  </div>
  <?php if(count($files) > 0): ?>
    <ul class="files">
      <?php foreach($files as $file): ?>
      <?php
        $class = str_replace('/', '-', $file->mime_type);
        $class = str_replace('.', '-', $class);
      ?>
      <li class="<?php print $class; ?>">
        <?php if ($file->mime_type == GD_FOLDER_TYPE): ?>
          <?php print l($file->title, 'google-drive-service-ajax-callback/nojs/' . $account_id . '/' . $file->fid . '/' . $root_id . '/' . $show_full_path, array('attributes' => array('class' => 'use-ajax title'))); ?>
        <?php else: ?>
          <?php print l($file->title, 'google-drive-service-open/' . $account_id . '/' . $file->fid . '/' . $show_full_path, array('attributes' => array('target' => '_new', 'class' => 'title'))); ?>
        <?php endif; ?>
        <span class="empty"></span>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <ul>
      <li><?php print t('No files found.'); ?></li>    
    </ul>
  <?php endif; ?>
</div>