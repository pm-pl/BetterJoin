<?php

namespace HenryDM\BetterJoin;

# =======================
#      General Class
# =======================

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

use pocketmine\player\Player;
use Vecnavium\FormsUI\SimpleForm;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;

use HenryDM\BetterJoin\Utils\PluginUtils;
use pocketmine\item\LegacyStringToItemParser;
use davidglitch04\libEco\libEco;

class Main extends PluginBase implements Listener {  

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this); 
        $this->saveResource("config.yml");
    }

    public function onJoin(PlayerJoinEvent $event) {

# ================================================================
#                        GENERAL VARIABLES
# ================================================================ 

        $player = $event->getPlayer();
        $name = $player->getName();

# ================================================================
#                        JOIN MESSAGE VARIABLES
# ================================================================ 

        $message = str_replace(["{player}", "{line}", "&"], [$name, "\n", "§"], $this->getConfig()->get("join-message-text"));

# ================================================================
#                        JOIN COMMAND VARIABLES
# ================================================================      

        $command = str_replace(["{player}", "{&}"], [$name, "§"], $this->getConfig()->get("join-command-name"));

# ================================================================
#                        JOIN TITLE VARIABLES
# ================================================================

        $title = str_replace(["&"], ["§"], $this->getConfig()->get("join-title-text"));
        $subtitle = str_replace(["&"], ["§"], $this->getConfig()->get("join-title-subtitle"));

# ================================================================
#                      JOIN BROADCAST VARIABLES
# ================================================================ 

        $broadcast = str_replace(["{player}", "{line}", "&"], [$name, "\n", "§"], $this->getConfig()->get("join-player-broadcast-message"));

# ================================================================
#                      JOIN FORM VARIABLES
# ================================================================ 

        $jut = str_replace(["&", "{line}"], ["§", "\n"], $this->getConfig()->get("join-ui-title"));
        $juc = str_replace(["&", "{line}", "{player}"], ["§", "\n", $name], $this->getConfig()->get("join-ui-content"));
        $jueb = str_replace(["&", "{line}"], ["§", "\n"], $this->getConfig()->get("join-ui-exit-button-text"));

# ================================================================
#                        JOIN ITEMS VARIABLES
# ================================================================        

        $joinitem = $this->getConfig()->get("join-items-id", []);
        $item = LegacyStringToItemParser::getInstance()->parse($joinitem);
        $itemcount = $this->getConfig()->get("join-items-count");

# ================================================================
#                        JOIN MONEY VARIABLES
# ================================================================  
     
        $amount = $this->getConfig()->get("join-money-amount");

# ================================================================
#                        JOIN EXP VARIABLES
# ================================================================   

        $xp = $player->getXpManager()->getCurrentTotalXp();
        $limit = $this->getConfig()->get("join-exp-limit-amount");
        $xpamount = $this->getConfig()->get("join-exp-amount");
# ================================================================

# =================
#   JOIN MESSAGE
# =================

        if($this->getConfig()->get("join-message") === true) {
            if($this->getConfig()->get("join-message-type") === "popup") {
                $player->sendPopup($message);
            }

            if($this->getConfig()->get("join-message-type") === "message") {
                $player->sendMessage($message);
            }
        }

# =================
#    JOIN CLEAR
# =================

        if($this->getConfig()->get("join-clear-inventory") === true) {
            $player->getInventory()->clearAll();
            $player->getArmorInventory()->clearAll();
        }

# =================
#    JOIN SPAWN 
# =================        

        if($this->getConfig()->get("join-teleport-spawn") === true) {
            $event->getPlayer()->teleport($this->getServer()->getWorldManager()->getDefaultWorld()->getSafeSpawn());
        }

# =================
#    JOIN HEALTH
# =================        

        if($this->getConfig()->get("join-health") === true) {
            $player->setHealth(20);
        }

# =================
#    JOIN FOOD
# =================        

        if($this->getConfig()->get("join-food") === true) {
            $player->getHungerManager()->setFood(20);
        }

# =================
#   JOIN COMMAND
# =================        

        if($this->getConfig()->get("join-command") === true) {
            $this->getServer()->getCommandMap()->dispatch(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), $command);
        }

# =================
#    JOIN SOUND
# =================        

        if($this->getConfig()->get("join-sound") === true) {
            PluginUtils::playSound($player, $this->getConfig()->get("join-sound-name"), 1, 1); 
        }

# =================
#    JOIN TITLE
# =================        

        if($this->getConfig()->get("join-title") === true) {
            $player->sendTitle($title);
            $player->sendSubTitle($subtitle);
        }

# =================
#     JOIN UI
# =================

        if($this->getConfig()->get("join-ui") === true) {
            $form = new SimpleForm(function (Player $player, int|null $data) {
                if(!isset($data)) {
                    return true;
                }
                
                if($data === 0) {
                    if($this->getConfig()->get("join-ui-exit-button") === true) {
                        if($this->getConfig()->get("exit-button-message-toggle") === true) {
                            $player->sendMessage($this->getConfig()->get("join-ui-exit-button-message"));
                        }
                    }
                }
            });
            
            $form->setTitle($jut);
            $form->setContent($juc);
            if($this->getConfig()->get("join-ui-exit-button") === true) {
            $form->addButton($jueb);
            }
            return $form;
        }

# =================
#  JOIN BROADCAST
# =================
        if($this->getConfig()->get("join-player-broadcast") === true) {
            $event->setJoinMessage("");
            $this->getServer()->broadcastMessage($broadcast);
        }

# =================
#    JOIN ITEMS
# =================
         
        if($this->getConfig()->get("join-items") === true) {
            $player->getInventory()->addItem($item->setCount($itemcount));
        }

# =================
#    JOIN MONEY
# =================

        if($this->getConfig()->get("join-money") === true) { 
            libEco::addMoney($player, $amount);
        }

# =================
#     JOIN EXP
# =================
        
        if($this->getConfig()->get("join-exp") === true) {
            if($this->getConfig()->get("join-exp-limit") === true) {
                if($xp < $limit) {
                    $player->getXpManager()->addXpLevels($xpamount);
                }
            } else {
                $player->getXpManager()->addXpLevels($xpamount);
            }
        }
    }
}
