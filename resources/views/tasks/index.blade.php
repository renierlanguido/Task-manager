<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Manager</title>

    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="page-container">

        <!-- TOP BAR -->

        <header class="top-bar">

            <div>
                <h1>Task Manager</h1>
                <p>Manage and organize your tasks.</p>
            </div>

            <a href="{{ route('tasks.create') }}" class="create-button">
                + Create Task
            </a>

        </header>


        <!-- SUCCESS MESSAGE -->

        @if (session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        <!-- TASK CONTENT -->

        <main class="task-container">

            <div class="task-header">

                <div>
                    <h2>All Tasks</h2>

                    <p>
                        Total tasks:
                        <strong>{{ $tasks->count() }}</strong>
                    </p>
                </div>

            </div>


            @if ($tasks->count() > 0)

                <div class="table-wrapper">

                    <table class="task-table">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Task</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($tasks as $task)

                                <tr>

                                    <td>
                                        #{{ $task->id }}
                                    </td>


                                    <td class="task-name">
                                        {{ $task->task_name }}
                                    </td>


                                    <td>

                                        @if ($task->description)

                                            {{ $task->description }}

                                        @else

                                            <span class="no-description">
                                                No description
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if ($task->due_date)

                                            {{ $task->due_date->format('M d, Y') }}

                                        @else

                                            <span class="no-description">
                                                No date
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if ($task->status === 'Completed')

                                            <span class="status completed">
                                                Completed
                                            </span>

                                        @else

                                            <span class="status pending">
                                                Pending
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <div class="action-buttons">

                                            <a
                                                href="{{ route('tasks.edit', $task->id) }}"
                                                class="edit-button"
                                            >
                                                Edit
                                            </a>


                                            @if ($task->status === 'Pending')

                                                <form
                                                    action="{{ route('tasks.status', $task->id) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('PATCH')

                                                    <input
                                                        type="hidden"
                                                        name="status"
                                                        value="Completed"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="complete-button"
                                                    >
                                                        Complete
                                                    </button>

                                                </form>

                                            @else

                                                <form
                                                    action="{{ route('tasks.status', $task->id) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('PATCH')

                                                    <input
                                                        type="hidden"
                                                        name="status"
                                                        value="Pending"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="pending-button"
                                                    >
                                                        Pending
                                                    </button>

                                                </form>

                                            @endif


                                            <form
                                                action="{{ route('tasks.destroy', $task->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this task?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="delete-button"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <h2>No Tasks Yet</h2>

                    <p>
                        There are currently no tasks in your list.
                    </p>

                    <a
                        href="{{ route('tasks.create') }}"
                        class="create-button"
                    >
                        + Create Your First Task
                    </a>

                </div>

            @endif

        </main>

    </div>

</body>

</html>