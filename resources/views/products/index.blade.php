@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Gestion des Produits</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Créer un Produit</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
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
                        <td class="text-end">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($products->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Aucun produit trouvé.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
