<?php

namespace iifouzi\servercore\events;

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
use pocketmine\event\playerPlayerExhaustEvent;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\ModalForm;
use iifouzi\servercore\Loader;

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
  
  // no hunger
  public function onHunger(PlayerExhaustEvent $event)
  {
    $event->setCancelled(true);
  }
  
  public function onJDItems(Player $player)
  {
    //TODO add items and stuff to this function.
  }
  
  public function onInteract(PlayerInteractEvent $event)
  {
    $player = $event->getPlayer();
    $item = $player->getInventory()->getItemInHand();
    
    if ($item->getId() == Item::COMPASS){
      $this->openCompassForm($player);
    }
    if ($item->getId() == Item::BOOK){
      $this->openBookForm($player);
    }
    if ($item->getId() == Item::STICK){
      $this->openStickForm($player);
    }
  }
  
  public function openCompassForm(){
    $form = new SimpleForm(function (Player $player, $data){
      if ($data === null){
        return;
      }
      switch ($data){
        
        case 0:
          $player->getServer()->dispacthCommand($player, "transferserver server_ip:port");
        break;
        case 1:
          
        break;
        
      }
      
    });
    $form->setTitle();
    $form->setContent();
    $form->addButton("Server Name");
    $form->addButton("§lExit");
    $form->sendToPlayer($player);
  }
  
  public function openBookForm(){
    $form = new SimpleForm(function (Player $player, $data){
      
      if ($data === null){
        return;
      }
      
      switch($data){
        case 0:
          
        break;
      }
      
    });
    $form->setTitle("Server Informations");
    $form->setContent("Put Anything You want");
    $form->addButton("§lExit");
    $form->sendToPlayer($player);
  }
  
  public function openStickForm(){
    $form = new SimpleForm(function (Player $player){
      
      if ($data === null){
        return;
      }
      
      switch($data){
        case 0:
          
        break;
      }
      
    });
    $form->setTitle("User Informations");
    $form->setContent("§l§eName: §f" . $player->getName() . "\n \n§ePing: §f" . $player->getPing() . "ms\n \n§eFirst Play: §f" . $player->getFirstPlayed() . "\n \n§eLast Play: §f" . $player->getLastPlay());
    $form->addButton("§lExit");
    $form->sendToPlayer($player);
  }
}