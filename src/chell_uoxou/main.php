<?php
namespace cowsay;
use phppo\system\systemProcessing as systemProcessing;
use phppo\command as command;
use phppo\command\plugincommand\addcommand as addcommand;
use Cowsayphp\Farm as Farm;
$pluginAddCommand = new addcommand;
$pluginAddCommand -> addcommand("command-cowsay","cowsay","plugin","","");
/**
 *
 */
class main extends systemProcessing{

	function __construct(){
		# code...
	}

	public function onLoad(){
		global $poPath;
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\AnimalInterface.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\AbstractAnimal.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\Cow.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\Farm.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\Farm\Cow.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\Farm\Dragon.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\Farm\Tux.php";
		include dirname(dirname(__FILE__)) . "\cowsayphp\src\Farm\Whale.php";
	}

	public function onCommand(){
		$say = substr($GLOBALS['raw_input'],7);
		if (!isset($GLOBALS['aryTipeTxt'][1])) {
			$say = "虚無(´･_･`)";
			$cow = Farm::create(\Cowsayphp\Farm\Cow::class);
		}else{
			switch (mb_strtolower($GLOBALS['aryTipeTxt'][1])) {
				case 'list':
					$this->info("I can show Animals:");
					break;
				case 'cow':
					$animal = "Cow";
					$cow = Farm::create(\Cowsayphp\Farm\Cow::class);
					$say = substr($GLOBALS['raw_input'],11);
					break;
				case 'whale':
					$animal = "Whale";
					$cow = Farm::create(\Cowsayphp\Farm\Whale::class);
					$say = substr($GLOBALS['raw_input'],13);
					break;
				case 'tux':
					$animal = "Tux";
					$cow = Farm::create(\Cowsayphp\Farm\Tux::class);
					$say = substr($GLOBALS['raw_input'],11);
					break;
				case 'dragon':
					$animal = "Dragon";
					$cow = Farm::create(\Cowsayphp\Farm\Dragon::class);
					$say = substr($GLOBALS['raw_input'],14);
					break;
				default:
					$animal = "Cow";
					$cow = Farm::create(\Cowsayphp\Farm\Cow::class);
					break;
			}
		}
		$this->info($cow->say($say));
	}
}
