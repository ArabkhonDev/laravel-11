<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query()->where('user_id', request()->user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('note.index')->with(['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note'=> ['required', 'string']
        ]);
        $data['user_id'] = $request->user()->id; 
        $note = Note::create($data);

        return to_route('note.show', $note)->with(['message'=>'Note was create']);
    }


    public function show(Note $note)
    {
        return view('note.show')->with( ['note'=> $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit')->with( ['note'=> $note]);
    }

    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'note'=> ['required', 'string']
        ]);
        $data['user_id'] = $request->user()->id; 
        $note->update($data);

        return to_route('note.show', $note)->with(['message'=>'Note was updated']);
    }


    public function destroy(Note $note)
    {
        $note->delete();
        return to_route('note.index')->with(['message'=>'Note was deleted']);
    }
}
