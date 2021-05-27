<?php

namespace MoneyProvider\MoneyProvider;

use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

abstract class ProviderBase{
	/**
	 * @param Player|string $player
	 * @return float
	 */
	abstract public function myMoney($player): float;
	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	abstract public function setMoney($player, float $money): void;
	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	abstract public function addMoney($player, float $money): void;
	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	abstract public function reduceMoney($player, float $money): void;
	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	abstract public function existMoney($player, float $money): bool;

	/** @var string */
	public static $pluginName = "";

	/** @var mixed */
	public $MoneyAPI;

	public function __construct(){
		$this->MoneyAPI = static::getPlugin();
	}

	/**
	 * @return Plugin|null
	 */
	public static function getPlugin(){
		return Server::getInstance()->getPluginManager()->getPlugin(static::$pluginName);
	}

	public static function isInstalled(): bool{
		return static::getPlugin() !== null;// ? true : false;
	}

	public function getName(): string{
		return static::$pluginName;
	}

	public function isEmpty(): bool{
		return false;
	}

	/**
	 * @param Player|String $player
	 * @return String
	 */
	public function getTranslatedName($player): string{
		return $player instanceof Player ? $player->getName() : $player;
	}
}
