<?php

namespace MoneyProvider\MoneyProvider;

use MixCoinSystem\MixCoinSystem;

class MixCoinSystem_Provider extends ProviderBase{
	public static string $pluginName = "MixCoinSystem";

	/** @var MixCoinSystem|mixed $MoneyAPI */
	public mixed $MoneyAPI;

	public function myMoney($player) : float{
		return $this->MoneyAPI->GetCoin($player);
	}

	public function setMoney($player, float $money) : void{
		$this->MoneyAPI->SetCoin($player, $money);
	}

	public function addMoney($player, float $money) : void{
		$this->MoneyAPI->PlusCoin($player, $money);
	}

	public function reduceMoney($player, float $money) : void{
		$this->MoneyAPI->MinusCoin($player, $money);
	}

	public function existMoney($player, float $money) : bool{
		return $this->myMoney($player) >= $money;
	}
}
