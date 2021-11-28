<?php

namespace MoneyProvider\MoneyProvider;

use cooldogedev\BedrockEconomy\BedrockEconomy;
use cooldogedev\BedrockEconomy\constant\SearchConstants;
use cooldogedev\BedrockEconomy\session\cache\SessionCache;
use cooldogedev\BedrockEconomy\session\SessionManager;
use pocketmine\Player;

class BedrockEconomy_Provider{
	public static string $pluginName = "BedrockEconomy";

	/** @var BedrockEconomy|mixed $MoneyAPI */
	public $MoneyAPI;

	public function myMoney($player) : float{
		return $this->getCache($player)?->getBalance() ?? 0;
	}

	public function setMoney($player, float $money) : void{
		$amount = (int) floor($money);
		$cache = $this->getCache($player);
		if($cache === null){
			return;
		}
		$cache->setBalance($amount);
	}

	public function addMoney($player, float $money) : void{
		$amount = (int) floor($money);
		$cache = $this->getCache($player);
		if($cache === null){
			return;
		}
		$cache->addToBalance($amount);
	}

	public function reduceMoney($player, float $money) : void{
		$amount = (int) floor($money);
		$cache = $this->getCache($player);
		if($cache === null){
			return;
		}
		$cache->subtractFromBalance($amount);
	}

	public function existMoney($player, float $money) : bool{
		return $this->myMoney($player) >= $money;
	}

	/**
	 * @param Player|string $player
	 * @return SessionCache|null
	 */
	public function getCache($player) : ?SessionCache{
		$session = null;
		if($player instanceof Player){
			$session = $this->getSessionManager()->getSession($player->getXuid(), SearchConstants::SEARCH_MODE_XUID);
		}else{
			$session = $this->getSessionManager()->getSession($player, SearchConstants::SEARCH_MODE_USERNAME);
		}
		if($session === null){
			return null;
		}
		return $session->getCache();
	}

	public function getSessionManager() : SessionManager{
		return $this->MoneyAPI->getSessionManager();
	}
}
