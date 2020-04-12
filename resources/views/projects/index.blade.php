@extends('layouts.app')

@section('content')
    <header class="flex mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-gray-500 text-sm">My Projects</h2>
            <a
                class="button-blue"
                href="/projects/create"
                @click.prevent="$modal.show('new-project-modal')"
            >
                New Project
            </a>
        </div>
    </header>

    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No Projects Yet!</div>
        @endforelse
    </div>

    <new-project-modal></new-project-modal>

@endsection
