<?php

namespace App\Http\Controllers;

use auth;
use App\Models\City;
use App\Models\Offert;
use App\Models\Profession;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OffertController extends Controller
{
    // Get & Show all 
    public function index(){
        return view('offerts.index', [
            // 'offerts' => Offert::all()
             'offerts' => Offert::latest()->filter(request(['profession', 'search']))->get()
            // 'offerts' => Offert::latest()->filter(request(['profession', 'search']))->paginate(6)
        ]);
    }
    // Show single
    public function show(Offert $offert){
        return view('offerts.show', [
            'offert' => $offert
        ]);
    }
    // Create new offert
    public function create(){
        $cities = City::all(); // Retrieve all cities from the database
        $professions = Profession::all(); // Retrieve all professions from the database
        return view('offerts.create', ['cities' => $cities, 'professions' => $professions]);
    }
    // Store new offert
    public function store(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'name' => 'string|required|max:17',
            'surname' => 'string|required|max:11',
            // 'voivodeship' => 'string|required|max:16',
            // 'city_id' => 'string|required|max:16',
            'city_id' => 'required|exists:cities,id',
            'company' => 'string|nullable|max:32',
            // 'profession' => 'string|required|max:29',
            'professions' => 'array',
            'workplace' => 'string|required|max:22',
            'profile-picture' => 'nullable',
            'youtube' => 'url|nullable|max:128',
            'facebook' => 'url|nullable|max:128',
            'instagram' => 'url|nullable|max:128',
            'tiktok' => 'url|nullable|max:128',
            'twitter' => 'url|nullable|max:128',
            'description' => 'string|nullable|max:512'
        ]);

        // Check Youtube link
        if (!empty($request->youtube) && !Str::startsWith($request->youtube, 'https://www.youtube.com/')) {
            return redirect()->back()->withErrors(['youtube' => 'Invalid YouTube link.']);
        }

        // Check Facebook link
        if (!empty($request->facebook) && !Str::startsWith($request->facebook, 'https://www.facebook.com/')) {
            return redirect()->back()->withErrors(['facebook' => 'Invalid Facebook link.']);
        }
    
        // Check Instagram link
        if (!empty($request->instagram) && !Str::startsWith($request->instagram, 'https://www.instagram.com/')) {
            return redirect()->back()->withErrors(['instagram' => 'Invalid Instagram link.']);
        }
    
        // Check TikTok link
        if (!empty($request->tiktok) && !Str::startsWith($request->tiktok, 'https://www.tiktok.com/')) {
            return redirect()->back()->withErrors(['tiktok' => 'Invalid TikTok link.']);
        }
    
        // Check Twitter link
        if (!empty($request->twitter) && !Str::startsWith($request->twitter, 'https://twitter.com/')) {
            return redirect()->back()->withErrors(['twitter' => 'Invalid Twitter link.']);
        }

        if($request->hasFile('profile-picture')){
            $formFields['profile-picture'] = $request->file('profile-picture')->store('profile-pictures', 'public');
        }
        $formFields['user_id'] = auth()->id();
        $formFields['description'] = nl2br(e($request->description));

        // dd($formFields);

        $offert = Offert::create($formFields);
        // Attach selected professions to the Offert
        if ($request->has('professions')) {
            $offert->professions()->attach($request->input('professions'));
        }
        return redirect('/')->with('message', 'Your offert has been added.');
    }
    // Show edit form
    public function edit(Offert $offert){
        $cities = City::all(); // Retrieve all cities from the database
        $professions = Profession::all(); // Retrieve all professions from the database
        return view('offerts.edit', ['offert' => $offert, 'cities' => $cities, 'professions' => $professions]);
    }

    // Update the offert
    public function update(Request $request, Offert $offert){
        // dd($request->all());
        $formFields = $request->validate([
            'name' => 'string|required|max:17',
            'surname' => 'string|required|max:11',
            // 'voivodeship' => 'string|required|max:16',
            // 'city_id' => 'string|required|max:16',
            'city_id' => 'required|exists:cities,id',
            'company' => 'string|nullable|max:32',
            // 'profession' => 'string|required|max:29',
            'professions' => 'array',
            'workplace' => 'string|required|max:22',
            'profile-picture' => 'nullable',
            'youtube' => 'url|nullable|max:128',
            'facebook' => 'url|nullable|max:128',
            'instagram' => 'url|nullable|max:128',
            'tiktok' => 'url|nullable|max:128',
            'twitter' => 'url|nullable|max:128',
            'description' => 'string|nullable|max:512'
        ]);

        // Check Youtube link
        if (!empty($request->youtube) && !Str::startsWith($request->youtube, 'https://www.youtube.com/')) {
            return redirect()->back()->withErrors(['youtube' => 'Invalid YouTube link.']);
        }

        // Check Facebook link
        if (!empty($request->facebook) && !Str::startsWith($request->facebook, 'https://www.facebook.com/')) {
            return redirect()->back()->withErrors(['facebook' => 'Invalid Facebook link.']);
        }
    
        // Check Instagram link
        if (!empty($request->instagram) && !Str::startsWith($request->instagram, 'https://www.instagram.com/')) {
            return redirect()->back()->withErrors(['instagram' => 'Invalid Instagram link.']);
        }
    
        // Check TikTok link
        if (!empty($request->tiktok) && !Str::startsWith($request->tiktok, 'https://www.tiktok.com/')) {
            return redirect()->back()->withErrors(['tiktok' => 'Invalid TikTok link.']);
        }
    
        // Check Twitter link
        if (!empty($request->twitter) && !Str::startsWith($request->twitter, 'https://twitter.com/')) {
            return redirect()->back()->withErrors(['twitter' => 'Invalid Twitter link.']);
        }

        if($request->hasFile('profile-picture')){
            $formFields['profile-picture'] = $request->file('profile-picture')->store('profile-pictures', 'public');
        }
        // dd($formFields);
        $formFields['description'] = nl2br(e($request->description));

        
        $offert->update($formFields);
        if ($request->has('professions')) {
            // Detach the current professions ; Without this line old and new professions will stack
            $offert->professions()->detach();
            // Attach selected professions to the Offert
            $offert->professions()->attach($request->input('professions'));
        }
        return redirect('/offerts/'. $offert->id)->with('message', 'Updated successfully');
    }
    public function delete(Offert $offert){
        $offert->delete();
        return redirect('/offerts/manage')->with('message', 'Deleted Succesfully');
    }
    public function manage(){
        return view('offerts.manage', ['offerts' => auth()->user()->offerts()->get()]);
    }
}
