<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quizzes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($quizzes as $quiz)
                        <div class="border rounded-lg p-4">
                            <a href="/quizzes/{{$quiz->id}}" class="text-lg font-semibold text-blue-900 hover:text-blue-700">{{ $quiz->name }}</a>
                            <div class="text-sm text-gray-600">Created at: {{ $quiz->created_at->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-600">Questions: {{ $quiz->questions_count }}</div>
                            <img src="{{ $quiz->main_image_link }}" alt="quiz" class="mt-2 rounded w-full h-32 object-cover">

                            @if(auth()->check() && auth()->id() == 1)
                            <form action="{{ route('quizzes.togglePublish', $quiz->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="mt-2 p-2 bg-green-500 text-white rounded hover:bg-green-700">
                                    {{ $quiz->published ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                            @endif

                            @if(auth()->check() && auth()->id() == $quiz->author_id)
                            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST"  class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-2 p-2 bg-red-500 text-white rounded hover:bg-red-700">Delete</button>
                            </form>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/quizzes/create" class="text-blue-900 dark:text-blue-500 hover:underline">Create Quiz</a>
        </div>
    </div>
</x-app-layout>
