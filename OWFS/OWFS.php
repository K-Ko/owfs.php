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
class OWFS {

  /**
   * Create a sensor object
   *
   * @param $path string OWFS root directory
   */
  public function __construct( $path ) {
    $this->path = $path;
    $this->sensors = array();
    $this->load();
  }

  /**
   * Get all found sensors
   *
   * @return array Array of Sensor instances
   */
  public function getAll() {
    return $this->sensors;
  }

  /**
   * Catch getBy<key> function calls
   *
   * @param $method string
   * @param $params array Only idx 0 will be used as key to search for
   * @return OWFS\Sensor|array|FALSE Returns a sensor instance if only one matches
   */
  public function __call( $method, $params ) {
    $lmethod = strtolower($method);
    if (substr($lmethod, 0, 5) != 'getby')
      die('Fatal error: Call to undefined method KKo\OWFS\OWFS::'.$method.'()');

    $key = substr($lmethod, 5);
    $res = array();
    foreach ($this->sensors as $sensor) {
      if ($sensor->$key == $params[0]) $res[] = $sensor;
    }

    switch (count($res)) {
      case 0:   return FALSE;
      case 1:   return $res[0];
      default:  return $res;
    }
  }

  // -------------------------------------------------------------------------
  // PROTECTED
  // -------------------------------------------------------------------------

  /**
   * OWFS root directory
   *
   * @var $path string
   */
  protected $path;

  /**
   * All found sensors
   *
   * @var $sensors array
   */
  protected $sensors;

  /**
   * Load all sensors
   *
   * @return void
   */
  protected function load() {
    $dir = new \DirectoryIterator($this->path);
    foreach ($dir as $fileinfo) {
      if (!$fileinfo->isDot() AND $fileinfo->isDir() AND
          preg_match('~^[0-9A-F]~', $fileinfo->getFilename())) {
        $this->sensors[] = new Sensor($this->path, $fileinfo->getFilename());
      }
    }
  }

}