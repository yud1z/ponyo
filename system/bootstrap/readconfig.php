<?php

/**
 * Read web config
 **/
class Readconfig
{
  var $file;
  var $result;

  
  /**
   * Get file.
   *
   * @return file.
   */
  function getFile()
  {
      return $this->file;
  }
  
  /**
   * Set file.
   *
   * @param file the value to set.
   */
  function setFile($file)
  {
      $this->file = "/../config/" . $file . ".ini.php";
  }
  
  /**
   * Get result.
   *
   * @return result.
   */
  function getResult()
  {
      return $this->result;
  }
  
  /**
   * Set result.
   *
   *  result the value to set.
   */
  function setResult()
  {
      $this->result = parse_ini_file($this->file);
  }
}
