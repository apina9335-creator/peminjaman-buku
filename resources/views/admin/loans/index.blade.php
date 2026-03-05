<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Peminjaman - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="bg-white shadow p-4 mb-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Admin Panel 🛡️</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Permintaan Peminjaman Masuk 📩</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 shadow">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-4 border-b text-gray-600 font-semibold uppercase text-sm">Peminjam</th>
                        <th class="p-4 border-b text-gray-600 font-semibold uppercase text-sm">Buku</th>
                        <th class="p-4 border-b text-gray-600 font-semibold uppercase text-sm">Tgl Pinjam</th>
                        <th class="p-4 border-b text-gray-600 font-semibold uppercase text-sm">Status</th>
                        <th class="p-4 border-b text-gray-600 font-semibold uppercase text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">
                            <div class="font-bold text-gray-800">{{ $loan->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $loan->user->email }}</div>
                        </td>
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-medium">
                                {{ $loan->book->title }}
                            </span>
                            <div class="text-xs text-gray-500 mt-1">Stok Sisa: {{ $loan->book->stock }}</div>
                        </td>
                        <td class="p-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}
                        </td>
                        <td class="p-4">
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                {{ $loan->status }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" onsubmit="return confirm('Setujui peminjaman ini? Stok buku akan berkurang.');">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow text-sm font-bold transition">
                                        ✔ Setuju
                                    </button>
                                </form>

                                <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST" onsubmit="return confirm('Tolak peminjaman ini?');">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow text-sm font-bold transition">
                                        ✖ Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400 italic">
                            Belum ada permintaan peminjaman baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>