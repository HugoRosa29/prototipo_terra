<?php
/**
 * @package     Directsales
 * @subpackage  mod_directsales
 *
 * Capa "Regularize" — redesign "Eixos e Curvas".
 * Duas seções (Editais de Convocação e Cadastramento) em grades de cards
 * card-lote/plot-frame, botões da posição "contexto-regularize-botoes" e
 * coluna lateral "contexto-regulariza-imovel". Substitui o carrossel
 * Bootstrap e o grid col-md do layout anterior.
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

<div class="aba-grid capa-regularize">
	<div>
		<!-- ================= EDITAIS DE CONVOCAÇÃO (propostas) ================= -->
		<h3 class="table-heading">Editais de Convocação</h3>

		<?php if ($listProp): ?>
		<div class="lotes-grid lotes-grid-2">
			<?php foreach ($listProp as $key => $item): ?>
				<?php
				$imagem = $item->image ? JUri::root() . 'images/directsales/' . $item->image : 'com_directsales/no-image.png';
				list($stampClass, $stampLabel) = stampStatus($item->statusprop);
				?>
				<a class="card-lote plot-frame" href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>">
					<div class="thumb">
						<?php echo JHtml::_('image', $imagem, $item->title, null, true); ?>
						<?php if ($stampLabel): ?>
							<span class="stamp <?php echo $stampClass; ?>"><?php echo $stampLabel; ?></span>
						<?php endif; ?>
					</div>
					<div class="body">
						<span class="code">PROPOSTA · DE <?php echo date('d/m', strtotime($item->date_start_prop)); ?> A <?php echo date('d/m', strtotime($item->date_end_prop)); ?></span>
						<div class="title"><?php echo htmlspecialchars($item->location); ?></div>
						<p class="card-lote-desc"><?php echo $item->title; ?></p>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php if ($params->get('show_button') == 1): ?>
			<div class="section-footer-actions">
				<a href="<?php echo $params->get('link_button'); ?>" class="btn btn-line">
					<?php echo $params->get('button'); ?>
				</a>
			</div>
		<?php endif; ?>

		<!-- ================= CADASTRAMENTO ================= -->
		<div class="capa-regularize-cadastro">
			<h3 class="table-heading">Cadastramento</h3>

			<?php if ($listCad): ?>
			<div class="lotes-grid lotes-grid-2">
				<?php foreach ($listCad as $key => $item): ?>
					<?php
					$imagem = $item->image ? JUri::root() . 'images/directsales/' . $item->image : 'com_directsales/no-image.png';
					list($stampClass, $stampLabel) = stampStatus($item->statuscad);
					$aberto = (strtolower($item->statuscad) != 'encerrado');
					?>
					<a class="card-lote plot-frame" href="http://servicosonline2.terracap.df.gov.br/" target="_blank" rel="noopener" title="Faça seu cadastro">
						<div class="thumb">
							<?php echo JHtml::_('image', $imagem, $item->title, null, true); ?>
							<?php if ($stampLabel): ?>
								<span class="stamp <?php echo $stampClass; ?>"><?php echo $stampLabel; ?></span>
							<?php endif; ?>
						</div>
						<div class="body">
							<?php if ($aberto): ?>
								<span class="code">CADASTRAMENTO · <?php echo date('d/m', strtotime($item->date_start)); ?> A <?php echo date('d/m', strtotime($item->date_end)); ?></span>
							<?php else: ?>
								<span class="code">CADASTRAMENTO</span>
							<?php endif; ?>
							<div class="title"><?php echo htmlspecialchars($item->location); ?></div>
							<p class="card-lote-desc"><?php echo $item->title; ?></p>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<!-- Botões de acesso ao cadastro (posição "contexto-regularize-botoes") -->
			<div class="botoes-area-cadastro">
				<?php echo $renderer->render('contexto-regularize-botoes', array('style' => 'none'), null); ?>
			</div>
		</div>
	</div>

	<aside>
		<div class="interna-direita">
			<?php echo $renderer->render('contexto-regulariza-imovel', array('style' => 'container'), null); ?>
		</div>
	</aside>
</div>
