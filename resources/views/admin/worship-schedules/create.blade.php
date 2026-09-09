@extends('admin.layouts.app')

@section('title', 'Tambah Jadwal Ibadah')
@section('page-title', 'Tambah Jadwal Ibadah')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl shadow-sm p-6">

        <form
            method="POST"
            action="{{ route('admin.worship-schedules.store') }}"
            enctype="multipart/form-data"
        >

            @csrf

            {{-- Nama Ibadah --}}
            <div class="mb-5">

                <label
                    for="name"
                    class="block text-sm font-medium mb-2"
                >
                    Nama Ibadah
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Ibadah Raya"
                    class="w-full rounded-lg border-gray-300"
                    required
                >

                @error('name')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Hari --}}
            <div class="mb-5">

                <label
                    for="day"
                    class="block text-sm font-medium mb-2"
                >
                    Hari
                </label>

                <select
                    id="day"
                    name="day"
                    class="w-full rounded-lg border-gray-300"
                    required
                >

                    <option value="">
                        -- Pilih Hari --
                    </option>

                    @foreach ([
                        'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat',
                        'Sabtu',
                        'Minggu'
                    ] as $day)

                        <option
                            value="{{ $day }}"
                            {{ old('day') == $day ? 'selected' : '' }}
                        >
                            {{ $day }}
                        </option>

                    @endforeach

                </select>

                @error('day')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Waktu --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                <div>

                    <label
                        for="start_time"
                        class="block text-sm font-medium mb-2"
                    >
                        Jam Mulai
                    </label>

                    <input
                        type="time"
                        id="start_time"
                        name="start_time"
                        value="{{ old('start_time') }}"
                        class="w-full rounded-lg border-gray-300"
                        required
                    >

                    @error('start_time')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="end_time"
                        class="block text-sm font-medium mb-2"
                    >
                        Jam Selesai
                    </label>

                    <input
                        type="time"
                        id="end_time"
                        name="end_time"
                        value="{{ old('end_time') }}"
                        class="w-full rounded-lg border-gray-300"
                    >

                    @error('end_time')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- Flyer --}}
            <div class="mb-6">

                <label
                    for="photo"
                    class="block text-sm font-medium mb-2"
                >
                    Flyer Jadwal Ibadah
                </label>

                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3"
                >

                <p class="text-sm text-gray-500 mt-1">
                    Upload flyer jadwal ibadah. Maksimal 2 MB.
                </p>

                @error('photo')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">

                <label
                    for="description"
                    class="block text-sm font-medium mb-2"
                >
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Keterangan tambahan tentang jadwal ibadah..."
                    class="w-full rounded-lg border-gray-300"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('admin.worship-schedules.index') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >
                    Simpan Jadwal
                </button>

            </div>

        </form>

    </div>

</div>

@endsection