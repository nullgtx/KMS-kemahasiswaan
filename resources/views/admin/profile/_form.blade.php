<div class="form-group">
    <label for="email">Email Pengguna</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" 
    id="email" name="email" value="{{ old('email', $update ? $admin->user->email:'') }}" readonly>

    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" 
    id="password" name="password" @if(!$update) required @endif>

    @if($update) <p class="help-block">Kosongkan bila tidak ingin mengganti password</p> @endif

    @error('password')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">Ulangi Password</label>
    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
    id="password_confirmation" name="password_confirmation" @if(!$update) required @endif>

    @error('password_confirmation')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="name">Nama Pengguna</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" 
    id="name" name="name" value="{{ old('name', $update ? $admin->user->name:'') }}" required>

    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="position">Jabatan</label>
    <input type="text" class="form-control @error('position') is-invalid @enderror" 
    id="position" name="position" value="{{ old('position', $update ? $admin->position:'') }}" required>

    @error('position')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>


<div class="form-group">
    <label for="active">Foto Pengguna</label>

    <div class="media">

        @if($update)
        <img class="mr-3" style="width: 60px; height: 60px;" src="{{ $admin->user->photo_url }}" alt="Image">
        @endif
        
        <div class="media-body">
            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" id="photo">
            @if($update) <p class="help-block">Kosongkan bila tidak ingin mengganti foto</p> @endif

            @error('photo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        
    </div>

</div>


