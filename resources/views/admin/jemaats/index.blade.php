@extends('admin.layouts.app')

@section('title', 'Jemaat')
@section('page-title', 'Jemaat')

@section('content')

    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Data Jemaat
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola data jemaat gereja.
            </p>
        </div>

        <button
            type="button"
            onclick="openCreateModal()"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
        >
            + Tambah Jemaat
        </button>

    </div>


    @if (session('success'))

        <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    {{-- GRID CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        @forelse ($jemaats as $jemaat)

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                {{-- FOTO --}}
                <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">

                    @if ($jemaat->photo)

                        <img
                            src="{{ asset('storage/' . $jemaat->photo) }}"
                            alt="{{ $jemaat->name }}"
                            class="w-full h-full object-contain"
                        >

                    @else

                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <div class="text-5xl mb-3">👤</div>
                            <span>Belum ada foto</span>
                        </div>

                    @endif

                </div>


                {{-- INFORMASI --}}
                <div class="p-6">

                    {{-- Nama + Status --}}
                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <h2 class="text-xl font-bold text-gray-800">
                                {{ $jemaat->name }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Jemaat Jalan Suci Jakpus
                            </p>

                        </div>


                        @if ($jemaat->is_active)

                            <span class="shrink-0 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                Aktif
                            </span>

                        @else

                            <span class="shrink-0 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                Tidak Aktif
                            </span>

                        @endif

                    </div>


                    {{-- Detail --}}
                    <div class="mt-5 space-y-3">

                        {{-- Tanggal lahir --}}
                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                                🎂
                            </div>

                            <div>

                                <p class="text-xs text-gray-400">
                                    Tanggal Lahir
                                </p>

                                <p class="text-sm font-medium text-gray-700">

                                    @if ($jemaat->birth_date)
                                        {{ $jemaat->birth_date->format('d M Y') }}
                                    @else
                                        -
                                    @endif

                                </p>

                            </div>

                        </div>


                        {{-- Telepon --}}
                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                                📱
                            </div>

                            <div>

                                <p class="text-xs text-gray-400">
                                    No. Telepon
                                </p>

                                <p class="text-sm font-medium text-gray-700">
                                    {{ $jemaat->phone ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- AKSI --}}
                    <div class="border-t mt-6 pt-5">

                        <div class="flex gap-3">

                           <button
                                type="button"
                                onclick="openEditModal({{ $jemaat->id }})"
                                class="flex-1 text-center bg-gray-100 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-200"
                            >
                                Edit
                            </button>

                            <button
                                type="button"
                                onclick="openDetailModal({{ $jemaat->id }})"
                                class="flex-1 text-center bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700"
                            >
                                Detail
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full bg-white rounded-xl p-10 text-center text-gray-500">

                Belum ada data jemaat.

            </div>

        @endforelse

    </div>

    {{-- MODAL EDIT --}}
        <div
            id="editModal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
        >
            <div
                class="w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-xl"
            >

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 py-5 border-b">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Edit Data Jemaat
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Ubah informasi jemaat.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="text-gray-400 hover:text-gray-600 text-2xl"
                    >
                        &times;
                    </button>

                </div>


                {{-- FORM --}}
                <form
                    id="editJemaatForm"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


                    {{-- FOTO --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Foto Jemaat
                        </label>

                        <div
                            id="editPhotoPreview"
                            class="w-32 h-32 mb-3 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden"
                        >
                            <span class="text-gray-400 text-sm">
                                Belum ada foto
                            </span>
                        </div>

                        <input
                            type="file"
                            name="photo"
                            accept="image/*"
                            class="w-full rounded-lg border-gray-300"
                        >

                        <p class="text-sm text-gray-500 mt-1">
                            Kosongkan jika tidak ingin mengganti foto.
                        </p>

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="editName"
                            name="name"
                            class="w-full rounded-lg border-gray-300"
                            required
                        >

                    </div>


                    {{-- TANGGAL LAHIR --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="editBirthDate"
                            name="birth_date"
                            class="w-full rounded-lg border-gray-300"
                        >

                    </div>


                    {{-- TELEPON --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            No. Telepon
                        </label>

                        <input
                            type="text"
                            id="editPhone"
                            name="phone"
                            class="w-full rounded-lg border-gray-300"
                        >

                    </div>


                    {{-- ALAMAT --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Alamat
                        </label>

                        <textarea
                            id="editAddress"
                            name="address"
                            rows="3"
                            class="w-full rounded-lg border-gray-300"
                        ></textarea>

                    </div>


                    {{-- BIO --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Profil Singkat / Biodata
                        </label>

                        <textarea
                            id="editBio"
                            name="bio"
                            rows="4"
                            class="w-full rounded-lg border-gray-300"
                        ></textarea>

                    </div>


                    {{-- STATUS --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-2">
                            Status Jemaat
                        </label>

                        <select
                            id="editStatus"
                            name="is_active"
                            class="w-full rounded-lg border-gray-300"
                        >
                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
                                Tidak Aktif
                            </option>
                        </select>

                    </div>


                    {{-- BUTTON --}}
                    <div class="flex items-center justify-between border-t pt-5">

                        <button
                            type="button"
                            onclick="deleteJemaat()"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                        >
                            Hapus Data
                        </button>

                        {{-- KANAN --}}
                        <div class="flex gap-3">

                            <button
                                type="button"
                                onclick="closeEditModal()"
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

                {{-- MODAL DETAIL --}}
        <div
            id="detailModal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4" >
            <div  class="w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-xl" >

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 py-5 border-b">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Detail Jemaat
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi lengkap jemaat.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="closeDetailModal()"
                        class="text-gray-400 hover:text-gray-600 text-2xl"
                    >
                        &times;
                    </button>

                </div>


                {{-- CONTENT --}}
                <div class="p-6">

                    {{-- FOTO --}}
                    <div
                        id="detailPhoto"
                        class="w-full h-72 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center mb-6"
                    >
                        <span class="text-gray-400">
                            Belum ada foto
                        </span>
                    </div>


                    {{-- NAMA + STATUS --}}
                    <div class="flex items-start justify-between gap-4 mb-6">

                        <div>
                            <h3
                                id="detailName"
                                class="text-2xl font-bold text-gray-800"
                            >
                            </h3>

                            <p class="text-gray-500 mt-1">
                                Jemaat GPI Jalan Suci Jakpus
                            </p>
                        </div>

                        <span
                            id="detailStatus"
                            class="shrink-0 px-3 py-1 rounded-full text-sm font-medium"
                        >
                        </span>

                    </div>


                    {{-- INFORMASI --}}
                    <div class="space-y-5">

                        {{-- TANGGAL LAHIR --}}
                        <div>
                            <p class="text-sm text-gray-400">
                                Tanggal Lahir
                            </p>

                            <p
                                id="detailBirthDate"
                                class="text-base font-medium text-gray-700 mt-1"
                            >
                            </p>
                        </div>


                        {{-- TELEPON --}}
                        <div>
                            <p class="text-sm text-gray-400">
                                No. Telepon
                            </p>

                            <p
                                id="detailPhone"
                                class="text-base font-medium text-gray-700 mt-1"
                            >
                            </p>
                        </div>


                        {{-- ALAMAT --}}
                        <div>
                            <p class="text-sm text-gray-400">
                                Alamat
                            </p>

                            <p
                                id="detailAddress"
                                class="text-base text-gray-700 mt-1 whitespace-pre-line"
                            >
                            </p>
                        </div>


                        {{-- BIO --}}
                        <div>
                            <p class="text-sm text-gray-400">
                                Profil Singkat / Biodata
                            </p>

                            <p
                                id="detailBio"
                                class="text-base text-gray-700 mt-1 whitespace-pre-line"
                            >
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="flex justify-end px-6 py-5 border-t">

                    <button
                        type="button"
                        onclick="closeDetailModal()"
                        class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200"
                    >
                        Tutup
                    </button>

                </div>

            </div>
        </div>

        {{-- MODAL TAMBAH JEMAAT --}}
        <div
            id="createModal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
        >
            <div
                class="w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-xl"
            >

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-6 py-5 border-b">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Tambah Jemaat
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Tambahkan data jemaat baru.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="closeCreateModal()"
                        class="text-gray-400 hover:text-gray-600 text-2xl"
                    >
                        &times;
                    </button>

                </div>


                {{-- FORM --}}
                <form
                    method="POST"
                    action="{{ route('admin.jemaats.store') }}"
                    enctype="multipart/form-data"
                    class="p-6"
                >

                    @csrf


                    {{-- FOTO --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Foto Jemaat
                        </label>

                        <div
                            id="createPhotoPreview"
                            class="w-full h-48 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden mb-3"
                        >
                            <div class="text-center text-gray-400">
                                <div class="text-4xl mb-2">
                                    👤
                                </div>

                                <p>
                                    Belum ada foto
                                </p>
                            </div>
                        </div>

                        <input
                            type="file"
                            name="photo"
                            accept="image/*"
                            onchange="previewCreatePhoto(event)"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2"
                        >

                        <p class="text-sm text-gray-500 mt-1">
                            Pilih foto jemaat.
                        </p>

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-lg border-gray-300"
                            required
                        >

                    </div>


                    {{-- TANGGAL LAHIR --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            value="{{ old('birth_date') }}"
                            class="w-full rounded-lg border-gray-300"
                        >

                    </div>


                    {{-- TELEPON --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            No. Telepon
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="w-full rounded-lg border-gray-300"
                        >

                    </div>


                    {{-- ALAMAT --}}
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Alamat
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="w-full rounded-lg border-gray-300"
                        >{{ old('address') }}</textarea>

                    </div>


                    {{-- BIO --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-2">
                            Profil Singkat / Biodata
                        </label>

                        <textarea
                            name="bio"
                            rows="4"
                            class="w-full rounded-lg border-gray-300"
                        >{{ old('bio') }}</textarea>

                    </div>


                    {{-- BUTTON --}}
                    <div class="flex justify-end gap-3 border-t pt-5">

                        <button
                            type="button"
                            onclick="closeCreateModal()"
                            class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                        >
                            Simpan Jemaat
                        </button>

                    </div>

                </form>

            </div>
        </div>

@endsection

<script>
    const jemaats = @json($jemaats);

    function openEditModal(id) {

        const jemaat = jemaats.find(item => item.id === id);

        if (!jemaat) {
            return;
        }

        document.getElementById('editName').value = jemaat.name ?? '';
        document.getElementById('editBirthDate').value = jemaat.birth_date  ? jemaat.birth_date.substring(0, 10): '';
        document.getElementById('editPhone').value = jemaat.phone ?? '';
        document.getElementById('editAddress').value = jemaat.address ?? '';
        document.getElementById('editBio').value = jemaat.bio ?? '';
        document.getElementById('editStatus').value = jemaat.is_active ? '1' : '0';

        const form = document.getElementById('editJemaatForm');
        form.action = `/admin/jemaats/${jemaat.id}`;

        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        const photoPreview = document.getElementById('editPhotoPreview');

            if (jemaat.photo) {
                photoPreview.innerHTML = `
                    <img
                        src="/storage/${jemaat.photo}"
                        class="w-full h-full object-cover"
                        alt="${jemaat.name}"
                    >
                `;
            } else {
                photoPreview.innerHTML = `
                    <span class="text-gray-400 text-sm">
                        Belum ada foto
                    </span>
                `;
            }
    }


    function closeEditModal() {

        const modal = document.getElementById('editModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

    }


    function openDetailModal(id) {

        const jemaat = jemaats.find(item => item.id === id);

        if (!jemaat) {
            return;
        }


        // Nama
        document.getElementById('detailName').textContent =
            jemaat.name ?? '-';


        // Tanggal lahir
        document.getElementById('detailBirthDate').textContent =
            jemaat.birth_date
                ? new Date(jemaat.birth_date).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                })
                : '-';


        // Telepon
        document.getElementById('detailPhone').textContent =
            jemaat.phone ?? '-';


        // Alamat
        document.getElementById('detailAddress').textContent =
            jemaat.address ?? '-';


        // Bio
        document.getElementById('detailBio').textContent =
            jemaat.bio ?? '-';


        // Status
        const status = document.getElementById('detailStatus');

        if (jemaat.is_active) {

            status.textContent = 'Aktif';

            status.className =
                'shrink-0 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium';

        } else {

            status.textContent = 'Tidak Aktif';

            status.className =
                'shrink-0 bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium';

        }


        // Foto
        const photo = document.getElementById('detailPhoto');

        if (jemaat.photo) {

            photo.innerHTML = `
                <img
                    src="/storage/${jemaat.photo}"
                    alt="${jemaat.name}"
                    class="w-full h-full object-contain"
                >
            `;

        } else {

            photo.innerHTML = `
                <div class="flex flex-col items-center justify-center text-gray-400">
                    <div class="text-5xl mb-3">👤</div>
                    <span>Belum ada foto</span>
                </div>
            `;

        }


        // Buka modal
        const modal = document.getElementById('detailModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }


    function closeDetailModal() {

        const modal = document.getElementById('detailModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

    }


    function openCreateModal() {

        const modal = document.getElementById('createModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }


    function closeCreateModal() {

        const modal = document.getElementById('createModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

    }


    function previewCreatePhoto(event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const preview = document.getElementById('createPhotoPreview');

        const imageUrl = URL.createObjectURL(file);

        preview.innerHTML = `
            <img
                src="${imageUrl}"
                class="w-full h-full object-contain"
                alt="Preview foto"
            >
        `;

    }

    function deleteJemaat() {

        const id = document
            .getElementById('editJemaatForm')
            .action
            .split('/')
            .pop();

        if (!confirm('Yakin ingin menghapus data jemaat ini?')) {
            return;
        }

        const form = document.createElement('form');

        form.method = 'POST';
        form.action = `/admin/jemaats/${id}`;

        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
        `;

        document.body.appendChild(form);

        form.submit();
    }
</script>