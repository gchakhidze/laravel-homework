<html>
    <body>
        <div class="container">
            <ul>
                @foreach($quizzes as $quiz)
                <li>
                    <a href="/quizzes/{{$quiz->id}}">name: {{ $quiz->name }}</a>
                </li>
                @endforeach
            </ul>
            <a href="/quizzes/create">Add</a>
        </div>
        
    </body>
</html>