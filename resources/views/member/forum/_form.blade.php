

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
        <select class="form-control @error('level') is-invalid @enderror" name="level" 
        id="level" @if($update && $forum->user->id==Auth::user()->id) disabled @else required @endif>
            <option value="">-- Pilih Level --</option>
            <option value="{{ \App\Forum::KATEGORI_BEASISWA }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_BEASISWA) selected @endif>Beasiswa</option>
            <option value="{{ \App\Forum::KATEGORI_PKM }}" 
                @if($update && $forum->level==\App\Forum::KATEGORI_PKM) selected @endif>PKM</option>
        </select>

        @error('level')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
    <label for="image">Gambar</label>

    <div class="media">

        @if($update)
        <img class="mr-3" style="width: 60px; height: 60px;" src="{{ $forum->image_url }}" alt="Image">
        @endif
        
        <div class="media-body">
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @if($update) <p class="help-block">Kosongkan bila tidak ingin mengganti gambar</p> @endif

            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

        </div>

    </div>

</div>

@push('scripts')
<script>
  $(function () {
    // Summernote
    $('.content').summernote()
  })
</script>
@endpush