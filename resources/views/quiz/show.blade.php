<html>
    <body>
        <div class="container">
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <div>
                    <div>
                        <strong>Name:</strong>
                        <input type="text" name="name" value="{{ $quiz->name }}"
                            placeholder="quiz name">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Description:</strong>
                        <input type="description" name="description" placeholder="quiz description"
                            value="{{ $quiz->description }}">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Assignee:</strong>
                        <input type="text" name="assignee" value="{{ $quiz->assignee }}"
                            placeholder="quiz assignee">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Score:</strong>
                        <input type="text" name="score" value="{{ $quiz->score }}"
                            placeholder="quiz score">
                    </div>
                </div>
                <button type="submit">Update</button>
            </div>
        </form>
        </div>
    </body>
</html>