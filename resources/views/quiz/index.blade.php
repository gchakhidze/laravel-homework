<html>
    <body>
        <div>
            <ul style="display: grid; grid-template-columns: repeat(4, 150px); column-gap: 50px;">
                @foreach($quizzes as $quiz)
                <li>
                    <a href="/quizzes/{{$quiz->id}}">{{ $quiz->name }}, {{ $quiz->created_at }}</a>
                    <img src="{{ $quiz->image }}" alt="quiz" width="100" height="100">
                    <p>{{ $quiz->description }}</p>
                </li>
                @endforeach
            </ul>
            <a href="/quizzes/create">Add new quiz</a>
        </div>
        
    </body>
</html>