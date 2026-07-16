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
                
<div class="tabs">
    <a href="#tab-1" class="btn-tab active">LICITAÇÕES</a>
    <div class="tab active" id="tab-1">

        <div class="row">
            <div class="col-md-8">

                <div class="introducao">Quando você vende algum produto, como decide para quem vender? Geralmente, utilizam-se critérios tais como: quem paga mais, quem dá uma entrada maior, quem paga em um menor número de parcelas, entre outros.</div>

                <h4> Editais mais recentes</h4>

                <?php $i=0;?>
                <?php foreach ($list2 as $item): ?>
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
                                 <p class="titulo mr-5">Caução até <br><span class="titulo-data"><?php echo dataExtenso($item->date_deposit);?></span></p><br>
                                 <p class="licitacao">Licitação <br> <span class="licitacao-titulo"><?php echo dataExtenso($item->date_bidding);?></span></p>                       
                              </div>
                            </div>
                            <div class="descricao">
                                <?php echo substr(strip_tags($item->description),0,50);?>
                            </div>
                                <?php //echo '<pre>'; var_dump($item); echo '</pre>';?>
                        </div>
                    </div>
                <?php $i++;?>
                <?php endforeach; ?>

                <div class="d-flex justify-content-center mt-5">
                    <a href="#" class="btn btn-outline-dark" title="Ver todos">Ver todos</a>
                </div>
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
                Mauris imperdiet tellus quis ipsum venenatis tristique. Cras pretium porttitor lacus, sit amet feugiat lorem finibus in. Etiam ut tellus viverra, molestie leo non, ullamcorper nisl. Duis tincidunt in orci eget lacinia. Etiam ultricies vel lectus vitae semper. Nullam placerat neque velit, non viverra eros semper at. Cras magna nibh, hendrerit et ante in, lobortis ornare nisi. Nunc tempus lorem at arcu luctus, eget interdum elit maximus. Sed eu ex id mauris ultricies posuere sed lobortis ante. Sed efficitur efficitur nisl ac facilisis. Nullam pellentesque lectus ut lacus malesuada varius.
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
                                 <p class="titulo mr-5">Data do 1º Leilão<br> <span class="titulo-data"><?php echo dataExtenso($item->date_one);?></span></p><br>
                                 <p class="licitacao">Data do 2º Leilão<br> <span class="titulo-data"><?php echo dataExtenso($item->date_two);?></span> </p>                      
                            </div>
                            </div>
                            <div class="descricao">
                                <?php echo substr(strip_tags($item->description),0,50);?>
                            </div>
                                <?php //echo '<pre>'; var_dump($item); echo '</pre>';?>
                        </div>
                    </div>
                <?php $i++;?>
                <?php endforeach; ?>

                <div class="d-flex justify-content-center mt-5">
                    <a href="#" class="btn btn-outline-dark" title="Ver todos">Ver todos</a>
                </div>

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
