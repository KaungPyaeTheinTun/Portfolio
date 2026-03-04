<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only allow logged-in users to update
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'technologies' => ['required', 'string'],
            'screenshot'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'github_link'  => ['nullable', 'url', 'max:255'],
            'live_demo'    => ['nullable', 'url', 'max:255'],
            'is_featured'  => ['nullable', 'boolean'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
        ];
    }
}