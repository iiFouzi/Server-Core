<?php

namespace iifouzi\servercore;

use iifouzi\servercore\listeners\EventListener;
use iifouzi\servercore\listeners\MessagesListener;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase 
{
  
  public function onEnable(){
    
    $this->Commands();
    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new MessagesListener($this),$this);
    $this->getServer()->getLogger()->info("Server-Core has been enabled");
  }
  
  public function Commands()
  {
    $this->getServer()->getCommandMap()->register("", new ($this));
  }
  
  public function onDisable()
  {
    $this->getServer()->getLogger()->info("ServerCore has been disabled");
  }
  
}