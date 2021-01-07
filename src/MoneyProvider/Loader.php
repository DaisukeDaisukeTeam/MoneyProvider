<?php

namespace MoneyProvider;

use MoneyProvider\MoneyProvider\MoneyProvider;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase{
	public function onEnable(){
		$config = new Config($this->getDataFolder()."Providers.yml", Config::YAML);

		if(!MoneyProvider::init($config)){
			$providers = MoneyProvider::getProviders();//...?
			$this->getLogger()->warning("MoneyAPIプラグインを発見することは出来ない為、このプラグインを無効化します。");
			$this->getLogger()->info("このプラグインは以下のMoneyAPIプラグインに対応致しましております。");
			foreach($providers as $pluginName => $class){
				$this->getLogger()->info("- ".$pluginName);
			}
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return;
		}

		$this->getLogger()->info("moneyAPIに関しましては「".MoneyProvider::getName()."」に設定致しました。");
	}

}
