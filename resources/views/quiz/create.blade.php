<html>
    <body>
        <div class="container">
            <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div>
                <div>
                    <div>
                        <strong>Name:</strong>
                        <input type="text" name="name" placeholder="quiz name">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Description:</strong>
                        <input type="description" name="description" placeholder="quiz description">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Assignee:</strong>
                        <input type="text" name="assignee" placeholder="quiz assignee">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Score:</strong>
                        <input type="text" name="score" placeholder="quiz score">
                    </div>
                </div>
                <button type="submit">Create</button>
            </div>
        </form>
        </div>
    </body>
</html>