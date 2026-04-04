<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<style>
    /* CSS untuk Modal Pop-up Cropper */
    .modal-crop { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); }
    .modal-crop-content { background-color: #ffffff; margin: 5% auto; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .img-container { max-height: 400px; margin-bottom: 20px; overflow: hidden; background: #eee; }
    img#image-to-crop { display: block; max-width: 100%; }
    .modal-actions { display: flex; gap: 10px; justify-content: flex-end; }
</style>

<div style="display: flex; justify-content: flex-end; align-items: center; padding: 15px 30px; background-color: #ffffff; border-bottom: 1px solid #e5e7eb;">
    
    <div style="display: flex; align-items: center; gap: 15px;">
        @if(Auth::user()->avatar)
            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
        @else
            <div style="width: 45px; height: 45px; background-color: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 20px; font-weight: bold;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
        
        <div style="line-height: 1.2;">
            <strong style="display: block; font-size: 16px; color: #111827;">{{ Auth::user()->name }}</strong>
            <span style="font-size: 14px; color: #6b7280;">{{ Auth::user()->email }}</span>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="margin: 0; margin-left: 20px;">
            @csrf
            <button type="submit" style="background-color: #ef4444; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                Logout
            </button>
        </form>
    </div>

</div>

<div style="padding: 30px; max-width: 600px;">
    <h2 style="margin-bottom: 20px;">Edit Profil</h2>

    @if(session('success'))
        <div style="color: #15803d; background-color: #dcfce3; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" style="background: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb;">
        @csrf
        @method('PUT')

        <input type="hidden" name="avatar_base64" id="avatar_base64">

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 10px;">Foto Profil Saat Ini:</label>
            @if(Auth::user()->avatar)
                <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" width="100" height="100" style="border-radius: 50%; object-fit: cover;">
            @else
                <img id="avatar-preview" src="" alt="Avatar" width="100" height="100" style="display: none; border-radius: 50%; object-fit: cover;">
                <div id="avatar-initial" style="width: 100px; height: 100px; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 40px; font-weight: bold;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>

        <div style="margin-bottom: 15px;">
            <label for="avatar_input" style="font-weight: bold;">Ganti Foto Profil:</label><br>
            <input type="file" id="avatar_input" accept="image/*" style="margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="name" style="font-weight: bold;">Nama:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
            @error('name') <span style="color: red; font-size: 12px; display: block;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="email" style="font-weight: bold;">Email:</label><br>
            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required style="width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
            @error('email') <span style="color: red; font-size: 12px; display: block;">{{ $message }}</span> @enderror
        </div>

        <button type="submit" style="background-color: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer;">
            Simpan Perubahan
        </button>
    </form>
</div>

<div id="cropModal" class="modal-crop">
    <div class="modal-crop-content">
        <h3 style="margin-bottom: 15px; margin-top: 0;">Sesuaikan Foto</h3>
        <div class="img-container">
            <img id="image-to-crop" src="">
        </div>
        <div class="modal-actions">
            <button type="button" id="btn-cancel" style="padding: 8px 15px; background: #e5e7eb; border: none; border-radius: 5px; cursor: pointer; color: #374151; font-weight: bold;">Batal</button>
            <button type="button" id="btn-crop" style="padding: 8px 15px; background: #3b82f6; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Crop & Pakai</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    let cropper;
    const avatarInput = document.getElementById('avatar_input');
    const imageToCrop = document.getElementById('image-to-crop');
    const modal = document.getElementById('cropModal');
    const avatarPreview = document.getElementById('avatar-preview');
    const avatarInitial = document.getElementById('avatar-initial');
    const base64Input = document.getElementById('avatar_base64');

    // 1. Saat user memilih file gambar
    avatarInput.addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const reader = new FileReader();
            reader.onload = function (event) {
                imageToCrop.src = event.target.result;
                modal.style.display = 'block'; // Tampilkan pop-up

                // Hancurkan cropper lama jika ada, lalu buat baru
                if (cropper) { cropper.destroy(); }
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 1, // Memaksa rasio 1:1 (kotak) agar pas dibikin bulat
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(files[0]);
        }
    });

    // 2. Saat user klik batal
    document.getElementById('btn-cancel').addEventListener('click', function() {
        modal.style.display = 'none'; // Sembunyikan pop-up
        avatarInput.value = ''; // Reset input file
    });

    // 3. Saat user klik "Crop & Pakai"
    document.getElementById('btn-crop').addEventListener('click', function() {
        // Ambil hasil crop dalam bentuk canvas
        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400, // Ukuran resolusi hasil foto (400x400)
        });

        // Ubah canvas menjadi Base64 string
        const base64Data = canvas.toDataURL('image/png');

        // Masukkan Base64 ke input hidden agar ikut tersubmit
        base64Input.value = base64Data;

        // Ubah gambar preview di form menjadi gambar hasil crop
        avatarPreview.src = base64Data;
        avatarPreview.style.display = 'block';
        if(avatarInitial) avatarInitial.style.display = 'none';

        // Tutup modal
        modal.style.display = 'none';
    });
</script>