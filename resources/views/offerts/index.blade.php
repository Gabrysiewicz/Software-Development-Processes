<x-layout>
    @include('partials/_search')
    
    @unless (count($offerts) == 0)
        @foreach ($offerts as $offert)
        <div class='offert'>
            <img src='{{$offert['profile_picture'] ? asset('storage/'. $offert['profile_picture']) : asset('images/no-image.jpg') }}' alt='pfp' width='150px' height='150px'>
            <ul class='offert-listing'>
                <li class='text-120'><a href='/offerts/{{$offert->id}}' >{{$offert->first_name}} {{$offert->last_name}}</a></li>
                {{-- <li><a href='/?profession={{$offert->profession}}'>{{$offert->profession}}</a></li> --}}
                <li>
                    @foreach ($offert->professions as $profession)
                        <a href='/offerts/{{$offert->id}}' > {{ $profession->name}} </a>
                        @if (!$loop->last)
                            , <!-- Add a comma if it's not the last profession -->
                        @endif
                    @endforeach
                </li>
                <li>{{$offert->city->voivodeship->name}}: {{$offert->city->name}}</li>
            </ul>
        </div>
        @endforeach
    @else
        <h1>Looks like there are no offerts...</h1>
        <h2>Log in and be the first one in here.</h2>
    @endunless
</x-layout>