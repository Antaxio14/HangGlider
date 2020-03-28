<?php

namespace AntaxioYT\HangGlider;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Effect;
use pocketmine\entity\Entity;
use pocketmine\entity\Attribute;
use pocketmine\entity\EffectInstance;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerItemHeldEvent;

class HangGlider extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
 
    public function ItemHeld(PlayerItemHeldEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem();
        if($item->getId() == Item::SLIME_BALL){
            $eff = new EffectInstance(Effect::getEffect(Effect::LEVITATION), 100 * 99999, -4, true);
            $player->addEffect($eff);
        } else if (($player->hasEffect(Effect::LEVITATION)) and (!$item->getId() == Item::SLIME_BALL)){
            $player->removeEffect(24);
        } else {
            $player->removeEffect(24);
        } 
    }

    public function onDamage(EntityDamageEvent $event){
        $player = $event->getEntity();
        if($player instanceof Player){
            if($event->getEntity()->getInventory()->getItemInHand()->getId() === 341){
                if ($event->getCause() === EntityDamageEvent::CAUSE_FALL){
                    $event->setCancelled();
    
                }
            }
        }
    } 

    public function Leave(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if($item->getId() == Item::SLIME_BALL){
            $player->removeEffect(24);
        }
    }

} 
