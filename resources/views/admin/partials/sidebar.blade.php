<div class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-64 bg-white border-r border-gray-200 shadow-md overflow-y-auto z-40">
    <nav class="h-full p-4 text-gray-700">
        <h2 class="text-xl font-bold mb-6 text-gray-800">🛠️ Admin Panel</h2>

        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-100 transition">
                    🏠 <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-green-100 transition">
                    👥 <span>Utilisateurs</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.alertes.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-red-100 transition">
                    🚨 <span>Alertes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-yellow-100 transition">
                    🗂️ <span>Catégories</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.parametres') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-gray-200 transition">
                    ⚙️ <span>Paramètres</span>
                </a>
            </li>
        </ul>

        <hr class="my-6 border-gray-300" />

        <div class="text-sm text-gray-500">
            Connecté en tant que : <strong>{{ Auth::user()->name }}</strong>
        </div>
    </nav>
</div>
