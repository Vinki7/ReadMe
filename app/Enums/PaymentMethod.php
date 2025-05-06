<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CreditCard = 'credit card';
    case DebitCard = 'debit card';
    case PayPal = 'paypal';
    case BankTransfer = 'bank transfer';
    case CashOnDelivery = 'cash on delivery';
}
