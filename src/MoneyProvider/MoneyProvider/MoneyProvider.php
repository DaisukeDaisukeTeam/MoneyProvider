<?php

namespace MoneyProvider\MoneyProvider;

use pocketmine\utils\Config;

class MoneyProvider{
	/**
	 * @phpstan-var array<string, class-string<ProviderBase>>
	 * @var class-string[] $providers
	 */
	public static $providers = [
		"PocketMoney" => PocketMoney_Provider::class,
		"EconomyAPI" => EconomyAPI_Provider::class,
		"LevelMoneySystem" => LevelMoneySystem_Provider::class,
		"MoneySystem_provider" => MoneySystem_provider::class,
	];

	/** @var ProviderBase|mixed|null */
	public static $provider = null;

	public static function init(Config $config){
		/**
		 * @phpstan-var array<string, bool> $providers_All
		 * @var bool[] $providers_All
		 */
		$providers_All = $config->getAll();
		foreach($providers_All as $provider => $bool){
			$class = self::$providers[$provider];
			if($bool === false||!$class::isInstalled()){
				continue;
			}
			self::$provider = new $class();
			break;
		}
		if(self::$provider === null){
			return false;
		}
		return true;
	}

	public static function getProviders(){
		return self::$providers;
	}

	public static function myMoney($player): float{
		return self::$provider->myMoney($player);
	}

	public static function setMoney($player, float $money){
		self::$provider->setMoney($player, $money);
	}

	public static function addMoney($player, float $money){
		self::$provider->addMoney($player, $money);
	}

	public static function reduceMoney($player, float $money){
		self::$provider->reduceMoney($player, $money);
	}

	public static function existMoney($player, int $money): bool{
		return self::$provider->existMoney($player, $money);
	}

	public static function getName(): string{
		return self::$provider->getName();
	}
}
