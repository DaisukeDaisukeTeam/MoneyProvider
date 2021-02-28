<?php

namespace MoneyProvider\MoneyProvider;

class MoneySystem_provider extends ProviderBase{
	public static $pluginName = "MoneySystem";

	public function myMoney($player): float{
		return $this->MoneyAPI->get($this->getTranslatedName($player));
	}

	public function setMoney($player, float $money){
		$this->MoneyAPI->set($this->getTranslatedName($player), $money);
	}

	public function addMoney($player, float $money){
		$this->MoneyAPI->increase($this->getTranslatedName($player), $money);
	}

	public function reduceMoney($player, float $money){
		$this->MoneyAPI->reduce($this->getTranslatedName($player), $money);
	}

	public function existMoney($player, float $money): bool{
		return $this->myMoney($player) >= $money;
	}
	
	public static function getPlugin(){
		if(Server::getInstance()->getPluginManager()->getPlugin(static::$pluginName) === null){
			return null;
		}
		return API::getInstance();
	}
}
