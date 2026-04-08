@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Créer une Catégorie</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">Retour à la liste</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la catégorie</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description (Optionnel)</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="seuil_alerte" class="form-label">Seuil d'alerte stock <span class="text-muted">(quantité minimum avant alerte)</span></label>
                <input type="number" name="seuil_alerte" id="seuil_alerte" class="form-control @error('seuil_alerte') is-invalid @enderror" value="{{ old('seuil_alerte', 5) }}" min="0" required>
                @error('seuil_alerte')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer la catégorie</button>
        </form>
    </div>
</div>
@endsection
