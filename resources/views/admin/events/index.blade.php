@extends('admin.layouts.app')

@section('title', 'Event')
@section('page-title', 'Event')

@section('content')

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Event Gereja
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola kegiatan dan event gereja.
            </p>
        </div>

        <a
            href="{{ route('admin.events.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            + Tambah Event
        </a>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR --}}
    @if ($errors->any())

        <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded-lg">

            <ul class="list-disc list-inside text-sm">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- GRID CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        @forelse ($events as $event)

            {{-- CARD --}}
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                {{-- FOTO --}}
                <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">

                    @if ($event->photo)

                        <img
                            src="{{ asset('storage/' . $event->photo) }}"
                            alt="{{ $event->name }}"
                            class="w-full h-full object-contain"
                        >

                    @else

                        <div class="flex flex-col items-center justify-center text-gray-400">

                            <div class="text-5xl mb-3">
                                📅
                            </div>

                            <span>
                                Belum ada foto
                            </span>

                        </div>

                    @endif

                </div>


                {{-- INFORMASI --}}
                <div class="p-6">

                    {{-- Nama + Status --}}
                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0">

                            <h2 class="text-xl font-bold text-gray-800">
                                {{ $event->name }}
                            </h2>

                        </div>


                        {{-- STATUS --}}
                        @if ($event->is_active)

                            <span class="shrink-0 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                Aktif
                            </span>

                        @else

                            <span class="shrink-0 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                Tidak Aktif
                            </span>

                        @endif

                    </div>


                    {{-- DETAIL --}}
                    <div class="mt-5 space-y-3">

                        {{-- TANGGAL --}}
                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                                📅
                            </div>

                            <div>

                                <p class="text-xs text-gray-400">
                                    Tanggal
                                </p>

                                <p class="text-sm font-medium text-gray-700">

                                    {{ $event->start_date->format('d M Y') }}

                                    @if ($event->end_date)

                                        - {{ $event->end_date->format('d M Y') }}

                                    @endif

                                </p>

                            </div>

                        </div>


                        {{-- WAKTU --}}
                        @if ($event->start_time)

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                                    🕐
                                </div>

                                <div>

                                    <p class="text-xs text-gray-400">
                                        Waktu
                                    </p>

                                    <p class="text-sm font-medium text-gray-700">

                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}

                                        @if ($event->end_time)

                                            -
                                            {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}

                                        @endif

                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- LOKASI --}}
                        @if ($event->location)

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                                    📍
                                </div>

                                <div>

                                    <p class="text-xs text-gray-400">
                                        Lokasi
                                    </p>

                                    <p class="text-sm font-medium text-gray-700">
                                        {{ $event->location }}
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- DESKRIPSI --}}
                        @if ($event->description)

                            <div class="mt-4">

                                <p class="text-xs text-gray-400 mb-1">
                                    Deskripsi
                                </p>

                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $event->description }}
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- AKSI --}}
                    <div class="border-t mt-6 pt-5">

                        <button
                            type="button"
                            onclick="openEditModal({{ $event->id }})"
                            class="w-full text-center bg-gray-100 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-200"
                        >
                            Edit
                        </button>

                    </div>

                </div>

            </div>


            {{-- MODAL EDIT --}}
            <div
                id="editModal{{ $event->id }}"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
            >

                <div
                    class="w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-xl"
                >

                    {{-- HEADER MODAL --}}
                    <div class="flex items-center justify-between px-6 py-5 border-b">

                        <div>

                            <h2 class="text-xl font-bold text-gray-800">
                                Edit Event
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Ubah informasi event.
                            </p>

                        </div>

                        <button
                            type="button"
                            onclick="closeEditModal({{ $event->id }})"
                            class="text-gray-400 hover:text-gray-600 text-2xl"
                        >
                            &times;
                        </button>

                    </div>


                    {{-- FORM EDIT --}}
                    <form
                        id="editEventForm{{ $event->id }}"
                        method="POST"
                        action="{{ route('admin.events.update', $event) }}"
                        enctype="multipart/form-data"
                        class="p-6"
                    >

                        @csrf
                        @method('PUT')


                        {{-- FOTO --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Foto Event
                            </label>

                            <div
                                class="w-32 h-32 mb-3 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden"
                            >

                                @if ($event->photo)

                                    <img
                                        src="{{ asset('storage/' . $event->photo) }}"
                                        alt="{{ $event->name }}"
                                        class="w-full h-full object-contain"
                                    >

                                @else

                                    <span class="text-gray-400 text-sm">
                                        Belum ada foto
                                    </span>

                                @endif

                            </div>

                            <input
                                type="file"
                                name="photo"
                                accept="image/*"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2"
                            >

                            <p class="text-sm text-gray-500 mt-1">
                                Kosongkan jika tidak ingin mengganti foto.
                            </p>

                        </div>


                        {{-- NAMA --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Nama Event
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ $event->name }}"
                                class="w-full rounded-lg border-gray-300"
                                required
                            >

                        </div>


                        {{-- TANGGAL --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Tanggal Mulai
                                </label>

                                <input
                                    type="date"
                                    name="start_date"
                                    value="{{ $event->start_date?->format('Y-m-d') }}"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                            </div>


                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Tanggal Selesai
                                </label>

                                <input
                                    type="date"
                                    name="end_date"
                                    value="{{ $event->end_date?->format('Y-m-d') }}"
                                    class="w-full rounded-lg border-gray-300"
                                >

                            </div>

                        </div>


                        {{-- WAKTU --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Waktu Mulai
                                </label>

                                <input
                                    type="time"
                                    name="start_time"
                                    value="{{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('H:i') : '' }}"
                                    class="w-full rounded-lg border-gray-300"
                                >

                            </div>


                            <div>

                                <label class="block text-sm font-medium mb-2">
                                    Waktu Selesai
                                </label>

                                <input
                                    type="time"
                                    name="end_time"
                                    value="{{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('H:i') : '' }}"
                                    class="w-full rounded-lg border-gray-300"
                                >

                            </div>

                        </div>


                        {{-- LOKASI --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Lokasi
                            </label>

                            <input
                                type="text"
                                name="location"
                                value="{{ $event->location }}"
                                placeholder="Contoh: Gedung Gereja GPIJS"
                                class="w-full rounded-lg border-gray-300"
                            >

                        </div>


                        {{-- DESKRIPSI --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Deskripsi
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="w-full rounded-lg border-gray-300"
                            >{{ $event->description }}</textarea>

                        </div>


                        {{-- STATUS --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                Status Event
                            </label>

                            <select
                                name="is_active"
                                class="w-full rounded-lg border-gray-300"
                                required
                            >

                                <option
                                    value="1"
                                    {{ $event->is_active ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    {{ !$event->is_active ? 'selected' : '' }}
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <div class="flex items-center justify-between border-t pt-5">

                            {{-- HAPUS --}}
                            <button
                                type="button"
                                onclick="deleteEvent({{ $event->id }})"
                                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                            >
                                Hapus Data
                            </button>


                            {{-- KANAN --}}
                            <div class="flex gap-3">

                                <button
                                    type="button"
                                    onclick="closeEditModal({{ $event->id }})"
                                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50"
                                >
                                    Batal
                                </button>

                                <button
                                    type="submit"
                                    class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                                >
                                    Simpan Perubahan
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        @empty

            {{-- EMPTY --}}
            <div class="col-span-full bg-white rounded-xl p-10 text-center text-gray-500">

                <div class="text-5xl mb-3">
                    📅
                </div>

                <p>
                    Belum ada event.
                </p>

            </div>

        @endforelse

    </div>


@endsection


<script>

    // =========================
    // OPEN EDIT MODAL
    // =========================

    function openEditModal(id) {

        const modal = document.getElementById('editModal' + id);

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

    }


    // =========================
    // CLOSE EDIT MODAL
    // =========================

    function closeEditModal(id) {

        const modal = document.getElementById('editModal' + id);

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');

    }


    // =========================
    // DELETE EVENT
    // =========================

    function deleteEvent(id) {

        if (!confirm('Yakin ingin menghapus data event ini?')) {
            return;
        }

        const form = document.createElement('form');

        form.method = 'POST';
        form.action = `/admin/events/${id}`;

        form.innerHTML = `
            <input
                type="hidden"
                name="_token"
                value="{{ csrf_token() }}"
            >

            <input
                type="hidden"
                name="_method"
                value="DELETE"
            >
        `;

        document.body.appendChild(form);

        form.submit();

    }


    // =========================
    // CLOSE MODAL KLIK OVERLAY
    // =========================

    document.querySelectorAll('[id^="editModal"]').forEach(modal => {

        modal.addEventListener('click', function(event) {

            if (event.target === modal) {

                const id = modal.id.replace('editModal', '');

                closeEditModal(id);

            }

        });

    });

</script>