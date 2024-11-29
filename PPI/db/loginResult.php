<?php

class LoginResult
{
  public $success;
  public $newLocation;

  function __construct($success, $newLocation)
  {
    $this->success = $success;
    $this->newLocation = $newLocation;
  }
}