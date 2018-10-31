<?php

namespace Vdhicts\MicroserviceClient\Exceptions;

use Exception;

class MicroserviceClientException extends Exception
{
    /**
     * @param string $endpoint
     * @return MicroserviceClientException
     */
    public static function invalidEndpoint(string $endpoint): MicroserviceClientException
    {
        return new self(
            sprintf(
                'Invalid endpoint provided `%s`',
                $endpoint
            )
        );
    }

    /**
     * @param string $endpoint
     * @param string $error
     * @return MicroserviceClientException
     */
    public static function unableToPerformRequest(string $endpoint, string $error): MicroserviceClientException
    {
        return new self(
            sprintf(
                'Unable to perform the request for endpoint `%s` with error `%s`.',
                $endpoint,
                $error
            )
        );
    }

    /**
     * @param string $endpoint
     * @param int $statusCode
     * @param string $reasonPhrase
     * @return MicroserviceClientException
     */
    public static function serverError(string $endpoint, int $statusCode, string $reasonPhrase): MicroserviceClientException
    {
        return new self(
            sprintf(
                'Server error occurred for endpoint `%s` with status code `%d` and message `%s`.',
                $endpoint,
                $statusCode,
                $reasonPhrase
            )
        );
    }
}
