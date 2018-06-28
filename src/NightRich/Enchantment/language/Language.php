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

namespace NightRich\Enchantment\language;

use NightRich\Enchantment\Base;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Language{

    /** @var string */
    public const DEFAULT_LANGUAGE = "en_EN";
    /** @var array */
    protected static $langs = [];

    public static function init(){
        self::$langs = self::loadLanguages();
        Base::getInstance()->getLogger()->info(TextFormat::AQUA . "LanguageManager > " . TextFormat::YELLOW . count(self::$langs) . TextFormat::GREEN . " adet dil yüklendi!");;
    }

    public static function getLangs() : array{
        return array_keys(self::$langs);
    }

    public static function loadLanguages(){
        $locale = scandir(self::getLangsDir());
        $locale = array_filter($locale, function($filename){
            return substr($filename, -4) === ".ini";
        });

        $result = [];
        foreach($locale as $lang){
            $file = self::loadLang(self::getLangsDir() . $lang);
            if(empty($file)) continue;
            $result[substr($lang, 0, -4)] = $file;
        }

        return $result;
    }

    public static function loadLang(string $path) : array{
        return file_exists($path) ? array_map('stripcslashes', parse_ini_file($path, false, INI_SCANNER_RAW)) : [];
    }

    public static function getLangsDir() : string{
        return __DIR__ . DIRECTORY_SEPARATOR . "locale" .DIRECTORY_SEPARATOR;
    }

    public static function convert(string $str){
        return str_replace("&", TextFormat::ESCAPE, $str);
    }

    public static function translate(string $locale, string $text, array $args = []) : string{
        $translatedText = self::get($locale, $text);
        if(!empty($args)) $translatedText = sprintf($translatedText, ...$args);
        $translatedText = self::convert($translatedText);
        return $translatedText;
    }

    public static function translateForPlayer(Player $player, string $text, array $args = []) : string{
        return self::translate(self::getLocaleForPlayer($player), $text, $args);
    }

    public static function get(string $locale, string $text){
        if(isset(self::$langs[$locale][$text])){
            return self::$langs[$locale][$text];
        }else{
            return self::$langs[self::DEFAULT_LANGUAGE][$text] ?? $text;
        }
    }

    public static function getLanguage(string $locale) : string{
        return isset(self::$langs[$locale]) ? $locale : self::DEFAULT_LANGUAGE;
    }

    public static function getLocaleForPlayer(Player $player) : string{
        return self::getLanguage($player->getLocale());
    }
}