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

use NightRich\Enchantment\language\Language;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;

class EnchantmentStory{

    /** @var array */
    public const enchantments = [
        "Sword" => [
            9 => Enchantment::SHARPNESS,
            12 => Enchantment::KNOCKBACK,
            13 => Enchantment::FIRE_ASPECT,
            14 => Enchantment::LOOTING,
            17 => Enchantment::UNBREAKING
        ],
        "Pickaxe" => [
            15 => Enchantment::EFFICIENCY,
            16 => Enchantment::SILK_TOUCH,
            17 => Enchantment::UNBREAKING,
            18 => Enchantment::FORTUNE
        ],
        "Axe" => [
            15 => Enchantment::EFFICIENCY,
            16 => Enchantment::SILK_TOUCH,
            17 => Enchantment::UNBREAKING,
            18 => Enchantment::FORTUNE
        ],
        "Shovel" => [
            15 => Enchantment::EFFICIENCY,
            16 => Enchantment::SILK_TOUCH,
            17 => Enchantment::UNBREAKING,
        ],
        "Helmet" => [
            0 => Enchantment::PROTECTION,
            1 => Enchantment::FIRE_PROTECTION,
            3 => Enchantment::BLAST_PROTECTION,
            4 => Enchantment::PROJECTILE_PROTECTION,
            5 => Enchantment::THORNS,
            6 => Enchantment::RESPIRATION
        ],
        "Chestplate" => [
            0 => Enchantment::PROTECTION,
            1 => Enchantment::FIRE_PROTECTION,
            3 => Enchantment::BLAST_PROTECTION,
            4 => Enchantment::PROJECTILE_PROTECTION,
            5 => Enchantment::THORNS
        ],
        "Leggings" => [
            0 => Enchantment::PROTECTION,
            1 => Enchantment::FIRE_PROTECTION,
            3 => Enchantment::BLAST_PROTECTION,
            4 => Enchantment::PROJECTILE_PROTECTION,
            5 => Enchantment::THORNS
        ],
        "Boots" => [
            0 => Enchantment::PROTECTION,
            2 => Enchantment::FEATHER_FALLING,
            1 => Enchantment::FIRE_PROTECTION,
            3 => Enchantment::BLAST_PROTECTION,
            4 => Enchantment::PROJECTILE_PROTECTION,
            5 => Enchantment::THORNS,
            7 => Enchantment::DEPTH_STRIDER
        ],
        "Bow" => [
            19 => Enchantment::POWER,
            20 => Enchantment::PUNCH,
            21 => Enchantment::FLAME,
            22 => Enchantment::INFINITY
        ]
    ];

    /** @var array */
    public const enchantmentCategory  = [
            "Sword" => "textures/items/diamond_sword",
            "Pickaxe" => "textures/items/diamond_pickaxe",
            "Axe" => "textures/items/diamond_axe",
            "Shovel" => "textures/items/diamond_shovel",
            "Helmet" => "textures/items/diamond_helmet",
            "Chestplate" => "textures/items/diamond_chestplate",
            "Leggings" => "textures/items/diamond_leggings",
            "Boots" => "textures/items/diamond_boots",
            "Bow" => "textures/items/bow_standby"
    ];

    public static function getEnchantmentName($enchantment, string $locale) : string{
        $array = [
            Enchantment::PROTECTION => Language::translate($locale, "protection.name"),
            Enchantment::FIRE_PROTECTION => Language::translate($locale, "fire.protection.name"),
            Enchantment::FEATHER_FALLING => Language::translate($locale, "feather.falling.name"),
            Enchantment::BLAST_PROTECTION => Language::translate($locale, "blast.protection.name"),
            Enchantment::PROJECTILE_PROTECTION => Language::translate($locale, "projectile.protection.name"),
            Enchantment::THORNS => Language::translate($locale, "thorns.name"),
            Enchantment::RESPIRATION => Language::translate($locale, "respiration.name"),
            Enchantment::DEPTH_STRIDER => Language::translate($locale, "depth.strider.name"),
            Enchantment::AQUA_AFFINITY => Language::translate($locale, "aqua.affinity.name"),
            Enchantment::SHARPNESS => Language::translate($locale, "sharpness.name"),
            Enchantment::KNOCKBACK => Language::translate($locale, "knockback.name"),
            Enchantment::FIRE_ASPECT => Language::translate($locale, "fire.aspect.name"),
            Enchantment::LOOTING => Language::translate($locale, "looting.name"),
            Enchantment::EFFICIENCY => Language::translate($locale, "efficiency.name"),
            Enchantment::SILK_TOUCH => Language::translate($locale, "silk.touch.name"),
            Enchantment::UNBREAKING => Language::translate($locale, "unbreaking.name"),
            Enchantment::FORTUNE => Language::translate($locale, "fortune.name"),
            Enchantment::POWER => Language::translate($locale, "power.name"),
            Enchantment::PUNCH => Language::translate($locale, "punch.name"),
            Enchantment::FLAME => Language::translate($locale, "flame.name"),
            Enchantment::INFINITY => Language::translate($locale, "infinity.name")
        ];
        return $array[$enchantment];
    }

    public static function getEnchantmentMoney(string $enchantment) : int{
        return (int)Base::getInstance()->config->get("Enchantments")[$enchantment];
    }

    public static function getEnchantment($enchantment, int $level = 1) : EnchantmentInstance{
        return new EnchantmentInstance($enchantment, $level);
    }
}