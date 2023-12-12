<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class QuestionUpdateRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => "string|required|max:255",
            'slug' => "string|required|max:255|unique:questions,slug,{$this->question->id}",
            'description' => "string|nullable|max:5000",
            'options' => "array|required",
            'answer' => "string|required|max:255",
            "weightage" => "required|integer|min:10",
            "status" => "boolean|nullable"
        ];
    }

    public function passedValidation(): array
    {
        return [
            function (Validator $validator) {
                if (!in_array($this->answer,$this->options)) {
                    $validator->errors()->add(
                        'answer',
                        'Answer must be from one of the option'
                    );
                }
            }
        ];
    }
}
