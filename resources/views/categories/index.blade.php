@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Gestion des Catégories</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Créer une Catégorie</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Seuil d'alerte</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td><span class="badge bg-warning text-dark">{{ $category->seuil_alerte }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($categories->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Aucune catégorie trouvée.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
