@extends('admin.layouts.app')

@section('title', 'Tambah Penatalayan')
@section('page-title', 'Tambah Penatalayan')

@section('content')

<div class="max-w-2xl">

    <div class="bg-white rounded-xl shadow-sm p-6">

        <form
            method="POST"
            action="{{ route('admin.ministry-members.store') }}"
        >

            @csrf

            {{-- Jemaat --}}
            <div class="mb-5">

                <label
                    for="jemaat_id"
                    class="block text-sm font-medium mb-2"
                >
                    Jemaat
                </label>

                <select
                    id="jemaat_id"
                    name="jemaat_id"
                    class="w-full rounded-lg border-gray-300"
                    required
                >

                    <option value="">
                        -- Pilih Jemaat --
                    </option>

                    @foreach ($jemaats as $jemaat)

                        <option
                            value="{{ $jemaat->id }}"
                            {{ old('jemaat_id') == $jemaat->id ? 'selected' : '' }}
                        >
                            {{ $jemaat->name }}
                        </option>

                    @endforeach

                </select>

                @error('jemaat_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Bidang Pelayanan --}}
            <div class="mb-5">

                <label
                    for="ministry_id"
                    class="block text-sm font-medium mb-2"
                >
                    Bidang Pelayanan
                </label>

                <select
                    id="ministry_id"
                    name="ministry_id"
                    class="w-full rounded-lg border-gray-300"
                    required
                >

                    <option value="">
                        -- Pilih Bidang Pelayanan --
                    </option>

                    @foreach ($ministries as $ministry)

                        <option
                            value="{{ $ministry->id }}"
                            {{ old('ministry_id') == $ministry->id ? 'selected' : '' }}
                        >
                            {{ $ministry->name }}
                        </option>

                    @endforeach

                </select>

                @error('ministry_id')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Posisi --}}
            <div class="mb-6">

                <label
                    for="position"
                    class="block text-sm font-medium mb-2"
                >
                    Posisi / Peran
                </label>

                <input
                    type="text"
                    id="position"
                    name="position"
                    value="{{ old('position') }}"
                    placeholder="Contoh: Worship Leader"
                    class="w-full rounded-lg border-gray-300"
                >

                @error('position')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex gap-3">

                <a
                    href="{{ route('admin.ministry-members.index') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection