<?php

class Validator
{
    private $errors = [];

    public function __construct(protected array $data, protected array $rules = [])
    {
        $this->validate();
    }

    public function validate(): void
    {
        foreach ($this->rules as $field => $rule) {
           $value = trim($this->data[$field] ?? null);
           $rules = explode('|', $rule);

           foreach ($rules as $rule) {
              [$name, $param] = array_pad(explode(':', $rule), 2, null);

              $error = match ($name) {
                  'required' => empty($value) ? "$field es obligatorio." : null,
                  'min' => strlen($value) < $param ? "$field debe tener al menos $param caracteres."                        : null,
                  'max' => strlen($value) > $param ? "$field no puede tener más de $param caracteres."                      : null,
                  'url' => !filter_var($value, FILTER_VALIDATE_URL) ? "$field debe ser una URL válida."                     : null,
                  'email' => !filter_var($value, FILTER_VALIDATE_EMAIL) ? "$field debe ser un correo electrónico válido."   : null,
                  default => null,
              };

              if ($error) {
                  $this->errors[] = $error;
                  break;
              }
           }
        }
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

}