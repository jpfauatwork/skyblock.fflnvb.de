<?php

namespace Domain\Rares\Enums;

enum CollectibleTypeEnum: string
{
    case BLOCK = 'block';
    case HEAD = 'head';
    case POTION = 'armor';
    case TOOL = 'tool';
}
