@extends('admin.layouts.app')

@section('title', 'Tambah Jemaat')
@section('page-title', 'Tambah Jemaat')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white rounded-xl shadow-sm p-6">

            <form
                method="POST"
                action="{{ route('admin.jemaats.store') }}"
                enctype="multipart/form-data">>


                @csrf

                <div class="mb-5">

                    <label
                        for="name"
                        class="block text-sm font-medium mb-2">

                        Nama Lengkap

                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-lg border-gray-300"
                        required>

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label
                        for="birth_date"
                        class="block text-sm font-medium mb-2">

                        Tanggal Lahir

                    </label>

                    <input
                        type="date"
                        id="birth_date"
                        name="birth_date"
                        value="{{ old('birth_date') }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('birth_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label
                        for="phone"
                        class="block text-sm font-medium mb-2">

                        No. Telepon

                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full rounded-lg border-gray-300">

                </div>


                <div class="mb-5">

                    <label
                        for="address"
                        class="block text-sm font-medium mb-2">

                        Alamat

                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('address') }}</textarea>

                </div>


                <div class="mb-5">

                    <label
                        for="bio"
                        class="block text-sm font-medium mb-2">

                        Profil Singkat / Biodata

                    </label>

                    <textarea
                        id="bio"
                        name="bio"
                        rows="5"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('bio') }}</textarea>

                </div>


                <div class="flex gap-3">

                    <a
                        href="{{ route('admin.jemaats.index') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">

                        Batal

                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">

                        Simpan Jemaat

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection