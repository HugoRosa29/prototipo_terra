<?php
/**
 * @package     Directsales
 * @subpackage  com_directsales
 *
 * Listagem de editais de Venda Direta — redesign "Eixos e Curvas".
 * Filtro por ano em pílulas (anos antigos em dropdown nativo <details>)
 * e cards no padrão card-lote/plot-frame da home, com carimbo de status.
 *
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Get the application.
$app = JFactory::getApplication('site');

/**
 * Mapeia o status vindo do componente para o carimbo do redesign.
 * Retorna array(classe do stamp, rótulo).
 */
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
?>

<?php if ($this->params->get('show_page_heading')): ?>
<h2><?php echo $this->escape($this->params->get('page_heading')); ?></h2>
<?php endif; ?>

<div id="listagem-compre-imoveis" class="lista-editais">

	<form action="<?php echo JUri::getInstance()->toString(); ?>" method="get" class="filtro-anos">
		<span class="rotulo">Filtre por ano</span>
		<?php foreach ($this->years as $year): ?>
			<input type="submit"
				class="aba-btn<?php echo $this->state->get('filter.year') == $year ? ' is-active' : ''; ?>"
				name="year" value="<?php echo $this->escape($year); ?>">
		<?php endforeach; ?>

		<?php if (!empty($this->yearsOld)): ?>
		<details class="mais-anos">
			<summary class="aba-btn">Mais</summary>
			<div class="mais-anos-menu">
				<?php foreach ($this->yearsOld as $year): ?>
					<a href="<?php echo JRoute::_($app->getMenu()->getActive()->link) . '?year=' . $year; ?>"
						class="<?php echo $this->state->get('filter.year') == $year ? 'is-active' : ''; ?>"><?php echo $this->escape($year); ?></a>
				<?php endforeach; ?>
			</div>
		</details>
		<?php endif; ?>
	</form>

	<div class="lotes-grid">
		<?php foreach ($this->items as $item): ?>
			<?php if ($item->state <> 0): ?>
				<?php
				$link = JRoute::_(DirectsalesHelperRoute::getPropertyRoute($item->slug));
				if ($item->show_sketch == 0) {
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
				?>
				<a class="card-lote plot-frame" href="<?php echo $link; ?>">
					<div class="thumb">
						<?php if ($item->image): ?>
							<?php echo JHtml::_('image', JUri::root() . '/images/directsales/thumbnails/' . $item->image, $item->title, null, true); ?>
						<?php else: ?>
							<?php echo JHtml::_('image', 'com_directsales/no-image.png', $item->title, null, true); ?>
						<?php endif; ?>
						<?php if ($stampLabel): ?>
							<span class="stamp <?php echo $stampClass; ?>"><?php echo $stampLabel; ?></span>
						<?php endif; ?>
					</div>
					<div class="body">
						<span class="code"><?php echo $tipo; ?> · DE <?php echo date('d/m', strtotime($inicio)); ?> A <?php echo date('d/m', strtotime($fim)); ?></span>
						<?php if ($item->params->get('show_title', 1)): ?>
							<div class="title"><?php echo $item->location; ?></div>
						<?php endif; ?>
						<p class="card-lote-desc"><?php echo $item->title; ?></p>
					</div>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
