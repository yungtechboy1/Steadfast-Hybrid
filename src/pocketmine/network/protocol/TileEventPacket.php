<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\protocol;

use pocketmine\utils\Binary;










class TileEventPacket extends DataPacket{
	public static $pool = [];
	public static $next = 0;

	public $x;
	public $y;
	public $z;
	public $eid;
	public $yaw;
	public $pitch;
	public $bodyYaw;
	public $teleport;
	public $flags;
	public $case1;
	public $case2;

	public function pid(){
		return Info::TILE_EVENT_PACKET;
	}

	public function decode(){
		$this->eid = (\PHP_INT_SIZE === 8 ? \unpack("N", $this->get(4))[1] << 32 >> 32 : \unpack("N", $this->get(4))[1]);
		$this->x = (\ENDIANNESS === 0 ? \unpack("f", $this->get(4))[1] : \unpack("f", \strrev($this->get(4)))[1]);
		$this->y = (\ENDIANNESS === 0 ? \unpack("f", $this->get(4))[1] : \unpack("f", \strrev($this->get(4)))[1]);
		$this->z = (\ENDIANNESS === 0 ? \unpack("f", $this->get(4))[1] : \unpack("f", \strrev($this->get(4)))[1]);
		$this->yaw = (\ENDIANNESS === 0 ? \unpack("f", $this->get(4))[1] : \unpack("f", \strrev($this->get(4)))[1]);
		$this->pitch = (\ENDIANNESS === 0 ? \unpack("f", $this->get(4))[1] : \unpack("f", \strrev($this->get(4)))[1]);
		$this->bodyYaw = (\ENDIANNESS === 0 ? \unpack("f", $this->get(4))[1] : \unpack("f", \strrev($this->get(4)))[1]);
		$flags = \ord($this->get(1));
		$this->teleport = (($flags & 0x80) > 0);
	}

	public function encode(){
		$this->reset();
		$this->buffer .= \pack("N", $this->x);
		$this->buffer .= \pack("N", $this->y);
		$this->buffer .= \pack("N", $this->z);
		$this->buffer .= \pack("N", $this->case1);
		$this->buffer .= \pack("N", $this->case2);
	}

}
