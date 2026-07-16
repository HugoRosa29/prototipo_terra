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
<?php if ($params->get('show_description') == 1): ?>
<div class="text-center mb-5"><?php echo $params->get('name_description'); ?></div>
<?php endif ?>

<div class="row">
    <div class="col-md-7">

        <div id="carousel-compre-imoveis" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($list as $key => $item): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>"></li>
                <?php endforeach; ?>
            </ol>

            <div class="carousel-inner">
                <?php foreach ($list as $key => $item): ?>
                <?php //$image = $item->image ? JUri::root() . 'images/auctions/' . $item->image : 'com_auctions/no-image.png'; ?>
                <div class="carousel-item <?php echo ($key==0)?'active':'';?>"  <?php $image = $item->image ? JUri::root() . 'images/auctions/' . $item->image : 'com_auctions/no-image.png'; echo "style=\"
    background-image: url(" .JUri::root() . 'images/auctions/' . $item->image . ");
    background-size: cover;
    background-position: center center;

\">" ?>
                <a href="<?php echo $item->link ? $item->link:'#'; ?>" title="<?php echo $item->title ?>">
                    <!-- <img class="d-block w-100 rounded img-fluid" src="<?php echo $image ?>" alt="<?php echo $item->title ?>"> -->
                </a>
            </div>
            <?php endforeach; ?>
        </div>


    </div> <!-- end #carousel-compre-imoveis -->

</div>

<?php //echo '<pre>'; var_dump($list); ?>

<div class="col-md-5 container">
    <div class="bloco-amarelo">
        <?php foreach ($list as $key => $item): ?>
            <h3 class="text-center"><?php echo $item->title ?></h3>
            <div class="datas">
                <div>
                    <p class="titulo">Caução até</p>
                    <p class="dia"><?php echo date("d M", strtotime($item->date_two)); ?></p>
                </div>
                <div>
                    <p class="titulo">Licitação em</p>
                    <p class="dia"><?php echo date("d M", strtotime($item->date_two)); ?></p>
                </div>
            </div>

            <div class="localizacao">
                <?php echo $item->description ?>
            </div>

            <div class="d-flex justify-content-center">
                <a href="<?php echo $item->link ? $item->link:'#'; ?>" class="btn btn-outline-dark" title="Saiba Mais">Saiba Mais</a> 
          
        

            </div>
        <?php endforeach; ?>
    </div>
</div> <!-- end .container -->

</div>


<?php if ($params->get('show_link') == 1): ?>
    <div class="d-flex justify-content-center">
        <a href="<?php echo $params->get('url_link'); ?>" class="btn btn-outline-dark" title="<?php echo $params->get('name_link'); ?>"><?php echo $params->get('name_link'); ?></a>
    </div>
<?php endif ?>
