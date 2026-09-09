@extends('admin.layouts.app')

@section('title', 'Edit Penatalayan')
@section('page-title', 'Edit Penatalayan')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white rounded-xl shadow-sm p-6">

            <form
                method="POST"
                action="{{ route('admin.ministry-members.update', $ministryMember) }}">

                @csrf
                @method('PUT')

                <div class="mb-5">

                    <label
                        for="ministry_id"
                        class="block text-sm font-medium mb-2">
                        Bidang Pelayanan
                    </label>

                    <select
                        id="ministry_id"
                        name="ministry_id"
                        class="w-full rounded-lg border-gray-300">

                        @foreach ($ministries as $ministry)

                            <option
                                value="{{ $ministry->id }}"
                                {{ old('ministry_id', $ministryMember->ministry_id) == $ministry->id ? 'selected' : '' }}>

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


                <div class="mb-5">

                    <label
                        for="name"
                        class="block text-sm font-medium mb-2">
                        Nama
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $ministryMember->name) }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label
                        for="position"
                        class="block text-sm font-medium mb-2">
                        Posisi / Peran
                    </label>

                    <input
                        type="text"
                        id="position"
                        name="position"
                        value="{{ old('position', $ministryMember->position) }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('position')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label
                        for="bio"
                        class="block text-sm font-medium mb-2">
                        Bio / Profil Singkat
                    </label>

                    <textarea
                        id="bio"
                        name="bio"
                        rows="5"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('bio', $ministryMember->bio) }}</textarea>

                    @error('bio')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mb-5">

                    <label
                        for="phone"
                        class="block text-sm font-medium mb-2">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $ministryMember->phone) }}"
                        class="w-full rounded-lg border-gray-300">

                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="flex gap-3">

                    <a
                        href="{{ route('admin.ministry-members.index') }}"
                        class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection