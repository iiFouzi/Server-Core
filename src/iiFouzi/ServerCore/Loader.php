<?php

namespace iiFouzi\ServerCore;

use iiFouzi\ServerCore\Events\EventListener;
use iiFouzi\ServerCore\Events\MessagesListener;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase 
{
  
  public function onEnable(){
    
    $this->Commands();
    $this->Listeners();
    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    $this->getServer()->getPluginManager()->registerEvents(new MessagesListener($this),$this);
    $this->getServer()->getLogger()->info("Server-Core has been enabled");
  }
  
  public function Commands()
  {
    $this->getServer()->getCommandMap()->register("", new ($this));
  }
  
  public function Listeners()
  {
    new EventListener($this);
    new MessagesListener($this);
  }
  
  public function onDisable()
  {
    $this->getServer()->getLogger()->info("ServerCore has been disabled");
  }
  
}