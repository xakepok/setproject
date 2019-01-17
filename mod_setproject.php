<?php
/**
 * @package    setproject
 *
 * @author     Admin <your@email.com>
 * @copyright  A copyright
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://your.url.com
 */

use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

function selectProject()
{
    $project = JFactory::getApplication()->input->getString('set_active_project', '');
    $session = JFactory::getSession();
    if (is_numeric($project))
    {
        $session->set("active_project", $project);
        if ($project === 0)
        {
            $session->clear("active_project");
        }
        $return = JFactory::getApplication()->input->getString('return', false);
        if ($return !== false)
        {
            JFactory::getApplication()->redirect(base64_decode($return));
            jexit();
        }
    }
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select("`id`, `title`")->from("`#__prj_projects`")->order("`title`");
    $projects = $db->setQuery($query)->loadObjectList();
    $options = array();
    $options[] = JHtml::_('select.option', '0', 'MOD_SETPROJECT_SELECT_ACTIVE_PROJECT');
    foreach ($projects as $item) {
        $options[] = JHtml::_('select.option', $item->id, $item->title);
    }
    $attribs = 'class="inputbox" style="width: 500px;" onchange="this.form.submit()"';
    return JHtml::_('select.genericlist', $options, 'set_active_project', $attribs, 'value', 'text',  $session->get('active_project', '0'), null, true);
}
function getProject()
{
    $session = JFactory::getSession();
    $project = $session->get('active_project');
    $activeProject = $project ?? JText::sprintf('MOD_SETPROJECT_ACTIVE_PROJECT_NOT_SELECT');
    return JText::sprintf('MOD_SETPROJECT_ACTIVE_PROJECT', $activeProject);
}
require ModuleHelper::getLayoutPath('mod_setproject', $params->get('layout', 'default'));
