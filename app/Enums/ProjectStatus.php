<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
    case IN_PROGRESS = 'in_progress';
    case BLOCKED = 'blocked';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'ccompleted';

    public function label()
    {
        return match ($this) {
            self::OPEN => 'Mở',
            self::CLOSED => 'Đã đóng',
            self::IN_PROGRESS => 'Đang tiến hành',
            self::BLOCKED => 'Đã chặn',
            self::CANCELLED => 'Đã hủy',
            self::COMPLETED => 'Đã hoàn thành'
        };
    }

    public static function values(){
        return array_column(self::cases(), 'value');
    }
}
