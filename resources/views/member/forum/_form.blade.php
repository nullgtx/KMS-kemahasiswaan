

<div class="form-group">
    <label for="title">Judul Diskusi</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" 
    id="title" name="title" value="{{ old('title', $update ? $forum->title:'') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="content">Content Forum</label>

    <textarea name="content" class="content form-control @error('content') is-invalid @enderror"
     id="content" cols="30" rows="10" required>{{ old('content', $update ? $forum->content:'') }}</textarea>

    @error('content')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
        <label for="level">Kategori Forum</label>
        <select class="form-control @error('level') is-invalid @enderror" value="{{ old('level', $update ? $forum->level:'') }}"  name="level" 
        id="level" @if($update && $forum->user->id==Auth::user()->id) @else required @endif>
            <option value="">-- Pilih Kategori --</option>
            <option value="{{ \App\Forum::KATEGORI_BEASISWA }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_BEASISWA) selected @endif>Beasiswa</option>
            <option value="{{ \App\Forum::KATEGORI_PKM }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_PKM) selected @endif>PKM</option>
            <option value="{{ \App\Forum::KATEGORI_TAK }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_TAK) selected @endif>TAK</option>
            <option value="{{ \App\Forum::KATEGORI_ASURANSI }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_ASURANSI) selected @endif>Asuransi</option>
            <option value="{{ \App\Forum::KATEGORI_KEGIATAN }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_KEGIATAN) selected @endif>Kegiatan Mahasiswa</option>
        </select>

        @error('level')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

@push('scripts')
<script>
  $(function () {
    // Summernote
    $('.content').summernote()
  })
</script>
@endpush