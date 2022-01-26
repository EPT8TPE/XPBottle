<?php

declare(strict_types = 1);

namespace TPE\XPBottle;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\level\sound\PopSound;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() : void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($command->getName() === "xpbottle") {

            if(!$sender instanceof Player) {
                $sender->sendMessage("You can not run this command via console!");
                return false;
            }

            if(!$sender->hasPermission("xpbottle.xpbottle.command")) {
                $sender->sendMessage($this->getConfig()->get("no-perms-message-xpbottle"));
                return false;
            }

            if(!isset($args[0])) {
                $sender->sendMessage(TextFormat::RED . "Usage: /xpbottle <amount>");
                return false;
            }

            if(is_numeric((string)$args[0])) {
                $currentxp = $sender->getXpManager()->getCurrentTotalXp();

                if($currentxp === 0) {
                    $sender->sendMessage($this->getConfig()->get("no-xp"));
                    return false;
                }

                if((int)$args[0] === 0) {
                    $sender->sendMessage($this->getConfig()->get("must-be-above-0"));
                    return false;
                }

                if($args[0] <= $currentxp) {
                    $bottle = Item::get(Item::BOTTLE_O_ENCHANTING);
                    $bottle->setDamage((int)$args[0]);
                    $bottle->setCustomName(TextFormat::GREEN . $bottle->getDamage() . TextFormat::AQUA . " XP " . TextFormat::GREEN . "extracted by " . TextFormat::AQUA . $sender->getName());
                    $bottle->setLore([TextFormat::DARK_PURPLE . TextFormat::ITALIC . "Right click to recieve XP!"]);
                    $sender->getInventory()->addItem($bottle);
                    $sender->sendMessage(str_replace("%AMOUNT-EXTRACTED%", (int)$args[0], $this->getConfig()->get("success-message")));
                    $sender->subtractXp($bottle->getDamage());
                } else {
                    $sender->sendMessage(str_replace("%XP%", $currentxp, $this->getConfig()->get("insufficient-xp")));
                }
            } else {
                $sender->sendMessage($this->getConfig()->get("not-integer-message"));
            }

        } elseif($command->getName() === "newxpbottle") {

            if(!$sender->hasPermission("xpbottle.newxpbottle.command")) {
                $sender->sendMessage($this->getConfig()->get("no-perms-message-newxpbottle"));
                return false;
            }

            if(!isset($args[0])) {
                $sender->sendMessage(TextFormat::RED . "Usage: /newxpbottle <amount> <player>");
                return false;
            }

            if(is_numeric((string)$args[0])) {

                if((int)$args[0] === 0) {
                    $sender->sendMessage($this->getConfig()->get("must-be-above-0"));
                    return false;
                }

                if(!isset($args[1])) {
                    $sender->sendMessage(TextFormat::RED . "Usage: /newxpbottle <amount> <player>");
                    return false;
                }

                $target = $this->getServer()->getPlayer((string)$args[1]);

                if(!$target instanceof Player) {
                    $sender->sendMessage($this->getConfig()->get("invalid-player"));
                    return false;
                }

                if($sender instanceof Player) {

                    if($target->getName() === $sender->getName()) {
                        $bottle = Item::get(Item::BOTTLE_O_ENCHANTING);
                        $bottle->setDamage((int)$args[0]);
                        $bottle->setCustomName(TextFormat::GREEN . $bottle->getDamage() . TextFormat::AQUA . " XP " . TextFormat::GREEN . "extracted by " . TextFormat::AQUA . $sender->getName());
                        $bottle->setLore([TextFormat::DARK_PURPLE . TextFormat::ITALIC . "Right click to recieve XP!"]);
                        $target->getInventory()->addItem($bottle);
                        $sender->sendMessage(str_replace("%AMOUNT%", (int)$args[0], $this->getConfig()->get("self-success-message")));
                        return false;
                    }

                    $bottle = Item::get(Item::BOTTLE_O_ENCHANTING);
                    $bottle->setDamage((int)$args[0]);
                    $bottle->setCustomName(TextFormat::GREEN . $bottle->getDamage() . TextFormat::AQUA . " XP " . TextFormat::GREEN . "extracted by " . TextFormat::AQUA . $sender->getName());
                    $bottle->setLore([TextFormat::DARK_PURPLE . TextFormat::ITALIC . "Right click to recieve XP!"]);
                    $target->getInventory()->addItem($bottle);
                    $target->sendMessage(str_replace(["%AMOUNT%", "%SENDER%"], [(int)$args[0], $sender->getName()], $this->getConfig()->get("target-success-message")));;
                    $sender->sendMessage(str_replace(["%AMOUNT%", "%TARGET%"], [(int)$args[0], $target->getName()], $this->getConfig()->get("sender-success-message")));
                }

                if($sender instanceof ConsoleCommandSender) {
                    $bottle = Item::get(Item::BOTTLE_O_ENCHANTING);
                    $bottle->setDamage((int)$args[0]);
                    $bottle->setCustomName(TextFormat::GREEN . $bottle->getDamage() . TextFormat::AQUA . " XP.");
                    $bottle->setLore([TextFormat::DARK_PURPLE . TextFormat::ITALIC . "Right click to recieve XP!"]);
                    $target->getInventory()->addItem($bottle);
                    $sender->sendMessage("Successfully given an XP bottle worth " . (int)$args[0] . " to " . $target->getName() . "!");
                }
            }

        } elseif($command->getName() === "myxp") {

            if(!$sender instanceof Player) {
                $sender->sendMessage("You can not run this commmand via console!");
                return false;
            }

            if(!$sender->hasPermission("xpbottle.myxp.command")) {
                $sender->sendMessage($this->getConfig()->get("no-perms-message-myxp"));
                return false;
            }

            $xp = $sender->getCurrentTotalXp();
            $sender->sendMessage(str_replace("%XP%", $xp, $this->getConfig()->get("xp-success-message")));
        }
        return true;
    }

    public function onBottleSmash(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if($item->getId() === 384 && $item->getDamage() > 0) {
            $item->pop();
            $player->getInventory()->setItem($player->getInventory()->getHeldItemIndex(), $item);
            $player->addXp($item->getDamage());
            $player->getLevel()->addSound(new PopSound($player), [$player]);
            $event->setCancelled();
        }
    }
}
