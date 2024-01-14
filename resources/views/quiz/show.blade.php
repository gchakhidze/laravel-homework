<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{ $quiz->description }}</p>

                    <button id="startQuiz" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Start Quiz</button>

                    @foreach($quiz->questions->sortBy('position') as $index => $question)
                    <div class="question" data-question-id="{{ $question->id }}" style="display: none;">
                        <p>{{ $question->question }}</p>
                        @if($question->image_link)
                            <img src="{{ $question->image_link }}" alt="Question Image" class="mt-2 mb-4 h-32 object-cover">
                        @endif
                        <div class="flex flex-wrap gap-2">
                            @foreach(json_decode($question->options) as $answer)
                                <button class="answerBtn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" data-answer="{{ $answer }}">{{ $answer }}</button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <p id="result" class="mt-4 text-lg font-semibold" style="display: none;"></p>
                    <button id="finishQuiz" onclick="window.location.href='/quizzes'" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="display: none;">Finish Quiz</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.getElementById('startQuiz').addEventListener('click', function() {
        this.style.display = 'none';
        showQuestion(0);
    });

    let currentQuestionIndex = 0;
    const questions = document.querySelectorAll('.question');
    const totalQuestions = questions.length;
    let correctAnswers = 0;

    function showQuestion(index) {
        questions[index].style.display = 'block';
        if (index > 0) {
            disableButtons(questions[index - 1]);
        }
    }

    function disableButtons(questionElement) {
        const buttons = questionElement.querySelectorAll('button');
        buttons.forEach(button => {
            button.disabled = true;
        });
    }

    document.querySelectorAll('.answerBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const questionId = this.closest('.question').getAttribute('data-question-id');
            const selectedAnswer = this.getAttribute('data-answer');
            checkAnswer(questionId, selectedAnswer, this);
        });
    });

    function checkAnswer(questionId, selectedAnswer, selectedButton) {
        fetch('/api/check-answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({questionId, selectedAnswer})
        })
        .then(response => response.json())
        .then(data => {
            if (data.correct) {
                correctAnswers++;
                selectedButton.classList.remove('bg-gray-300', 'hover:bg-gray-400');
                selectedButton.classList.add('bg-green-500');
            } else {
                selectedButton.classList.remove('bg-gray-300', 'hover:bg-gray-400');
                selectedButton.classList.add('bg-red-500');
            }

            if (currentQuestionIndex < totalQuestions - 1) {
                showQuestion(++currentQuestionIndex);
            } else {
                document.getElementById('result').textContent = `You got ${correctAnswers} out of ${totalQuestions} correct.`;
                document.getElementById('result').style.display = 'block';
                document.getElementById('finishQuiz').style.display = 'block';
            }
        });
    }
</script>