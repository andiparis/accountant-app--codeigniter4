For authentication process, add codes below 
  protected $helpers = ['auth'];
in
  vendor/codeigniter4/framework/system/RESTful/BaseResource.php

In this file
  vendor/myth/auth/src/Config/Auth.php
change this code below
  public $requireActivation = 'Myth\Auth\Authentication\Activators\EmailActivator';
to
  public $requireActivation;

also in this code too
  public $activeResetter = 'Myth\Auth\Authentication\Resetters\EmailResetter';
change to
  public $activeResetter = false;

also comment this code below
  // 'Myth\Auth\Authentication\Passwords\PwnedValidator',

also fill this code below
  public $defaultUserGroup;  
to something like this
  public $defaultUserGroup = 'user';