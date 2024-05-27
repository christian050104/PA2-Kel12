<x-web-layout title="checkout">
    <style>
        .bread-crumb .img-fluid {
    max-width: 100%; /* Lebar maksimum gambar */
    height: auto; /* Tinggi otomatis sesuai proporsi aslinya */
    object-fit: cover; /* Mengisi dan memotong gambar untuk menyesuaikan ukuran elemen */
}

    </style>
    <div class="bread-crumb bg-light py-3">
        <img src="{{ asset('assets/images/5.jpeg') }}" class="img-fluid" alt="banner-top" title="banner-top">
        <div class="container text-center">
            <div class="matter">
                <h2 class="my-3">Kontak & Alamat</h2>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="list-inline-item"><a href="{{ url('/daftarmenu') }}">Kontak & Alamat</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mycart py-5">
        <div class="container">
            <div class="row justify-content-center">
                <form method="post" id="form" enctype="multipart/form-data" action="{{ route('web.checkout.updateCustomer') }}" class="col-lg-8 col-md-10">
                    @csrf
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Informasi Kontak & Alamat</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Informasi Kontak</h6>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="input-namalengkap">Nama Lengkap</label>
                                            <input name="namalengkap" value="{{ Auth::user()->namalengkap }}" placeholder="Nama Lengkap" id="input-namalengkap" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-email">Email</label>
                                            <input name="email" value="{{ Auth::user()->email }}" placeholder="Email" id="input-email" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-nomorhp">Nomor HP</label>
                                            <input name="nomorhp" value="{{ Auth::user()->nomorhp }}" placeholder="Nomor HP" id="input-nomorhp" class="form-control" type="text" readonly>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <h6>Alamat</h6>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="input-city">Kota</label>
                                            <select name="city" id="input-city" class="form-control">
                                                <option value="" disabled selected>Pilih Kota</option>
                                                <option value="Balige">Balige</option>
                                                <option value="Sitoluama">Sitoluama</option>
                                                <option value="Sigumpar">Sigumpar</option>
                                                <option value="Silaen">Silaen</option>
                                                <option value="Laguboti">Laguboti</option>
                                                <option value="Porsea">Porsea</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-address">Alamat Lengkap</label>
                                            <input name="address" value="{{ Auth::user()->address }}" placeholder="Input Alamat Lengkap" id="input-address" class="form-control" type="text">
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Metode Pembayaran</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        $('#form').on('submit', function(event){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('web.checkout.updateCustomer') }}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.alert == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('web.checkout.payment') }}";
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                }
            });
        });
    </script>
    @endsection
</x-web-layout>