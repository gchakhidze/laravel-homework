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
                        <strong>Image:</strong>
                        <input type="text" name="image" value="{{ $quiz->image }}"
                            placeholder="quiz image">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Status:</strong>
                        <input type="text" name="status" value="{{ $quiz->status }}"
                            placeholder="quiz status">
                    </div>
                </div>
                <button type="submit">Update</button>
            </div>
        </form>
        </div>
    </body>
</html>