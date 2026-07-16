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
<?php if ($params->get('readmore') == 1): ?>
<script>
    jQuery(document).ready(function() {
        var mudartxt = 1; 
        jQuery(".abrir-div").click(function() {
            jQuery(".invista-brasilia").toggleClass("invista-brasilia-efeito");
            console.log(mudartxt);
            if (mudartxt === 1){
                //jQuery('.texto-botao:contains("LEIA MAIS")').text('OCULTAR');
                jQuery('.texto-botao:contains("COMO SE TORNAR UM PARCEIRO")').text('OCULTAR');
                mudartxt = 0;
            }else{
                mudartxt = 1;
                //jQuery('.texto-botao:contains("OCULTAR")').text('LEIA MAIS');
                jQuery('.texto-botao:contains("OCULTAR")').text('COMO SE TORNAR UM PARCEIRO');
                jQuery('.invista-brasilia').focus();
            }
        });
    });
</script>
<?php endif; ?>

<div class="interna-invista"> 
    <div class="container conteudo-invista ">
        <div class="row invista-brasilia <?php echo $params->get('readmore') == '1' ? 'invista-brasilia-efeito' : ''; ?>">
            <?php foreach ($list as $key => $item) : ?>
            <?php echo $item->introtext; ?>
            <?php endforeach ?>
        </div>
        <div class="row justify-content-end botoes-invista">
            <div class="col-md-8">
                <div >
                    <a href="#" class="btn btn-outline-light botao-invista text-center abrir-div">
                        <span class="texto-botao">
                            <!-- LEIA MAIS -->
                            COMO SE TORNAR UM PARCEIRO
                        </span>
                    </a>
                </div>
            </div>    
        
            <!-- <div class="col-4">
                <div class="d-flex float-right ">
                    <a href="#" class="btn btn-outline-light botao-invista text-center">COMO SE TORNAR UM PARCEIRO</a>
                </div>
            </div> -->
        </div>
    </div>
</div>