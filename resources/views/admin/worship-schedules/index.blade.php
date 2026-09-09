@extends('admin.layouts.app')

@section('title', 'Jadwal Ibadah')
@section('page-title', 'Jadwal Ibadah')

@section('content')

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Jadwal Ibadah
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola jadwal ibadah gereja.
            </p>
        </div>

        <a
            href="{{ route('admin.worship-schedules.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            + Tambah Jadwal
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


    {{-- CARD JADWAL --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

        @forelse ($schedules as $schedule)

            {{-- CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- FLYER --}}
                <div class="h-48 bg-gray-50 flex items-center justify-center">

                    @if ($schedule->photo)

                        <img
                            src="{{ asset('storage/' . $schedule->photo) }}"
                            alt="{{ $schedule->name }}"
                            class="max-w-full max-h-full object-contain"
                        >

                    @else

                        <div class="flex flex-col items-center justify-center text-gray-400">

                            <div class="text-4xl mb-2">
                                📅
                            </div>

                            <span class="text-sm">
                                Belum ada flyer
                            </span>

                        </div>

                    @endif

                </div>


                {{-- CONTENT --}}
                <div class="p-5">

                    {{-- HEADER --}}
                    <div class="flex items-start justify-between gap-3">

                        <h2 class="text-lg font-bold text-gray-800">
                            {{ $schedule->name }}
                        </h2>


                        {{-- STATUS --}}
                        @if ($schedule->is_active)

                            <span class="shrink-0 bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-medium">
                                ● Aktif
                            </span>

                        @else

                            <span class="shrink-0 bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs font-medium">
                                ● Tidak Aktif
                            </span>

                        @endif

                    </div>


                    {{-- HARI --}}
                    <div class="mt-5">

                        <p class="text-sm text-gray-400">
                            Hari
                        </p>

                        <p class="text-gray-700 font-medium mt-1">
                            {{ $schedule->day }}
                        </p>

                    </div>


                    {{-- JAM --}}
                    <div class="mt-4">

                        <p class="text-sm text-gray-400">
                            Waktu
                        </p>

                        <p class="text-gray-700 font-medium mt-1">

                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                            @if ($schedule->end_time)

                                - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                            @endif

                        </p>

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="mt-4">

                        <p class="text-sm text-gray-400">
                            Deskripsi
                        </p>

                        <p class="text-gray-600 text-sm mt-1 line-clamp-2">
                            {{ $schedule->description ?? '-' }}
                        </p>

                    </div>


                    {{-- GARIS --}}
                    <div class="border-t border-gray-200 my-5"></div>


                    {{-- TOMBOL EDIT --}}
                    <button
                        type="button"
                        onclick="openEditModal({{ $schedule->id }})"
                        class="w-full px-4 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium"
                    >
                        Edit
                    </button>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- MODAL EDIT --}}
            {{-- ========================= --}}

            <div
                id="editModal{{ $schedule->id }}"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
            >

                <div
                    class="w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-xl"
                    onclick="event.stopPropagation()"
                >

                    {{-- HEADER MODAL --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b">

                        <div>

                            <h2 class="text-xl font-bold text-gray-800">
                                Edit Jadwal Ibadah
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Ubah informasi jadwal ibadah.
                            </p>

                        </div>

                        <button
                            type="button"
                            onclick="closeEditModal({{ $schedule->id }})"
                            class="text-gray-400 hover:text-gray-600 text-2xl"
                        >
                            &times;
                        </button>

                    </div>


                    {{-- FORM EDIT --}}
                    <form
                        method="POST"
                        action="{{ route('admin.worship-schedules.update', $schedule) }}"
                        enctype="multipart/form-data"
                        id="editScheduleForm{{ $schedule->id }}"
                    >

                        @csrf
                        @method('PUT')


                        <div class="p-6">


                            {{-- NAMA --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Nama Ibadah
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ $schedule->name }}"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                            </div>


                            {{-- HARI --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Hari
                                </label>

                                <select
                                    name="day"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

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
                                            {{ $schedule->day === $day ? 'selected' : '' }}
                                        >
                                            {{ $day }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- WAKTU --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                                <div>

                                    <label class="block text-sm font-medium mb-2">
                                        Jam Mulai
                                    </label>

                                    <input
                                        type="time"
                                        name="start_time"
                                        value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}"
                                        class="w-full rounded-lg border-gray-300"
                                        required
                                    >

                                </div>


                                <div>

                                    <label class="block text-sm font-medium mb-2">
                                        Jam Selesai
                                    </label>

                                    <input
                                        type="time"
                                        name="end_time"
                                        value="{{ $schedule->end_time ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : '' }}"
                                        class="w-full rounded-lg border-gray-300"
                                    >

                                </div>

                            </div>


                            {{-- FLYER --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Flyer Jadwal Ibadah
                                </label>


                                @if ($schedule->photo)

                                    <div class="mb-3 h-40 bg-gray-50 rounded-lg flex items-center justify-center">

                                        <img
                                            src="{{ asset('storage/' . $schedule->photo) }}"
                                            alt="{{ $schedule->name }}"
                                            class="max-w-full max-h-full object-contain"
                                        >

                                    </div>

                                @endif


                                <input
                                    type="file"
                                    name="photo"
                                    accept="image/*"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3"
                                >


                                <p class="text-sm text-gray-500 mt-1">
                                    Kosongkan jika tidak ingin mengganti flyer.
                                </p>

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
                                >{{ $schedule->description }}</textarea>

                            </div>


                            {{-- STATUS --}}
                            <div class="mb-6">

                                <label class="block text-sm font-medium mb-2">
                                    Status Jadwal
                                </label>

                                <select
                                    name="is_active"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                                    <option
                                        value="1"
                                        {{ $schedule->is_active ? 'selected' : '' }}
                                    >
                                        Aktif
                                    </option>

                                    <option
                                        value="0"
                                        {{ !$schedule->is_active ? 'selected' : '' }}
                                    >
                                        Tidak Aktif
                                    </option>

                                </select>

                            </div>


                            {{-- ========================= --}}
                            {{-- BUTTON --}}
                            {{-- ========================= --}}

                            <div class="border-t border-gray-200 pt-5">

                                <div class="flex items-center justify-between">


                                    {{-- HAPUS --}}
                                    <button
                                        type="button"
                                        onclick="deleteSchedule({{ $schedule->id }})"
                                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                                    >
                                        Hapus Data
                                    </button>


                                    {{-- KANAN --}}
                                    <div class="flex gap-3">

                                        <button
                                            type="button"
                                            onclick="closeEditModal({{ $schedule->id }})"
                                            class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50"
                                        >
                                            Batal
                                        </button>


                                        <button
                                            type="submit"
                                            class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                                        >
                                            Simpan Perubahan
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>


                    {{-- FORM DELETE TERPISAH --}}
                    <form
                        id="deleteScheduleForm{{ $schedule->id }}"
                        method="POST"
                        action="{{ route('admin.worship-schedules.destroy', $schedule) }}"
                        class="hidden"
                    >

                        @csrf
                        @method('DELETE')

                    </form>

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="col-span-full bg-white rounded-2xl p-10 text-center text-gray-500">

                <p>
                    Belum ada jadwal ibadah.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ========================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================= --}}

    <script>

        // =========================
        // OPEN MODAL
        // =========================

        function openEditModal(id) {

            const modal = document.getElementById(
                'editModal' + id
            );

            if (!modal) {
                return;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

        }


        // =========================
        // CLOSE MODAL
        // =========================

        function closeEditModal(id) {

            const modal = document.getElementById(
                'editModal' + id
            );

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }


        // =========================
        // DELETE SCHEDULE
        // =========================

        function deleteSchedule(id) {

            if (!confirm('Yakin ingin menghapus jadwal ibadah ini?')) {
                return;
            }

            const form = document.getElementById(
                'deleteScheduleForm' + id
            );

            if (form) {
                form.submit();
            }

        }


        // =========================
        // CLOSE KLIK OVERLAY
        // =========================

        document
            .querySelectorAll('[id^="editModal"]')
            .forEach(function(modal) {

                modal.addEventListener('click', function(event) {

                    if (event.target === modal) {

                        const id = modal.id.replace(
                            'editModal',
                            ''
                        );

                        closeEditModal(id);

                    }

                });

            });


        // =========================
        // CLOSE ESC
        // =========================

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                document
                    .querySelectorAll('[id^="editModal"]')
                    .forEach(function(modal) {

                        modal.classList.add('hidden');
                        modal.classList.remove('flex');

                    });

                document.body.classList.remove('overflow-hidden');

            }

        });

    </script>

@endsection