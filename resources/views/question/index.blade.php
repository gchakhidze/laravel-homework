<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($questions as $question)
                        <div class="border rounded-lg p-4">
                            <div class="font-bold text-lg">{{ $question->quiz->name }}</div>
                            <div class="text-sm text-gray-600">{{ $question->question }}</div>
                            @if($question->image_link)
                                <img src="{{ $question->image_link }}" alt="Question Image" class="mt-2 rounded w-full h-32 object-cover">
                            @endif
                            <div class="text-sm text-gray-600">Position: {{ $question->position }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/questions/create" class="text-blue-900 dark:text-blue-500 hover:underline">Create Question</a>
        </div>
    </div>
</x-app-layout>