@extends('admin.layouts.app')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita')

@section('content')

    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Tambah Berita
            </h1>

            <p class="text-gray-500 mt-1">
                Tambahkan berita dan informasi seputar gereja.
            </p>
        </div>

        <a
            href="{{ route('admin.news.index') }}"
            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200"
        >
            Kembali
        </a>

    </div>


    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <form
            method="POST"
            action="{{ route('admin.news.store') }}"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- Judul --}}
            <div class="mb-5">

                <label
                    for="title"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Judul Berita
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan judul berita"
                >

                @error('title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Kategori --}}
            <div class="mb-5">

                <label
                    for="category"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Kategori
                </label>

                <select
                    id="category"
                    name="category"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Pilih kategori
                    </option>

                    <option
                        value="Kegiatan Gereja"
                        {{ old('category') === 'Kegiatan Gereja' ? 'selected' : '' }}
                    >
                        Kegiatan Gereja
                    </option>

                    <option
                        value="Pelayanan"
                        {{ old('category') === 'Pelayanan' ? 'selected' : '' }}
                    >
                        Pelayanan
                    </option>

                    <option
                        value="Pengumuman"
                        {{ old('category') === 'Pengumuman' ? 'selected' : '' }}
                    >
                        Pengumuman
                    </option>

                    <option
                        value="Kabar Jemaat"
                        {{ old('category') === 'Kabar Jemaat' ? 'selected' : '' }}
                    >
                        Kabar Jemaat
                    </option>

                    <option
                        value="Artikel Rohani"
                        {{ old('category') === 'Artikel Rohani' ? 'selected' : '' }}
                    >
                        Artikel Rohani
                    </option>

                    <option
                        value="Organisasi Gereja"
                        {{ old('category') === 'Organisasi Gereja' ? 'selected' : '' }}
                    >
                        Organisasi Gereja
                    </option>

                </select>

                @error('category')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tanggal Publikasi --}}
            <div class="mb-5">

                <label
                    for="published_at"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Tanggal Publikasi
                </label>

                <input
                    type="date"
                    id="published_at"
                    name="published_at"
                    value="{{ old('published_at', now()->format('Y-m-d')) }}"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                @error('published_at')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Foto --}}
            <div class="mb-5">

                <label
                    for="photo"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Foto Berita
                </label>

                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3"
                >

                <p class="text-sm text-gray-500 mt-1">
                    Maksimal 2 MB.
                </p>

                @error('photo')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Isi Berita --}}
            <div class="mb-6">

                <label
                    for="content"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Isi Berita
                </label>

                <textarea
                    id="content"
                    name="content"
                    rows="10"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Tulis isi berita..."
                >{{ old('content') }}</textarea>

                @error('content')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('admin.news.index') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >
                    Simpan Berita
                </button>

            </div>

        </form>

    </div>

@endsection