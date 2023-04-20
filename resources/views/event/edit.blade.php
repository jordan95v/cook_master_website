@extends('main_layout')

@section('title')
    Modifier un évenement
@endsection

@section('content')
<div class="flex justify-center my-10">
    <div class="card shadow-lg">
        <div class="card-body">
            <p class="font-bold text-2xl text-center pb-4">Modifier l'événement</p>
            <form action="/events/{{$event->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-control">
                    <input type="text" name="title"   class="input input-bordered my-3" value="{{$event->title}}">
                    <input type="text" name="organizer" class="input input-bordered my-3" value="{{$event->Organizer}}"> 
                    <div class="uploader mt-2 my-3">
                        <input type="file" name="image" class="uploader-input">
                        <img src="{{$event->image ? asset('storage/'.$event->image) : 'https://picsum.photos/500/300'}}" alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">

                    </div>
                    
                    @error('image')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror

                    <textarea name="description" class="textarea textarea-bordered h-32 my-3" >{{$event->description}}</textarea>
                    
                    @error('description')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                    
                    <input type="text" name="location" class="input input-bordered my-3" value="{{$event->location}}">
                    <input type="date" name="date" class="input input-bordered my-3" value="{{$event->date}}">
                    <input type="time" name="start_time" class="input input-bordered my-3" value="{{$event->start_time}}">
                    <input type="time" name="end_time" class="input input-bordered my-3" value="{{$event->end_time}}">
                    <button type="submit" class="btn btn-primary w-full">Mettre à jour l'événement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
