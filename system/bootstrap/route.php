<?php

import('system.bootstrap.readconfig');

/**
 * pembaca route website
 **/
class Route extends Readconfig
{

  var $route;
  
  function __construct()
  {
    $this->setFile("route");
    $this->setResult();
    $landing = $this->getResult();
    $this->setRoute($landing['landing']);
    import('application.welcome.controller.' . $this->route);
    $className = $this->route;
    new $className();


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
}
