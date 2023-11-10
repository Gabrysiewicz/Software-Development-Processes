<x-layout>
    <section id='section-manage-table'>
        <table>
            <thead>
                <tr><th>First Name</th><th>Last Name</th><th>Profession</th><th>View</th><th>Edit</th><th>Delete</th></tr>
            </thead>
            <tbody>
                @unless ($offerts->isEmpty())
                    @foreach ( $offerts as $offert)
                    <tr><td>{{$offert->first_name}}</td>
                        <td>{{$offert->last_name}}</td>
                        <td>
                        @foreach ($offert->professions as $profession)
                            {{$profession->name}}
                            @if (!$loop->last)
                                , <!-- Add a comma if it's not the last profession -->
                            @endif
                        @endforeach                        
                        </td>
                        <td><a href='/offerts/{{$offert->id}}'><button>View</button></a></td>
                        <td><a href='/offerts/{{$offert->id}}/edit'><button>Edit</button></a></td>
                        <td><form method="POST" action="/offerts/{{$offert->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="sumbit" id='delete-offert' name='delete-offert'>Delete</button>
                        
                        </form></td>
                    </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No offerts to manage</td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </section>
</x-layout>