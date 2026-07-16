<?php
/**
 * @package     Auctions
 * @subpackage  mod_auctions
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2018 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

?>

<script>
    jQuery(document).ready(function(){
        jQuery('.tabs a.btn-tab').click(function(){
            event.preventDefault();
            var tab_id = jQuery(this).attr('href');
            jQuery('.tabs a.btn-tab, .tab').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(tab_id).addClass('active');
        })
    })
</script>
                
<div class="tabs mt-5">
    <a href="#tab-1" class="btn-tab active">LICITAÇÕES</a>
    <div class="tab active" id="tab-1">

        <div class="row">
            <div class="col-md-8">

                <div class="introducao"> 
                    <?php 
                    if(!empty($description1)){
                        echo $description1;
                    }
                    ?>
                </div>

                <h4> Editais mais recentes</h4>

                <?php $i=0;?>
                <?php foreach ($list2 as $item): ?>
                    <?php //echo '<pre>'; var_dump($item); ?>
                    <div class="row lista-compra">
                        <div class="col-md-5 img-bloco">
                            <a href="<?php echo $item->link ? $item->link:'#'; ?>">
                            <?php if (json_decode($item->image)): ?>
                                    <?php $image = $item->image ? JUri::root() . 'images/biddings/thumbnails/' . json_decode($item->image)[0] : 'com_biddings/no-image.png'; ?>
                                <?php elseif ($item->image): ?>
                                    <?php $image = $item->image ? JUri::root() . 'images/biddings/thumbnails/' . $item->image : 'com_biddings/no-image.png'; ?>
                                <?php endif ?>
                                <?php echo JHtml::_('image', $image, $item->title, "class=\"img-fluid\"", true); ?>
                            </a>
                        </div>    
                        <div class="col-md-7 titulo-editais">
                            <a href="<?php echo $item->link ? $item->link:'#'; ?>" >
                                <?php echo $item->title ; ?>
                            </a>
                            <div class="caucao">
                              <div class="row">
                                 <p class="titulo mr-5">Caução até <br><span class="titulo-data"><?php echo JHtml::_("date", strtotime($item->date_deposit), 'd F');?></span></p>
                                 <p class="licitacao">Licitação <br> <span class="licitacao-titulo"><?php echo JHtml::_("date", strtotime($item->date_bidding), 'd F');?></span></p>                       
                              </div>
                            </div>
                            <?php if(!empty($item->location)):?>
                                <div class="descricao">
                                    <?php echo $item->location;?>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                <?php $i++;?>
                <?php endforeach; ?>

                <?php if($showBtnBd):?>
                <div class="d-flex justify-content-center mt-5">
                    <a href="<?php echo $linkBtnBd;?>" class="btn btn-outline-dark" title="<?php echo $btnBd;?>"><?php echo $btnBd;?></a>
                </div>
                <?php endif;?>
            </div>

            <div class="col-md-4">
                <div class="interna-direita">
                    <?php 
                        // Monta posição virtual para escrever módulos
                        $document = JFactory::getDocument();
                        $renderer = $document->loadRenderer('modules');
                        $position = "contexto-licitacao";
                        $options = array('style' => 'container');
                        echo $renderer->render($position, $options, null);
                    ?>
                </div>
            </div>
        </div>
        

    </div>

    <a href="#tab-2" class="btn-tab">LEILÕES</a>
    <div class="tab" id="tab-2">
        
        <div class="row">
            <div class="col-md-8">

                <div class="introducao">
                    <?php 
                    if(!empty($description2)){
                        echo $description2;
                    }
                    ?>
                </div>

                <h4>Leilões mais recentes</h4>

                <?php $i=0;?>
                <?php foreach ($list as $item): ?>
                    <div class="row lista-compra">
                        <div class="col-md-5 img-bloco">
                            <a href="<?php echo $item->link ? $item->link:'#'; ?>">
                            <?php if (json_decode($item->image)): ?>
                                    <?php $image = $item->image ? JUri::root() . 'images/auctions/thumbnails/' . json_decode($item->image)[0] : 'com_biddings/no-image.png'; ?>
                                <?php elseif ($item->image): ?>
                                    <?php $image = $item->image ? JUri::root() . 'images/auctions/thumbnails/' . $item->image : 'com_biddings/no-image.png'; ?>
                                <?php endif ?>
                                <?php echo JHtml::_('image', $image, $item->title, "class=\"img-fluid\"", true); ?>
                            </a>
                        </div>    
                        <div class="col-md-7 titulo-editais">
                            <a href="<?php echo $item->link ? $item->link:'#'; ?>" >
                                <?php echo $item->title ; ?>
                            </a>
                            <div class="leilao">
                            <div class="row">
                                 <p class="titulo mr-5">Data do 1º Leilão<br> <span class="titulo-data"><?php echo JHtml::_("date", strtotime($item->date_one), 'd F');?></span></p><br>
                                 <p class="licitacao">Data do 2º Leilão<br> <span class="titulo-data"><?php echo JHtml::_("date", strtotime($item->date_two), 'd F');?></span> </p>                      
                            </div>
                            </div>
                            
                            <div class="item-date card-download-date">
                                <span class="bloco-data">
                                    <i class="material-icons date-icon">gavel</i>
                                    <span class="bloco-data-descricao">
                                        <span class="bloco-data-texto">DADOS DO LEILOEIRO</span>
                                        <span class="dados-leiloeiro">
                                            NOME: <?php echo $item->auctioneer_name; ?><br>
                                            <span class="bloco-data-texto">TELEFONE: <?php echo $item->auctioneer_phone; ?></span>
                                            <span class="bloco-data-texto">SITE: <?php echo $item->auctioneer_site; ?></span>
                                        </span>

                                    </span>
                                </span>
                            </div>
                                <?php //echo '<pre>'; var_dump($item); echo '</pre>';?>
                        </div>
                    </div>
                <?php $i++;?>
                <?php endforeach; ?>
                <?php if($showBtnAc):?>
                <div class="d-flex justify-content-center mt-5">
                    <a href="<?php echo $linkBtnAc;?>" class="btn btn-outline-dark" title="<?php echo $btnAc;?>"><?php echo $btnAc;?></a>
                </div>
                <?php endif;?>

            </div> <!-- end .col-md-8 -->

            <div class="col-md-4">
                
                <div class="interna-direita">
                    <?php 
                        // Monta posição virtual para escrever módulos
                        $document = JFactory::getDocument();
                        $renderer = $document->loadRenderer('modules');
                        $position = "contexto-leilao";
                        $options = array('style' => 'container');
                        echo $renderer->render($position, $options, null);
                    ?>
                </div>

            </div> <!-- end .col-md-4-->
        </div>

    </div>
</div>
