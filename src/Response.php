<?php

namespace Vdhicts\MicroserviceClient;

use stdClass;

class Response
{
    /**
     * @var bool
     */
    private $success;

    /**
     * @var string
     */
    private $error;

    /**
     * @var array
     */
    private $validationErrors = [];

    /**
     * @var stdClass|null
     */
    private $data;

    /**
     * Response constructor.
     *
     * @param bool $success
     * @param null|string $error
     * @param array $validationErrors
     * @param null|stdClass $data
     */
    public function __construct(bool $success = false, string $error = '', array $validationErrors = [], $data = null)
    {
        $this->success = $success;
        $this->error = $error;
        $this->validationErrors = $validationErrors;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return array
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }

    /**
     * @return null|stdClass
     */
    public function getData(): ?stdClass
    {
        return $this->data;
    }

    /**
     * Transform the response to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'success'           => $this->success,
            'error'             => $this->error,
            'validation_errors' => $this->validationErrors,
            'data'              => $this->data,
        ];
    }
}
