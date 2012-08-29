<?php

import("system.bootstrap.readconfig");

/**
 * pembaca route website
 **/
class Route extends Readconfig
{
  
  function __construct()
  {
    $this->setFile("route");
    $this->setResult();
    print_r($this->getResult());

  }
}
