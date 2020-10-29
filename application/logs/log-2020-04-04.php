<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-04 03:37:41 --> Severity: error --> Exception: You cannot use a Stripe token more than once: tok_1GU6ZJDNTa6VPb3m3bcOc9Cy. C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38
ERROR - 2020-04-04 03:40:57 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 360
ERROR - 2020-04-04 03:40:57 --> Severity: Notice --> Undefined index: email C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 361
ERROR - 2020-04-04 03:40:59 --> Query error: Unknown column 'name' in 'field list' - Invalid query: INSERT INTO `orders` (`name`, `user_id`, `email`, `card_num`, `card_cvc`, `card_exp_month`, `card_exp_year`, `item_name`, `order_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES (NULL, 1, NULL, '4242424242424242', '123', '12', '2020', 'ONLINE.INC ORDER', 'ONLINE285706345', '8.99', 'usd', 8.99, 'usd', 'txn_1GU6cgDNTa6VPb3mXJbuLnN7', 'succeeded', '2020-04-04 03:40:59', '2020-04-04 03:40:59')
ERROR - 2020-04-04 03:43:01 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 360
ERROR - 2020-04-04 03:43:01 --> Severity: Notice --> Undefined index: email C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 361
ERROR - 2020-04-04 03:44:18 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 360
ERROR - 2020-04-04 03:44:56 --> Severity: Notice --> Undefined index: name C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 360
ERROR - 2020-04-04 03:52:53 --> Severity: error --> Exception: You cannot use a Stripe token more than once: tok_1GU6lyDNTa6VPb3mrHl6AEwp. C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38
ERROR - 2020-04-04 10:01:13 --> 404 Page Not Found: Account/paymentProcess
