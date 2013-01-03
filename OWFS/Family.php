<?php
/**
 *
 */
namespace OWFS;

/**
 *
 * @author     Knut Kohl <github@knutkohl.de>
 * @copyright  2013 Knut Kohl
 * @licence    GNU General Public License - http://www.gnu.org/licenses/gpl.txt
 * @version    $Id$
 */
abstract class Family {

  /**
   *
   */
  public static function Description( $family ) {
    return isset(self::$description[$family])
         ? self::$description[$family]
         : 'unknown (' . $family . ')';
  }

  // -------------------------------------------------------------------------
  // PRIVATE
  // -------------------------------------------------------------------------

  /**
   * Family descriptors
   *
   * @var $sensors array
   */
  private static $description = array(
    '00' => 'Provide location information',
    '01' => 'ID-only',
    '02' => 'Multikey',
    '04' => 'EconoRam Time chi',
    '05' => 'Switch',
    '06' => 'Memory',
    '08' => 'Memory',
    '09' => 'Memory',
    '0B' => 'Memory',
    '0F' => 'Memory',
    '10' => 'Temperature',
    '12' => 'Switch',
    '14' => 'Memory',
    '16' => 'crypto-ibutton',
    '18' => 'SHA iButton',
    '1A' => 'Monetary iButton',
    '1B' => 'Battery monitor',
    '1C' => 'Switch',
    '1D' => 'Counter',
    '1E' => 'Battery monitor',
    '1F' => 'Microhub',
    '20' => 'Voltage',
    '21' => 'Thermocron',
    '22' => 'Temperature',
    '23' => 'Memory',
    '24' => 'Clock',
    '26' => 'Battery monitor',
    '27' => 'Clock + interrupt',
    '28' => 'Temperature',
    '29' => 'Switch',
    '2C' => 'Varible Resitor',
    '2D' => 'Memory',
    '2E' => 'Battery',
    '30' => 'Battery',
    '31' => 'Battery ID',
    '32' => 'Battery',
    '33' => 'SHA-1 ibutton',
    '34' => 'SHA-1 Battery',
    '35' => 'Battery',
    '36' => 'Coulomb counter',
    '37' => 'password EEPROM',
    '3A' => 'Switch',
    '3B' => 'Temperature/memory',
    '3D' => 'Battery',
    '41' => 'Hygrocron',
    '42' => 'Temperature/IO',
    '43' => 'Memory',
    '44' => 'SHA-1 Authenticator',
    '51' => 'Battery monitor',
    '7E' => 'Envoronmental Monitors',
    '81' => 'DS2490R / DS2490B USB adapter',
    '82' => 'Authorization',
    '89' => 'Uniqueware',
    '8B' => 'Uniqueware',
    '8F' => 'Uniqueware',
    'A0' => 'Rotation Sensor',
    'A1' => 'Vibratio',
    'A2' => 'AC Voltage',
    'A6' => 'IR Temperature',
    'B1' => 'Thermocouple Converter',
    'B2' => 'DC Current or Voltage',
    'B3' => 'Thermocouple Converter',
    'EE' => 'Ultra Violet Index',
    'EF' => 'Moisture meter., 4 Channel Hub',
    'FC' => 'Programmable Miroprocessor',
    'FF' => 'Swart LCD'
  );

}