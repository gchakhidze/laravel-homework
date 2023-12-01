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
                        <strong>Image:</strong>
                        <input type="text" name="image" placeholder="quiz image">
                    </div>
                </div>
                <div>
                    <div>
                        <strong>Status:</strong>
                        <input type="text" name="status" placeholder="quiz status">
                    </div>
                </div>
                <button type="submit">Create</button>
            </div>
        </form>
        </div>
    </body>
</html>