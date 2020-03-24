
@csrf

<div class="field mb-6">
    <label class="label block text-gray-700 text-sm mb-2" for="title">
        Title
    </label>
    <input class="input bg-transparent border border-gray-400 rounded p-2 text-xs w-full"
           name="title"
           id="title"
           type="text"
           placeholder="My next awesome project"
           required
           value="{{ $project->title }}"
    >
</div>
<div class="field mb-6">
    <label class="label block text-gray-700 text-sm mb-2" for="description">
        Description
    </label>
    <textarea
        rows="10"
        class="textarea bg-transparent border border-gray-400 rounded p-2 text-xs w-full"
        name="description"
        id="description"
        placeholder="I should stop the birdshit"
        required
    >{{ $project->description }}</textarea>
</div>
<div class="field">
    <div class="control flex justify-between">
        <button class="button-blue" type="submit">
            {{ $buttonText }}
        </button>
        <a href="{{ $project->path() }}">Cancel</a>
    </div>
</div>
@if ($errors->any())
    <ul class="mt-4">
        @foreach ($errors->all() as $error)
            <li class="text-xs text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif
