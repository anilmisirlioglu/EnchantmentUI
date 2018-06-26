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

namespace NightRich\Enchantment\forms;

use NightRich\Enchantment\EnchantmentStory;
use NightRich\Enchantment\language\Language;
use pocketmine\form\CustomForm;
use pocketmine\form\element\Label;
use pocketmine\form\element\Slider;
use pocketmine\form\Form;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\Player;

class BuyEnchantmentForm extends CustomForm{

    /** @var Enchantment */
    private $ench;
    /** @var int */
    private $price;
    
    public function __construct(Player $player, EnchantmentInstance $enchantment){
        $this->ench = $enchantment;
        $this->price = EnchantmentStory::getEnchantmentMoney($enchantment->getId());

        parent::__construct(Language::translate($player->getLocale(), "buy.form.text"), [
            new Label(Language::translate($player->getLocale(), "buy.form.label.text", [$enchantment->getEnchantment()->getName(), $this->price])),
            new Slider(Language::translate($player->getLocale(), "buy.form.slider.text"), 1, 5)
        ]);
    }
    
    public function onSubmit(Player $player) : ?Form{
        $level = $this->getElement(1)->getValue();
        $price = $level * $this->price;

        $this->ench->setLevel($level);
        $item = $player->getInventory()->getItemInHand();
        if($player->getXpLevel() > $price){
            $item->addEnchantment($this->ench);
            $player->getInventory()->setItemInHand($item);
            $player->setXpLevel($player->getXpLevel() - $price);
            $player->sendMessage(Language::translate($player->getLocale(), "buy.form.enchantment.successful"));
        }else{
            $player->sendMessage(Language::translate($player->getLocale(), "buy.form.enchantment.unsuccessful"));;
        }
        return null;
    }
}