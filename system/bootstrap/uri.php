<?php

/**
 * Url Handler
 * Sengaja diberi nama uri supaya gampang klo ngapalin
 **/


class Uri
{
  var $uri;
  
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
        new $classname;
        $uri = new ReflectionClass($classname);
        //bongkar($uri->getMethod('__construct')->getNumberOfParameters());
      }
      catch(Exception $e)
      {
        //echo BASE;
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
}
