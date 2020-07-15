

<div class="form-group">
    <label for="title">Judul Dokumen</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" 
    id="title" name="title" value="{{ old('title', $update ? $kegiatan->title:'') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="image">Dokumen Kegiatan</label>

    <div class="media">
        
        <div class="media-body">
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image', $update ? $kegiatan->image:'') }}" id="image">
            @if($update) <p class="help-block">Dokumen harus berformat .pdf</p> @endif

            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>

    </div>

</div>

