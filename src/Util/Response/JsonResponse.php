<?php


namespace Linnzh\HyperfComponent\Util\Response;


use Hyperf\Utils\Codec\Json;

class JsonResponse
{
    private int $code;

    private string $message;

    private mixed $data;

    public function __construct($data = null)
    {
        $this->code = 1;
        $this->message = '';
        $this->data = $data;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

    public function toJson(): string
    {
        return Json::encode($this->toArray());
    }
}