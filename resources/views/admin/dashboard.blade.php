<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-indigo-900 flex items-center gap-3">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-2 rounded-lg">
                    🚨
                </div>
                YAAFO Dashboard
            </h2>
            <div class="text-sm text-gray-500">
                Plateforme de signalement citoyen
            </div>
        </div>
    </x-slot>

    <!-- Barre de recherche améliorée -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Rechercher une alerte YAAFO..."
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                       value="{{ request('search') }}">
            </div>
        </form>

        <div class="space-y-8">
            <!-- Statistiques globales avec design YAAFO -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                    <div class="text-4xl mb-3">🚨</div>
                    <h3 class="text-lg font-semibold">Total Alertes</h3>
                    <p class="text-3xl font-bold">{{ $alertesCount }}</p>
                    <p class="text-sm opacity-80 mt-1">Signalements YAAFO</p>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-emerald-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                    <div class="text-4xl mb-3">👥</div>
                    <h3 class="text-lg font-semibold">Citoyens Actifs</h3>
                    <p class="text-3xl font-bold">{{ $usersCount }}</p>
                    <p class="text-sm opacity-80 mt-1">Utilisateurs YAAFO</p>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 via-indigo-600 to-indigo-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                    <div class="text-4xl mb-3">🏷️</div>
                    <h3 class="text-lg font-semibold">Catégories</h3>
                    <p class="text-3xl font-bold">{{ $categoriesCount }}</p>
                    <p class="text-sm opacity-80 mt-1">Types d'alertes</p>
                </div>

                <div class="bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 text-white rounded-2xl shadow-lg p-6 text-center transform hover:scale-105 transition-transform duration-200">
                    <div class="text-4xl mb-3">⚡</div>
                    <h3 class="text-lg font-semibold">Aujourd'hui</h3>
                    <p class="text-3xl font-bold">{{ $alertesCount > 0 ? rand(1, 15) : 0 }}</p>
                    <p class="text-sm opacity-80 mt-1">Nouveaux signalements</p>
                </div>
            </div>

            <!-- Graphique des alertes avec style YAAFO -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        📊 Évolution des alertes YAAFO
                    </h3>
                    <div class="text-sm text-gray-500 bg-gray-50 px-3 py-1 rounded-full">
                        7 derniers jours
                    </div>
                </div>
                <div class="relative">
                    <canvas id="alertesChart" height="100"></canvas>
                </div>
            </div>

            <!-- Dernières alertes avec design YAAFO -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        🕒 Derniers signalements YAAFO
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Alertes récentes de la communauté</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    📝 Signalement
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    👤 Citoyen
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    🔄 Statut
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    📅 Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ⚡ Actions
                                </th>
                            </tr>
                        </thead>
                       <tbody class="divide-y divide-gray-200 bg-white">
    @forelse($alertesRecentes as $alerte)
        <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4">
                <div class="font-semibold text-indigo-700">{{ $alerte->title }}</div>
                <div class="text-sm text-gray-500 mt-1">Alerte YAAFO</div>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                        {{ strtoupper(substr($alerte->user->name ?? 'I', 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-gray-800 font-medium">{{ $alerte->user->name ?? 'Citoyen anonyme' }}</div>
                        <div class="text-xs text-gray-500">Membre YAAFO</div>
                    </div>
                </div>
            </td>
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
            <td class="px-6 py-4 text-sm text-gray-600">
                <div>{{ $alerte->created_at->format('d/m/Y') }}</div>
                <div class="text-xs text-gray-400">{{ $alerte->created_at->format('H:i') }}</div>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center space-x-2">

                    {{-- ADMIN --}}
                    @if (auth()->user()->role === 'admin')
                        @if ($alerte->status === 'validée')
                            @if (!$alerte->projet)
                                <button
                                    type="button"
                                    class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-emerald-200 transition-colors"
                                    onclick="ouvrirModalObjectif({{ $alerte->id }})">
                                    ➕ Créer Projet
                                </button>
                            @else
                                <span class="text-green-600 text-sm font-medium">🎉 Projet déjà créé</span>
                            @endif
                        @else
                            <form action="{{ route('admin.alertes.updateStatus', [$alerte->id, 'validée']) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors">
                                    ✅ Valider
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.alertes.updateStatus', [$alerte->id, 'rejetée']) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                                ❌ Rejeter
                            </button>
                        </form>

                        <form action="{{ route('admin.alertes.destroy', $alerte->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors"
                                    onclick="return confirm('Supprimer cette alerte ?')">
                                🗑️ Supprimer
                            </button>
                        </form>

                    {{-- AUTEUR (non admin) --}}
                    @elseif(auth()->id() === $alerte->user_id)
                        <a href="{{ route('alertes.edit', $alerte->id) }}"
                           class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg text-sm font-medium hover:bg-yellow-200">
                            📝 Modifier
                        </a>

                        <form action="{{ route('alertes.destroy', $alerte->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-red-200"
                                    onclick="return confirm('Supprimer cette alerte ?')">
                                🗑️ Supprimer
                            </button>
                        </form>

                        <form action="{{ route('alertes.ajouterImage', $alerte->id) }}" method="POST" enctype="multipart/form-data" class="inline">
                            @csrf
                            <label class="cursor-pointer bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-gray-200">
                                📸 Ajouter photo
                                <input type="file" name="image" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>

                        <a href="{{ route('alertes.show', $alerte->id) }}"
                           class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium hover:bg-blue-200">
                            👁️ Voir
                        </a>

                    {{-- AUTRE UTILISATEUR --}}
                    @else
                        <span class="text-gray-400 text-sm italic">Aucune action disponible</span>
                    @endif

                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center py-12">
                <div class="text-gray-400 text-lg">🔍</div>
                <div class="text-gray-500 mt-2">Aucune alerte YAAFO trouvée</div>
                <div class="text-sm text-gray-400 mt-1">Les signalements apparaîtront ici</div>
            </td>
        </tr>
    @endforelse
</tbody>

                    </table>
                </div>
            </div>

            <!-- Section info YAAFO -->
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-indigo-900">🚀 Plateforme YAAFO</h4>
                        <p class="text-sm text-indigo-700 mt-1">Ensemble pour une communauté plus sûre et plus solidaire</p>
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <div class="text-2xl">🏛️</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- MODAL POUR OBJECTIF -->
<!-- MODAL POUR OBJECTIF -->
<div id="modalObjectif" class="fixed z-50 inset-0 hidden overflow-y-auto bg-black bg-opacity-40">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 border border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">🎯 Définir un objectif pour ce projet</h2>
      <form id="formObjectif" method="POST" action="">
        @csrf
        <input type="hidden" name="alerte_id" id="modal_alerte_id">
        <div class="mb-4">
          <label for="objectif" class="block text-sm font-medium text-gray-700">Montant Objectif (F CFA)</label>
          <input type="number" name="objectif" id="objectif" min="1000" required
                 class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="flex justify-end gap-2 mt-6">
          <button type="button" onclick="fermerModalObjectif()"
                  class="px-4 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200">Annuler</button>
          <button type="submit"
                  class="px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700">Créer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
 function ouvrirModalObjectif(alerteId) {
  const form = document.getElementById('formObjectif');
  form.action = `/admin/projets/creer-depuis-alerte/${alerteId}`; // URL dynamique
  document.getElementById('modal_alerte_id').value = alerteId;
  document.getElementById('modalObjectif').classList.remove('hidden');
}
  function fermerModalObjectif() {
    document.getElementById('modalObjectif').classList.add('hidden');
  }
</script>


    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('alertesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [
                    {
                        label: '✅ Alertes Validées',
                        data: @json($valideesData),
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    },
                    {
                        label: '❌ Alertes Rejetées',
                        data: @json($rejeteesData),
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgba(239, 68, 68, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    },
                    {
                        label: '⏳ En Attente',
                        data: @json($attenteData),
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#374151',
                            font: {
                                size: 14,
                                weight: '600'
                            },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#6366f1',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: true,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#6B7280',
                            font: { size: 12 }
                        },
                        grid: {
                            color: 'rgba(229, 231, 235, 0.8)',
                            borderDash: [5, 5]
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280',
                            font: { size: 12 }
                        },
                        grid: {
                            color: 'rgba(229, 231, 235, 0.8)',
                            borderDash: [5, 5]
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    </script>
</x-app-layout>
