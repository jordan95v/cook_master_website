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
                    <h2 class="card-title flex justify-center text-2xl pb-2">Edit your account !</h2>

                    <div class="avatar flex justify-center my-4">
                        <div class="w-20 rounded-full ring ring-primary">
                            <img
                                src="{{ auth()->user()->image ?? false ? asset('storage/' . $user->image) : asset('images/user.png') }}" />
                        </div>
                    </div>

                    <x-utils.input name="name" type="text" hint="Change your username" error="1"
                        :target="$user" label="user" />
                    <x-utils.input name="email" type="email" hint="Enter your email" error="1"
                        :target="$user" label="envelopes-bulk" />


                    <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
                        <x-utils.input name="password" type="password" hint="Enter your password" error="0" />
                        <x-utils.input name="password_confirmation" type="password" hint="Confirm your password"
                            error="0" />
                    </div>
                    <x-utils.form-error name="password" />

                    <div class="flex items-center">
                        <div class="form-control w-full">
                            <input type="file" name="image" class="file-input file-input-bordered w-full" />
                            <label class="label">
                                <span class="label-text-alt">Change profil pic</span>
                            </label>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 mt-4 gap-2">
                        <button class="btn btn-primary "><i class="fa-solid fa-pen me-2"></i>
                            Update my account
                        </button>

                        <!-- Open delete modal -->
                        <label for="delete-modal" class="btn btn-error ">
                            <i class="fa-solid fa-trash me-2"></i>Delete account
                        </label>
                    </div>

                    <div class="divider"></div>
                    <p class="text-center">
                        Forgot your password ? <a href="" class="link">Click here</a>
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
                    <h3 class="font-bold text-lg mb-4">Are you sure you wanna delete this account ?</h3>

                    <div class="flex justify-center">
                        <button class="btn btn-error w-3/5"><i class="fa-solid fa-trash me-2"></i>Delete
                            account</button>
                    </div>
                </form>
            </div>
        </div>
</x-layout>
