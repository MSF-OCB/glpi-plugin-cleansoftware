<?php
/**
 * MSF
 *
 * Copyright (C) 2020-2020 by the MSF OCB.
 *
 * https://www.msf-azg.be
 * https://github.com/msf/glpi-pliguin-msf
 *
 * ------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of MSF project.
 *
 * MSF is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with MSF. If not, see <http://www.gnu.org/licenses/>.
 *
 * ------------------------------------------------------------------------
 *
 * This file is used to manage the setup / initialize plugin
 * MSF.
 *
 * ------------------------------------------------------------------------
 *
 * @package   MSF
 * @copyright Copyright (c) 2020-2020 MSF OCB
 * @license   AGPL License 3.0 or (at your option) any later version
 *            http://www.gnu.org/licenses/agpl-3.0-standalone.html
 * @link      https://www.msf-azg.be
 * @link      https://github.com/msf/glpi-plugin-msf
 * @version GIT: $
 * @author  Sébastien Batteur <sebastien.batteur@brussels.msf.org>
 *
 */


if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access directly to this file");
}

class PluginCleansoftwareCleanning extends CommonDBTM
{
    /**
     * The right name for this class
     *
     * @var string
     */
    static $rightname                   = 'software';

    /**
     * Get name of this type by language of the user connected
     *
     * @param integer $nb number of elements
     * @return string name of this type
     */
    static function getTypeName($nb=0) {
        return __('Software');
    }


    /**
     * Give cron information
     *
     * @param $name : task's name
     *
     * @return array of information
     **/
    static function cronInfo($name) {

        switch ($name) {
            case 'Clean software' :
                return ['description' => __('Clean softwares task scheduler')];
            case 'Clean manufacturer' :
                return ['description' => __('Clean manufacturers task scheduler')];
            default:
                return [];
        }
    }

    /**
     * Cron task: clean computer (retention time)
     *
     * @global object $DB
     */
    static function cronCleanSoftware()
    {
        global $DB;
        $query = "call " . PLUGIN_CLEANSOFTWARE_PROCEDURE_SOFTWARE . "();";
        $DB->queryOrDie($query, $DB->error());
    }

    /**
     * Cron task: clean manufacturer (retention time)
     *
     * @global object $DB
     */
    static function cronCleanManufacturer()
    {
        global $DB;
        $query = "call " . PLUGIN_CLEANSOFTWARE_PROCEDURE_MANUFACTURER . "();";
        $DB->queryOrDie($query, $DB->error());
    }
}