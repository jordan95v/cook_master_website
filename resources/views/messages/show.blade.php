<x-layout title="Messages">
    <!-- component -->
    <div class="flex flex-justify-start">
        <button>
            <a href="{{ route('messages.index') }}" class="">Retour à la liste</a>
        </button>
    </div>
    <div class="flex h-screen antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0 items-center justify-center">
                <div class="flex flex-col mt-8 items-center justify-center">
                    <img class="rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="User image">
                    <h2 class="text-2xl font-semibold pt-5 mt-5">{{ $user->name }}</h2>
                </div>
            </div>
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <h3 class="flex bg-white rounded p-3">Vous discutez actuellement avec {{ $user->name }}</h3>
                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <div class="flex flex-col h-full">
                            @foreach ($messages as $message)
                                <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                    <div class="flex items-center justify-start {{ $message->sender_id == auth()->id() ? 'flex-row-reverse' : '' }}">
                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                            A
                                        </div>
                                        <div class="relative mr-3 text-sm {{ $message->sender_id == auth()->id() ? 'bg-indigo-100' : 'bg-white' }} py-2 px-4 shadow rounded-xl">
                                            <div id="messages">
                                                {{ $message->message }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                        <div class="flex-grow ml-4">
                            <div class="relative w-full">
                                <form id="form" method="post" action="{{ route('messages.store', $receiver) }}">
                                    @csrf
                                    <input type="text" name="content" class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <button id="input" type="submit" class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                <span>Send</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>

