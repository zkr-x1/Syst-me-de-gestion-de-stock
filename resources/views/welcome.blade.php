@extends('layouts.app')

@section('content')
<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">Système de Gestion de Stock</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Bienvenue sur votre nouvelle plateforme de gestion de stock. Gagnez en efficacité en gérant facilement vos produits et vos catégories depuis un espace unique, rapide et sécurisé.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Se connecter</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Créer un compte</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 gap-3">Accéder au Dashboard</a>
            @endguest
        </div>
    </div>
</div>
@endsection
