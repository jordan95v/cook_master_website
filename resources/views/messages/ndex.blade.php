<div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
    <div class="flex flex-col mt-8">
        <div class="flex flex-row items-center justify-between text-xs">
        <span class="font-bold">Active Conversations</span>
        <span
            class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full"
            >4</span
        >
        </div>
        <div class="flex flex-col space-y-1 mt-4 -mx-2 h-96 overflow-y-auto">
        @foreach ($users as $user)
            <form action="{{ route('messages.show', $user->id) }}" method="GET">
                <button type="submit" class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                    <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">A</div>
                    <div class="ml-2 text-sm font-semibold">{{ $user->name }}</div>
                </button>
            </form>
        @endforeach
        </div>
    </div>
</div>



