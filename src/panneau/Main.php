<?php

namespace panneau;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{

    public static $instance;
    public static $function;

    public function onEnable()
    {
        $this->getServer()->getCommandMap()->register('cmd', new Command($this));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        self::$instance = $this;
        self::$function = new FunctionAPI();
    }

    public static function getInstance() {
        return self::$instance;
    }

    public static function getFunction() : FunctionAPI
    {
        return self::$function;
    }

}

?>
