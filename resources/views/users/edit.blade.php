<x-layout title="Modifier mon profil">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/edit_profile.png') }}" alt="">
        </div>
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('user.update') }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h2 class="card-title flex justify-center text-2xl pb-2">{{ __('Edit your account') }} !</h2>

                    <div class="avatar flex justify-center my-4">
                        <div class="w-20 rounded-full ring ring-primary">
                            <img
                                src="{{ Auth::user()->image ?? false ? asset('storage/' . $user->image) : asset('images/user.png') }}" />
                        </div>
                    </div>

                    <x-utils.input name="name" type="text" hint="Change your username" error="1"
                        :target="$user" label="user" />
                    <x-utils.input name="email" type="email" hint="Change your email" error="1"
                        :target="$user" label="envelopes-bulk" />


                    <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
                        <x-utils.input name="password" type="password" hint="Password" error="0" />
                        <x-utils.input name="password_confirmation" type="password" hint="Password confirmation"
                            error="0" />
                    </div>
                    <x-utils.form-error name="password" />

                    <div class="flex items-center">
                        <div class="form-control w-full">
                            <input type="file" name="image" class="file-input file-input-bordered w-full" />
                            <label class="label">
                                <span class="label-text-alt">{{ __('Change profile picture') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 mt-4 gap-2">
                        <button class="btn btn-primary "><i class="fa-solid fa-pen me-2"></i>
                            {{ __('Update') }}
                        </button>

                        <!-- Open delete modal -->
                        <label for="delete-modal" class="btn btn-error ">
                            <i class="fa-solid fa-trash me-2"></i>{{ __('Delete your account') }}
                        </label>
                    </div>

                    <div class="divider"></div>
                    <p class="text-center">
                        {{ __('Forgot your password ?') }}<a href="" class="link"> {{ __('Click here') }}</a>
                    </p>
                </form>
            </x-utils.card-grid>
        </div>

        <!-- Delete modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <form action="{{ route('user.destroy', ['user' => $user]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <label for="delete-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                    <h3 class="font-bold text-lg mb-4">{{ __('Are you sure you want to delete your account ?') }}</h3>

                    <div class="flex justify-center">
                        <button class="btn btn-error w-3/5">
                            <i class="fa-solid fa-trash me-2"></i>{{ __('Delete your account') }}</button>
                    </div>
                </form>
            </div>
        </div>
</x-layout>
