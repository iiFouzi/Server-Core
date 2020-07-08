<?php

namespace iiFouzi\ServerCore\EventListener;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Level;
use pocketmine\event\Listener;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Player\PlayerDropItemEvent;
use pocketmine\event\entity\EntityDamageEvent;
use iiFouzi\ServerCore\Loader;

class EventListener implements Listener 
{
  
  private $main;
  
  public function __construct(Loader $main)
  {
    $this->main = $main;
  }
  
  // when player joins server.in 
  public function onJoin(PlayerJoinEvent $event)
  {
    $player = $event->getPlayer();
    // define the player variable. 
    
    $player->teleport($player->getLevel()->getServer()->getDefaultLevel()->getSpawnLocation());
    //teleport him to the default world 
    
    $this->onJDItems($player);
    // gives him a certain items when he joins server. 
  }
  
  // when a player picks up item.
  public function onPick(InventoryPickupItemEvent $event)
  {
    $player = $event->getPlayer();
    // define the player variable.
    
    if ($player->getLevel()->getServer()->isDefaultLevel()){
      
      // if player is in default world he wont be able to pick up items.
      $event->setCancelled(true);
    }
  }
  
  public function onDmg(EntityDamageEvent $event)
  {
    $player = $event->getPlayer();
    // define the player variable.
    
    if ($player->getLevel()->getServer()->isDefaultLevel() or $player->getCause() === EntityDamageEvent::CAUSE_FALL){
      
      // if player is in default world or did fall, he wont take damage.
      
      /* 
      if you want to keep the fall damage on
      all you should do is to remove the code above this.
      
      the code is: " or $player->getCause() === EntityDamageEvent::CAUSE_FALL"
      */
      $event->setCancelled(true);
      
    }
  }
  
  // when a player drops item.
  public function onDrop(PlayerDropItemEvent $event)
  {
    $player = $event->getPlayer();
    // define the player variable.
    
    if ($player->getLevel()->getServer()->isDefaultLevel()){
      
      // if player is in default world he wont be able to drop items.
      $event->setCancelled(true);
    }
  }
  
  // when player deaths.
  public function onDeath(PlayerDeathEvent $event)
  {
    $player = $event->getPlayer();
    // define the player variable.
    
    $player->teleport($player->getLevel()->getServer()->getDefaultLevel()->getSpawnLocation());
    // teleport him to the default world
    
    $this->onJDItems($player);
  }
  
  public function onJDItems(Player $player)
  {
    //TODO add items to this function.
  }
  
  public function onInteract(PlayerInteractEvent $event)
  {
    //TODO complete this.
  }
  
}