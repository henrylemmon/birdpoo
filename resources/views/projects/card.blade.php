<div class="card" style="height:200px;">
    <h3 class="card-header">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>

    <div class="text-gray-600 leading-tight">{{ STR::limit($project->description, 75) }}</div>
</div>
