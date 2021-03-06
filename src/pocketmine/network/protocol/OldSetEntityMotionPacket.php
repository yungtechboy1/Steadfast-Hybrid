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










class OldSetEntityMotionPacket extends DataPacket{
	public static $pool = [];
	public static $next = 0;


	// eid, motX, motY, motZ
	/** @var array[] */
	public $entities = [];

	public function pid(){
		return OldInfo::SET_ENTITY_MOTION_PACKET;
	}

	public function clean(){
		$this->entities = [];
		return parent::clean();
	}

	public function decode(){

	}

	public function encode(){
		$this->reset();
		$this->buffer .= \pack("N", \count($this->entities));
		foreach($this->entities as $d){
			$this->buffer .= \pack("N", $d[0]); //eid
			$this->buffer .= \pack("n", (int) ($d[1] * 8000)); //motX
			$this->buffer .= \pack("n", (int) ($d[2] * 8000)); //motY
			$this->buffer .= \pack("n", (int) ($d[3] * 8000)); //motZ
		}
	}

}
