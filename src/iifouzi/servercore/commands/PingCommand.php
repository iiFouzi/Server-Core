<?php

namespace iifouzi\servercore\Commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat as C;

use iifouzi\servercorr\Loader;

class PingCommand extends PluginCommand{

    public $plugin;
    private $main;

    public function __construct(Loader $main){
        $this->main = $main;
        $this->setDescription("Shows your internet status!");
        parent::__construct("ping", $main);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $ping = $sender->getPing();
        $sender->sendMessage(C::GRAY . "Your ping: " . C::GREEN . $ping . " ms");
        return true;
    }
}