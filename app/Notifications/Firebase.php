<?php

namespace App\Notifications;

use Exception;
use Google\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Firebase
{
    private static $client;

    private static function response($success, $message, $data = []): array
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }

    public static function send($notificationToken, $title, $body, $data = [], $debug = [])
    {
        $data = (object)array_map('strval', $data);

        if (!self::$client) {
            $credentialsFilePath = Storage::path('json/firebase_credentials.json');
            self::$client = new Client();
            self::$client->setAuthConfig($credentialsFilePath);
            self::$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            // self::$client->refreshTokenWithAssertion();
            self::$client->fetchAccessTokenWithAssertion();
        }

        try {

            $token = self::$client->getAccessToken();
            $accessToken = $token['access_token'];
            $projectId = env('PROJECT_ID');
            $headers = [
                "Authorization" => "Bearer $accessToken",
                'Content-Type' => 'application/json'
            ];

            $payload = [
                "message" => [
                    "token" => $notificationToken,
                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                    ],
                    "data" => $data
                ]
            ];

            $response = Http::
                withHeaders($headers)
                ->post(
                    "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
                    $payload
                );

            if ($response->failed()):
                Log::debug('send notification:', array_merge([
                    'success' => false,
                    'time' => date('Y-m-d H:i:s'),
                    'notificationToken' => $notificationToken,
                ]), $debug);
                return self::response(false, 'HTTP Error: ' . $response->body());
            else:
                Log::debug('send notification:', array_merge([
                    'success' => true,
                    'time' => date('Y-m-d H:i:s'),
                    'notificationToken' => $notificationToken,
                ]), $debug);
                return self::response(true, 'Notification has been sent', $response->json());
            endif;
        } catch (Exception $ex) {
            return self::response(false, 'Exception: ' . $ex->getMessage());
        }
    }
}
