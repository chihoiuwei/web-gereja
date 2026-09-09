@extends('admin.layouts.app')

@section('title', 'Tambah Album')
@section('page-title', 'Tambah Album')

@section('content')

<div class="max-w-3xl">

    <div class="mb-6">
        <h2 class="text-2xl font-bold">
            Tambah Album
        </h2>

        <p class="text-gray-500 mt-1">
            Buat album dan upload beberapa foto sekaligus.
        </p>
    </div>


    {{-- Error --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-5">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="bg-white rounded-xl shadow-sm p-6">

        <form method="POST"
              action="{{ route('admin.galleries.store') }}"
              enctype="multipart/form-data">

            @csrf


            {{-- Judul Album --}}
            <div class="mb-5">

                <label for="title"
                       class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Album
                </label>

                <input type="text"
                       id="title"
                       name="title"
                       value="{{ old('title') }}"
                       required
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Contoh: Ibadah Minggu">

                @error('title')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Foto --}}
            <div class="mb-5">

                <label for="photos"
                       class="block text-sm font-medium text-gray-700 mb-2">
                    Foto Album
                </label>

                <input type="file"
                       id="photos"
                       name="photos[]"
                       accept="image/*"
                       multiple
                       required
                       class="w-full rounded-lg border border-gray-300 px-3 py-2">

                <p class="text-xs text-gray-500 mt-1">
                    Pilih beberapa foto sekaligus. Maksimal 2 MB per foto.
                </p>

                @error('photos')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror

                @error('photos.*')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Preview Foto --}}
            <div id="previewContainer"
                 class="hidden mb-6">

                <div class="flex items-center justify-between mb-3">

                    <h3 class="text-sm font-medium text-gray-700">
                        Foto dalam Album
                    </h3>

                    <span id="photoCount"
                          class="text-xs text-gray-500">
                    </span>

                </div>

                <div id="previewGrid"
                     class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                </div>

            </div>


            {{-- Tanggal --}}
            <div class="mb-5">

                <label for="taken_at"
                       class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Kegiatan
                </label>

                <input type="date"
                       id="taken_at"
                       name="taken_at"
                       value="{{ old('taken_at') }}"
                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                @error('taken_at')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Deskripsi --}}
            <div class="mb-6">

                <label for="description"
                       class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Album
                </label>

                <textarea id="description"
                          name="description"
                          rows="4"
                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                          placeholder="Deskripsi album (opsional)">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex gap-3">

                <a href="{{ route('admin.galleries.index') }}"
                   class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                    Batal
                </a>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Simpan Album
                </button>

            </div>

        </form>

    </div>

</div>


<script>

    const photosInput = document.getElementById('photos');
    const previewContainer = document.getElementById('previewContainer');
    const previewGrid = document.getElementById('previewGrid');
    const photoCount = document.getElementById('photoCount');

    photosInput.addEventListener('change', function () {

        previewGrid.innerHTML = '';

        const files = this.files;

        if (!files.length) {
            previewContainer.classList.add('hidden');
            return;
        }

        previewContainer.classList.remove('hidden');

        photoCount.textContent =
            `${files.length} foto dipilih`;

        Array.from(files).forEach(function (file) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const wrapper = document.createElement('div');

                wrapper.className =
                    'bg-gray-100 rounded-lg overflow-hidden';

                wrapper.innerHTML = `
                    <div class="h-32 flex items-center justify-center p-2">
                        <img
                            src="${event.target.result}"
                            alt="${file.name}"
                            class="max-h-full max-w-full object-contain">
                    </div>

                    <div class="px-2 py-2 bg-white">
                        <p class="text-xs text-gray-600 truncate"
                           title="${file.name}">
                            ${file.name}
                        </p>
                    </div>
                `;

                previewGrid.appendChild(wrapper);
            };

            reader.readAsDataURL(file);

        });

    });

</script>

@endsection