@extends('layouts.app')

@section('content')

<div class="bg-gray-200 w-2/3 mx-auto p-6 shadow">
    <form action="/authors" method="POST" class="flex flex-col items-center">
        @csrf
        <h1>Add new author</h1>
        <div class="pt-4">
            <input type="text" name="name" placeholder="full name" class="rounded px-4 py-2 w-64">
            @error('name')
                <p class="text-red-600">{{$message}}</p>
            @enderror
        </div>
        <div class="pt-4">
            <input type="text" name="dob" placeholder="Date of birth" class="rounded px-4 py-2 w-64">
            @if($errors->has('dob'))
                <p class="text-red-600">{{$errors->first('dob')}}</p>
            @endif
        </div>
        <div class="pt-4">
            <button class="bg-blue-400 text-white rounded py-2 px-4">Add new author</button>
        </div>
    </form>
</div>

@endsection
