<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Task</title>

    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="page-container">

        <header class="top-bar">

            <div>
                <h1>Create New Task</h1>
            </div>

            <a href="{{ route('tasks.index') }}" class="back-button">
                ← Task List
            </a>

        </header>


        <main class="form-section">

            <div class="form-heading">
                <h2>Task Information</h2>
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
                action="{{ route('tasks.store') }}"
                method="POST"
            >

                @csrf


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
                            value="{{ old('task_name') }}"
                            placeholder="Example: Finish project"
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
                            value="{{ old('due_date') }}"
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
                                {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Completed"
                                {{ old('status') === 'Completed' ? 'selected' : '' }}
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
                            placeholder="Describe what needs to be done..."
                        >{{ old('description') }}</textarea>

                    </div>

                </div>


                <!-- FORM ACTIONS -->

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
                        Create Task
                    </button>

                </div>

            </form>

        </main>

    </div>

</body>

</html>