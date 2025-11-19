@extends('layout')

@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">

    <h1 class="mb-4">Tentang Kami</h1>

    <p class="mb-4">
        Penerbit Suhuf adalah bagian dari <strong>CV. LITERA MULIA ABADI</strong>, 
        sebuah badan usaha yang bergerak di bidang percetakan, penerbitan, 
        dan perdagangan umum. Kami berdedikasi untuk menghadirkan buku-buku 
        berkualitas yang bermanfaat bagi masyarakat umum.
    </p>

    <h4 class="mt-4">Profil Usaha</h4>
    <table class="table table-borderless w-auto">
        <tr>
            <td><strong>Nama Usaha</strong></td>
            <td>: CV. LITERA MULIA ABADI</td>
        </tr>
        <tr>
            <td><strong>Jenis Kegiatan</strong></td>
            <td>: Percetakan / Penerbitan & Perdagangan Umum</td>
        </tr>
        <tr>
            <td><strong>Tempat Kegiatan</strong></td>
            <td>: Candi III, RT 02 / RW 05, <br>Sardonoharjo, Ngaglik, Sleman</td>
        </tr>
        <tr>
            <td><strong>Tahun Berdiri</strong></td>
            <td>: (2024)</td>
        </tr>
    </table>

    <h4 class="mt-4">Visi</h4>
    <p>
        Menjadi penerbit yang berkontribusi dalam memberikan literasi bermutu 
        bagi masyarakat dengan tetap menjunjung nilai intelektualitas dan integritas.
    </p>

    <h4 class="mt-4">Misi</h4>
    <ul>
        <li>Menerbitkan karya-karya berkualitas dalam berbagai bidang.</li>
        <li>Mendukung penulis lokal untuk berkembang dan dikenal lebih luas.</li>
        <li>Menyediakan layanan penerbitan yang profesional dan terpercaya.</li>
    </ul>

</div>
@endsection
