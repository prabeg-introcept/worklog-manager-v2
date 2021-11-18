<?php

namespace App\Http\Requests;

use App\Constants\DbTables;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWorklogRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:255'],
            'user_id' => [sprintf('exists:%s,id', DbTables::USERS)]
        ];
    }
}
