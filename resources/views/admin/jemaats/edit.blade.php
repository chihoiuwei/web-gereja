@extends('admin.layouts.app')

@section('title', 'Edit Jemaat')
@section('page-title', 'Edit Jemaat')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white rounded-xl shadow-sm p-6">

            <form
                method="POST"
                action="{{ route('admin.jemaats.update', $jemaat->id) }}"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                {{-- Foto Jemaat --}}
                <div class="mb-6">

                    <label class="block text-sm font-medium mb-2">
                        Foto Jemaat
                    </label>

                    @if ($jemaat->photo)

                        <img
                            src="{{ asset('storage/' . $jemaat->photo) }}"
                            alt="{{ $jemaat->name }}"
                            class="w-32 h-32 object-cover rounded-xl mb-3"
                        >

                    @else

                        <div class="w-32 h-32 bg-gray-100 rounded-xl flex items-center justify-center mb-3">
                            <span class="text-gray-400 text-sm text-center px-2">
                                Belum ada foto
                            </span>
                        </div>

                    @endif

                    <input
                        type="file"
                        name="photo"
                        accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3"
                    >

                    <p class="text-sm text-gray-500 mt-1">
                        Kosongkan jika tidak ingin mengganti foto.
                    </p>

                    @error('photo')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Nama --}}
                <div class="mb-5">

                    <label
                        for="name"
                        class="block text-sm font-medium mb-2"
                    >
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $jemaat->name) }}"
                        class="w-full rounded-lg border-gray-300"
                        required
                    >

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Tanggal Lahir --}}
                <div class="mb-5">

                    <label
                        for="birth_date"
                        class="block text-sm font-medium mb-2"
                    >
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        id="birth_date"
                        name="birth_date"
                        value="{{ old('birth_date', $jemaat->birth_date?->format('Y-m-d')) }}"
                        class="w-full rounded-lg border-gray-300"
                    >

                    @error('birth_date')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- No Telepon --}}
                <div class="mb-5">

                    <label
                        for="phone"
                        class="block text-sm font-medium mb-2"
                    >
                        No. Telepon
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $jemaat->phone) }}"
                        class="w-full rounded-lg border-gray-300"
                    >

                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Alamat --}}
                <div class="mb-5">

                    <label
                        for="address"
                        class="block text-sm font-medium mb-2"
                    >
                        Alamat
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('address', $jemaat->address) }}</textarea>

                    @error('address')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Bio --}}
                <div class="mb-5">

                    <label
                        for="bio"
                        class="block text-sm font-medium mb-2"
                    >
                        Profil Singkat / Biodata
                    </label>

                    <textarea
                        id="bio"
                        name="bio"
                        rows="5"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('bio', $jemaat->bio) }}</textarea>

                    @error('bio')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-6">

                    <label
                        for="is_active"
                        class="block text-sm font-medium mb-2"
                    >
                        Status Jemaat
                    </label>

                    <select
                        id="is_active"
                        name="is_active"
                        class="w-full rounded-lg border-gray-300"
                    >

                        <option
                            value="1"
                            {{ old('is_active', $jemaat->is_active) == 1 ? 'selected' : '' }}
                        >
                            Aktif
                        </option>

                        <option
                            value="0"
                            {{ old('is_active', $jemaat->is_active) == 0 ? 'selected' : '' }}
                        >
                            Tidak Aktif
                        </option>

                    </select>

                    @error('is_active')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Tombol Edit --}}
            {{-- Tombol Edit --}}
<div class="flex justify-end gap-3 mt-6">

    <a
        href="{{ route('admin.jemaats.index') }}"
        class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50"
    >
        Batal
    </a>

    <button
        type="submit"
        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
    >
        Simpan Perubahan
    </button>

</div>

</form>


{{-- Form Hapus --}}
<form
    method="POST"
    action="{{ route('admin.jemaats.destroy', $jemaat->id) }}"
    onsubmit="return confirm('Yakin ingin menghapus data jemaat ini?')"
    class="mt-3"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="w-full px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
    >
        Hapus Data
    </button>
</form>

        </div>

    </div>      

@endsection