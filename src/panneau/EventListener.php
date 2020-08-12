<?php


namespace panneau;


use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Config;

class EventListener implements Listener
{

    public function __construct(Main $pl)
    {
        $this->pl = $pl;
        $this->data = new Config($this->pl->getDataFolder() .'Panneau.json', Config::JSON);
    }

    public function onInteract(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $block = $event->getBlock();

        if ( Main::getFunction()->isVarToggle($name) ) {
            $cmd = Main::getFunction()->getVar($name);
            $this->data->set($block->getX() .":". $block->getY() .":". $block->getZ(), $cmd);
            $this->data->save();
            $player->sendMessage('§aYou place a command-block');
            Main::getFunction()->setVarTo($name, false);
        } elseif ( $this->data->exists($block->getX() .":". $block->getY() .":". $block->getZ()) ) {
            $this->pl->getServer()->dispatchCommand($player, str_replace('{player}', $player->getName(), $this->data->get($block->getX() .":". $block->getY() .":". $block->getZ())));
        }
    }

    public function onBreak(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $block = $event->getBlock();

        if ( $this->data->exists($block->getX() .":". $block->getY() .":". $block->getZ()) ) {
            $this->data->remove($block->getX() .":". $block->getY() .":". $block->getZ());
            $player->sendMessage('§cYou broke a command-block');
        }
    }
}

?>
