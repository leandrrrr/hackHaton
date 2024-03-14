<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\delis; // Assure-toi d'importer ton modèle Delis
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function afficherDepartement($nom)
    {
        // Récupère les délits pour le département spécifié
        $delits = delis::where('departement', $nom)->get();

        // Passe les données à la vue
        return view('departement', ['nom' => $nom, 'delits' => $delits]);
    }
    public function create()
    {
        $delisData = Delis::all(); // Récupère toutes les données de la table "delis"

        // Maintenant, envoie ces données à ta vue
        return view('articles.create')->with('delisData', $delisData);
    }
    public function store(Request $request)
    {
        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft']);

        // Créateur de l'article (auteur)
        $data['user_id'] = Auth::user()->id;

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        // On crée l'article
        $article = Article::create($data); // $Article est l'objet article nouvellement créé

        // Exemple pour ajouter la catégorie 1 à l'article
        // $article->categories()->sync(1);

        // Exemple pour ajouter des catégories à l'article
        // $article->categories()->sync([1, 2, 3]);

        // Exemple pour ajouter des catégories à l'article en venant du formulaire
        // $article->categories()->sync($request->input('categories'));

        // On redirige l'utilisateur vers la liste des articles
        return redirect()->route('dashboard')->with('create', 'Article créé !');

    }
    public function index()
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Maintenant, récupère également les données de la table "delis"
        $delisData = Delis::all();

        // Compte le nombre d'articles, tu n'as pas encore implémenté cette partie, alors je te laisse le faire
        $articles = 0;

        // Retourne la vue avec les données nécessaires
        return view('dashboard', [
            'articles' => $articles,
            'delisData' => $delisData // Passe les données de la table "delis" à la vue
        ]);
    }
    public function dashboard()
    {
        $delisData = Delis::all(); // Récupère toutes les données de la table "delis"

        // Envoie ces données à ta vue "dashboard"
        return view('dashboard', compact('delisData'));
    }
    public function edit(Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            abort(403);
        }

        // On retourne la vue avec l'article
        return view('articles.edit', [
            'article' => $article
        ]);
    }
    public function remove(Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            abort(403);
        }


        // On met à jour l'article
        $article->delete();

        // On redirige l'utilisateur vers la liste des articles (avec un flash)
        return redirect()->route('dashboard')->with('remove', 'Article FINITO !');

    }

    public function update(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->id !== Auth::user()->id) {
            abort(403);
        }

        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft']);

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        // On met à jour l'article
        $article->update($data);

        // On redirige l'utilisateur vers la liste des articles (avec un flash)
        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }






}

