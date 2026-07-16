<?php
/**
 * @package		
 * @subpackage	
 * @copyright	
 * @license		
 */

// no direct access
defined('_JEXEC') or die;

class TemplateFaqQuestionHelper {

	static function displayMetakeyLinks( $metakey, $link = '' )
	{
		if(empty($link))
			//$link = 'index.php?ordering=newest&searchphrase=all&limit=20&areas[0]=tags&Itemid=112&option=com_search&searchword=';
			$link = 'index.php?ordering=newest&searchphrase=all&limit=20&Itemid=112&option=com_search&searchword=';

		if(empty($metakey))
		{
			$db = JFactory::getDBO();
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id', 0);
			if($id > 0)
			{
				$query = 'SELECT title FROM'
							.' `#__contentitem_tag_map` tm'
							.' INNER JOIN `#__tags` tg ON tm.tag_id = tg.id'
							.' WHERE content_item_id = %d';
				$query = sprintf($query, $id);
				$db->setQuery($query);
				$metakey = $db->loadObjectList();
				$arr = array();
				for ($i=0,$limit=count($metakey); $i < $limit; $i++) { 
					$arr[] = $metakey[$i]->title;
				}
				$metakey = implode(',', $arr);
			}
		}

		$keys = explode(',', $metakey);
		$count_keys = count($keys);
		$lang = JFactory::getLanguage();

		if(count($keys)==1)
		{				
			$keys =  explode(';', $metakey);
			$count_keys = count($keys);
		}
		for ($i=1; $i <= $count_keys; $i++) { 
			if($i!=$count_keys)
				$separator = '';
			else
				$separator = '';

			if(trim($keys[$i-1]) != ''):
				$search_formated = urlencode(substr(trim($keys[$i-1]),0, $lang->getUpperLimitSearchWord()));
			?>
			<span>
				<a href="<?php echo JRoute::_($link . $search_formated); ?>" class="link-categoria"><?php echo trim($keys[$i-1]); ?></a>
				<?php echo $separator; ?>
			</span>
			<?php
			endif;
		}
	}

	static function showBelowContent($categories, $item)
	{
		$show = array();

		if(count($categories) > 0 )
			$show[] = 'categories';
		elseif($item->catid > 2)
			$show[] = 'categories';
		
		if(trim($item->metakey) != '')
			$show[] = 'metakeys';		

		if (! in_array('metakeys', $show) )
		{
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id', 0);
			$db = JFactory::getDBO();
			$query = 'SELECT count(title) FROM'
						.' `#__contentitem_tag_map` tm'
						.' INNER JOIN `#__tags` tg ON tm.tag_id = tg.id'
						.' WHERE content_item_id = %d';
			$query = sprintf($query, $id);
			$db->setQuery($query);
			if( $db->loadResult() > 0 )
				$show[] = 'metakeys';
		}			

		return $show;		
	}
}

