<?php

namespace Hexagonal\Task\Adapter;


use Hexagonal\Common\Validator;
use Valitron\Validator as V;

class TaskValitronValidator implements Validator
{

    private static $rules = [
        'description' => ['required', ['lengthMin', 5]]
    ];

    /**
     * @var Validator
     */
    private $validator;

    /**
     * TaskValidator constructor.
     */
    public function __construct()
    {
        $this->validator = (new V([]));
        $this->validator->mapFieldsRules(static::$rules);
    }

    /**
     * @param array $assoc
     * @return bool
     */
    public function isValidFromAssoc(array $assoc)
    {
        $this->validator = $this->validator->withData($assoc);
        return $this->validator->validate();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}