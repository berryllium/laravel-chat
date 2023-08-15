@extends('base')

@section('content')
    <div class="container h-screen mx-auto">
        <div class="nav flex p-6">
            <a href="{{ route('chat.index') }}">&#8592;</a>
            <div class="name flex-1 text-center -ml-2"><span>{{ $contact->name }}</span></div>
        </div>
        <div class="p-6 text-gray-900">
            <div id="chat" class="chat" data-socket-url="{{ env('APP_URL') }}:3000">
                <ul id="messages" class="p-5 mb-5 overflow-y-auto text-lg border border-gray-300 h-4/5 bg-white">
                    @foreach($messages as $message)
                        <li data-id="{{ $message->id }}" class="{{ $message->from == $contact->id ? 'left' : 'right' }}">{{ $message->message }}</li>
                    @endforeach
                </ul>
                <form id="sendForm" class="flex justify-center" data-from="{{ auth()->user()->id }}" data-to="{{ $contact->id }}" data-csrf="{{ csrf_token() }}">
                    <textarea id="text" name="text" rows="2" class="block outline-none p-2.5 w-full text-gray-900 bg-gray-50 border border-gray-300 focus:border-blue-500 flex-1 text-base" placeholder="Write your thoughts here..."></textarea>
                    <input type="submit" value="Send" class="button" id="sendButton">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/chat.js')
@endsection