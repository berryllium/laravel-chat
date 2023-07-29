@extends('base')

@section('content')
    <form class="search flex justify-center m-2">
        <input type="search" name="q" value="{{ request()->get('q') }}" class="flex-1">
        <input type="submit" value="Search" class="button">
    </form>
    @foreach($users as $user)
        <a href="{{ route('chat.dialog', ['id' => $user->id]) }}" class="block p-2 m-2 border border-gray-300">{{ $user->name }} ({{ $user->email }})</a>
    @endforeach
@endsection