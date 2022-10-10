<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateBookAPIRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'subtitle' => ['nullable'],
            'year_published' => ['integer', 'min_digits:4', 'max_digits:4'],
            'edition' => ['nullable','integer'],
            'isbn_10' => ['nullable','max:10', 'min:10'],
            'isbn_13' => ['nullable','min:13', 'max:13'],
            'genre' => ['nullable', 'max:32'],
            'sub_genre' => ['nullable', 'max:32'],
            'height' => ['integer', 'nullable'],
            'family_or_corporate_name' => ['string', "nullable"],
            'given_name' => ['nullable', 'string',],
            'authors' => ['nullable'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ]));
    }

    public function messages(): array
    {
        return [
            'title' => 'A title is required',
            'year_published' => 'The entered year has to be a number and 4 digits longs',
            'isbn_10' => 'This has to be a 10 digit number',
            'isbn_13' => 'This has to be a 13 digit number',
            'genre' => "Doesn't have to filled. If filled the genre can be maximum length of 32",
            'sub_genre' => "Doesn't have to filled. If filled the genre can be maximum length of 32",
            'height' => 'Height has to be a number.',
            'family_or_corporate_name' => "Need to be string and is required",
            'given_name' => "Testing"
        ];
    }
}
