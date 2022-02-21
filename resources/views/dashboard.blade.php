@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
           @if ($users)
                @if (auth()->user()->id <=5)
                    <p>Search by name, lastname and email</p>
                    <form action="{{ route('filter')}}" method="post">
                    @csrf

                    <div class="mb-4">
                        <span>Name</span>
                        <div>
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name"
                            class="bg-gray-100 border-2  p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{\Request::get('name')}}"
                        </div>
                    </div>

                    <div class="mb-4">
                        <span>Last name</span>
                        <div>
                            <label for="lastname" class="sr-only">Last name</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Last Name"
                            class="bg-gray-100 border-2  p-4 rounded-lg @error('lastname') border-red-500 @enderror" value="{{\Request::get('lastname')}}"
                        </div>
                    </div>

                    <div class="mb-4">
                        <span>Email</span>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" name="email" id="email" placeholder="Email"
                            class="bg-gray-100 border-2  p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{\Request::get('email')}}"
                        </div>
                    </div>

                    <div>
                        <button type="sumbit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium ">Search</button>
                    </div>
                    </form>
                    <p>Your subordinates</p>
                @else
                    <p>Your managers</p>
                @endif  
                <table class="display">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Last name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)  
                            <tr>
                                <td><img class="card-img-top" src="{{ asset('images/' . $user->image ) }}" onError="this.onerror=null;this.src='/images/default.jpg';" }}" style="width: 70px; height:70px;"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 p-4 box has-text-centered">
                    {{ $users->links('pagination::semantic-ui') }}
                </div>
           @else

           @endif
        </div>
    </div>
@endsection