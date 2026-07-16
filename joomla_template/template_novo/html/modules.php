<?php
/**
 * @package     Cleanportal_2019
 * @subpackage  tpl_cleanportal_2019
 *
 * @author      Charles Guedes <charlesgcf@gmail.com>
 * @copyright   Copyright (C) 2019 Capgemini do Brasil. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Bootstrap
 *
 * @param   object  $module    The module data.
 * @param   object  &$params   The module params.
 * @param   array   &$attribs  The module attribs.
 *
 * @return  string
 */
function modChrome_bootstrap($module, &$params, &$attribs)
{
	// Initialiase variables.
	$moduleTag      = $params->get('module_tag');
	$headerTag      = htmlspecialchars($params->get('header_tag'));
	$headerClass    = htmlspecialchars($params->get('header_class', 'title'));
	$bootstrapSize  = htmlspecialchars($params->get('bootstrap_size'));
	$moduleClass    = !empty($bootstrapSize) ? " class=\"{$bootstrapSize}\"" : '';

	if ($module->showtitle)
	{
		// Set up the variables we will need during processing.
		$icons = array();
		$icon  = '';

		preg_match('(icon([\-a-zA-Z0-9]){1,})', $module->title, $icons);

		// Icon text (if exists).
		if (count($icons) > 0)
		{
			$icon = '<i class="' . $icons[0] . '"></i>';
		}

		$title = preg_replace('@(\[icon([\-a-zA-Z0-9]){1,}\])@', '', $module->title);
	}

	if (!empty ($module->content))
	{
		$html  = "";

		if ((bool) $module->showtitle)
		{
			$html .= "<div class=\"section-title mb-100\">";
			$html .= "<{$headerTag} class=\"{$headerClass}\">{$icon}{$title}</{$headerTag}>";
			$html .= "</div>";
		}

		$html .= $module->content;
		$html .= "";

		echo $html;
	}
}

/**
 * Sidebar
 *
 * @param   object  $module    The module data.
 * @param   object  &$params   The module params.
 * @param   array   &$attribs  The module attribs.
 *
 * @return  string
 */
function modChrome_sidebar($module, &$params, &$attribs)
{
	// Initialiase variables.
	$moduleTag      = $params->get('module_tag');
	$headerTag      = htmlspecialchars($params->get('header_tag'));
	$headerClass    = htmlspecialchars($params->get('header_class', 'title'));
	$bootstrapSize  = htmlspecialchars($params->get('bootstrap_size'));
	$moduleClass    = !empty($bootstrapSize) ? " {$bootstrapSize}" : '';

	if ($module->showtitle)
	{
		// Set up the variables we will need during processing.
		$icons = array();
		$icon  = '';

		preg_match('(icon([\-a-zA-Z0-9]){1,})', $module->title, $icons);

		// Icon text (if exists).
		if (count($icons) > 0)
		{
			$icon = '<i class="' . $icons[0] . '"></i>';
		}

		$title = preg_replace('@(\[icon([\-a-zA-Z0-9]){1,}\])@', '', $module->title);
	}

	if (!empty ($module->content))
	{
		$html  = "<{$moduleTag} class=\"widget{$moduleClass}\">";

		if ((bool) $module->showtitle)
		{
			$html .= "<{$headerTag} class=\"{$headerClass}\">{$icon}{$title}</{$headerTag}>";
		}

		$html .= $module->content;
		$html .= "</{$moduleTag}>";

		echo $html;
	}
}

/**
 * Mega
 *
 * @param   object  $module    The module data.
 * @param   object  &$params   The module params.
 * @param   array   &$attribs  The module attribs.
 *
 * @return  string
 */
function modChrome_mega($module, &$params, &$attribs)
{
	// Initialiase variables.
	$moduleTag      = $params->get('module_tag');
	$headerTag      = htmlspecialchars($params->get('header_tag'));
	$headerClass    = htmlspecialchars($params->get('header_class', 'title'));
	$bootstrapSize  = htmlspecialchars($params->get('bootstrap_size', '1'));
	$moduleClass    = !empty($bootstrapSize) ? "{$bootstrapSize}" : '';

	if ($module->showtitle)
	{
		// Set up the variables we will need during processing.
		$icons = array();
		$icon  = '';

		preg_match('(icon([\-a-zA-Z0-9]){1,})', $module->title, $icons);

		// Icon text (if exists).
		if (count($icons) > 0)
		{
			$icon = '<i class="' . $icons[0] . '"></i>';
		}

		$title = preg_replace('@(\[icon([\-a-zA-Z0-9]){1,}\])@', '', $module->title);
	}

	if (!empty ($module->content))
	{
		$html = '';

		if ($attribs['structure'])
		{
			$html  = "<{$moduleTag} class=\"col{$moduleClass}\">";
		}

		if ((bool) $module->showtitle)
		{
			$html .= "<{$headerTag} class=\"{$headerClass}\">{$icon}{$title}</{$headerTag}>";
		}

		$html .= $module->content;

		if ($attribs['structure'])
		{
			$html .= "</{$moduleTag}>";
		}

		echo $html;
	}
}


/**
 * Bootstrap
 *
 * @param   object  $module    The module data.
 * @param   object  &$params   The module params.
 * @param   array   &$attribs  The module attribs.
 *
 * @return  string
 */
function modChrome_paginaInicial($module, &$params, &$attribs)
{
	// Initialiase variables.
	$moduleTag      = $params->get('module_tag');
	$headerTag      = htmlspecialchars($params->get('header_tag'));
	$headerClass    = htmlspecialchars($params->get('header_class', 'title'));
	$bootstrapSize  = htmlspecialchars($params->get('bootstrap_size'));
	$moduleClass    = !empty($bootstrapSize) ? " class=\"{$bootstrapSize}\"" : '';

	if ($module->showtitle)
	{
		// Set up the variables we will need during processing.
		$icons = array();
		$icon  = '';

		preg_match('(icon([\-a-zA-Z0-9]){1,})', $module->title, $icons);

		// Icon text (if exists).
		if (count($icons) > 0)
		{
			$icon = '<i class="' . $icons[0] . '"></i>';
		}

		$title = preg_replace('@(\[icon([\-a-zA-Z0-9]){1,}\])@', '', $module->title);
	}

	if (!empty ($module->content))
	{
		$html  = "<!-- {$headerClass}  --><section id=\"{$headerClass}\"><div class='container'>";

		if ((bool) $module->showtitle)
		{
			//$html .= "<div class=\"section-title mb-100\">";
			$html .= "<{$headerTag} class=\"text-center\">{$icon}{$title}</{$headerTag}>";
			//$html .= "<hr class=\"linha-titulos\"/>"; linha fina
			//$html .= "</div>";
		}

		$html .= $module->content;
		$html .= "</div></section><!-- fim {$headerClass}  -->";

		echo $html;
	}
}

function modChrome_paginaCapa($module, &$params, &$attribs)
{
	// Initialiase variables.
	$moduleTag      = $params->get('module_tag');
	$headerTag      = htmlspecialchars($params->get('header_tag'));
	$headerClass    = htmlspecialchars($params->get('header_class', 'title'));
	$bootstrapSize  = htmlspecialchars($params->get('bootstrap_size'));
	$moduleClass    = !empty($bootstrapSize) ? " class=\"{$bootstrapSize}\"" : '';

	if ($module->showtitle)
	{
		// Set up the variables we will need during processing.
		$icons = array();
		$icon  = '';

		preg_match('(icon([\-a-zA-Z0-9]){1,})', $module->title, $icons);

		// Icon text (if exists).
		if (count($icons) > 0)
		{
			$icon = '<i class="' . $icons[0] . '"></i>';
		}

		$title = preg_replace('@(\[icon([\-a-zA-Z0-9]){1,}\])@', '', $module->title);
	}

	if (!empty ($module->content))
	{
		$html  = "<!-- {$headerClass}  --><div id=\"{$headerClass}\">";

		if ((bool) $module->showtitle)
		{
			$html .= "<{$headerTag} class=\"text-center\">{$icon}{$title}</{$headerTag}>";
		}

		$html .= $module->content;
		$html .= "</div><!-- fim {$headerClass}  -->";

		echo $html;
	}
}

function modChrome_container($module, &$params, &$attribs)
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 2;

	// echo "<pre>";
	// echo("<script>alert(1);</script>");
	// echo "</pre>";

	if(! empty($module->content) ):
		if($module->module == 'mod_container') // || ($module->module == 'mod_chamadas' && $params->get('layout')=='padraogoverno01:listagem-box01'
		{
			echo $module->content;
		}
		else
		{
		$class = $params->get('moduleclass_sfx');

		$container_class = '';
		$container_class_pos = strpos($class, 'container-class-');
		if($container_class_pos !== false)
		{
			$container_class = substr($class, $container_class_pos);
			$container_class = str_replace(array('container-class-','--'), array('', ' '), $container_class);
			$class = str_replace( 'container-class-', '', $class);
		}

		$variacao = $params->get('variacao', 0);
		if( $variacao > 0 ){
			if ( $variacao < 10 ) {
				$variacao = '0'.$variacao;
			}
			$class = trim($class.' variacao-module-'.$variacao);
		}

		$title = ( $params->get('titulo_alternativo', '') != '' )? $params->get('titulo_alternativo') : $module->title;
		$layout = explode(':', $params->get('layout'));
		$module->showtitle = (@$layout[1]!='manchete-principal')? $module->showtitle : '';
		?>
		<div class="row-fluid module <?php echo $class; ?>">
			<?php if ($module->showtitle): ?>
				<?php if(strpos($params->get('moduleclass_sfx'), 'no-outstanding-title')===false): ?><div class="outstanding-header"><?php endif; ?>
			 	<h<?php echo $headerLevel; ?> <?php if(strpos($params->get('moduleclass_sfx'), 'no-outstanding-title')===false): ?>class="outstanding-title"<?php endif; ?>><span><?php echo $title; ?></span></h<?php echo $headerLevel; ?>>
			 	<?php if(strpos($params->get('moduleclass_sfx'), 'no-outstanding-title')===false): ?></div><?php endif; ?>
			<?php endif; ?>
			<?php if($container_class != ''): ?><div class="<?php echo $container_class; ?>"><?php endif; ?>
			<?php echo $module->content; ?>
			<?php if($container_class != ''): ?></div><?php endif; ?>
		</div>
		<?php
		}
	endif;
}
