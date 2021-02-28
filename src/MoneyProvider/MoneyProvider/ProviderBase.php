<?php

namespace MoneyProvider\MoneyProvider;

use pocketmine\Player;
use pocketmine\Server;

abstract class ProviderBase{
	abstract public function myMoney($player): float;
	abstract public function setMoney($player, float $money);
	abstract public function addMoney($player, float $money);
	abstract public function reduceMoney($player, float $money);
	abstract public function existMoney($player, float $money): bool;

	public static $pluginName = "";

	/** @var mixed */
	public $MoneyAPI;

	public function __construct(){
		$this->MoneyAPI = static::getPlugin();
	}

	public static function getPlugin(){
		return Server::getInstance()->getPluginManager()->getPlugin(static::$pluginName);
	}

	public static function isInstalled(): bool{
		return static::getPlugin() !== null;// ? true : false;
	}

	public function getName(): string{
		return static::$pluginName;
	}

	/**
	 * @param Player|String $player
	 * @return String
	 */
	public function getTranslatedName($player): string{
		return $player instanceof Player ? $player->getName() : $player;
	}
}
