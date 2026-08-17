<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormProcessor extends Controller
{
    public function index()
    {
        return view('formprocessor');
    }

    public function store(Request $request)
    {
        $userData = [
            'name' => $request->user_name,
            'last name' => $request->user_lastname,
            'E-mail' => $request->user_email
        ];
        return response()->json($userData);
    }

    public function showStore(Request $request)
    {
        $userData = [
            'name' => $request->user_name,
            'last_name' => $request->user_lastname,
            'email' => $request->user_email
        ];

        return view('hello-user', ['users' => $userData]);
    }
}
