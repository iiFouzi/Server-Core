<?php

declare(strict_types=1);

namespace iiFouzi\ServerCore;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener
{
    // This variable shows the [Server] with colors in every message it is used in.

    const PREFIX = "Â§8[Â§bServerÂ§8] ";

    // When the plugin enables it does this.

    public function onEnable()
    {
        // getLogger() Basically logs things in Console

        $this->getLogger()->info(TF::GREEN . "Basic core ready!");
    }

    public function onDisable()
    {

    }

    // this makes the PREFIX a function to call

    public static function getPrefix() : string
    {
        return self::PREFIX;
    }

    // This onJoin is the name of the function and uses the PlayerJoinEvent

    public function onJoin(PlayerJoinEvent $event)
    {
        // $player is a made up Variable

        $player = $event->getPlayer(); // Unnecessary

        // This makes the Join Message of the server when someone joins the server

        $event->setJoinMessage(TF::BOLD . TF::YELLOW . $player->getName() . TF::GRAY . "has joined the server.");
    }

    // This onLeave is the name of the function and uses the PlayerQuitEvent

    public function onLeave(PlayerQuitEvent $event)
    {
        // $player is a made up Variable

        $player = $event->getPlayer(); // Unnecessary

        // This makes the Leave Message of the server when someone leaves the server

        $event->setQuitMessage(TF::BOLD . TF::YELLOW . $player->getName() . TF::GRAY . "has left the server.");
    }

    // onCommand is a function for making commands / modding some

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        // This checks if the $sender is a Player or not

        // This executes if the $sender is NOT a player and won't execute if it is a player

        if (!$sender instanceof Player) {

            // If the $sender is not a player in-game it will send a message to the person who sent it

            $sender->sendMessage(Main::getPrefix() . "You must be a player to use this command.");
            return false;
        }

        // Making switch statements is the most basic ways of making commands

        switch ($command)
        {
            // Name of the command first, then what the functions of it is

            case "heal":
                // This if statement checks if the $sender or player has full health

                if ($sender->getHealth() == $sender->getMaxHealth())
                {
                    // If the player has full health it will send him/her this message

                    $sender->sendMessage(Main::getPrefix() . "Your health is already full!");
                    return false;
                }
                // If the player does not have full health it will heal him/her and send a lovely message

                $sender->setHealth($sender->getMaxHealth());
                $sender->sendMessage(Main::getPrefix() . "You have been healed!");
                break;

            case "feed":
                // This if statement checks if the $sender or player has full food bar

                if($sender->getFood() == 20)
                {
                    $sender->sendMessage(Main::getPrefix() . "You are already full on food!");
                    return false;
                }
                // if the player does not have full food bar, it will feed them and send them a message

                $sender->setFood(20);
                $sender->sendMessage(Main::getPrefix() . "You have been fed!");
                break;

            case "fly":
                // This if statement checks if the $sender or player has access to Flight

                if($sender->getAllowFlight())
                {
                    // If the player has Flight access, it will disable it and send a message
                    $sender->setAllowFlight(false);
                    $sender->sendMessage(Main::getPrefix() . "Flight disabled!");
                    return false;
                }
                // if the player does not have flight, it will enable that and give him/her access

                $sender->setAllowFlight(true);
                $sender->sendMessage(Main::getPrefix() . "Flight enabled!");
                break;

            case "clearinv":
                // This command clears the inventory it will start by clearing the ArmourInventory then the full inventory and send a message to the player

                $sender->getArmorInventory()->clearAll();
                $sender->getInventory()->clearAll();
                $sender->sendMessage(Main::getPrefix() . "Inventory cleared!");
                break;

            case "ping":
                // This command lets player see their ping by sending them a message with their ping inside of it

                $sender->sendMessage(Main::getPrefix() . TF::YELLOW . "Your ping is " . $sender->getPing() . "ms");

            }
            return true;
    }
}