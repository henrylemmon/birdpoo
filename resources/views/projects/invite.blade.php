<div class="card mt-3">
    <h3 class="card-header">
        Invite a User
    </h3>

    <footer>
        <form action="{{ $project->path() . '/invitations' }}" method="POST">
            @csrf

            <div class="mb-3">
                <input
                    name="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                    type="email"
                    placeholder="Invite a User..."
                >
            </div>
            <button type="submit" class="button-blue text-xs">Invite User</button>
        </form>
        @include ('errors', ['bag' => 'invitations'])
    </footer>
</div>
