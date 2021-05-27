<?php


namespace MoneyProvider\MoneyProvider;


class EmptyProvider extends ProviderBase{
	public static $pluginName = "";

	public function myMoney($player): float{
		return 0.0;
	}

	public function setMoney($player, float $money): void{
		//none
	}

	public function addMoney($player, float $money): void{
		//none
	}

	public function reduceMoney($player, float $money): void{
		//none
	}

	public function existMoney($player, float $money): bool{
		return false;
	}

	public function isEmpty(): bool{
		return true;
	}
}