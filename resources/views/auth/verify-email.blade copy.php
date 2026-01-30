@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi Email</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </div>
                    @endif
                    <p>Silakan cek email Anda untuk link verifikasi sebelum melanjutkan.</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
