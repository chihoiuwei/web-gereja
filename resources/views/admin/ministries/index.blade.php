@extends('admin.layouts.app')

@section('title', 'Bidang Pelayanan')
@section('page-title', 'Bidang Pelayanan')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">
                Bidang Pelayanan
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola bidang pelayanan gereja.
            </p>
        </div>

        <a href="{{ route('admin.ministries.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Tambah Pelayanan
        </a>
    </div>


    @if (session('success'))
        <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif


        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @forelse ($ministries as $ministry)

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-4">

                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $ministry->name }}
                        </h2>

                        @if ($ministry->is_active)
                            <span class="shrink-0 bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                ● Aktif
                            </span>
                        @else
                            <span class="shrink-0 bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                ● Tidak Aktif
                            </span>
                        @endif

                    </div>


                    {{-- Deskripsi --}}
                    <div class="mt-5 min-h-[80px]">

                        <p class="text-sm text-gray-400 mb-1">
                            Deskripsi
                        </p>

                        <p class="text-gray-600">
                            {{ $ministry->description ?? '-' }}
                        </p>

                    </div>


                    {{-- Garis --}}
                    <div class="border-t border-gray-200 my-5"></div>


                    {{-- Tombol --}}
                    <button
                        type="button"
                        onclick="openEditModal({{ $ministry->id }})"
                        class="w-full text-center px-4 py-3 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 font-medium"
                    >
                        Edit
                    </button>

                </div>

            @empty

                <div class="col-span-full bg-white rounded-2xl p-10 text-center text-gray-500">
                    Belum ada data bidang pelayanan.
                </div>

            @endforelse

        </div>

    {{-- Modal Edit --}}
            <div
                id="editModal"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
            >
                <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-6">

                    <div class="flex items-center justify-between mb-6">

                        <h2 class="text-xl font-bold text-gray-800">
                            Edit Pelayanan
                        </h2>

                        <button
                            type="button"
                            onclick="closeEditModal()"
                            class="text-gray-400 hover:text-gray-700 text-2xl"
                        >
                            &times;
                        </button>

                    </div>

                    <form
                        id="editMinistryForm"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Nama Pelayanan
                            </label>

                            <input
                                type="text"
                                id="edit_name"
                                name="name"
                                class="w-full rounded-lg border-gray-300"
                                required
                            >

                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-5">

                            <label class="block text-sm font-medium mb-2">
                                Deskripsi
                            </label>

                            <textarea
                                id="edit_description"
                                name="description"
                                rows="4"
                                class="w-full rounded-lg border-gray-300"
                            ></textarea>

                        </div>

                        {{-- Status --}}
                        <div class="mb-6">

                            <label class="block text-sm font-medium mb-2">
                                Status Pelayanan
                            </label>

                            <select
                                id="edit_is_active"
                                name="is_active"
                                class="w-full rounded-lg border-gray-300"
                            >
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>

                        </div>

                        <div class="border-t border-gray-200 pt-5">

                            <div class="flex items-center justify-between">

                                {{-- Hapus --}}
                                <button
                                    type="button"
                                    onclick="deleteMinistry()"
                                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                                >
                                    Hapus Data
                                </button>

                                <div class="flex gap-3">

                                    <button
                                        type="button"
                                        onclick="closeEditModal()"
                                        class="px-4 py-2 rounded-lg border border-gray-300"
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

                    {{-- Form hapus --}}
                    <form
                        id="deleteMinistryForm"
                        method="POST"
                        class="hidden"
                    >
                        @csrf
                        @method('DELETE')
                    </form>

                </div>
            </div>    

@endsection


<script>

    function openEditModal(id) {

        fetch(`/admin/ministries/${id}/edit`)
            .then(response => response.json())
            .then(data => {

                document.getElementById('edit_name').value =
                    data.name ?? '';

                document.getElementById('edit_description').value =
                    data.description ?? '';

                document.getElementById('edit_is_active').value =
                    data.is_active ? '1' : '0';

                document.getElementById('editMinistryForm').action =
                    `/admin/ministries/${id}`;

                document.getElementById('deleteMinistryForm').action =
                    `/admin/ministries/${id}`;

                const modal = document.getElementById('editModal');

                modal.classList.remove('hidden');
                modal.classList.add('flex');

            });

    }


    function closeEditModal() {

        const modal = document.getElementById('editModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

    }


    function deleteMinistry() {

        if (confirm('Yakin ingin menghapus bidang pelayanan ini?')) {

            document
                .getElementById('deleteMinistryForm')
                .submit();

        }

    }

</script>