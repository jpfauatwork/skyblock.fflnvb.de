<?php

namespace App\PublicApi\Playground\Controllers;

use Domain\Playground\Data\CollectibleData;
use Domain\Playground\Data\DropPartyData;
use Spatie\LaravelData\DataCollection;

class PlaygroundController
{
    public function __invoke()
    {

        $collectibles = [
            [
                'type' => 'head',
                'lore' => 'Baby Penguin',
                'amount' => 20,
            ],
            [
                'type' => 'head',
                'lore' => 'Toy Train',
                'amount' => 20,
            ],
            [
                'type' => 'head',
                'lore' => 'Chimney',
                'amount' => 20,
            ],
            [
                'type' => 'head',
                'lore' => 'Tiny Santa',
                'amount' => 20,
            ],
            [
                'type' => 'head',
                'lore' => 'Festive Log',
                'amount' => 20,
            ],
            [
                'type' => 'head',
                'lore' => 'Cozy Crew',
                'amount' => 5,
            ],
            [
                'type' => 'armor',
                'lore' => 'Candy Cane',
                'amount' => 10,
            ],
        ];

        $dropParty = [
            'name' => 'Christmas Drop Party 2022',
            'date' => '2022-12-25T12:00:00Z',
            'collectibles' => $collectibles,
        ];

        dump($dropParty);

        $dropPartyData = DropPartyData::from($dropParty);
        dump($dropPartyData);
        dump($dropPartyData->collectibles->sum('amount'));

        $collectibleDataCollection = CollectibleData::collect($collectibles, DataCollection::class);

        dump($collectibleDataCollection);
        dump($collectibleDataCollection->toCollection()->sum('amount'));
    }
}
