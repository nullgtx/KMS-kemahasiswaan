

<div class="form-group">
    <label for="title">Judul Artikel</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" 
    id="title" name="title" value="{{ old('title', $update ? $article->title:'') }}" required>

    @error('title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="content">Content Artikel</label>

    <textarea name="content" class="content form-control @error('content') is-invalid @enderror"
     id="content" cols="30" rows="10" required>{{ old('content', $update ? $article->content:'') }}</textarea>

    @error('content')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="image">Gambar Berita</label>

    <div class="media">

        @if($update)
        <img class="mr-3" style="width: 60px; height: 60px;" src="{{ $article->image_url }}" alt="Image">
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
<!-- CK Editor -->
<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

<script>
    var konten = document.getElementById("content");
      CKEDITOR.replace(konten,{
      language:'id-ID'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endpush