<x-app-layout>
    <div class="note-container single-note">
        <h1>Create new note</h1>
        <form action="{{ route('note.store') }}" method="POST" class="note">
            @csrf
            <textarea name="note" class="note-body" placeholder="Enter your note here" cols="30" rows="10"></textarea>
            <div class="note-buttons">
                <a href="#" class="note-cancel-button">Cancel</a>
                <button type="submit" class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
