<?php

namespace App\Enums;

enum TaskStatus : string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in progress';
    case BLOCKED = 'blocked';
    case COMPLETED = 'completed';
    case CLOSED = 'closed';
    case CANCELLED = 'cancelled';

    public function label() {
        return match($this) {
            self::OPEN => 'Mở',
            self::IN_PROGRESS => 'Đang tiến hành',
            self::BLOCKED => 'Đã chặn',
            self::COMPLETED => 'Đã hoàn thành',
            self::CLOSED => 'Đã đóng',
            self::CANCELLED => 'Đã hủy'
        };
    }

    public static function values() {
        return array_column(self::cases(), 'value');
    }
}
