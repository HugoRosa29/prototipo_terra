<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.terracap2026
 *
 * Layout para exibição de componentes em janela modal / impressão (tmpl=component).
 *
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$this->language  = $doc->language;
$this->direction = $doc->direction;

$doc->setHtml5(true);
$tpl_url = $this->baseurl . '/templates/' . $this->template;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Public+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/terracap.css">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/interno.css">
</head>
<body class="pagina-interna contentpane modal">
	<div class="container pagina-interna-conteudo">
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	</div>
</body>
</html>
