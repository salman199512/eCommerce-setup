<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PhonePeService
{
    private $merchantId;
    private $saltKey;
    private $saltIndex;
    private $baseUrl;
    private $client;

    public function __construct()
    {
        $this->merchantId = config('services.phonepe.merchant_id');
        $this->saltKey = config('services.phonepe.salt_key');
        $this->saltIndex = config('services.phonepe.salt_index');
        $this->baseUrl = config('services.phonepe.base_url');
        $this->client = new Client();
    }

    public function initiatePayment($orderData)
    {
        $payload = [
            'merchantId' => $this->merchantId,
            'merchantTransactionId' => $orderData['transaction_id'],
            'merchantUserId' => $orderData['user_id'],
            'amount' => 1 * 100, // Amount in paisa
            'redirectUrl' => 'https://ramdevoils.com/payment/success',
            'redirectMode' => 'POST',
            'callbackUrl' => 'https://ramdevoils.com/payment/callback',
            'mobileNumber' => $orderData['mobile'],
            'paymentInstrument' => [
                'type' => 'PAY_PAGE'
            ]
        ];

        $jsonPayload = json_encode($payload);
        $base64Payload = base64_encode($jsonPayload);

        $checksum = hash('sha256', $base64Payload . '/pg/v1/pay' . $this->saltKey) . '###' . $this->saltIndex;

        try {
            $response = $this->client->post('https://api.phonepe.com/apis/pg/checkout/v2/pay', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $checksum,
                    'accept' => 'application/json'
                ],
                'json' => [
                    'request' => $base64Payload
                ]
            ]);
dd($response);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            dd($e);
            Log::error('PhonePe Payment Initiation Error: ' . $e);
            return false;
        }
    }

    public function verifyPayment($merchantTransactionId)
    {
        $checksum = hash('sha256', '/pg/v1/status/' . $this->merchantId . '/' . $merchantTransactionId . $this->saltKey) . '###' . $this->saltIndex;

        try {
            $response = $this->client->get($this->baseUrl . '/pg/v1/status/' . $this->merchantId . '/' . $merchantTransactionId, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $checksum,
                    'X-MERCHANT-ID' => $this->merchantId,
                    'accept' => 'application/json'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('PhonePe Payment Verification Error: ' . $e->getMessage());
            return false;
        }
    }

    public function validateCallback($response, $checksum)
    {
        $calculatedChecksum = hash('sha256', $response . $this->saltKey) . '###' . $this->saltIndex;
        return $calculatedChecksum === $checksum;
    }
}
