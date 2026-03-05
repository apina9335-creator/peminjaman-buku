<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Form Edit Buku --}}
                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING: Mengubah method POST menjadi PUT untuk update --}}

                        {{-- Judul --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Buku</label>
                            <input type="text" name="title" value="{{ old('title', $book->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        {{-- Penulis --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Penulis</label>
                            <input type="text" name="author" value="{{ old('author', $book->author) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                            <select name="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="Fiksi" {{ $book->category == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                                <option value="Non-Fiksi" {{ $book->category == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                <option value="Sains" {{ $book->category == 'Sains' ? 'selected' : '' }}>Sains</option>
                                <option value="Sejarah" {{ $book->category == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                                <option value="Teknologi" {{ $book->category == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                            </select>
                        </div>

                        {{-- Stok --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" min="0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $book->description) }}</textarea>
                        </div>

                        {{-- Cover Image --}}
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Cover Buku (Opsional)</label>
                            
                            {{-- Preview Gambar Lama --}}
                            @if($book->cover_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Lama" class="w-32 h-48 object-cover rounded shadow">
                                    <p class="text-xs text-gray-500 mt-1">Cover saat ini</p>
                                </div>
                            @endif

                            <input type="file" name="cover_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah cover.</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Update Buku
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>