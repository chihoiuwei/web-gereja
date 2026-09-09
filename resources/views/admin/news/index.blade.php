@extends('admin.layouts.app')

@section('title', 'Berita')
@section('page-title', 'Berita')

@section('content')

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Berita Seputar Gereja
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola berita dan informasi seputar gereja.
            </p>
        </div>

        <a
            href="{{ route('admin.news.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            + Tambah Berita
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


    {{-- CARD BERITA --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

        @forelse ($news as $item)

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- FOTO --}}
                <div class="h-48 bg-gray-50 flex items-center justify-center">

                    @if ($item->photo)

                        <img
                            src="{{ asset('storage/' . $item->photo) }}"
                            alt="{{ $item->title }}"
                            class="max-w-full max-h-full object-contain"
                        >

                    @else

                        <div class="flex flex-col items-center justify-center text-gray-400">

                            <div class="text-4xl mb-2">
                                📰
                            </div>

                            <span class="text-sm">
                                Belum ada foto
                            </span>

                        </div>

                    @endif

                </div>


                {{-- CONTENT --}}
                <div class="p-5">

                    {{-- KATEGORI + STATUS --}}
                    <div class="flex items-start justify-between gap-3">

                        <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-medium">
                            {{ $item->category }}
                        </span>


                        @if ($item->is_active)

                            <span class="shrink-0 bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-medium">
                                ● Aktif
                            </span>

                        @else

                            <span class="shrink-0 bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs font-medium">
                                ● Tidak Aktif
                            </span>

                        @endif

                    </div>


                    {{-- JUDUL --}}
                    <h2 class="text-lg font-bold text-gray-800 mt-4 line-clamp-2">
                        {{ $item->title }}
                    </h2>


                    {{-- TANGGAL --}}
                    <div class="mt-4">

                        <p class="text-sm text-gray-400">
                            Tanggal Publikasi
                        </p>

                        <p class="text-gray-700 font-medium mt-1">
                            {{ $item->published_at->format('d M Y') }}
                        </p>

                    </div>


                    {{-- ISI BERITA --}}
                    <div class="mt-4">

                        <p class="text-sm text-gray-400">
                            Isi Berita
                        </p>

                        <p class="text-gray-600 text-sm mt-1 line-clamp-3">
                            {{ $item->content }}
                        </p>

                    </div>


                    {{-- GARIS --}}
                    <div class="border-t border-gray-200 my-5"></div>


                    {{-- EDIT --}}
                    <button
                        type="button"
                        onclick="openEditModal({{ $item->id }})"
                        class="w-full px-4 py-2.5 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium"
                    >
                        Edit
                    </button>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- MODAL EDIT BERITA --}}
            {{-- ========================================= --}}

            <div
                id="editModal{{ $item->id }}"
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
                                Edit Berita
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Ubah informasi berita.
                            </p>

                        </div>


                        <button
                            type="button"
                            onclick="closeEditModal({{ $item->id }})"
                            class="text-gray-400 hover:text-gray-600 text-2xl"
                        >
                            &times;
                        </button>

                    </div>


                    {{-- FORM UPDATE --}}
                    <form
                        method="POST"
                        action="{{ route('admin.news.update', $item) }}"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')


                        <div class="p-6">

                            {{-- JUDUL --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Judul Berita
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ $item->title }}"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                            </div>


                            {{-- KATEGORI --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Kategori
                                </label>

                                <select
                                    name="category"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                                    <option
                                        value="Kegiatan Gereja"
                                        {{ $item->category === 'Kegiatan Gereja' ? 'selected' : '' }}
                                    >
                                        Kegiatan Gereja
                                    </option>

                                    <option
                                        value="Pelayanan"
                                        {{ $item->category === 'Pelayanan' ? 'selected' : '' }}
                                    >
                                        Pelayanan
                                    </option>

                                    <option
                                        value="Pengumuman"
                                        {{ $item->category === 'Pengumuman' ? 'selected' : '' }}
                                    >
                                        Pengumuman
                                    </option>

                                    <option
                                        value="Kabar Jemaat"
                                        {{ $item->category === 'Kabar Jemaat' ? 'selected' : '' }}
                                    >
                                        Kabar Jemaat
                                    </option>

                                    <option
                                        value="Artikel Rohani"
                                        {{ $item->category === 'Artikel Rohani' ? 'selected' : '' }}
                                    >
                                        Artikel Rohani
                                    </option>

                                    <option
                                        value="Organisasi Gereja"
                                        {{ $item->category === 'Organisasi Gereja' ? 'selected' : '' }}
                                    >
                                        Organisasi Gereja
                                    </option>

                                </select>

                            </div>


                            {{-- TANGGAL PUBLIKASI --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Tanggal Publikasi
                                </label>

                                <input
                                    type="date"
                                    name="published_at"
                                    value="{{ $item->published_at->format('Y-m-d') }}"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                            </div>


                            {{-- FOTO --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Foto Berita
                                </label>


                                @if ($item->photo)

                                    <div class="mb-3 h-40 bg-gray-50 rounded-lg flex items-center justify-center">

                                        <img
                                            src="{{ asset('storage/' . $item->photo) }}"
                                            alt="{{ $item->title }}"
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
                                    Kosongkan jika tidak ingin mengganti foto.
                                </p>

                            </div>


                            {{-- ISI BERITA --}}
                            <div class="mb-5">

                                <label class="block text-sm font-medium mb-2">
                                    Isi Berita
                                </label>

                                <textarea
                                    name="content"
                                    rows="7"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >{{ $item->content }}</textarea>

                            </div>


                            {{-- STATUS --}}
                            <div class="mb-6">

                                <label class="block text-sm font-medium mb-2">
                                    Status Berita
                                </label>

                                <select
                                    name="is_active"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >

                                    <option
                                        value="1"
                                        {{ $item->is_active ? 'selected' : '' }}
                                    >
                                        Aktif
                                    </option>

                                    <option
                                        value="0"
                                        {{ !$item->is_active ? 'selected' : '' }}
                                    >
                                        Tidak Aktif
                                    </option>

                                </select>

                            </div>


                            {{-- ================================= --}}
                            {{-- BUTTON --}}
                            {{-- ================================= --}}

                            <div class="border-t border-gray-200 pt-5">

                                <div class="flex items-center justify-between">

                                    {{-- HAPUS --}}
                                    <button
                                        type="button"
                                        onclick="deleteNews({{ $item->id }})"
                                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                                    >
                                        Hapus Data
                                    </button>


                                    {{-- KANAN --}}
                                    <div class="flex gap-3">

                                        <button
                                            type="button"
                                            onclick="closeEditModal({{ $item->id }})"
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
                        id="deleteNewsForm{{ $item->id }}"
                        method="POST"
                        action="{{ route('admin.news.destroy', $item) }}"
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

                <div class="text-4xl mb-3">
                    📰
                </div>

                <p>
                    Belum ada berita.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ========================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================= --}}

    <script>

        // OPEN MODAL
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


        // CLOSE MODAL
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


        // DELETE NEWS
        function deleteNews(id) {

            if (!confirm('Yakin ingin menghapus berita ini?')) {
                return;
            }

            const form = document.getElementById(
                'deleteNewsForm' + id
            );

            if (form) {
                form.submit();
            }

        }


        // CLOSE KLIK OVERLAY
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


        // CLOSE ESC
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