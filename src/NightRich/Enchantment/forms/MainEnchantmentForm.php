<?php

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