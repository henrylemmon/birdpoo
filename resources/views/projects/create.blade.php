@extends('layouts.app')

@section('content')
<header class="flex mb-3 py-4">
    <div class="w-full">
        <h2 class="text-gray-500 text-sm">Create a Project</h2>
    </div>
</header>
<form method="POST" action="/projects">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Title
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
               name="title"
               id="title"
               type="text">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            Description
        </label>
        <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
            name="description"
            id="description">
        </textarea>
    </div>
    <div class="mb-4 flex justify-between">
        <button class="button-blue" type="submit">
            Create Project
        </button>
        <a href="/projects">Cancel</a>
    </div>
</form>
@endsection
