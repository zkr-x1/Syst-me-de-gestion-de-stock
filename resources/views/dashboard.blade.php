@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <h2 class="mb-4">Tableau de bord</h2>

        @if(Auth::user()->isAdmin())
        {{-- ===================== ADMIN ===================== --}}
        <div class="alert alert-danger mb-4" role="alert">
            <strong>Administrateur</strong> &nbsp;— Accès complet au système.
        </div>
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $totalProducts }}</h3>
                        <p class="mb-0">Produits</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $totalCategories }}</h3>
                        <p class="mb-0">Catégories</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $lowStock }}</h3>
                        <p class="mb-0">Alertes Stock</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $totalUsers }}</h3>
                        <p class="mb-0">Utilisateurs</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <h4 class="card-title">Gestion des Produits</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center py-4">
                        <h4 class="card-title">Gestion des Catégories</h4>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Accéder</a>
                    </div>
                </div>
            </div>
        </div>

        @elseif(Auth::user()->isSuperviseur())
        {{-- ===================== SUPERVISEUR ===================== --}}
        <div class="alert alert-warning mb-4" role="alert">
            <strong>Superviseur</strong> &nbsp;— Consultation complète du stock (lecture seule).
        </div>

        {{-- Statistiques --}}
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $totalProducts }}</h3>
                        <p class="mb-0">Total Produits</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-secondary shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $totalCategories }}</h3>
                        <p class="mb-0">Catégories</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger shadow-sm">
                    <div class="card-body text-center">
                        <h3>{{ $lowStock }}</h3>
                        <p class="mb-0">Alertes Stock</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableau complet --}}
        <h5 class="mb-3">📦 Tous les Produits</h5>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><span class="badge bg-secondary">{{ $product->category->name ?? 'N/A' }}</span></td>
                                <td>{{ number_format($product->price, 2) }} MAD</td>
                                <td>
                                    @php
                                        $alertLevel = $product->category ? $product->category->getAlertLevel($product->quantity) : ($product->quantity > 0 ? 'ok' : 'rupture');
                                        $badgeClass = $alertLevel === 'rupture' ? 'bg-danger' : ($alertLevel === 'faible' ? 'bg-warning text-dark' : 'bg-success');
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted">Aucun produit.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Catégories --}}
        <h5 class="mb-3">🗂️ Catégories</h5>
        <div class="row g-3">
            @forelse($categories as $category)
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body py-3">
                        <h6 class="mb-0">{{ $category->name }}</h6>
                        <small class="text-muted">{{ $category->products->count() }} produit(s)</small>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">Aucune catégorie.</p>
            @endforelse
        </div>

        @else
        {{-- ===================== UTILISATEUR NORMAL ===================== --}}
        <div class="alert alert-secondary mb-4" role="alert">
            <strong>Utilisateur</strong> &nbsp;— Consultation du catalogue produits.
        </div>

        {{-- Catalogue simple : produits uniquement --}}
        <h5 class="mb-3">📦 Catalogue des Produits</h5>
        <div class="row g-3">
            @forelse($products as $product)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <span class="badge bg-secondary mb-2">{{ $product->category->name ?? 'N/A' }}</span>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong class="text-primary">{{ number_format($product->price, 2) }} MAD</strong>
                            @php
                                $alertLevel = $product->category ? $product->category->getAlertLevel($product->quantity) : ($product->quantity > 0 ? 'ok' : 'rupture');
                                $statusLabel = $alertLevel === 'ok' ? 'En stock' : ($alertLevel === 'faible' ? 'Stock faible' : 'Rupture');
                                $badgeClass = $alertLevel === 'rupture' ? 'bg-danger' : ($alertLevel === 'faible' ? 'bg-warning text-dark' : 'bg-success');
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">Aucun produit disponible.</p>
            @endforelse
        </div>
        @endif

    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
