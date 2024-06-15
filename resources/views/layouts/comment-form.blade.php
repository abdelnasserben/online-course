<form action="{{ $action }}" method="post">
    @csrf
    <input type="hidden" name="tutorial_id" value="{{ $tutorial->id }}">
    <input type="hidden" name="parent_id" value="{{ $parentId ?? null }}">
    <x-textarea name="content" label="Commentaire" />
    <button type="submit" class="btn btn-sm btn-primary">Commenter</button>
</form>
