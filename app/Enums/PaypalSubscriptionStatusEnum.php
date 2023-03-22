<?php

namespace App\Enums;

enum PaypalSubscriptionStatusEnum: string
{
    case APPROVAL_PENDING = 'APPROVAL_PENDING';
    case APPROVED = 'APPROVED';
    case ACTIVE = 'ACTIVE';
    case SUSPENDED = 'SUSPENDED';
    case EXPIRED = 'EXPIRED';
    case CANCELLED = 'CANCELLED';


    public function toString(): string
    {
        return match ($this) {
            self::APPROVAL_PENDING => 'Approval Pending',
            self::APPROVED => 'Approved',
            self::ACTIVE => 'Active',
            self::SUSPENDED => 'Suspended',
            self::EXPIRED => 'Expired',
            self::CANCELLED => 'Cancelled',
        };
    }


    public function isActive(){
        return $this == self::ACTIVE;
    }


}