<?php

/**
 * Url Handler
 * Sengaja diberi nama uri supaya gampang klo ngapalin
 **/


class Uri
{
  var $uri;
  var $file = array();
  
  function __construct()
  {
    $this->setUri($_SERVER['REQUEST_URI']);
    $this->FilterUri();
    $this->FetchUri();
    if ($this->getUri()) {
      $uri = $this->getUri();
      try{
        import('application.'. $uri[1] .'.controller.' . $uri[1]);
        $classname = ''. $uri[1] .'\\'. $uri[1];
        $parent_url = $uri[1];
        error_reporting(0);
        call_constructor_array_eval($classname, $this->getUri());
        $uri = new ReflectionClass($classname);
        (int) $jumlah_argument = $uri->getMethod('__construct')->getNumberOfParameters();
        $remove_1arg = $this->getUri();
        unset($remove_1arg[1]);


        //lakukan cek jika argumen terlalu banyak
        if (count($remove_1arg) > $jumlah_argument) {

          //lakukan ceking lagi melalui class pembantu
          $this->setFile(scandir('application/'. $parent_url . '/controller'));
          $this->FilterFile();

          //bongkar($this->getFile());
        }
        else {

          //jika sudah benar
          echo "benar";
        }
      }
      catch(Exception $e)
      {
        header('Location: /index.php/error/404');
      }
    }
    else {
      return true;
    }
  }


  /**
   * Remove index.php uri.
   *
   * @param uri the value to set.
   */
  function FilterUri()
  {
      $this->uri = str_replace('/index.php', '', $this->uri);
  }

  /**
   * Remove index.php uri.
   *
   * @param uri the value to set.
   */
  function FetchUri()
  {
      $this->uri = array_filter(explode('/', $this->uri));
  }

  
  /**
   * Get uri.
   *
   * @return uri.
   */
  function getUri()
  {
      return $this->uri;
  }
  
  /**
   * Set uri.
   *
   * @param uri the value to set.
   */
  function setUri($uri)
  {
      $this->uri = $uri;
  }

  /**
   * Filter file.
   *
   * @param file the value to set.
   */
  function FilterFile()
  {
    foreach ($this->file as $kunci_file) {
      if (preg_match('/[a-z].php/i', $kunci_file)) {
        $key[] = $kunci_file;
      }
      else {
        $key = "";
      }
    }
    bongkar($key);
    $a = preg_match('/[a-z].php/i', 'file.php');
    //bongkar($a);
      $this->file;
  }

  
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
      $this->file = $file;
  }
}
