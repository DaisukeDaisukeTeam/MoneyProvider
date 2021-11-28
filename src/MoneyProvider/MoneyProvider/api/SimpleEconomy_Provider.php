<?php

namespace MoneyProvider\MoneyProvider;

use rark\simple_economy\api\SimpleEconomyAPI;

class SimpleEconomy_Provider extends ProviderBase{
	public static $pluginName = "SimpleEconomy";

	public const CURRENCY = "yen";

	/** @var SimpleEconomyAPI|mixed $MoneyAPI */
	public $MoneyAPI;

	public function myMoney($player) : float{
		return $this->MoneyAPI->myMoney($player);
	}

	public function setMoney($player, float $money) : void{
		$this->MoneyAPI->setMoney($player, (int) $money);
	}

	public function addMoney($player, float $money) : void{
		$this->MoneyAPI->addMoney($player, (int) $money);
	}

	public function reduceMoney($player, float $money) : void{
		$this->MoneyAPI->reduceMoney($player, (int) $money);
	}

	public function existMoney($player, float $money) : bool{
		return $this->myMoney($player) >= $money;
	}

	/**
	 * @return SimpleEconomyAPI|null
	 */
	public static function getPlugin() : ?SimpleEconomyAPI{
		return new SimpleEconomyAPI(self::CURRENCY);
	}

	public static function isInstalled() : bool{
		if(class_exists(SimpleEconomyAPI::class)){
			return true;
		}
		return false;
	}
}
