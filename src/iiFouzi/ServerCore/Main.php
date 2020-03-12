<?php

namespace iiFouzi\ServerCore;
  
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\PlayerJoinEvent; //it will be added soon!
use pocketmine\event\PlayerDeathEvent; //it will be added soon!
use pocketmine\event\PlayerQuitEvent; //it will be added soon!
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\TextFormat as TF;
//config coming soon//
use pocketmine\utils\Config;
//config coming soon//

class Main extends PluginBase implements Listener {
  
  const PREFIX = "§8[§bServer§8] ";
  
  public function onEnable(): void{
    $this->getLogger()->info(TF::GREEN . "Server Core plugin has succesfully enabled");
  }
  
  public function onDisable(): void{
    $this->getLogger()->info(TF::RED . "Server Core plugin has succesfully disabled");
  }
  
  public static function getPrefix() : string
  {
    return self::PREFIX;
  }
  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

    if(!$sender instanceof Player){
      $sender->sendMessage(Main::getPrefix() . "You must be a player to use this command.");
      return false;
    }
    switch($command){

      case "heal":
        if($sender->getHealth() == $sender->getMaxHealth()){
          
          $sender->sendMessage(Main::getPrefix() . "You're health is already max");
          return false;        
        }
        
        $sender->setHealth($sender->getMaxHealth());
        $sender->sendMessage(Main::getPrefix() . "You have been healed");
        break;
      
      case "feed":
        if($sender->getFood() == 20){
          $sender->sendMessage(Main::getPrefix() . "You already have maxed food");
          return false;
}
        $sender->setFood(20);
        $sender->sendMessage(Main::getPrefix() . "You have been fed");
        break;
      
      case "fly":
        if($sender->getAllowFlight()){
          $sender->setAllowFlight(false);
          $sender->sendMessage(Main::getPrefix() . "You have disabled your fly mode");
          return false;
        }
        
        $sender->setAllowFlight(true);
        $sender->sendMessage(Main::getPrefix() . "You have enabled your flight mode");
            break;
        
        case "clearinv":
        case "ci":
            $sender->getArmorInventory()->clearAll();
            $sender->getInventory()->clearAll();
            $sender->sendMessage(Main::getPrefix() . "Cleared your inventory.");
            break;
        
        case "ping":
                $sender->sendMessage(Main::getPrefix() . TextFormat::YELLOW . "Your ping is " . $sender->getPing() . " ms");
            }
    }
    
  }
