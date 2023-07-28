@extends('base')

@section('content')
    <div class="container h-screen mx-auto">
        <ul id="messages" class="p-5 mb-5 overflow-scroll text-lg border border-gray-300 rounded-lg h-3/5"></ul>
        <form action="">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
            <textarea id="text" name="text" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
        </form>
    </div>
@endsection