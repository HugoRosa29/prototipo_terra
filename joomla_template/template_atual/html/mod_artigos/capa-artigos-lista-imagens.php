<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="container interna-invista">

        <div class="row">

                    <?php foreach ($list as $key => $item) : ?>
                        <div class="col-md-4">
                            <a href="<?php echo $item->link; ?>">
                                <img src="<?php echo json_decode($item->images)->image_intro ?>" class="figure-img img-fluid rounded projetos-img thumb-invista" alt="<?php echo $item->title ?>">
                                
                                <h5>
                                    <?php echo $item->title; ?>
                                </h5>
                             </a>
                        </div>
                    <?php endforeach ?>

        </div>

</div>