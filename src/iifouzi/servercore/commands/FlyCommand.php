<?php

namespace iifouzi\servercore\commands;

use pocketmine\Server;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustpmForm;
use jojoe77777\FormAPI\ModalForm;
use iifouzi\servercore\Loader;

class FlyCommand extends PluginCommand
{
  public $plugin;
  private $main;
  
  public function __construct(Loader $main){
    $this->main = $main;
    $this->setDescription("Shows a FlyUI");
    $this->setPermission("fly.commamd");
    parent::__construct("fly", $main);
  }
  
  public function execute(CommandSender $sender, string $commandLabel, array $args){
    if (!$sender->hasPermission("fly.command")){
      $sender->sendMessage(C::RED . "You dont have permission to run this command!");
    }
    if (!$sender instanceof Player){
      $sender->sendMessage(C::RED 
       "You must be a player to run this command!");
    }
    if($sender instanceof Player){
      $this->openFlyForm($sender);
    }
    return true;
  }
  
  public function openFlyForm(){
    $form = new SimpleForm(function (Player $player, $data){
      if (!$data){
        return true;
      }
      switch($data){
        
        case 0:
          if (!$sender->hasAllowFlight() === true){
            $sender->setAllowFlight(true);
            $sender->sendMessage(C::GREEN . "Fly has been enabled");
          }
        break;
        case 1:
          if ($sender->hasAllowFlight() === true){
            $sender->setAllowFlight(false);
            $sender->sendMessage(C::GREEN . "Fly has been disabled");
          }
        break;
        
      }
    });
    $form->setTitle("FlyUI Form");
    $form->setContent("Please choose an option!");
    $form->addButton("§l§enable.fly");
    $form->addButton("§l§cdisable.fly");
    $form->addButton("Exit");
    return $form;
  }
}