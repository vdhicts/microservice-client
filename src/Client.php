<?php

namespace Vdhicts\MicroserviceClient;

use GuzzleHttp\Exception\GuzzleException;
use stdClass;
use Vdhicts\MicroserviceClient\Exceptions\MicroserviceClientException;

class Client
{
    const MICROSERVICES_URL = 'https://microservices.vdhicts.nl';

    /**
     * The optional API key.
     *
     * @var string
     */
    private $token;

    /**
     * Client constructor.
     *
     * @param string|null $token
     */
    public function __construct(string $token = null)
    {
        $this->token = $token;
    }

    /**
     * Builds the request options for the provided parameters.
     *
     * @param array $parameters
     * @return array
     */
    private function buildRequestOptions(array $parameters = []): array
    {
        $options = [];

        if (! is_null($this->token)) {
            $options['headers'] = [
                'X-Api-Key' => $this->token,
            ];
        }

        if (count($parameters) !== 0) {
            $options['query'] = $parameters;
        }

        return $options;
    }

    /**
     * Retrieve the data from the microservice endpoint.
     *
     * @param string $endpoint
     * @param array $parameters
     * @return Response
     * @throws MicroserviceClientException
     */
    public function get(string $endpoint, array $parameters = []): Response
    {
        // Endpoint is required
        if (strlen(trim($endpoint)) === 0) {
            throw MicroserviceClientException::invalidEndpoint($endpoint);
        }

        // Perform request
        $client = new \GuzzleHttp\Client();
        try {
            $url = sprintf('%s/%s', self::MICROSERVICES_URL, $endpoint);
            $options = $this->buildRequestOptions($parameters);

            $response = $client->request('GET', $url, $options);
        } catch (GuzzleException $e) {
            throw MicroserviceClientException::unableToPerformRequest($endpoint, $e->getMessage());
        }

        // Server error
        if ($response->getStatusCode() >= 500) {
            throw MicroserviceClientException::serverError(
                $endpoint,
                $response->getStatusCode(),
                $response->getReasonPhrase()
            );
        }

        return $this->buildResponse(json_decode($response->getBody()));
    }

    /**
     * Builds the response object from the HTTP request.
     *
     * @param stdClass $responseData
     * @return Response
     */
    private function buildResponse(stdClass $responseData): Response
    {
        $success = $responseData->success;
        $error = isset($responseData->error)
            ? $responseData->error
            : '';
        $validationErrors = isset($responseData->validation_errors)
            ? $responseData->validation_errors
            : [];
        $data = isset($responseData->data)
            ? $responseData->data
            : null;

        return new Response($success, $error, $validationErrors, $data);
    }
}
