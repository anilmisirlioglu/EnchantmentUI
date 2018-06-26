<?php

namespace NightRich\Enchantment\forms;

use NightRich\Enchantment\EnchantmentStory;
use NightRich\Enchantment\language\Language;
use pocketmine\form\Form;
use pocketmine\form\MenuForm;
use pocketmine\form\MenuOption;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class SelectEnchantmentForm extends MenuForm{

    /** @var string */
    private $enchant;
    /** @var array */
    private $id = [];

    public function __construct(Player $player, string $enchant){
        $this->enchant = $enchant;

        parent::__construct(Language::translate($player, "select.form.title"), Language::translate($player, "select.form.text"), $this->getOptionList($player));
    }

    public function getOptionList(Player $player) : array{
        $options = [];
        foreach(EnchantmentStory::enchantments[$this->enchant] as $id => $enchantment){
            $enchantmentName = EnchantmentStory::getEnchantmentName($enchantment, $player->getLocale());
            $options[] = new MenuOption(TextFormat::GREEN . $enchantmentName);
            $this->id[$enchantmentName] = $id;
        }
        return $options;
    }

    public function onSubmit(Player $player) : ?Form{
        $select = $this->id[TextFormat::clean($this->getSelectedOption()->getText())];
        $ench = Enchantment::getEnchantment($select);

        if($ench == null){
            $player->sendMessage(Language::translate($player->getLocale(), "select.form.enchantment.not.found"));
            return null;
        }else{
            $getEnchantment = EnchantmentStory::getEnchantment($ench);
            return new BuyEnchantmentForm($player, $getEnchantment);
        }
    }
}