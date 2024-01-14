<html>
    <body>
        
        <div class="container">
            <h2>Create a New Question</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            
            <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="quiz_id">Select Quiz:</label>
                    <select class="form-control" id="quiz_id" name="quiz_id">
                        @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" class="form-control" id="question" name="question" required>
                </div>

                <div class="form-group">
                    <label for="image_link">Image Link:</label>
                    <input type="text" class="form-control" id="image_link" name="image_link">
                </div>

                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" class="form-control" id="position" name="position">
                </div>

                <div class="form-group">
                    <label>Optional Answers:</label>
                    <input type="text" class="form-control mb-2" name="options[]" required>
                    <input type="text" class="form-control mb-2" name="options[]" required>
                    <input type="text" class="form-control mb-2" name="options[]" required>
                    <input type="text" class="form-control mb-2" name="options[]" required>
                </div>

                <div class="form-group">
                    <label for="correct">Correct Answer:</label>
                    <input type="text" class="form-control" id="correct" name="correct" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Question</button>
            </form>
        </div>
    </body>
</html>