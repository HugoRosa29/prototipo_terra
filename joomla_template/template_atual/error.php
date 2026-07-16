<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Logo file or site title param
if ($params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php // Use of Google Font ?>
	<?php if ($params->get('googleFont')) : ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $params->get('googleFontName')); ?>', sans-serif;
			}
			html{
				height: 100%;
			}
		</style>
	<?php endif; ?>

	<style type="text/css">

			html{
				height: 100%;
			}
		</style>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
	<?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/cms/css/debug.css" type="text/css" />
	<?php endif; ?>
	<?php // If Right-to-Left ?>
	<?php if ($this->direction == 'rtl') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/jui/css/bootstrap-rtl.css" type="text/css" />
	<?php endif; ?>
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<?php // Template color ?>
	<?php if ($params->get('templateColor')) : ?>
		<style type="text/css">
			body{
				
			}
		</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl; ?>/media/jui/js/html5.js"></script>
	<![endif]-->


			<!-- CSS -->
			<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/all.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/style.css">
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/media-querie.css">
</head>

<body id="errorPage" class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			
			<!-- Header -->
			<header class="topo" role="banner">
				<a href="<?php echo $this->baseurl; ?>/">
					<?php echo $logo; ?>
				</a>				
			</header>
		

			<div class="row-fluid content-error">
					<!-- Begin Content -->
					<h2 class="text-center codigo-do-erro">
						Erro <?php echo $this->error->getCode(); ?>
					</h2>
					<h3 class="text-center"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h3>
				
					<!--
					<div class="col-12 tipos-de-erros">
						<div class="content-tipos-de-erros">
							<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
							<ul>
							<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></li>
							</ul>
						</div>
					</div>
					-->

					<div class="col-12">
						<div class="outros-acessos">						
						
							<h5 class="text-center"><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></h5>
							<div class="home-search">
								<?php if (JModuleHelper::getModule('search')) : ?>						
									<?php echo $doc->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<span>ou</span>
								<a class="btn btn-outline-dark" href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>
							</div>
						</div>
					</div>

						
			</div>

			<p class="text-center administrador-error"><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
		</div>
	</div>

</body>
</html>
