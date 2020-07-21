

<div class="form-group">
    <label for="title">Judul Dokumen</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" 
    id="title" name="title" value="{{ old('title', $update ? $knowledge->title:'') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
        <label for="level">Kategori Pengetahuan</label>
        <select class="form-control @error('level') is-invalid @enderror" value="{{ old('level', $update ? $knowledge->level:'') }}" name="level" 
        id="level" required>
            <option value="">-- Pilih Level --</option>
            <option value="{{ \App\Knowledge::KATEGORI_BEASISWA }}" 
                @if($update && $knowledge->level==\App\Knowledge::KATEGORI_BEASISWA) selected @endif>Beasiswa</option>
            <option value="{{ \App\Knowledge::KATEGORI_PKM }}" 
                @if($update && $knowledge->level==\App\Knowledge::KATEGORI_PKM) selected @endif>PKM</option>
            <option value="{{ \App\Knowledge::KATEGORI_TAK }}" 
                @if($update && $knowledge->level==\App\Knowledge::KATEGORI_TAK) selected @endif>TAK</option>
            <option value="{{ \App\Knowledge::KATEGORI_ASURANSI }}" 
                @if($update && $knowledge->level==\App\Knowledge::KATEGORI_ASURANSI) selected @endif>Asuransi</option>
            <option value="{{ \App\Knowledge::KATEGORI_KEGIATAN }}" 
                @if($update && $knowledge->level==\App\Knowledge::KATEGORI_KEGIATAN) selected @endif>Kegiatan Mahasiswa</option>
        </select>

        @error('level')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

<div class="form-group">
    <label for="image">Dokumen Pengetahuan</label>

    <div class="media">
        
        <div class="media-body">
            <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('level', $update ? $knowledge->image:'') }}" name="image" id="image">
            @if($update) <p class="help-block">Dokumen harus berformat .pdf</p> @endif

            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>

    </div>

</div>

