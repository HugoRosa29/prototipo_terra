<?php
/**
 * @package     Directsales
 * @subpackage  mod_directsales
 *
 * Listagem de editais de Venda Direta — redesign "Eixos e Curvas".
 * Substitui o carrossel Swiper por um scroller horizontal de cards
 * (mesmo padrão da seção "Regularize Imóveis" da home); cards de
 * cadastro apontam para os serviços online, como no layout anterior.
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Mapeia o status do componente para o carimbo do redesign
if (!function_exists('stampStatus')) {
	function stampStatus($status)
	{
		$st = strtolower(trim((string) $status));
		switch ($st) {
			case 'disponível':
			case 'disponivel':
			case 'aberto':
			case 'iniciado':
				return array('stamp-verde', strtoupper($status));
			case 'encerrado':
				return array('stamp-alerta', 'ENCERRADO');
			case '':
				return array('', '');
			default:
				return array('stamp-dourado', strtoupper($status));
		}
	}
}

$document = JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
?>

<?php if ($params->get('show_description') == 1): ?>
	<p class="section-sub retranca"><?php echo $params->get('name_description'); ?></p>
<?php endif; ?>

<div class="scroller">
	<?php foreach ($list as $key => $item): ?>
		<?php
		$ehCadastro = ($item->show_sketch == 0);
		$link       = $ehCadastro ? 'http://servicosonline2.terracap.df.gov.br/' : $item->link;
		$imagem     = $item->image ? JUri::root() . 'images/directsales/' . $item->image : 'com_directsales/no-image.png';

		if ($ehCadastro) {
			$tipo   = 'CADASTRO';
			$status = $item->statuscad;
			$inicio = $item->date_start;
			$fim    = $item->date_end;
		} else {
			$tipo   = 'PROPOSTA';
			$status = $item->statusprop;
			$inicio = $item->date_start_prop;
			$fim    = $item->date_end_prop;
		}
		list($stampClass, $stampLabel) = stampStatus($status);

		$periodo = '';
		if ($inicio && $inicio != '0000-00-00') {
			$periodo = 'DE ' . date('d/m', strtotime($inicio));
			if ($fim && $fim != '0000-00-00') {
				$periodo .= ' A ' . date('d/m', strtotime($fim));
			}
		}
		?>
		<a class="card-lote plot-frame"
			href="<?php echo $link; ?>"
			<?php echo $ehCadastro ? 'target="_blank" rel="noopener"' : ''; ?>
			title="<?php echo $ehCadastro ? 'Faça seu cadastro' : htmlspecialchars($item->title); ?>">
			<div class="thumb">
				<?php echo JHtml::_('image', $imagem, $item->title, null, true); ?>
				<?php if ($stampLabel): ?>
					<span class="stamp <?php echo $stampClass; ?>"><?php echo $stampLabel; ?></span>
				<?php endif; ?>
			</div>
			<div class="body">
				<span class="code"><?php echo $tipo; ?><?php echo $periodo ? ' · ' . $periodo : ''; ?></span>
				<div class="title"><?php echo htmlspecialchars($item->location); ?></div>
				<p class="card-lote-desc"><?php echo $item->title; ?></p>
			</div>
		</a>
	<?php endforeach; ?>
</div>

<?php if ($params->get('show_button') == 1): ?>
	<div class="section-footer-actions">
		<a href="<?php echo $linkButton; ?>" class="btn btn-line" title="<?php echo $button; ?>"><?php echo $button; ?></a>
	</div>
<?php endif; ?>

<?php
// Chamado 2623/2019 - Inclusão de links e Carrossel
echo $renderer->render('mais-regularize', array('style' => 'container'), null);
?>
