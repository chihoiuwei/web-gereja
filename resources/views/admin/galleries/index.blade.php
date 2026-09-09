@extends('admin.layouts.app')

@section('title', 'Gallery')
@section('page-title', 'Gallery')

@section('content')

<div>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-2xl font-bold">
                Gallery
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola album foto dan dokumentasi gereja.
            </p>
        </div>

        <a href="{{ route('admin.galleries.create') }}"
           class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
            + Tambah Album
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>

    @endif


    {{-- Album Cards --}}
    @if($albums->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            @foreach($albums as $album)

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                    {{-- Cover --}}
                    <div class="h-48 bg-gray-100 flex items-center justify-center p-3">

                        @if($album->photos->first())

                            <img src="{{ asset('storage/' . $album->photos->first()->photo) }}"
                                 alt="{{ $album->title }}"
                                 class="max-h-full max-w-full object-contain">

                        @else

                            <span class="text-sm text-gray-400">
                                Tidak ada foto
                            </span>

                        @endif

                    </div>


                    {{-- Content --}}
                    <div class="p-4">

                        <div class="flex items-start justify-between gap-2">

                            <h3 class="font-semibold text-gray-800 line-clamp-2">
                                {{ $album->title }}
                            </h3>

                            @if($album->is_active)

                                <span class="shrink-0 px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    Aktif
                                </span>

                            @else

                                <span class="shrink-0 px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                                    Nonaktif
                                </span>

                            @endif

                        </div>


                        {{-- Jumlah Foto --}}
                        <p class="text-sm text-gray-500 mt-2">
                            {{ $album->photos->count() }} foto
                        </p>


                        {{-- Tanggal --}}
                        @if($album->taken_at)

                            <p class="text-xs text-gray-500 mt-1">
                                {{ $album->taken_at->format('d M Y') }}
                            </p>

                        @endif


                        {{-- Description --}}
                        @if($album->description)

                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                {{ $album->description }}
                            </p>

                        @endif


                        {{-- Buttons --}}
                        <div class="flex gap-2 mt-4">

                            <a href="{{ route('admin.galleries.show', $album) }}"
                               class="flex-1 text-center px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                Lihat Album
                            </a>

                            <button type="button"
                                    onclick="openEditModal({{ $album->id }})"
                                    class="px-3 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">
                                Edit
                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-white rounded-xl shadow-sm p-10 text-center">

            <p class="text-gray-500">
                Belum ada album gallery.
            </p>

            <a href="{{ route('admin.galleries.create') }}"
               class="inline-block mt-4 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                + Tambah Album
            </a>

        </div>

    @endif

</div>


{{-- =====================================================
     EDIT ALBUM MODAL
===================================================== --}}

<div id="editModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">


        {{-- Modal Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">

            <h3 class="text-lg font-semibold text-gray-800">
                Edit Album
            </h3>

            <button type="button"
                    onclick="closeEditModal()"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                &times;
            </button>

        </div>


        {{-- =================================================
             UPDATE ALBUM INFORMATION
        ================================================== --}}

        <form id="editForm"
              method="POST">

            @csrf
            @method('PUT')

            <div class="p-6">

                {{-- Judul --}}
                <div class="mb-5">

                    <label for="edit_title"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Album
                    </label>

                    <input type="text"
                           id="edit_title"
                           name="title"
                           required
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>


                {{-- Tanggal --}}
                <div class="mb-5">

                    <label for="edit_taken_at"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Kegiatan
                    </label>

                    <input type="date"
                           id="edit_taken_at"
                           name="taken_at"
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                </div>


                {{-- Deskripsi --}}
                <div class="mb-5">

                    <label for="edit_description"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Album
                    </label>

                    <textarea id="edit_description"
                              name="description"
                              rows="3"
                              class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>

                </div>


                {{-- Status --}}
                <div class="mb-6">

                    <label for="edit_is_active"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>

                    <select id="edit_is_active"
                            name="is_active"
                            required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>

                    </select>

                </div>

            </div>

        </form>


        {{-- =================================================
             FOTO DALAM ALBUM
        ================================================== --}}

        <div class="px-6 pb-6">

            <div class="border-t border-gray-200 pt-5">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h4 class="font-semibold text-gray-800">
                            Foto dalam Album
                        </h4>

                        <p id="edit_photo_count"
                           class="text-xs text-gray-500 mt-1">
                        </p>
                    </div>

                </div>


                {{-- Existing Photos --}}
                <div id="existingPhotos"
                     class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                </div>


                {{-- No Photos --}}
                <div id="noPhotos"
                     class="hidden bg-gray-50 rounded-lg p-6 text-center">

                    <p class="text-sm text-gray-500">
                        Belum ada foto dalam album.
                    </p>

                </div>

            </div>


            {{-- =================================================
                 TAMBAH FOTO
            ================================================== --}}

            <div class="border-t border-gray-200 mt-6 pt-5">

                <h4 class="font-semibold text-gray-800">
                    Tambah Foto
                </h4>

                <p class="text-xs text-gray-500 mt-1 mb-4">
                    Pilih beberapa foto sekaligus untuk ditambahkan ke album.
                </p>


                <form id="addPhotosForm"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <input type="file"
                           id="edit_photos"
                           name="photos[]"
                           accept="image/*"
                           multiple
                           class="w-full rounded-lg border border-gray-300 px-3 py-2">


                    <p id="newPhotoCount"
                       class="text-xs text-gray-500 mt-2">
                    </p>


                    {{-- Preview Foto Baru --}}
                    <div id="newPhotoPreview"
                         class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4">
                    </div>


                    <button type="submit"
                            id="addPhotosButton"
                            class="mt-4 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        + Tambahkan Foto
                    </button>

                </form>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="border-t border-gray-200 mt-6 pt-5">

                <div class="flex items-center justify-between">

                    <button type="button"
                            onclick="deleteGallery()"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Hapus Album
                    </button>


                    <div class="flex gap-3">

                        <button type="button"
                                onclick="closeEditModal()"
                                class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                            Batal
                        </button>

                        <button type="button"
                                onclick="saveAlbum()"
                                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                            Simpan Perubahan
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     HIDDEN DELETE ALBUM FORMS
===================================================== --}}

@foreach($albums as $album)

    <form id="delete-gallery-{{ $album->id }}"
          method="POST"
          action="{{ route('admin.galleries.destroy', $album) }}"
          class="hidden">

        @csrf
        @method('DELETE')

    </form>

@endforeach


{{-- =====================================================
     HIDDEN DELETE PHOTO FORMS
===================================================== --}}

<!-- <div id="deletePhotoForms">

    @foreach($albums as $album)

        @foreach($album->photos as $photo)

            <form id="delete-photo-{{ $photo->id }}"
                  method="POST"
                  action="{{ route('admin.galleries.photos.destroy', [$album, $photo->id]) }}"
                  class="hidden">

                @csrf
                @method('DELETE')

            </form>

        @endforeach

    @endforeach

</div> -->


<script>

    let currentGalleryId = null;


    /*
    |--------------------------------------------------------------------------
    | Buka Modal Edit
    |--------------------------------------------------------------------------
    */

    function openEditModal(id)
    {
        fetch(`/admin/galleries/${id}/edit`)
            .then(response => {

                if (!response.ok) {
                    throw new Error('Gagal mengambil data album.');
                }

                return response.json();

            })
            .then(data => {

                currentGalleryId = id;


                // Data album
                document.getElementById('edit_title').value =
                    data.title ?? '';

                document.getElementById('edit_taken_at').value =
                    data.taken_at ?? '';

                document.getElementById('edit_description').value =
                    data.description ?? '';

                document.getElementById('edit_is_active').value =
                    data.is_active ? '1' : '0';


                // Form update
                document.getElementById('editForm').action =
                    `/admin/galleries/${id}`;


                // Form tambah foto
                document.getElementById('addPhotosForm').action =
                    `/admin/galleries/${id}/photos`;


                // Tampilkan foto
                renderExistingPhotos(data.photos ?? []);


                // Reset input foto baru
                document.getElementById('edit_photos').value = '';

                document.getElementById('newPhotoPreview').innerHTML = '';
                document.getElementById('newPhotoPreview').classList.add('hidden');

                document.getElementById('newPhotoCount').textContent = '';


                // Tampilkan modal
                const modal = document.getElementById('editModal');

                modal.classList.remove('hidden');
                modal.classList.add('flex');

            })
            .catch(error => {

                console.error(error);

                alert('Gagal mengambil data album.');

            });
    }


    /*
    |--------------------------------------------------------------------------
    | Render Foto Existing
    |--------------------------------------------------------------------------
    */

    function renderExistingPhotos(photos)
    {
        const container =
            document.getElementById('existingPhotos');

        const noPhotos =
            document.getElementById('noPhotos');

        const count =
            document.getElementById('edit_photo_count');


        container.innerHTML = '';


        count.textContent =
            `${photos.length} foto dalam album`;


        if (!photos.length) {

            noPhotos.classList.remove('hidden');

            return;
        }


        noPhotos.classList.add('hidden');


        photos.forEach(function(photo) {

            const wrapper =
                document.createElement('div');

            wrapper.className =
                'bg-gray-100 rounded-lg overflow-hidden';

            wrapper.setAttribute(
                'data-photo-id',
                photo.id
            );


            wrapper.innerHTML = `

                <div class="h-36 flex items-center justify-center p-2">

                    <img
                        src="/storage/${photo.photo}"
                        alt="Foto Album"
                        class="max-h-full max-w-full object-contain">

                </div>

                <div class="bg-white p-2">

                    <button
                        type="button"
                        onclick="deletePhoto(${photo.id})"
                        class="w-full px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs">
                        Hapus Foto
                    </button>

                </div>

            `;


            container.appendChild(wrapper);

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Foto
    |--------------------------------------------------------------------------
    */

    function deletePhoto(photoId)
    {
        const confirmed = confirm(
            'Apakah Anda yakin ingin menghapus foto ini dari album?'
        );

        if (!confirmed) {
            return;
        }

        if (!currentGalleryId) {
            return;
        }

        const url =
            `/admin/galleries/${currentGalleryId}/photos/${photoId}`;

        const formData = new FormData();

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'DELETE');

        fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {

            if (!response.ok) {
                throw new Error('Gagal menghapus foto.');
            }

            return response.json();

        })
        .then(data => {

            // Hapus card foto dari tampilan
            const photoCards =
                document.querySelectorAll(
                    `[data-photo-id="${photoId}"]`
                );

            photoCards.forEach(card => {
                card.remove();
            });


            // Update jumlah foto
            const container =
                document.getElementById('existingPhotos');

            const remainingPhotos =
                container.children.length;

            document.getElementById('edit_photo_count').textContent =
                `${remainingPhotos} foto dalam album`;


            // Kalau sudah tidak ada foto
            if (remainingPhotos === 0) {

                document
                    .getElementById('noPhotos')
                    .classList.remove('hidden');

            }


            // Beri notifikasi
            alert(data.message ?? 'Foto berhasil dihapus.');

        })
        .catch(error => {

            console.error(error);

            alert('Gagal menghapus foto.');

        });
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Perubahan Album
    |--------------------------------------------------------------------------
    */

    function saveAlbum()
    {
        document.getElementById('editForm').submit();
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Album
    |--------------------------------------------------------------------------
    */

    function deleteGallery()
    {
        if (!currentGalleryId) {
            return;
        }


        const confirmed = confirm(
            'Apakah Anda yakin ingin menghapus album beserta semua fotonya?'
        );


        if (!confirmed) {
            return;
        }


        document
            .getElementById(`delete-gallery-${currentGalleryId}`)
            .submit();
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Foto Baru
    |--------------------------------------------------------------------------
    */

    document.getElementById('edit_photos').addEventListener('change', function() {

        const files = this.files;

        const preview =
            document.getElementById('newPhotoPreview');

        const count =
            document.getElementById('newPhotoCount');


        preview.innerHTML = '';


        if (!files.length) {

            preview.classList.add('hidden');

            count.textContent = '';

            return;
        }


        preview.classList.remove('hidden');


        count.textContent =
            `${files.length} foto dipilih`;


        Array.from(files).forEach(function(file) {

            if (!file.type.startsWith('image/')) {
                return;
            }


            const reader =
                new FileReader();


            reader.onload = function(event) {

                const wrapper =
                    document.createElement('div');

                wrapper.className =
                    'bg-gray-100 rounded-lg overflow-hidden';


                wrapper.innerHTML = `

                    <div class="h-32 flex items-center justify-center p-2">

                        <img
                            src="${event.target.result}"
                            alt="${file.name}"
                            class="max-h-full max-w-full object-contain">

                    </div>

                    <div class="px-2 py-2 bg-white">

                        <p
                            class="text-xs text-gray-600 truncate"
                            title="${file.name}">
                            ${file.name}
                        </p>

                    </div>

                `;


                preview.appendChild(wrapper);

            };


            reader.readAsDataURL(file);

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Tutup Modal
    |--------------------------------------------------------------------------
    */

    function closeEditModal()
    {
        const modal =
            document.getElementById('editModal');


        modal.classList.add('hidden');
        modal.classList.remove('flex');


        currentGalleryId = null;
    }


    /*
    |--------------------------------------------------------------------------
    | Klik Area Luar Modal
    |--------------------------------------------------------------------------
    */

    document.getElementById('editModal').addEventListener('click', function(event) {

        if (event.target === this) {

            closeEditModal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Tombol ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeEditModal();

        }

    });

    /*
|--------------------------------------------------------------------------
| Tambah Foto ke Album
|--------------------------------------------------------------------------
*/

document.getElementById('addPhotosForm').addEventListener('submit', function(event) {

    event.preventDefault();

    const form = this;
    const button = document.getElementById('addPhotosButton');
    const input = document.getElementById('edit_photos');

    if (!input.files.length) {
        alert('Pilih minimal satu foto terlebih dahulu.');
        return;
    }

    if (!currentGalleryId) {
        alert('Album belum dipilih.');
        return;
    }

    const formData = new FormData(form);

    button.disabled = true;
    button.textContent = 'Menambahkan...';

    fetch(form.action, {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {

        if (!response.ok) {
            throw new Error('Gagal menambahkan foto.');
        }

        return response.json();

    })
    .then(data => {

        // Render ulang semua foto dalam album
        renderExistingPhotos(data.photos ?? []);

        // Reset input
        input.value = '';

        document.getElementById('newPhotoPreview').innerHTML = '';
        document.getElementById('newPhotoPreview').classList.add('hidden');
        document.getElementById('newPhotoCount').textContent = '';

        alert(data.message ?? 'Foto berhasil ditambahkan.');

    })
    .catch(error => {

        console.error(error);

        alert('Gagal menambahkan foto.');

    })
    .finally(() => {

        button.disabled = false;
        button.textContent = '+ Tambahkan Foto';

    });

});

</script>

@endsection