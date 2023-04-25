@extends('main_layout')

@section('title')
    Relier un équipement
@endsection

@section('content')
<div class="flex justify-center my-10">
    <div class="card shadow-lg">
        <div class="card-body">
            <p class="font-bold text-2xl text-center pb-4">Relier un Equipement</p>
            <form action="/equiped"method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <x-input type="number" name="room_id" hint="Saisissez l'id de la room'"  class="input input-bordered my-3" error="1"/>
                    <x-input type="number" name="equipment_id" hint="Saisissez l'id de l'équipement"  class="input input-bordered my-3" error="1"/>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Relier l'équipement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
