<?php

namespace MoneyProvider\MoneyProvider;

use pocketmine\Player;
use pocketmine\utils\Config;

class MoneyProvider{
	/**
	 * @phpstan-var array<string, class-string<ProviderBase>>
	 * @var class-string<ProviderBase>[] $providers
	 */
	public static $providers = [
		"PocketMoney" => PocketMoney_Provider::class,
		"EconomyAPI" => EconomyAPI_Provider::class,
		"LevelMoneySystem" => LevelMoneySystem_Provider::class,
		"MoneySystem_provider" => MoneySystem_provider::class,
		"SimpleEconomy" => SimpleEconomy_Provider::class,
		"BedrockEconomy" => BedrockEconomy_Provider::class,
		"MixCoinSystem" => MixCoinSystem_Provider::class
	];

	/** @var ProviderBase */
	public static $provider;

	public static function init(Config $config): bool{
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
			self::$provider = new EmptyProvider();
			return false;
		}
		return true;
	}

	/**
	 * @phpstan-return array<string, class-string<ProviderBase>>
	 * @return class-string<ProviderBase>[] $providers
	 */
	public static function getProviders(){
		return self::$providers;
	}

	/**
	 * @param Player|string $player
	 * @return float
	 */
	public static function myMoney($player): float{
		return self::$provider->myMoney($player);
	}

	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	public static function setMoney($player, float $money): void{
		self::$provider->setMoney($player, $money);
	}

	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	public static function addMoney($player, float $money): void{
		self::$provider->addMoney($player, $money);
	}

	/**
	 * @param Player|string $player
	 * @param float $money
	 */
	public static function reduceMoney($player, float $money): void{
		self::$provider->reduceMoney($player, $money);
	}

	/**
	 * @param Player|string $player
	 * @param int $money
	 * @return bool
	 */
	public static function existMoney($player, int $money): bool{
		return self::$provider->existMoney($player, $money);
	}

	public static function isEmpty(): bool{
		return self::$provider instanceof EmptyProvider;
	}
	
	public static function getName(): string{
		return self::$provider->getName();
	}
}
