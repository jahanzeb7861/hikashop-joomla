<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// echo implode($displayData);

array_push($displayData, ['action' => '<button class="btn btn-small button-apply btn-success">Ship</button>']);


	// $displayData['action'] = '<button class="btn btn-small button-apply btn-success">
	// 		Ship</button>';

?>
<div class="btn-wrapper" <?php echo $displayData['id']; ?>>
	<?php echo $displayData['action']; ?>
</div>
