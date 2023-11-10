<x-layout>
    <section id='section-edit-form'>
        <h1>Edit your offert</h1>
        <form action='/offerts/{{$offert->id}}' method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <div>
                <label for='edit-name' >* name</label>
                <input type='text' name='name' id='edit-name' placeholder="Adam" value="{{$offert->name}}">
                @error('name')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='edit-surname' >* surname</label>
                <input type='text' name='surname' id='edit-surname' placeholder="Mickiewcz" value="{{$offert->surname}}">
                @error('surname')
                    <p>{{$message}}</p>
                @enderror
            </div> --}}
            <div>
                <label for='edit-first_name' >* First Name</label>
                <input type='text' name='first_name' id='edit-first_name' placeholder="Adam" value="{{$offert->first_name}}"">
                @error('first_name')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='edit-last_name' >* Last Name</label>
                <input type='text' name='last_name' id='edit-last_name' placeholder="Mickiewcz" value="{{$offert->last_name}}">
                @error('last_name')
                    <p>{{$message}}</p>
                @enderror
            </div>
            {{-- <div>            
                <label for='edit-city' >* city </label>
                <input type='text' name='city' id='edit-city' placeholder="Lublin" value="{{$offert->city}}">
                @error('city')
                    <p>{{$message}}</p>
                @enderror
            </div> --}}
            <div>            
                <label for='edit-city' >* city </label>
                <select name="city_id" id="edit_city">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>            
                <label for='edit-company' > company </label>
                <input type='text' name='company' id='edit-company' placeholder="Barber 44" value="{{$offert->company}}">
                @error('company')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="edit-profession">* Professions</label>
                <select name="professions[]" id="edit-profession" multiple>
                    @foreach ($professions as $profession)
                        <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                    @endforeach
                </select>
                @error('professions')
                    <p>{{ $message }}</p>
                @enderror
            </div>              
            {{-- <div>                    
                <label for='edit-workplace' >* Workplace (comma spearated) </label>
                <input type='text' id='edit-workplace' name='workplace' placeholder="salon, private, client" value="{{$offert->workplace}}">
            </div>   --}}
            <div>
                <label for="edit-workplace">* Workplaces</label>
                <select name="workplaces[]" id="edit-workplace" multiple>
                    @foreach ($workplaces as $workplace)
                        <option value="{{ $workplace->id }}">{{ $workplace->name }}</option>
                    @endforeach
                </select>
                @error('workplaces')
                    <p>{{ $message }}</p>
                @enderror
            </div>   
            <div>                    
                <label for='edit-profile_picture' > Profile picture </label>
                <input type='file' id='edit-profile_picture' name='profile_picture' value="{{$offert['profile_picture']}}">
                <img src='{{$offert['profile_picture'] ? asset('storage/'. $offert['profile_picture']) : asset('images/no-image.jpg') }}' alt='pfp' width='150px' height='150px'>

            </div>  
            <div>
                <label for='youtube' > youtube </label>
                <input type='text' name='youtube' id='edit-youtube' placeholder="https://www.youtube.com/@my_channel" value="{{$offert->youtube}}">
                @error('youtube')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='facebook' > facebook </label>
                <input type='text' name='facebook' id='edit-facebook' placeholder="https://www.facebook.com/my_page" value="{{$offert->facebook}}">
                @error('facebook')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='instagram' > instagram </label>
                <input type='text' name='instagram' id='edit-instagram' placeholder="https://www.instagram.com/my_profile" value="{{$offert->instagram}}">
                @error('instagram')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='tiktok' > tiktok </label>
                <input type='text' name='tiktok' id='edit-tiktok' placeholder="https://www.tiktok.com/@my_profile" value="{{$offert->tiktok}}">
                @error('tiktok')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='twitter' > twitter </label>
                <input type='text' name='twitter' id='edit-twitter' placeholder="https://twitter.com/my_profile"  value="{{$offert->twitter}}">
                @error('twitter')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for='description' > description </label>
                @php
                    $offert->description = str_replace("<br />", "", $offert->description);
                
                @endphp
                <textarea name='description' id='edit-description' cols='4' rows='5' >{!! $offert->description !!}</textarea>
                
                @error('description')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <input type='submit' name='edit-submit' id='edit-submit' value='Update'>
        </form>
    </section>
</x-layout>