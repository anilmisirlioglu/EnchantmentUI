<?php

/**
 *  _   _  _         _      _   ______  _        _      _____ ______
 * | \ | |(_)       | |    | |  | ___ \(_)      | |    |_   _|| ___ \
 * |  \| | _   __ _ | |__  | |_ | |_/ / _   ___ | |__    | |  | |_/ /
 * | . ` || | / _` || '_ \ | __||    / | | / __|| '_ \   | |  |    /
 * | |\  || || (_| || | | || |_ | |\ \ | || (__ | | | |  | |  | |\ \
 * \_| \_/|_| \__, ||_| |_| \__|\_| \_||_| \___||_| |_|  \_/  \_| \_|
 *             __/ |
 *            |___/
 *
 * @version 1.1
 * @author NightRich_TR
 *
 * - 'My Little Angel :*?'
 *
 */

namespace NightRich\Enchantment;

use NightRich\Enchantment\forms\MainEnchantmentForm;
use NightRich\Enchantment\language\Language;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Base extends PluginBase{

    /** @var Base */
    public static $api;
    /** @var Config */
    public $config;

    public function onLoad(){
        self::$api = $this;
    }

    public static function getInstance() : Base{
        return self::$api;
    }

    public function onEnable(){
        Language::init();

        $this->getLogger()->info(TextFormat::AQUA . "Plugin active...");

        @mkdir($this->getDataFolder());

        $this->saveDefaultConfig();
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if(strtolower($command->getName()) == "addenchant"){
            if($sender instanceof Player){
                if($sender->getInventory()->getItemInHand()->getId() !== 0){
                    $sender->sendForm(new MainEnchantmentForm($sender));
                }else{
                    $sender->sendMessage(Language::translate($sender->getLocale(), "base.no.items.in.your.hand"));
                }
            }else{
                $sender->sendMessage(Language::translate(Language::DEFAULT_LANGUAGE, "please.run.in.game"));
            }
        }
        return true;
    }
}