<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-03 13:11:37 --> Severity: error --> Exception: You cannot use a Stripe token more than once: tok_1GTsyxDNTa6VPb3m7lptlpTn. C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38
ERROR - 2020-04-03 13:15:34 --> Query error: Table 'online_inc.order' doesn't exist - Invalid query: INSERT INTO `order` (`user_id`, `order_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES ('1', 'ONLINE1156598996', '8.99', 'usd', 8.99, 'usd', 'txn_1GTt7CDNTa6VPb3myZlslUfl', 'succeeded', '2020-04-03 13:15:34', '2021-04-03 13:15:34')
ERROR - 2020-04-03 13:15:36 --> Query error: Table 'online_inc.order' doesn't exist - Invalid query: INSERT INTO `order` (`user_id`, `order_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES ('1', 'ONLINE173807980', '8.99', 'usd', 8.99, 'usd', 'txn_1GTt7DDNTa6VPb3m6lb1GhKX', 'succeeded', '2020-04-03 13:15:36', '2021-04-03 13:15:36')
ERROR - 2020-04-03 13:15:51 --> Query error: Table 'online_inc.order' doesn't exist - Invalid query: INSERT INTO `order` (`user_id`, `order_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES ('1', 'ONLINE120683518', '8.99', 'usd', 8.99, 'usd', 'txn_1GTt7TDNTa6VPb3m89Ix2po6', 'succeeded', '2020-04-03 13:15:51', '2021-04-03 13:15:51')
ERROR - 2020-04-03 13:15:53 --> Query error: Table 'online_inc.order' doesn't exist - Invalid query: INSERT INTO `order` (`user_id`, `order_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES ('1', 'ONLINE250973312', '8.99', 'usd', 8.99, 'usd', 'txn_1GTt7VDNTa6VPb3mXcIAUF3R', 'succeeded', '2020-04-03 13:15:53', '2021-04-03 13:15:53')
ERROR - 2020-04-03 13:19:25 --> Severity: Notice --> Undefined variable: token C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 398
ERROR - 2020-04-03 13:19:26 --> Severity: error --> Exception: Cannot charge a customer that has no active card C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38
ERROR - 2020-04-03 13:19:26 --> Severity: Notice --> Undefined variable: token C:\xampp\htdocs\online.inc\application\controllers\Checkout.php 398
ERROR - 2020-04-03 13:19:27 --> Severity: error --> Exception: Cannot charge a customer that has no active card C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38
ERROR - 2020-04-03 13:21:27 --> Severity: error --> Exception: Cannot charge a customer that has no active card C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38
ERROR - 2020-04-03 13:21:28 --> Severity: error --> Exception: Cannot charge a customer that has no active card C:\xampp\htdocs\online.inc\application\third_party\stripe\lib\Exception\ApiErrorException.php 38