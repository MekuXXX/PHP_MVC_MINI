<?php

namespace App\Core\Form;

use App\Core\Model;

class FormField
{
    protected string $attribute;
    protected Model $model;
    protected FORM_TYPE $type;

    public function __construct(Model $model, string $attribute, FORM_TYPE $type = FORM_TYPE::TEXT)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
    }

    public function __toString(): string
    {
        $value = $this->model->{$this->attribute} ?? '';
        $error = $this->model->hasError($this->attribute) ? "<p class=\"text-sm text-red-600 mt-0\">{$this->model->getFirstError($this->attribute)}</p>" : '';
        
        return sprintf('
            <div class="w-full flex flex-col">
                <label class"text-sm font-bold">%s</label>
                <input type="%s" name="%s" value="%s" class="min-h-[35px] px-4"/>
                %s
            </div>
        ',
        
        ucwords($this->model->getLabel($this->attribute)),
        $this->type->type(),
        $this->attribute,
        htmlspecialchars($value, ENT_QUOTES, 'UTF-8'),
        $error);
    }

    public function setPassword(): void
    {
        $this->type = FORM_TYPE::PASSWORD;
    }
}