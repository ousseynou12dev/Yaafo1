<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-indigo-900">
            👤 Mon tableau de bord YAAFO
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Statistiques utilisateur -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-gradient-to-br from-indigo-500 via-indigo-600 to-indigo-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                <div class="text-4xl mb-3">🚨</div>
                <h3 class="text-lg font-semibold">Mes Alertes</h3>
                <p class="text-3xl font-bold">{{ $alertesCount }}</p>
                <p class="text-sm opacity-80 mt-1">Signalements effectués</p>
            </div>

            <div class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                <div class="text-4xl mb-3">📸</div>
                <h3 class="text-lg font-semibold">Photos ajoutées</h3>
                <p class="text-3xl font-bold">{{ $photosCount }}</p>
                <p class="text-sm opacity-80 mt-1">Photos sur mes alertes</p>
            </div>

            <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                <div class="text-4xl mb-3">🎯</div>
                <h3 class="text-lg font-semibold">Projets créés</h3>
                <p class="text-3xl font-bold">{{ $projetsCount }}</p>
                <p class="text-sm opacity-80 mt-1">Projets issus de mes alertes</p>
            </div>

        </div>

        <!-- Bouton Créer une alerte -->
        <div class="text-right mb-4">
            <a href="{{ route('commentsamarche') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-xl shadow hover:bg-indigo-700 transition">
                ➕ Créer une alerte
            </a>
        </div>

        <!-- Liste des alertes -->
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">📝 Titre</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">📅 Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">📊 Statut</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">⚡ Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($alertesRecentes as $alerte)
                        <tr class="hover:bg-gray-50">
                            <!-- Titre + photos + badge -->
                            <td class="px-6 py-4 font-medium text-indigo-700">
                                {{ $alerte->title }}
                                <div class="text-sm text-gray-500">
                                    📸 {{ $alerte->images->count() }} photo(s)
                                </div>
                                @if($alerte->projet)
                                    <div class="mt-1">
                                        <span class="inline-block text-xs bg-emerald-100 text-emerald-800 px-2 py-1 rounded-full">
                                            🎯 Projet créé
                                        </span>
                                    </div>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div>{{ $alerte->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $alerte->created_at->format('H:i') }}</div>
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @switch($alerte->status)
                                        @case('validée') bg-green-100 text-green-800 border border-green-200 @break
                                        @case('rejetée') bg-red-100 text-red-800 border border-red-200 @break
                                        @default bg-yellow-100 text-yellow-800 border border-yellow-200
                                    @endswitch">
                                    @switch($alerte->status)
                                        @case('validée') ✅ Validée @break
                                        @case('rejetée') ❌ Rejetée @break
                                        @default ⏳ En attente
                                    @endswitch
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">

                                    <!-- Modifier -->
                                    <a href="{{ route('alertes.edit', $alerte->id) }}"
                                       class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg text-sm font-medium hover:bg-yellow-200">
                                        📝 Modifier
                                    </a>

                                    <!-- Supprimer -->
                                    <form action="{{ route('alertes.destroy', $alerte->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-red-200"
                                                onclick="return confirm('Supprimer cette alerte ?')">
                                            🗑️ Supprimer
                                        </button>
                                    </form>

                                    <!-- Ajouter image -->
                                    <form action="{{ route('alertes.ajouterImage', $alerte->id) }}" method="POST" enctype="multipart/form-data" class="inline">
                                        @csrf
                                        <label class="cursor-pointer bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-gray-200">
                                            📸 Ajouter photo
                                            <input type="file" name="image" class="hidden" onchange="this.form.submit()">
                                        </label>
                                    </form>

                                    <!-- Voir -->
                                    <a href="{{ route('alertes.show', $alerte->id) }}"
                                       class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-blue-200">
                                        👁️ Voir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-500">
                                Aucune alerte trouvée pour votre compte.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
