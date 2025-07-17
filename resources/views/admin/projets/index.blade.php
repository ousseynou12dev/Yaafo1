<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-3 rounded-xl shadow-lg">
                💰
            </div>
            <h2 class="text-3xl font-bold text-indigo-900">Projets communautaires validés</h2>
        </div>
        <p class="text-gray-600 mt-1">Liste des projets issus des alertes approuvées</p>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">📋 Tous les projets</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                📌 Titre
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                🧍 Auteur
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                🎯 Objectif
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                📍 Quartier
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ✅ Statut
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ⚙️ Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($projets as $projet)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-indigo-700">{{ $projet->titre }}</div>
                                    <div class="text-sm text-gray-500">Créé le {{ $projet->created_at->format('d/m/Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-800 font-medium">{{ $projet->user->name ?? 'Anonyme' }}</div>
                                </td>
                                <td class="px-6 py-4 text-green-800 font-semibold">
                                    {{ number_format($projet->objectif, 0, ',', ' ') }} CFA
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $projet->quartier }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $projet->approuve ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200' }}">
                                        {{ $projet->approuve ? '✅ Approuvé' : '⏳ En attente' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('admin.projets.show', $projet) }}"
                                       class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-indigo-200">
                                        👁️ Voir
                                    </a>
                                    <a href="{{ route('admin.projets.edit', $projet) }}"
                                       class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-blue-200">
                                        ✏️ Modifier
                                    </a>
                                    <form action="{{ route('admin.projets.destroy', $projet) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('Confirmer la suppression de ce projet ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-red-200">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">
                                    Aucun projet pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4">
                {{ $projets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
