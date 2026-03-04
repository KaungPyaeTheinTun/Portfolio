<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool {  return Auth::check(); }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'technologies' => ['required', 'string'],
            'screenshot'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'github_link'  => ['nullable', 'url', 'max:255'],
            'live_demo'    => ['nullable', 'url', 'max:255'],
            'is_featured'  => ['boolean'],
            'sort_order'   => ['integer', 'min:0'],
        ];
    }
}