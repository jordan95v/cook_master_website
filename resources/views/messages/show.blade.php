

<x-layout title="Messages">

<!-- component -->
<div class="flex h-screen antialiased text-gray-800">
    <div class="flex flex-row h-full w-full overflow-x-hidden">
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
      <div class="flex flex-col flex-auto h-full p-6">
    <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
        <div class="flex flex-col h-full overflow-x-auto mb-4">
            <div class="flex flex-col h-full">
                <div class="grid grid-cols-12 gap-y-2">
                    @foreach ($messages as $message)
                        <div class="col-start-{{ $message->sender_id == auth()->id() ? '1' : '7' }} col-end-{{ $message->sender_id == auth()->id() ? '8' : '13' }} p-3 rounded-lg">
                            <div class="flex flex-row items-center justify-{{ $message->sender_id == auth()->id() ? 'start ' : 'end flex-row-reverse' }}">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                    A
                                </div>
                                <div class="{{ $message->sender_id == auth()->id() ? 'relative ml-3' : 'relative mr-3' }} text-sm bg-{{ $message->sender_id == auth()->id() ? 'white' : 'indigo' }} py-2 px-4 shadow rounded-xl">
                                    <div>{{ $message->message }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
            <div class="flex-grow ml-4">
                <div class="relative w-full">
                    <form method="post" action="{{ route('messages.store', $receiver) }}">
                        @csrf
                        <input type="text" name="content" class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                </div>
            </div>
            <div class="ml-4">
                <button type="submit" class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                    <span>Send</span>
                </button>
            </div>
            </form>
        </div>
    </div>
    </div>
  </div>

  

</x-layout>