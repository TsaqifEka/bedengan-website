@extends('layouts.admin')

@section('title', (isset($equipment) ? 'Edit' : 'Tambah') . ' Equipment - Bedengan')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-bedengan-dark mb-2">
            {{ isset($equipment) ? 'Edit Equipment' : 'Tambah Equipment Baru' }}
        </h1>
        <p class="text-gray-500 mb-8">Isi form di bawah untuk {{ isset($equipment) ? 'mengubah' : 'menambahkan' }} equipment</p>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ isset($equipment) ? route('admin.equipment.update', $equipment->id) : route('admin.equipment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($equipment))
                    @method('PUT')
                @endif

                {{-- Nama Equipment --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Equipment <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $equipment->name ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-bedengan-primary focus:ring-2 focus:ring-green-200" placeholder="Contoh: Tenda 4 Orang">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-bedengan-primary focus:ring-2 focus:ring-green-200" placeholder="Jelaskan detail equipment ini...">{{ old('description', $equipment->description ?? '') }}</textarea>
                </div>

                {{-- Harga Per Hari --}}
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Hari (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ old('price', $equipment->price ?? '') }}" required min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-bedengan-primary focus:ring-2 focus:ring-green-200" placeholder="100000">
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stok (Unit) <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity', $equipment->quantity ?? '1') }}" required min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-bedengan-primary focus:ring-2 focus:ring-green-200" placeholder="5">
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Equipment</label>
                    <div class="flex gap-6 items-start">
                        {{-- Preview Gambar --}}
                        @if(isset($equipment) && $equipment->image)
                            <div class="w-32 h-32 rounded-lg overflow-hidden border-2 border-gray-200 flex-shrink-0">
                                <img id="imagePreview" src="{{ asset('storage/' . $equipment->image) }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div id="imagePreviewBox" class="w-32 h-32 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center flex-shrink-0 bg-gray-50 {{ isset($equipment) && $equipment->image ? '' : 'hidden' }}">
                                <img id="imagePreview" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        {{-- Input File --}}
                        <div class="flex-1">
                            <input type="file" name="image" id="imageInput" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-bedengan-primary file:bg-bedengan-primary file:text-white file:rounded-lg file:border-0 file:px-4 file:py-2 file:cursor-pointer">
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF (Max 5MB)</p>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-bedengan-primary hover:bg-green-600 text-white font-bold py-3 rounded-lg shadow-lg transition-all transform hover:-translate-y-0.5">
                        {{ isset($equipment) ? '💾 Perbarui Equipment' : '➕ Tambah Equipment' }}
                    </button>
                    <a href="{{ route('admin.equipment.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 rounded-lg text-center transition-colors">
                        ❌ Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    let previewBox = document.getElementById('imagePreviewBox');
                    let preview = document.getElementById('imagePreview');
                    
                    if (!previewBox) {
                        previewBox = document.createElement('div');
                        previewBox.id = 'imagePreviewBox';
                        previewBox.className = 'w-32 h-32 rounded-lg overflow-hidden border-2 border-gray-200 flex-shrink-0';
                        document.querySelector('.flex-1').parentElement.insertBefore(previewBox, document.querySelector('.flex-1'));
                        preview = document.createElement('img');
                        preview.id = 'imagePreview';
                        preview.className = 'w-full h-full object-cover';
                        previewBox.appendChild(preview);
                    }
                    
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
