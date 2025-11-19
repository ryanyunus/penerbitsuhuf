@extends('layout')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Keranjang Belanja</h3>

        @if(count($cart))
            <form action="{{ route('cart.clear') }}" method="POST"
                  onsubmit="return confirm('Kosongkan keranjang?')">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    Kosongkan Keranjang
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!count($cart))
        <p class="text-muted">Keranjang masih kosong.</p>
        <a href="{{ route('books.front.index') }}" class="btn btn-success btn-sm">
            Lihat Buku
        </a>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="80">Cover</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th width="80">Qty</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            {{-- <td>
                                @if($item['cover'])
                                    <img src="{{ asset('storage/'.$item['cover']) }}"
                                         alt="{{ $item['title'] }}"
                                         class="img-thumbnail"
                                         style="max-height: 70px;">
                                @endif
                            </td> --}}
                            <td>
                                @if(!empty($item['cover']))
                                    <img src="{{ asset($item['cover']) }}"
                                        alt="{{ $item['title'] }}"
                                        style="max-height: 80px"
                                        class="img-thumbnail">
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('books.front.show', $item['slug']) }}">
                                    {{ $item['title'] }}
                                </a>
                            </td>
                            <td>{{ $item['author'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus buku ini dari keranjang?')">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tombol checkout palsu dulu aja --}}
        <div class="mt-3">
            {{-- <button class="btn btn-success" disabled>
                Checkout (coming soon)
            </button> --}}

                        @php
                // GANTI dengan nomor WhatsApp kamu (tanpa +)
                $waNumber = '62812xxxxxxxx';

                $lines = ["Halo, saya ingin memesan buku dari Penerbit Suhuf:"];

                foreach($cart as $item) {
                    $lines[] = "- {$item['title']} (qty: {$item['qty']})";
                }

                $text = urlencode(implode("\n", $lines));
                $whatsappUrl = "https://wa.me/{$waNumber}?text={$text}";
            @endphp

            <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-success">
                Checkout via WhatsApp
            </a>

        </div>
    @endif
</div>
@endsection
