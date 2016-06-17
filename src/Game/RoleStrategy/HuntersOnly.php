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

        $num_seer = 0;
        $num_witch = 0;
        $num_hunter = $num_good;

        $requiredRoles = [
            Role::HUNTER => $num_hunter
        ];

        $this->roleListMsg = "Required: [Werewolf, Hunters]";

        $rolePool = [];

        shuffle($rolePool);

        $i = 0;
        foreach ($players as $player) {
            $player->role = $rolePool[$i];
            $i++;
        }

        return $players;
    }
}
