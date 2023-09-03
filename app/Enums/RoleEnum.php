<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'Admin';
    case CHEF = 'Chef';
    case WAITER = 'Waiter';

    case CASHIER = 'Cashier';

}
