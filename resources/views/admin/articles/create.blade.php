<x-admin-layout>
    <div class="mb-8">
        <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Artikel Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    placeholder="Contoh: Keutamaan Shalat Berjamaah">
                @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                <select name="category_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Thumbnail (PNG/JPG)</label>
                <input type="file" name="thumbnail" accept="image/png,image/jpeg,image/webp"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <p class="text-xs text-gray-500 mt-1">Format: PNG, JPG, WEBP. Maks 2MB</p>
                @error('thumbnail')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Ringkasan (opsional)</label>
                <textarea name="excerpt" rows="2"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Konten Artikel</label>
                <textarea name="content" id="editor" rows="10"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    placeholder="Tulis konten artikel di sini...">{{ old('content') }}</textarea>
                @error('content')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                class="w-full px-6 py-4 bg-orange-600 text-white rounded-xl font-bold hover:bg-orange-700 transition">
                💾 Simpan Artikel
            </button>
        </form>
    </div>

    <!-- CKEditor 5 Super Build -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/super-build/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 400px;
            direction: auto;
        }

        .ck-editor__editable[dir="rtl"] {
            text-align: right;
        }
    </style>
    <script>
        CKEDITOR.ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'alignment', '|',
                    'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                    'link', 'blockQuote', 'insertTable', '|',
                    'undo', 'redo', '|',
                    'findAndReplace', 'selectAll', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif',
                    'Amiri, serif',
                    'Scheherazade New, serif',
                    'Noto Naskh Arabic, serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 24, 28, 32, 36, 48],
                supportAllValues: true
            },
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            },
            language: 'id',
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced',
                'AIAssistant',
                'CaseChange',
                'MultiLevelList'
            ]
        })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-admin-layout>