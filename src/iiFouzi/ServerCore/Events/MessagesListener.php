<?php

namespace iiFouzi\ServerCore\Listeners;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\TextFormat as TF;
use iiFouzi\ServerCore\Loader;

class EventListener implements Listener 
{
  
  public function onJoin(PlayerJoinEvent $event){
    $p = $event->getPlayer();
    $n = $p->getName();
    $p->setJoinMessage(TF::GAY . "[" . TF::GREEN . "+" . TF::GRAY . "]" . TF::GREEN . $n);
  }
  
  public function onQuit(PlayerQuitEvent $event){
    $p = $event->getPlayer();
    $n = $p->getName();
    $p->setQuitMessage(TF::GAY . "[" . TF::RED . "-" . TF::GRAY . "]" . TF::RED . $n);
  }
  
  public function onDeath(PlayerDeathEvent $event){
    $e = $event->getEntity();
    if($e->getLastCause() === EntityDamageByEntityEvent){
      $d = $p->getDamager();
      $n = $d->getName();
      $nn = $p->getName();
      $e->setDeathMessage(TF::GREEN . $nn . TF::WHITE . " got rekt by " . TF::RED . $n);
    }
 }
  
}