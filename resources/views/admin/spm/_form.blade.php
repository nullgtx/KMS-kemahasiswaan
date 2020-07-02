

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
        <select class="form-control @error('level') is-invalid @enderror" name="level" 
        id="level" @if($update && $admin->user->id==Auth::user()->id) disabled @else required @endif>
            <option value="">-- Pilih Level --</option>
            <option value="{{ \App\Spm::KATEGORI_BEASISWA }}" 
                @if($update && $admin->level==\App\Spm::KATEGORI_BEASISWA) selected @endif>Beasiswa</option>
            <option value="{{ \App\Spm::KATEGORI_PKM }}" 
                @if($update && $admin->level==\App\Spm::KATEGORI_PKM) selected @endif>PKM</option>
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
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @if($update) <p class="help-block">Dokumen harus berformat .pdf</p> @endif

            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>

    </div>

</div>

