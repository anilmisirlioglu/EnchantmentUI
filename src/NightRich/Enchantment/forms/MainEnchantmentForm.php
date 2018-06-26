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
use pocketmine\form\Form;
use pocketmine\form\FormIcon;
use pocketmine\form\MenuForm;
use pocketmine\form\MenuOption;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class MainEnchantmentForm extends MenuForm{

    public function __construct(Player $player){
        parent::__construct(Language::translate($player->getLocale(), "main.form.title"), Language::translate($player->getLocale(), "main.form.text"), $this->getOptionList());
    }

    public function getOptionList() : array{
        $options = [];
        foreach(EnchantmentStory::enchantmentCategory as $key => $value){
            $options[] = new MenuOption(TextFormat::GREEN . $key, new FormIcon($value, FormIcon::IMAGE_TYPE_PATH));
        }
        return $options;
    }

    public function onSubmit(Player $player) : ?Form{
        return new SelectEnchantmentForm($player, TextFormat::clean($this->getSelectedOption()->getText()));
    }
}