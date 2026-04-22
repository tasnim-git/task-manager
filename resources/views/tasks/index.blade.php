<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

<h1 class="text-2xl font-bold mb-4">Task Manager</h1>
@if($errors->any())
<div class="bg-red-100 p-2 mb-2">
    @foreach($errors->all() as $error)
        <p class="text-red-500">{{ $error }}</p>
    @endforeach
</div>
@endif

<div class="grid grid-cols-4 gap-4 mb-6">

    <div class="bg-gray-100 p-4 rounded shadow text-center">
        <h2 class="text-xl font-bold">{{ $total }}</h2>
        <p>Total Tasks</p>
    </div>

    <div class="bg-red-100 p-4 rounded shadow text-center">
        <h2 class="text-xl font-bold">{{ $pending }}</h2>
        <p>Pending</p>
    </div>

    <div class="bg-yellow-100 p-4 rounded shadow text-center">
        <h2 class="text-xl font-bold">{{ $inProgress }}</h2>
        <p>In Progress</p>
    </div>

    <div class="bg-green-100 p-4 rounded shadow text-center">
        <h2 class="text-xl font-bold">{{ $completed }}</h2>
        <p>Completed</p>
    </div>

</div>

<form method="POST" action="{{ route('tasks.store') }}" class="mb-4">
    @csrf
    <input name="title" placeholder="Task title" class="border p-2 w-full mb-2" required>
    <textarea name="description" placeholder="Description" class="border p-2 w-full mb-2"></textarea>
    <button class="bg-blue-500 text-white px-4 py-2 rounded">Add Task</button>
</form>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tasks as $task)
        <tr class="border-t">
    <td class="p-2">
        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
            @csrf
            @method('PUT')

            <input name="title" value="{{ $task->title }}" class="border p-1 w-full mb-1">
            <input name="description" value="{{ $task->description }}" class="border p-1 w-full">

            <button class="text-blue-500 text-sm mt-1">Update</button>
        </form>
    </td>

    <td>
        <form method="POST" action="{{ route('tasks.status', $task->id) }}">
            @csrf
            @method('PATCH')
            <select name="status" onchange="this.form.submit()" 
class="p-1 rounded 
{{ $task->status=='pending' ? 'bg-red-100' : '' }}
{{ $task->status=='in_progress' ? 'bg-yellow-100' : '' }}
{{ $task->status=='completed' ? 'bg-green-100' : '' }}">
                <option value="pending" {{ $task->status=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status=='in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status=='completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
    </td>

    <td>
        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500">Delete</button>
        </form>
    </td>
</tr>
        @endforeach
    </tbody>
</table>

</div>

</body>
</html>