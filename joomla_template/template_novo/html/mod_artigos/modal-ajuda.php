  <?php
  /**
   * @package     Joomla.Site
   * @subpackage  mod_articles_news
   *
   * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
   * @license     GNU General Public License version 2 or later; see LICENSE.txt
   */

  defined('_JEXEC') or die;?>

  <?php foreach ($list as $artigo): 
  ?>



  <div class="modal fade" id="<?php echo $artigo->alias; ?>" tabindex="-1" role="dialog" aria-labelledby="modalAjuda" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAjuda"><?php echo $artigo->title; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php  
              //echo "<pre>"; var_dump($artigo);  
             echo $artigo->introtext;
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <?php endforeach; ?>