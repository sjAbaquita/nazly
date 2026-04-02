<?php

namespace App\Enums;

enum FriendStatus: string
{
    case Pending = 'pending';
	case Accepted = 'accepted';
	case Denied = 'denied';
	case Blocked = 'blocked';
}
