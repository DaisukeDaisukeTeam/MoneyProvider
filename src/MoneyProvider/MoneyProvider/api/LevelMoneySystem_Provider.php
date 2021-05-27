<?php

namespace MoneyProvider\MoneyProvider;

class LevelMoneySystem_Provider extends ProviderBase{
	public static $pluginName = "LevelMoneySystem";

	public function myMoney($player): float{
		return $this->MoneyAPI->getMoney($this->getTranslatedName($player));
	}

	public function setMoney($player, float $money): void{
		$this->MoneyAPI->setMoney($this->getTranslatedName($player), $money);
	}

	public function addMoney($player, float $money): void{
		$this->MoneyAPI->addMoney($this->getTranslatedName($player), $money);
	}

	public function reduceMoney($player, float $money): void{
		$this->MoneyAPI->removeMoney($this->getTranslatedName($player), $money);
	}

	public function existMoney($player, float $money): bool{
		return $this->myMoney($player) >= $money;
	}
}
