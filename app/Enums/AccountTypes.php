<?php

namespace App;

enum AccountTypes: string
{
    case cash = "cash";
    case bank_account = "bankAccount";
    case credit_card = "creditCard";
    case digital_wallet = "digitalWallet";
}
