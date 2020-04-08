<div class="card flex flex-col" style="height:200px;">
    <h3 class="card-header">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>

    <div class="mb-2 text-gray-600 leading-tight flex-1">{{ STR::limit($project->description, 75) }}</div>
    @can ('manage', $project)
        <footer>
            <form class="text-right" action="{{ $project->path() }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button-blue text-xs">Delete</button>
            </form>
        </footer>
    @endcan
</div>
