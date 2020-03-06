<?php

namespace iiFouzi\ServerCore;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSeder;
use pocketmine\event\Listener;
use pocketmine\event\PlayerJoinEvent;
use pocketmine\event\PlayerQuitEvent;
use pocketmine\event\PlayerDeathEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;
// config coming soon

class Maim extends PluginBase implements Listener {

    public function onEnable(): void{
      this->getLogger()->info(TF::RED:: . "Server Core Plugin has succefully enabled! ");
    }
