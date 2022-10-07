<?php

declare(strict_types=1);

namespace HenryDM\BetterJoin\Utils;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

use pocketmine\world\Position;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use ReflectionClass;

class PluginUtils {

	public static function PlaySound(Player $player, string $sound, $volume = 1, $pitch = 1) {
		$packet = new PlaySoundPacket();
		$packet->x = $player->getPosition()->getX();
		$packet->y = $player->getPosition()->getY();
		$packet->z = $player->getPosition()->getZ();
		$packet->soundName = $sound;
		$packet->volume = 1;
		$packet->pitch = 1;
		$player->getNetworkSession()->sendDataPacket($packet);
	}
}