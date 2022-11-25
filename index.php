<?php

// Include autoload file.
require __DIR__ . '/vendor/autoload.php';

// Import Invoice client class.
use BTCPayServer\Client\Invoice;
use BTCPayServer\Client\InvoiceCheckoutOptions;
use BTCPayServer\Util\PreciseNumber;

// Fill in with your BTCPay Server data.
$apiKey = '';
$host = '';
$storeId = '';
$amount = 5.15 + mt_rand(0, 20);
$currency = 'USD';
$orderId = 'Test39939' . mt_rand(0, 1000);
$buyerEmail = 'john@example.com';

// Create a basic invoice.
try {
    $client = new Invoice($host, $apiKey);
    $invoice = $client->createInvoice(
            $storeId,
            $currency,
            PreciseNumber::parseString($amount),
            $orderId,
            $buyerEmail
    );

    echo "<pre>";
    echo "invoice data: \n";
    var_dump($invoice);

    echo "redirect link: \n";
    var_dump($invoice->getData()['checkoutLink']);
    echo "</pre>";
} catch (\Throwable $e) {
    echo "Error on request: \n";
    echo "Error code: " . $e->getCode();
    echo "<pre>";
    var_dump($e->getTrace());
    echo "</pre>";
}
