<?php

namespace iifouzi\servercore\commands;

use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as C;
use iifouzi\servercore\Loader;

class HealCommand extends PluginCommand
{
  
  public $plugin;
  private $main;
  
  public function __construct(Loader $main)
  {
    $this->main = $main;
    $this->setDescription("Makes your health Max");
    $this->setPermission("heal.command");
    parent::__construct("heal", $main);
  }
  
  public function execute(CommandSender $sender, string $commandLabel, array $args){
    if(!$sender->hasPermission("heal.command"){
      $sender->sendMessage(C::RED . "You dont have permissions to run this command!");
    }
    if(count($args) > 0){
      $sender->sendMessage(C:RED . "Usage: /heal <me|name)");
    }
    switch ($args[0]){
      $target = $this->getServer()->getOnlinePlayers()->getPlayer($args[0]);
      case "me"
      if($sender->getHealth()->isMax()){
        $sender->sendMessage(C::GREEN . "Your health is already maxed!");
      }
      if(!$sender->getHealth()->isMax()){
        $sender->setMaxHealth();
        $sender->sendMessage(C::GREEN . "You health has been maxed!");
      }
      break;
      
      if($target === null){
        $sender->sendMessage("Player not found"):
      }
      $target->setMaxHealth();
      $target->sendMessage(C::GREEN . "Your health has been maxed by " . C::WHITE . $sender->getName());
      $sender->sendMessage(C::GREEN . "You have maxed the health for " . C::WHITE . $target->getName());
    }
    return true;
  }
}