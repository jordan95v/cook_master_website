@extends('main_layout')

@section('title')
    Modifier mon profil
@endsection

@section('content')
    <div class="flex justify-center my-10">
        <div class="card shadow-xl md:w-1/3 w-96">
            <form action="/users/{{ $user->id }}" method="post" class="card-body">
                @csrf
                @method('put')
                <h2 class="card-title flex justify-center text-2xl pb-2">Edit your account !</h2>

                <x-input name="name" type="text" hint="Chnage your username" error="1" :target="$user" />
                <x-input name="email" type="email" hint="Enter your email" error="1" :target="$user" />
                <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
                    <x-input name="password" type="password" hint="Enter your password" error="0" />
                    <x-input name="password_confirmation" type="password" hint="Confirm your password" error="0" />
                </div>
                @error('password')
                    <p class="text-red-600 ms-2">{{ $message }}</p>
                @enderror

                <button class="btn btn-primary mt-4">Update my account</button>
                <!-- Open delete modal -->
                <label for="delete-modal" class="btn btn-error"><i class="fa-solid fa-trash me-2"></i>Delete account</label>
                <div class="divider"></div>
                <p class="text-center">Forgot your password ? <a href="" class="link">Click here</a></p>
            </form>
        </div>
    </div>

    <!-- Delete modal -->
    <input type="checkbox" id="delete-modal" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form action="/users/{{ $user->id }}" method="post">
                @csrf
                @method('DELETE')
                <label for="delete-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="font-bold text-lg mb-4">Are you sure you wanna delete this account ?</h3>

                <div class="flex justify-center">
                    <button class="btn btn-error w-3/5"><i class="fa-solid fa-trash me-2"></i>Delete account</button>
                </div>
            </form>
        </div>
    </div>
@endsection
