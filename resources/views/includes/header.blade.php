<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel chat</title>
    @vite('resources/css/app.css')
</head>
<body>
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{ __('Log Out') }}
    </button>
</form>