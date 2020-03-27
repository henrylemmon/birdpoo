<div class="card mt-3" style="height: auto;">
    <ul class="text-xs">
        @foreach ($project->activity as $activity)
            <li class="{{ $loop->last ? '' : 'mb-2 border-b' }}">
                @include ("projects.activity.{$activity->description}")
                <span class="text-gray-500">{{ $activity->created_at->diffForHumans(null, true, 1) }}</span>
                {{--@if ($activity->description === 'created_project')
                    You Created a project
                @elseif ($activity->description === 'updated_project')
                    You Updated a project
                @elseif ($activity->description === 'created_task')
                    You Created a task
                @elseif ($activity->description === 'completed_task')
                    You Completed a task
                @elseif ($activity->description === 'uncompleted_task')
                    You Marked task incomplete
                @else
                    x box {{ $activity->description }}
                @endif--}}
            </li>
        @endforeach
    </ul>
</div>
