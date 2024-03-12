<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();

        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }
    public function show(User $user, Article $article)
    {
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();

        // Je vous laisse faire le code
        // N'oubliez pas de vérifier que l'article est publié (draft == 0)
    }

    public function store(Request $request)
    {
        // Vérification de l'authentification de l'utilisateur
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Récupération des données du formulaire
        $content = $request->input('commentaire');
        $articleId = $request->input('articleId');

        // Validation des données
        $validatedData = $request->validate([
            'commentaire' => 'required|string',
            'articleId' => 'required|integer|exists:articles,id'
        ]);

        // Création du commentaire dans la base de données
        Comment::create([
            'content' => $content,
            'article_id' => $articleId,
            'user_id' => Auth::user()->id
        ]);

        // Redirection vers la page de l'article commenté
        return redirect()->route('articles.show', ['id' => $articleId]);
    }
}
