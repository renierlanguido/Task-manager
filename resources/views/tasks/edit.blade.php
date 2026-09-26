<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task</title>

    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="page-container">

        <header class="top-bar">

            <div>
                <h1>Edit Task</h1>
            </div>

            <a href="{{ route('tasks.index') }}" class="back-button">
                ← Task List
            </a>

        </header>


        <main class="form-section">

            <div class="form-heading">

                <h2>Update Task Details</h2>
                <hr>

            </div>


            @if ($errors->any())

                <div class="error-message">

                    <strong>Please check the following:</strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                action="{{ route('tasks.update', $task->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="form-grid">

                    <!-- TASK NAME -->

                    <div class="form-group">

                        <label for="task_name">
                            Task Name
                        </label>

                        <input
                            type="text"
                            id="task_name"
                            name="task_name"
                            value="{{ old('task_name', $task->task_name) }}"
                            required
                        >

                    </div>


                    <!-- DUE DATE -->

                    <div class="form-group">

                        <label for="due_date">
                            Due Date
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label for="status">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                        >

                            <option
                                value="Pending"
                                {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Completed"
                                {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}
                            >
                                Completed
                            </option>

                        </select>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group full-width">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe the task..."
                        >{{ old('description', $task->description) }}</textarea>

                    </div>

                </div>


                <!-- ACTION BUTTONS -->

                <div class="form-buttons">

                    <a
                        href="{{ route('tasks.index') }}"
                        class="cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="save-button"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </main>

    </div>

</body>

</html>