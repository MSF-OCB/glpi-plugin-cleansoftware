<?php
/**
 * Public IP
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
 * FusionInventory is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with FusionInventory. If not, see <http://www.gnu.org/licenses/>.
 *
 * ------------------------------------------------------------------------
 *
 * This file is used to manage the setup / initialize plugin
 * FusionInventory.
 *
 * ------------------------------------------------------------------------
 *
 * @package   Public IP
 * @copyright Copyright (c) 2020-2020 MSF OCB
 * @license   AGPL License 3.0 or (at your option) any later version
 *            http://www.gnu.org/licenses/agpl-3.0-standalone.html
 * @link      https://www.msf-azg.be
 * @link      https://github.com/msf/glpi-plugin-msf
 *
 */

define ("PLUGIN_CLEANSOFTWARE_VERSION", "1.0.0");
// Minimal GLPI version, inclusive
define('PLUGIN_CLEANSOFTWARE_GLPI_MIN_VERSION', '9.5');
// Maximum GLPI version, exclusive
define('PLUGIN_CLEANSOFTWARE_GLPI_MAX_VERSION', '9.6');

define ("PLUGIN_CLEANSOFTWARE_OFFICIAL_RELEASE", "1");
define ("PLUGIN_CLEANSOFTWARE_REALVERSION", PLUGIN_CLEANSOFTWARE_VERSION . "");
define ("PLUGIN_CLEANSOFTWARE_PROCEDURE_SOFTWARE", "glpi_plugin_cleansoftware");
define ("PLUGIN_CLEANSOFTWARE_PROCEDURE_MANUFACTURER", "glpi_plugin_cleanmanufacturer");



/**
 * Init the hooks of MSF
 *
 * @global array $PLUGIN_HOOKS
 * @global array $CFG_GLPI
 */
function plugin_init_cleansoftware() {
    global $PLUGIN_HOOKS, $CFG_GLPI;

    $PLUGIN_HOOKS['csrf_compliant']['cleansoftware'] = true;

    $Plugin = new Plugin();
    $moduleId = 0;

    $debug_mode = true;
    if (isset($_SESSION['glpi_use_mode'])) {
      $debug_mode = ($_SESSION['glpi_use_mode'] == Session::DEBUG_MODE);
    }
    if ($Plugin->isInstalled('cleansoftware')
       && $Plugin->isActivated('cleansoftware')) { // check if plugin is active

    }
}


/**
 * Manage the version information of the plugin
 *
 * @return array
 */
function plugin_version_cleansoftware() {
   return ['name'           => 'Clean Software',
           'shortname'      => 'cleansoftware',
           'version'        => PLUGIN_CLEANSOFTWARE_VERSION,
           'license'        => 'AGPLv3+',
           'author'         => '<a href="mailto:sebastien.batteur@brussels.msf.org">SEBASTIEN BATTEUR</a>',
           'homepage'       => 'https://github.com/msf-ocb/glpi-plugin-cleansoftware',
           'requirements'   => [
              'glpi' => [
                  'min' => PLUGIN_CLEANSOFTWARE_GLPI_MIN_VERSION,
                  'max' => PLUGIN_CLEANSOFTWARE_GLPI_MAX_VERSION,
                  'dev' => PLUGIN_CLEANSOFTWARE_OFFICIAL_RELEASE == 0
               ]
            ]
         ];
}


/**
 * Manage / check the prerequisites of the plugin
 *
 * @return boolean
 */
function plugin_cleansoftware_check_prerequisites(){

   return true;
}


/**
 * Check if the config is ok
 *
 * @return boolean
 */
function plugin_cleansoftware_check_config() {
   return true;
}


/**
 * Check the rights
 *
 * @param string $type
 * @param string $right
 * @return boolean
 */
function plugin_cleansoftware_haveTypeRight($type, $right) {
   return true;
}
