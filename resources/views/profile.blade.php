@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg bm-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <span>Your profile image</span>
            <img class="card-img-top" src="{{ asset('images/' .  auth()->user()->image  ) }}" alt="Card image cap" style="width: 720px; height:400px;">
            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control">
                    </div>
         
                    <div class="col-md-6">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Upload</button>
                    </div>
         
                </div>
            </form>

            <form action="{{ route('profile')}}" method="post">
                @csrf

                <div class="mb-4">
                    <span>Name</span>
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" id="name" placeholder="Your name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ auth()->user()->name }}">

                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <span>Last Name</span>
                    <label for="lastname" class="sr-only">Last name</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Your last name"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('lastname') border-red-500 @enderror" value="{{ auth()->user()->lastname }}">

                    @error('lastname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <span>Email</span>
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your email"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ auth()->user()->email }}">

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <span>Current password*</span>
                    <label for="oldpassword" class="sr-only">Current Password</label>
                    <input type="password" name="oldpassword" id="oldpassword" placeholder="Enter your current password"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('oldpassword') border-red-500 @enderror" value="">

                    @error('oldpassword')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <span>New Password</span>
                    <label for="newpassword" class="sr-only">New Password</label>
                    <input type="password" name="newpassword" id="newpassword" placeholder="Choose a new password"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">

                    @error('newpassword')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="sumbit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection