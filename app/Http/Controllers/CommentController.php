<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Méthode pour créer un commentaire
    public function store(CommentRequest $request)
    {
        $comment = $request->validated();
        $comment['user_id'] = Auth::user()->id; // Assigner l'ID de l'utilisateur connecté
        Comment::create($comment);

        return redirect()->back()->with('success', 'Le commentaire a été ajouté avec succès.');
    }

    // Méthode pour répondre à un commentaire
    public function reply(CommentRequest $request, Comment $comment)
    {
        //dd($comment);
        
        $newComment = $request->validated();
        $newComment['user_id'] = Auth::user()->id; // Assigner l'ID de l'utilisateur connecté
        $newComment['parent_id'] = $comment->id; // parent_id est l'ID du commentaire auquel nous répondons
        Comment::create($newComment);

        return redirect()->back()->with('success', 'Votre réponse a été publiée avec succès.');
    }
}
