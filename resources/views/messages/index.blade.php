<x-layout title="{{ __('Messagerie') }}">
    <div class="flex justify-center">
        <div class="w-3/4 max-w-4xl mx-auto p-4 rounded-lg border shadow-md sm:p-8 border-gray-300 h-screen overflow-y-auto">
            <div class="flex items-center mb-4">
                <h1 class="text-2xl font-bold">Messagerie</h1>
                <div class="flex items-center justify-center flex-1 ml-4">
                    <input type="text" id="search" placeholder="Rechercher un utilisateur" class="w-full px-4 py-2 border rounded">
                </div>
                <div class="ml-4">
                    <label for="my_modal_6" class="btn">Nouveau message</label>
                </div>
            </div>
            <ul role="list" class="divide-y divide-gray-200 -700 list-none">
                @foreach ($sortedUser as $user)
                    <li class="py-3 sm:py-4 user-item">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('messages.show', $user->id) }}" class="flex-1 min-w-0">
                                <div class="flex items-center">
                                    <img class="w-16 h-16 rounded-full" src="{{ $user->image ?? false ? asset('storage/app/public/' . $user->image) : asset('images/user.png') }}" alt="User image">
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-gray-900 truncate user-name">
                                            {{ $user->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500 ml-2">
                                            {{ $user->messages()->latest()->first()->message }}
                                        </p>
                                    </div>
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
                <option value="">Sélectionner un chef</option>
                @foreach($users as $user)
                    <option value="{{ route('messages.show', $user) }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <div class="modal-action">
                <label for="my_modal_6" class="btn">Close</label>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function(event) {
            var searchValue = event.target.value.toLowerCase();
            var users = document.querySelectorAll('.user-item');

            users.forEach(function(user) {
                var userName = user.querySelector('.user-name').textContent.toLowerCase();

                if (userName.includes(searchValue)) {
                    user.style.display = 'block';
                } else {
                    user.style.display = 'none';
                }
            });
        });

        
    </script>
</x-layout>
