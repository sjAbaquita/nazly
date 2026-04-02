<?php

namespace App\Enums;

enum LikeType: string
{
    case Like = 'like';
	case Heart = 'heart';
	case Haha = 'haha';

	public function icon(): string
    {
        return match($this) {
            self::Like => 'thumbs-up',
            self::Heart => 'heart',
            self::Haha => 'laugh',
        };
    }
}
