<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-indigo-800">
            {{ isset($projet) ? '✏️ Modifier le projet : "' . $projet->titre . '"' : '💡 Nouveau projet pour l\'alerte : "' . $alert->title . '"' }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <form method="POST" action="{{ isset($projet) ? route('admin.projets.update', $projet) : route('admin.projets.storeDepuisAlerte', $alert->id) }}">
            @csrf
            @if(isset($projet))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Titre du projet</label>
                <input type="text" name="titre" value="{{ old('titre', $projet->titre ?? $alert->title ?? '') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>{{ old('description', $projet->description ?? $alert->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Quartier</label>
                <input type="text" name="quartier" value="{{ old('quartier', $projet->quartier ?? $alert->quartier ?? '') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Objectif de financement (CFA)</label>
                <input type="number" name="objectif" value="{{ old('objectif', $projet->objectif ?? 500000) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">
                    {{ isset($projet) ? '💾 Mettre à jour le projet' : '✅ Créer le projet' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
