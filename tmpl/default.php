<?php
/**
 * @package    setproject
 *
 * @author     Admin <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
// Access to module parameters
$domain = $params->get('domain', 'https://www.joomla.org');
?>
<?php echo JText::sprintf('MOD_SETPROJECT_ACTIVE_PROJECT_IS'); ?>
&nbsp;
<form action="" method="post" name="adminForm" id="adminForm">
    <?php echo selectProject(); ?>
</form>