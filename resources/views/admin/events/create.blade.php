@extends('admin.layouts.app')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')

@section('content')

<div class="max-w-2xl">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold">
            Tambah Event
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan kegiatan atau event gereja.
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

    {{-- Form --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <form
            method="POST"
            action="{{ route('admin.events.store') }}"
            enctype="multipart/form-data">

            @csrf

            {{-- Nama Event --}}
            <div class="mb-5">

                <label
                    for="name"
                    class="block text-sm font-medium mb-2">

                    Nama Event

                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Perayaan Natal 2026"
                    class="w-full rounded-lg border-gray-300"
                    required>

                @error('name')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Foto --}}
            <div class="mb-5">

                <label
                    for="photo"
                    class="block text-sm font-medium mb-2">

                    Foto Event

                </label>

                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="w-full text-sm">

                <p class="text-xs text-gray-400 mt-1">
                    Maksimal 2 MB.
                </p>

                @error('photo')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                <div>

                    <label
                        for="start_date"
                        class="block text-sm font-medium mb-2">

                        Tanggal Mulai

                    </label>

                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date') }}"
                        class="w-full rounded-lg border-gray-300"
                        required>

                    @error('start_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="end_date"
                        class="block text-sm font-medium mb-2">

                        Tanggal Selesai

                    </label>

                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ old('end_date') }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('end_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Waktu --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                <div>

                    <label
                        for="start_time"
                        class="block text-sm font-medium mb-2">

                        Waktu Mulai

                    </label>

                    <input
                        type="time"
                        id="start_time"
                        name="start_time"
                        value="{{ old('start_time') }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('start_time')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="end_time"
                        class="block text-sm font-medium mb-2">

                        Waktu Selesai

                    </label>

                    <input
                        type="time"
                        id="end_time"
                        name="end_time"
                        value="{{ old('end_time') }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('end_time')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Lokasi --}}
            <div class="mb-5">

                <label
                    for="location"
                    class="block text-sm font-medium mb-2">

                    Lokasi

                </label>

                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location') }}"
                    placeholder="Contoh: Gedung Gereja GPIJS"
                    class="w-full rounded-lg border-gray-300">

                @error('location')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Deskripsi --}}
            <div class="mb-5">

                <label
                    for="description"
                    class="block text-sm font-medium mb-2">

                    Deskripsi

                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Tuliskan informasi mengenai event..."
                    class="w-full rounded-lg border-gray-300"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Button --}}
            <div class="flex gap-3">

                <a
                    href="{{ route('admin.events.index') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                    Simpan Event

                </button>

            </div>

        </form>

    </div>

</div>

@endsection