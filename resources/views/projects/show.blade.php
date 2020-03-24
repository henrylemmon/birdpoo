@extends('layouts.app')

@section('content')
    <header class="flex mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-500 text-sm">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>

            <a class="button-blue" href="{{ $project->path() . '/edit' }}">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex lg:-mx-3">
            <div class="lg:w-3/4 lg:px-3">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-500 mb-2">Tasks</h2>
                    <!--tasks-->
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex items-center">
                                    <input
                                        name="body"
                                        value="{{ $task->body }}"
                                        class="w-full mr-4 focus:outline-none{{ $task->completed ? ' text-gray-400' : '' }}"
                                    >
                                    <input
                                        type="checkbox"
                                        name="completed"
                                        {{ $task->completed ? 'checked' : '' }}
                                        onChange="this.form.submit()"
                                    >
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input
                                name="body"
                                class="w-full focus:outline-none"
                                type="text"
                                placeholder="Add a new task..."
                            >
                        </form>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-lg text-gray-500 mb-2">General Notes</h2>
                    {{--general notes--}}
                    <form action="{{ $project->path() }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <textarea
                            name="notes"
                            class="card w-full"
                            style="min-height:200px;"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>
                        <button type="submit" class="button-blue mt-2">Save</button>
                    </form>
                    @if ($errors->any())
                        <ul class="mt-4">
                            @foreach ($errors->all() as $error)
                                <li class="text-xs text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="lg:w-1/4 lg:px-3">
                @include('projects.card')
            </div>

        </div>
    </main>
@endsection
