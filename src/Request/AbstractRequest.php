<?php


namespace Linnzh\HyperfComponent\Request;


abstract class AbstractRequest extends \Hyperf\Validation\Request\FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

        ];
    }
}
