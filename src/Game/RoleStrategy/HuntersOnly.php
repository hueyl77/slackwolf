<?php namespace Slackwolf\Game\RoleStrategy;

use Slackwolf\Game\Role;
use Slackwolf\Game\OptionsManager;
use Slackwolf\Game\OptionName;
use Slackwolf\Game\Roles\Hunter;
use Slackwolf\Game\Roles\Werewolf;

class HuntersOnly implements RoleStrategyInterface
{

    private $roleListMsg;
    private $minExtraRolesNumPlayers = 4;

    /**
     * @return string
     */
    public function getRoleListMsg()
    {
        return $this->roleListMsg;
    }


    public function assign(array $players, $optionsManager)
    {
        $num_players = count($players);
        $num_evil = 1;
        $num_good = $num_players - $num_evil;

        $num_hunter = $num_good;
        $requiredRoles = [
            Role::HUNTER => $num_hunter,
            Role::WEREWOLF => $num_evil
        ];

        $rolePool = [];

        for($i=0; $i<$num_evil; $i++) {
            $rolePool[] = new Werewolf();
        }

        for($i=0; $i<$num_good; $i++) {
            $rolePool[] = new Hunter();
        }

        shuffle($rolePool);

        $i = 0;
        foreach ($players as $player) {
            $player->role = $rolePool[$i];
            $i++;
        }

        $this->roleListMsg = "[1 Werewolf, " . $num_good . " Hunters]";

        return $players;
    }
}
