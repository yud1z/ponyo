<?php

import('system.bootstrap.readconfig');

/**
 * pembaca route website
 **/
class Route extends Readconfig
{

  var $route;
  var $clean_url;
  
  function __construct()
  {
    $uri = new Uri();
    $uri->setUri($_SERVER['REQUEST_URI']);
    $uri->FilterUri();
    $uri->FetchUri();
    $this->setFile("route");
    $this->setResult();

    $landing = $this->getResult();
    $this->setRoute($landing['landing']);
    $this->setClean_url($landing['clean_url']);
    $this->modifyClean_url();

    define("BASE", $this->getClean_url());

    if ($uri->getUri()) {
      return true;
    }
    else {

      try{
        import('application.'. $this->route .'.controller.' . $this->route);
        $className = ''. $this->route .'\\'. $this->route;
        error_reporting(0);
        new $className;
      }
      catch(Exception $e)
      {
        header('Location: /index.php/error/404');
      }
    }




  }
  
  /**
   * Get route.
   *
   * @return route.
   */
  function getRoute()
  {
      return $this->route;
  }
  
  /**
   * Set route.
   *
   * @param route the value to set.
   */
  function setRoute($route)
  {
      $this->route = $route;
  }

  /**
   * Set Modifyclean_url.
   *
   * @param clean_url the value to set.
   */
  function modifyClean_url()
  {
      if ($this->clean_url == "no") {
        $this->clean_url = "/index.php/";
      }
      else if ($this->clean_url == "yes") {
        $this->clean_url = "/";
      }
      else {
        $this->clean_url = "/index.php/";
      }
  }
  
  /**
   * Get clean_url.
   *
   * @return clean_url.
   */
  function getClean_url()
  {
      return $this->clean_url;
  }
  
  /**
   * Set clean_url.
   *
   * @param clean_url the value to set.
   */
  function setClean_url($clean_url)
  {
      $this->clean_url = $clean_url;
  }
}
