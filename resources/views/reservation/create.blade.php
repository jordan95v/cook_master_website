<x-layout title="{{ __('Reserve home courses') }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/Reservation_form.png') }}" alt="">
        </div>
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('reservation.store') }}"method="POST" enctype="multipart/form-data"
                    class="card-body">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Reserve a home course') }}</h2>

                    {{-- Title --}}
                    <x-utils.input type="text" name="title" hint="{!! __('Desired course') !!}" error=1 />

                    {{-- Comment --}}
                    <textarea id="editor" class="textarea textarea-bordered border-2 @error('comment') border-error @enderror" rows=4
                        name="comment" placeholder="{{ __('Give us details about the course') }}">{{ old('comment') }}</textarea>
                    <x-utils.form-error name="comment" />

                    {{-- Image --}}

                    <div class="divider"></div>

                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Where ? When ?') }}</h2>

                    {{-- Address --}}
                    <x-utils.input type="text" name="address" hint="{!! __('Enter your address') !!}" error=1 />

                    {{-- Date --}}
                    <x-utils.input type="date" name="date" hint="{{ __('Date') }}" error="1" />

                    {{-- Range time --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        {{-- Start time --}}
                        <select class="select select-bordered w-full max-w-xs" name="start_time" id="start-time">
                            <option disabled selected>{{ __('Choose the start time') }}</option>
                            @php
                                for ($i = 0; $i <= 23; $i++) {
                                    $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                    echo "<option value=\"$hour:00\">$hour:00</option>";
                                }
                            @endphp
                        </select>

                        {{-- End time --}}
                        <select class="select select-bordered w-full max-w-xs" name="end_time" id="end-time">
                            <option disabled selected>{{ __('Choose the end time') }}</option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full"> {{ __('Send the request') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
    <x-event.time />
    <x-utils.editor />
</x-layout>
