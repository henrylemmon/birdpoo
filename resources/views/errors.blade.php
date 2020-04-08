@if ($errors->{$bag ?? 'default'}->any())
    <ul class="mt-4">
        @foreach ($errors->{ $bag ?? 'default'}->all() as $error)
            <li class="text-xs text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif
