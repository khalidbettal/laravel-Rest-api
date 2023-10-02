<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
               'title' => 'sometimes|required',
                'is_done' => 'sometimes|required|boolean',
                'project_id' => [
                    'nullable',
                    Rule::exists('projects', 'id')->where(function ($query) {
                        $query->where('creator_id', Auth::id());
                    }),
                ],
        ];
    }
}
