@extends('layouts.front_app')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="agenda">Agenda</label>
                                <input type="text" class="form-control form-control-sm @error('agenda') is-invalid @enderror" name="agenda" value="{{$item->agenda}}" id="agenda" placeholder="Masukan Agenda Rapat / Acara" readonly>
                                @error('agenda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="tgl_agenda">Tanggal Agenda</label>
                                <input type="date" class="form-control form-control-sm @error('tgl_agenda') is-invalid @enderror" name="tgl_agenda" value="{{$item->tgl_agenda}}" id="tgl_agenda" placeholder="dd/mm/yyyy" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tempat">Tempat</label>
                                <input type="text" class="form-control form-control-sm @error('tempat') is-invalid @enderror" name="tempat" value="{{$item->tempat}}" id="tempat" placeholder="Masukan Tempat Acara" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="jam_mulai">Jam Mulai</label>
                                        <input type="time" class="form-control form-control-sm @error('jam_mulai') is-invalid @enderror" name="jam_mulai" value="{{$item->jam_mulai}}" id="jam_mulai" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                    
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_selesai" name="is_selesai" {{$item->is_selesai == 'Ya' ? 'checked' : ''}}>
                                            <label class="form-check-label" for="is_selesai">s/d Selesai?</label>
                                        </div>
                                        <input type="time" class="form-control form-control-sm @error('jam_berakhir') is-invalid @enderror" name="jam_berakhir" value="{{$item->jam_berakhir}}" id="jam_berakhir" placeholder="dd/mm/yyyy" {{$item->is_selesai == 'Ya' ? 'disabled' : ''}}>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group mb-3">
                                <label for="tempat">Publikasi Absensi?</label>
                                <input type="text" class="form-control form-control-sm @error('tempat') is-invalid @enderror" name="tempat" value="{{$item->is_public}}" id="tempat" placeholder="Masukan Tempat Acara" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered table-hover w-100 table table-striped">
                                <tr>
                                    <td>Qr Code</td>
                                    <td>:</td>
                                    <td>
                                        {!! $qrcode !!}
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>Download QrCode</td>
                                    <td>:</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm text-white" href="{{route('attendances.generateQr', $item->id)}}">
                                            <i class="fa-solid fa-qrcode"></i> Download QR Code
                                        </a>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>Download Pdf</td>
                                    <td>:</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm text-white" href="{{route('attendances.printAbsensi', $item->id)}}">
                                            <i class="fa-solid fa-file-pdf"></i> Download Lembar Absensi
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" id="copyText" value="{{$url}}" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Copy Link</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Daftar Hadir</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover w-100 table table-striped">
                            <thead>
                                <tr>
                                    <th class="py-2">#</th>
                                    <th class="py-2">Nama</th>
                                    <th class="py-2">No HP / Email</th>
                                    <th class="py-2">Unit / Jabatan</th>
                                    <th class="py-2">Waktu Kehadiran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $kehadiran as $absen )
                                    <tr>
                                        <td>{{ $loop->index }} </td>
                                        <td>{{ $absen->nama }} </td>
                                        <td>{{ $absen->no_tlp }}  <br> {{ $absen->email }}</td>
                                        <td>{{ $absen->unit }}</td>
                                        <td>{{ $absen->created_at }}</td>
                                        <td>
                                            <form action="{{route('attendances.destroyCeklok', $absen->id)}}" method="POST" id="form" class="form-inline" onSubmit="if (confirm(`Apa anda yakin menghapus data kehadiran ini?`)) run; return false">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="5">Belum ada kehadiran absensi</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')

@endpush

@push('addon-script')
<script>
    const copyBtn = document.getElementById('button-addon2')
    const copyText = document.getElementById('copyText')
    
    copyBtn.onclick = () => {
        copyText.select();    // Selects the text inside the input
        document.execCommand('copy');
        alert('Link Berhasil di Copy');
    // Simply copies the selected text to clipboard 
    }
</script>
@endpush