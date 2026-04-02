<?php

namespace App\Enums;

enum PostPrivacy: string
{
    case Public = 'public';
	case Friends = 'friends';
	case Private = 'private';
}
