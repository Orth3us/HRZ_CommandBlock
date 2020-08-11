<?php


namespace panneau;


use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

class Command extends PluginCommand
{

    public function __construct(Main $plugin)
    {

        parent::__construct("panneau", $plugin);   //Construction de la commandes (nom de la commande, plugin).
        $this->setDescription("Affiche l'id de l'item que tu as dans la main");   //Définit la description de la commande.
        $this->plugin = $plugin;

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if ( $sender->isOp() ) {
            if ( count($args) >= 1 ) {
                Main::getFunction()->setVarTo($sender->getName(), true, implode(" ", $args));
                $sender->sendMessage('§aNow, you must touch the block for set the command.');
            } else {
                $sender->sendMessage('usage(exemple): /panneau give {player} 1 5');
            }
        }

    }
}

?>