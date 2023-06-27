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
        @foreach ($sortedUsers as $user)
    <li class="py-3 sm:py-4">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="User image">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    {{ $user->name }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    @if ($user->messages->isNotEmpty())
                        {{ $user->messages->first()->message }}
                    @else
                        Aucun message disponible.
                    @endif
                </p>
            </div>
        </div>
    </li>
@endforeach

        </div>
    </div>
</div>



