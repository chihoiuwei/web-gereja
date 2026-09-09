@extends('admin.layouts.app')

@section('title', 'Penatalayan')
@section('page-title', 'Penatalayan')

@section('content')

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Penatalayan
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola orang-orang yang melayani di gereja.
            </p>
        </div>

        <a
            href="{{ route('admin.ministry-members.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            + Tambah Penatalayan
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


    {{-- CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

        @forelse ($members as $member)

            {{-- CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- FOTO --}}
                <div class="h-48 bg-gray-50 flex items-center justify-center">

                    @if ($member->jemaat && $member->jemaat->photo)

                        <img
                            src="{{ asset('storage/' . $member->jemaat->photo) }}"
                            alt="{{ $member->jemaat->name }}"
                            class="max-h-full max-w-full object-contain"
                        >

                    @else

                        <div class="flex flex-col items-center justify-center text-gray-400">

                            <div class="text-5xl mb-3">
                                👤
                            </div>

                            <span>
                                Belum ada foto
                            </span>

                        </div>

                    @endif

                </div>


                {{-- CONTENT --}}
                <div class="p-6">

                    {{-- HEADER CARD --}}
                    <div class="flex items-start justify-between gap-4">

                        <div class="min-w-0">

                            <h2 class="text-xl font-bold text-gray-800 truncate">
                                {{ $member->jemaat->name ?? '-' }}
                            </h2>

                            <p class="text-sm text-gray-400 mt-1">
                                {{ $member->ministry->name ?? '-' }}
                            </p>

                        </div>


                        {{-- STATUS --}}
                        @if ($member->is_active)

                            <span class="shrink-0 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                ● Aktif
                            </span>

                        @else

                            <span class="shrink-0 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                ● Tidak Aktif
                            </span>

                        @endif

                    </div>


                    {{-- POSISI --}}
                    <div class="mt-6">

                        <p class="text-sm text-gray-400">
                            Posisi
                        </p>

                        <p class="text-gray-700 font-medium mt-1">
                            {{ $member->position ?? '-' }}
                        </p>

                    </div>


                    {{-- GARIS --}}
                    <div class="border-t border-gray-200 my-5"></div>


                    {{-- EDIT BUTTON --}}
                    <button
                        type="button"
                        onclick="openEditModal({{ $member->id }})"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium"
                    >
                        Edit
                    </button>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- MODAL EDIT --}}
            {{-- ========================= --}}

            <div
                id="editModal{{ $member->id }}"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
            >

                <div
                    class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6"
                    onclick="event.stopPropagation()"
                >

                    {{-- MODAL HEADER --}}
                    <div class="flex items-center justify-between mb-6">

                        <div>

                            <h2 class="text-xl font-bold text-gray-800">
                                Edit Penatalayan
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Ubah data penatalayan.
                            </p>

                        </div>

                        <button
                            type="button"
                            onclick="closeEditModal({{ $member->id }})"
                            class="text-gray-400 hover:text-gray-700 text-2xl"
                        >
                            &times;
                        </button>

                    </div>


                    {{-- FORM UPDATE --}}
                    <form
                        method="POST"
                        action="{{ route('admin.ministry-members.update', $member) }}"
                    >

                        @csrf
                        @method('PUT')


                        {{-- JEMAAT --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Nama Jemaat
                            </label>

                            <select
                                name="jemaat_id"
                                class="w-full rounded-lg border-gray-300"
                                required
                            >

                                @foreach ($jemaats as $jemaat)

                                    <option
                                        value="{{ $jemaat->id }}"
                                        {{ $member->jemaat_id == $jemaat->id ? 'selected' : '' }}
                                    >
                                        {{ $jemaat->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- BIDANG PELAYANAN --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Bidang Pelayanan
                            </label>

                            <select
                                name="ministry_id"
                                class="w-full rounded-lg border-gray-300"
                                required
                            >

                                @foreach ($ministries as $ministry)

                                    <option
                                        value="{{ $ministry->id }}"
                                        {{ $member->ministry_id == $ministry->id ? 'selected' : '' }}
                                    >
                                        {{ $ministry->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- POSISI --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Posisi / Peran
                            </label>

                            <input
                                type="text"
                                name="position"
                                value="{{ $member->position }}"
                                placeholder="Contoh: Worship Leader"
                                class="w-full rounded-lg border-gray-300"
                            >

                        </div>


                        {{-- STATUS --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                Status
                            </label>

                            <select
                                name="is_active"
                                class="w-full rounded-lg border-gray-300"
                                required
                            >

                                <option
                                    value="1"
                                    {{ $member->is_active ? 'selected' : '' }}
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    {{ !$member->is_active ? 'selected' : '' }}
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <div class="border-t border-gray-200 pt-5">

                            <div class="flex items-center justify-between">

                                {{-- HAPUS --}}
                                <button
                                    type="button"
                                    onclick="deleteMember({{ $member->id }})"
                                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                                >
                                    Hapus Data
                                </button>


                                {{-- KANAN --}}
                                <div class="flex gap-3">

                                    <button
                                        type="button"
                                        onclick="closeEditModal({{ $member->id }})"
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

                    </form>


                    {{-- FORM DELETE --}}
                    <form
                        id="deleteMemberForm{{ $member->id }}"
                        method="POST"
                        action="{{ route('admin.ministry-members.destroy', $member) }}"
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
                    Belum ada data penatalayanan.
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

            const modal = document.getElementById('editModal' + id);

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

            const modal = document.getElementById('editModal' + id);

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }


        // =========================
        // DELETE MEMBER
        // =========================

        function deleteMember(id) {

            if (!confirm('Yakin ingin menghapus penatalayan ini?')) {
                return;
            }

            const form = document.getElementById(
                'deleteMemberForm' + id
            );

            if (form) {
                form.submit();
            }

        }


        // =========================
        // CLOSE CLICK OVERLAY
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