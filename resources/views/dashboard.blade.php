<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white ">
        <div class="p-6 text-gray-900">
            <div class="chat">
                <ul id="messages" class="p-5 mb-5 overflow-y-auto text-lg border border-gray-300 rounded-lg h-3/5"></ul>
                <form action="">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
                    <textarea id="text" name="text" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
