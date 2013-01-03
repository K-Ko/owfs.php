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
class Sensor {

  /**
   * Create a sensor object
   *
   * @param $path string OWFS root directory
   * @param $id string Sensor subdir in OWFS root directory
   * @return void
   */
  public function __construct( $path, $id ) {
    $this->path = $path;
    $this->id = $id;
    $this->data = array();
  }

  /**
   * Get a value for a sensor key
   *
   * @param $key string
   * @param $uncached bool Set TRUE to retrieve the uncached value
   * @return string
   */
  public function get( $key, $uncached=FALSE ) {
    $key = strtolower($key);

    if ($key == 'path') {
      return $this->path . DIRECTORY_SEPARATOR . $this->id;
    } elseif ($key == 'description') {
      return Family::Description($this->get('family'));
    }

    if (!$uncached AND isset($this->data[$key])) return $this->data[$key];

    $file = $this->path . DIRECTORY_SEPARATOR;
    if ($uncached) $file .= 'uncached' . DIRECTORY_SEPARATOR;
    $file .= $this->id . DIRECTORY_SEPARATOR . $key;

    $value = file_exists($file) ? trim(file_get_contents($file)) : '';

    if (!$uncached) $this->data[$key] = $value;

    return $value;
  }

  /**
   * Set a value for a sensor key
   *
   * @param $key string
   * @param $value string Set the sensor key to this value
   */
  public function set( $key, $value ) {
    $file = $this->path . DIRECTORY_SEPARATOR
          . $this->id . DIRECTORY_SEPARATOR . strtolower($key);
    if (file_exists($file) AND is_writable($file)) {
      file_put_contents($file, trim($value));
    }
  }

  /**
   * Magic method to read $sensor->key and $sensor->key_uncached
   *
   * @param $key string
   * @return string
   */
  public function __get( $key ) {
    $uncached = FALSE;
    if (preg_match('~^(.+)_uncached$~i', $key, $args)) {
      $key = $args[1];
      $uncached = TRUE;
    }
    return $this->get($key, $uncached);
  }

  /**
   * Magic method to set $sensor->key
   *
   * @param $key string
   * @param $value string Set the sensor key to this value
   */
  public function __set( $key, $value ) {
    $file = $this->path . DIRECTORY_SEPARATOR
          . $this->id . DIRECTORY_SEPARATOR . strtolower($key);
    if (file_exists($file)) file_put_contents($file, trim($value));
  }

  /**
   * Get an array with key => value pairs of all sensor properties
   *
   * @param $uncached bool Set TRUE to retrieve the uncached values
   * @return array
   */
  public function getAll( $uncached=FALSE ) {
    $data = array();
    $dir = new \DirectoryIterator($this->get('path'));
    foreach ($dir as $fileinfo) {
      if (!$fileinfo->isDot() AND $fileinfo->isFile()) {
        $data[$fileinfo->getFilename()] = $this->get($fileinfo->getFilename(), $uncached);
      }
    }
    $data['path'] = $this->get('path');
    $data['description'] = $this->Description;
    return $data;
  }

  // -------------------------------------------------------------------------
  // PROTECTED
  // -------------------------------------------------------------------------

  /**
   *
   */
  protected $path;

  /**
   *
   */
  protected $id;

  /**
   *
   */
  protected $data;

}