<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.terracap2026
 *
 * Página de erro (404, 500 etc.) no estilo "Eixos e Curvas".
 *
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$this->language  = $doc->language;
$this->direction = $doc->direction;

$sitename  = $app->get('sitename', '');
$tpl_url   = $this->baseurl . '/templates/' . $this->template;
$errorCode = (int) $this->error->getCode();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $errorCode; ?> — <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $tpl_url; ?>/favicon.ico" />
	<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Public+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $tpl_url; ?>/css/terracap.css">
	<style>
		.error-wrap{
			min-height:100vh;display:flex;flex-direction:column;
			align-items:center;justify-content:center;text-align:center;
			padding:40px 24px;
		}
		.error-code{
			font-family:var(--mono);font-size:.8125rem;letter-spacing:.08em;
			text-transform:uppercase;color:var(--azul);margin-bottom:14px;
		}
		.error-title{
			font-family:var(--display);font-weight:600;letter-spacing:-.02em;
			font-size:clamp(2rem,5vw,3.25rem);line-height:1.1;color:var(--ink);
			margin-bottom:16px;
		}
		.error-msg{max-width:520px;color:var(--ink-60);line-height:1.65;margin-bottom:32px;}
		.error-mark{width:26px;height:26px;background-image:var(--mark);background-size:cover;border-radius:3px;margin-bottom:24px;}
	</style>
</head>
<body>
	<div class="error-wrap">
		<span class="error-mark" aria-hidden="true"></span>
		<span class="error-code">Erro <?php echo $errorCode; ?> · <?php echo $sitename; ?></span>
		<h1 class="error-title"><?php echo $errorCode == 404 ? 'Página não encontrada.' : 'Algo saiu do eixo.'; ?></h1>
		<p class="error-msg">
			<?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?><br>
			Volte para a página inicial e continue a navegação de lá.
		</p>
		<a class="btn btn-primary" href="<?php echo $this->baseurl; ?>/">Ir para a página inicial</a>
	</div>
</body>
</html>
