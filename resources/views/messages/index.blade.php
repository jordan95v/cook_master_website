<x-layout title="{{ __('Create a room') }}">
    <div class="flex justify-center">
        <div class="w-3/4 max-w-4xl mx-auto p-4 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 h-screen overflow-y-auto">
            <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Mes Messages</h3>
            <div class="flex justify-end">
                <label for="my_modal_6" class="btn ">Nouveau message</label>
            </div>
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($sortedUsers as $user)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('messages.show', $user->id) }}" class="flex-1 min-w-0">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="User image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        @if ($user->messages()->exists())
                                            {{ $user->messages()->latest()->first()->message }}
                                        @else
                                            Aucun message disponible.
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

<!-- The modal -->
<input type="checkbox" id="my_modal_6" class="modal-toggle hidden" />
<div class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">Envoyer un nouveau message</h3>
    <select onchange="location = this.value;" class="w-full p-2 border rounded mt-3">
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ route('messages.show', $user) }}">{{ $user->name }}</option>
                    @endforeach
                </select>
    <div class="modal-action">
      <label for="my_modal_6" class="btn">Close!</label>
    </div>
  </div>
</div>
</x-layout>
