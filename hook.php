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

/**
* Manage the installation process
*
* @return boolean
*/
function plugin_cleansoftware_install() {
//    $rule = new PluginMsfRule();
//    $rule->init();

    global $DB;


    if (basename(filter_input(INPUT_SERVER, "SCRIPT_NAME")) != "cli_install.php") {
        Html::header(__('Setup'), filter_input(INPUT_SERVER, "PHP_SELF"), "config", "plugins");
        $migrationname = 'Migration';
    } else {
        $migrationname = 'CliMigration';
    }

    $migration = new $migrationname(PLUGIN_MSF_VERSION);
    $migration->displayMessage("creation PROCEDURE in db ");

/*    $query = "
CREATE PROCEDURE `" . PLUGIN_CLEANSOFTWARE_PROCEDURE_SOFTWARE . "` ()
BEGIN
	DELETE
		`glpi_softwareversions`
	FROM
		`glpi_softwareversions`
			LEFT JOIN
		`glpi_items_softwareversions` ON `glpi_items_softwareversions`.`softwareversions_id` = `glpi_softwareversions`.`id`
			LEFT JOIN
		`glpi_softwarelicenses` slb ON slb.`softwareversions_id_buy` = `glpi_softwareversions`.`id`
			LEFT JOIN
		`glpi_softwarelicenses` slu ON slu.`softwareversions_id_use` = `glpi_softwareversions`.`id`
        
	WHERE
		`glpi_items_softwareversions`.`softwareversions_id` IS NULL
			AND slb.`softwareversions_id_buy` IS NULL
			AND slu.`softwareversions_id_use` IS NULL;
            
	DELETE 
		`glpi_softwares`
	FROM
		`glpi_softwares`
			LEFT JOIN
		`glpi_softwareversions` ON `glpi_softwareversions`.`softwares_id` = `glpi_softwares`.`id`
			LEFT JOIN
		`glpi_softwarelicenses` ON `glpi_softwarelicenses`.`softwares_id` = `glpi_softwares`.`id`
	WHERE
		`glpi_softwareversions`.`softwares_id` IS NULL
			AND `glpi_softwarelicenses`.`softwares_id` IS NULL;
        
END;";
    $DB->queryOrDie($query, $DB->error());*/

/*    $query = "
CREATE PROCEDURE `" . PLUGIN_CLEANSOFTWARE_PROCEDURE_MANUFACTURER . "` ()
BEGIN
	DELETE
		`glpi_manufacturers`
    FROM
        `glpi_manufacturers`
            LEFT JOIN
        `glpi_appliances` ON `glpi_appliances`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_cartridgeitems` ON `glpi_cartridgeitems`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_certificates` ON `glpi_certificates`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_computerantiviruses` ON `glpi_computerantiviruses`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_computers` ON `glpi_computers`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_consumableitems` ON `glpi_consumableitems`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicebatteries` ON `glpi_devicebatteries`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicecases` ON `glpi_devicebatteries`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicecontrols` ON `glpi_devicecontrols`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicedrives` ON `glpi_devicedrives`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicefirmwares` ON `glpi_devicefirmwares`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicegenerics` ON `glpi_devicegenerics`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicegraphiccards` ON `glpi_devicegraphiccards`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_deviceharddrives` ON `glpi_deviceharddrives`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicememories` ON `glpi_devicememories`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicemotherboards` ON `glpi_devicemotherboards`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicenetworkcards` ON `glpi_devicenetworkcards`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicepcis` ON `glpi_devicepcis`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicepowersupplies` ON `glpi_devicepowersupplies`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_deviceprocessors` ON `glpi_deviceprocessors`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicesensors` ON `glpi_devicesensors`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicesimcards` ON `glpi_devicesimcards`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_devicesoundcards` ON `glpi_devicesoundcards`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_enclosures` ON `glpi_enclosures`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_monitors` ON `glpi_monitors`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_networkequipments` ON `glpi_networkequipments`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_passivedcequipments` ON `glpi_passivedcequipments`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_pdus` ON `glpi_pdus`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_peripherals` ON `glpi_peripherals`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_phones` ON `glpi_phones`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_printers` ON `glpi_printers`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_racks` ON `glpi_racks`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_softwarelicenses` ON `glpi_softwarelicenses`.`manufacturers_id` = `glpi_manufacturers`.`id`
            LEFT JOIN
        `glpi_softwares` ON `glpi_softwares`.`manufacturers_id` = `glpi_manufacturers`.`id`
    WHERE
        `glpi_appliances`.`manufacturers_id` IS NULL
            AND `glpi_cartridgeitems`.`manufacturers_id` IS NULL
            AND `glpi_certificates`.`manufacturers_id` IS NULL
            AND `glpi_computerantiviruses`.`manufacturers_id` IS NULL
            AND `glpi_computers`.`manufacturers_id` IS NULL
            AND `glpi_consumableitems`.`manufacturers_id` IS NULL
            AND `glpi_devicecases`.`manufacturers_id` IS NULL
            AND `glpi_devicecontrols`.`manufacturers_id` IS NULL
            AND `glpi_devicedrives`.`manufacturers_id` IS NULL
            AND `glpi_devicefirmwares`.`manufacturers_id` IS NULL
            AND `glpi_devicegenerics`.`manufacturers_id` IS NULL
            AND `glpi_devicegraphiccards`.`manufacturers_id` IS NULL
            AND `glpi_deviceharddrives`.`manufacturers_id` IS NULL
            AND `glpi_devicememories`.`manufacturers_id` IS NULL
            AND `glpi_devicemotherboards`.`manufacturers_id` IS NULL
            AND `glpi_devicenetworkcards`.`manufacturers_id` IS NULL
            AND `glpi_devicepcis`.`manufacturers_id` IS NULL
            AND `glpi_devicepowersupplies`.`manufacturers_id` IS NULL
            AND `glpi_deviceprocessors`.`manufacturers_id` IS NULL
            AND `glpi_devicesensors`.`manufacturers_id` IS NULL
            AND `glpi_devicesimcards`.`manufacturers_id` IS NULL
            AND `glpi_devicesoundcards`.`manufacturers_id` IS NULL
            AND `glpi_enclosures`.`manufacturers_id` IS NULL
            AND `glpi_monitors`.`manufacturers_id` IS NULL
            AND `glpi_networkequipments`.`manufacturers_id` IS NULL
            AND `glpi_passivedcequipments`.`manufacturers_id` IS NULL
            AND `glpi_pdus`.`manufacturers_id` IS NULL
            AND `glpi_peripherals`.`manufacturers_id` IS NULL
            AND `glpi_phones`.`manufacturers_id` IS NULL
            AND `glpi_printers`.`manufacturers_id` IS NULL
            AND `glpi_racks`.`manufacturers_id` IS NULL
            AND `glpi_softwarelicenses`.`manufacturers_id` IS NULL
            AND `glpi_softwares`.`manufacturers_id` IS NULL;
        
END;";
    $DB->queryOrDie($query, $DB->error());*/


    /*
    * Add cron task
    */
    $migration->displayMessage("Initialize cron task");
    $crontask = new CronTask();
    if (!$crontask->getFromDBbyName('PluginCleansoftwareCleanning', 'Clean software')) {
        CronTask::Register('PluginCleansoftwareCleanning', 'cleansoftware', (3600 * 24),
            array('mode' => 2, 'allowmode' => 3, 'logs_lifetime' => 30,
                'comment'=> Toolbox::addslashes_deep(__('Automatically deletes softwares that no longer have computers or items associated via an automatic actions.', 'cleansoftware'))));
    }
    if (!$crontask->getFromDBbyName('PluginCleansoftwareCleanning', 'Clean manufacturer')) {
        CronTask::Register('PluginCleansoftwareCleanning', 'cleanmanufacturer', (3600 * 24),
            array('mode' => 2, 'allowmode' => 3, 'logs_lifetime' => 30,
                'comment'=> Toolbox::addslashes_deep(__('Automatically deletes Manufacturers that no longer have items associated via an automatic actions.', 'cleansoftware'))));
    }

    //execute the whole migration
    //$migration->executeMigration();

    return true;
}


/**
* Manage the uninstallation of the plugin
*
* @return boolean
*/
function plugin_cleansoftware_uninstall() {
    global $DB;
    $DB->queryOrDie(
        "DROP procedure IF EXISTS `" . PLUGIN_CLEANSOFTWARE_PROCEDURE_SOFTWARE . "`;",
        $DB->error()
    );
    $DB->queryOrDie(
        "DROP procedure IF EXISTS `" . PLUGIN_CLEANSOFTWARE_PROCEDURE_MANUFACTURER . "`;",
        $DB->error()
    );

    return true;
}


