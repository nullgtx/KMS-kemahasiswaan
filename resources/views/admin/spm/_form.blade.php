

<div class="form-group">
    <label for="title">Judul Dokumen</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" 
    id="title" name="title" value="{{ old('title', $update ? $spm->title:'') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
        <label for="level">Kategori Pengetahuan</label>
        <select class="form-control @error('level') is-invalid @enderror" value="{{ old('level', $update ? $spm->level:'') }}" name="level" 
        id="level" required>
            <option value="">-- Pilih Level --</option>
            <option value="{{ \App\Spm::KATEGORI_BEASISWA }}" 
                @if($update && $spm->level==\App\Spm::KATEGORI_BEASISWA) selected @endif>Beasiswa</option>
            <option value="{{ \App\Spm::KATEGORI_PKM }}" 
                @if($update && $spm->level==\App\Spm::KATEGORI_PKM) selected @endif>PKM</option>
            <option value="{{ \App\Spm::KATEGORI_TAK }}" 
                @if($update && $spm->level==\App\Spm::KATEGORI_TAK) selected @endif>TAK</option>
            <option value="{{ \App\Spm::KATEGORI_ASURANSI }}" 
                @if($update && $spm->level==\App\Spm::KATEGORI_ASURANSI) selected @endif>Asuransi</option>
            <option value="{{ \App\Spm::KATEGORI_KEGIATAN }}" 
                @if($update && $spm->level==\App\Spm::KATEGORI_KEGIATAN) selected @endif>Kegiatan Mahasiswa</option>
        </select>

        @error('level')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

<div class="form-group">
    <label for="image">Dokumen SOP</label>

    <div class="media">
        
        <div class="media-body">
            <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('level', $update ? $spm->image:'') }}" name="image" id="image">
            @if($update) <p class="help-block">Dokumen harus berformat .pdf</p> @endif

            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>

    </div>

</div>

