@extends('layouts.app', ['title' => 'Halaman Pengaturan'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-tags"></i> KALIMAT SLIDER</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>PROMO TEXT</label>
                            <input type="text" name="promo_text" value="{{ old('promo_text', $setting->promo_text) }}" placeholder="Masukkan Promo Text" class="form-control @error('promo_text') is-invalid @enderror">

                            @error('promo_text')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>SLOGAN TEXT</label>
                            <input type="text" name="slogan_text" value="{{ old('slogan_text', $setting->slogan_text) }}" placeholder="Masukkan Slogan Text" class="form-control @error('slogan_text') is-invalid @enderror">

                            @error('slogan_text')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
