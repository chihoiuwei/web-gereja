@extends('admin.layouts.app')

@section('title', 'Tambah Pelayanan')
@section('page-title', 'Tambah Pelayanan')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white rounded-xl shadow-sm p-6">

            <form method="POST" action="{{ route('admin.ministries.store') }}">

                @csrf

                <div class="mb-5">

                    <label for="name" class="block text-sm font-medium mb-2">
                        Nama Pelayanan
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-lg border-gray-300"
                        placeholder="Contoh: Musik"
                    >

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label for="description" class="block text-sm font-medium mb-2">
                        Deskripsi
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full rounded-lg border-gray-300"
                        placeholder="Deskripsi singkat pelayanan..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="flex gap-3">

                    <a href="{{ route('admin.ministries.index') }}"
                       class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection