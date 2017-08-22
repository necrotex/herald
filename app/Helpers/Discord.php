<?php

namespace nullx27\Herald\Helpers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;
use NotificationChannels\Discord\Exceptions\CouldNotSendNotification;

class Discord
{

    protected $baseUrl = 'https://discordapp.com/api';

    protected $httpClient;

    protected $token;

    public function __construct(Client $client, $token)
    {
        $this->httpClient = $client;
        $this->token = $token;
    }

    public function request($verb, $endpoint, array $data = [])
    {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');

        try {
            $response = $this->httpClient->request($verb, $url, [
                'headers' => [
                    'Authorization' => 'Bot ' . $this->token,
                ],
                'json' => $data,
            ]);

        } catch (RequestException $exception) {

            if ($response = $exception->getResponse()) {
                throw CouldNotSendNotification::serviceRespondedWithAnHttpError($response);
            }

            throw CouldNotSendNotification::serviceCommunicationError($exception);

        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceCommunicationError($exception);
        }

        $body = json_decode($response->getBody(), true);

        if (Arr::get($body, 'code', 0) > 0) {
            throw CouldNotSendNotification::serviceRespondedWithAnApiError($body);
        }

        return $body;
    }

    public function delete($channel, $message_id)
    {
        return $this->request('DELETE', "/channels/{$channel}/messages/{$message_id}");
    }

    public function update($channel, $message_id, $content, Array $embed = [])
    {
        $data = ['content' => $content, 'embed' => $embed];

        return $this->request('PATCH', "/channels/{$channel}/messages/{$message_id}", $data);
    }

}