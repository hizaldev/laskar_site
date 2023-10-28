@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header"><strong>Tambah Absensi Laskar PLN</strong></div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('attendances.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="agenda">Agenda</label>
                            <input type="text" class="form-control form-control-sm @error('agenda') is-invalid @enderror" name="agenda" value="{{ old('agenda') }}" id="agenda" placeholder="Masukan Agenda Rapat / Acara">
                            @error('agenda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tgl_agenda">Tanggal Agenda</label>
                            <input type="date" class="form-control form-control-sm @error('tgl_agenda') is-invalid @enderror" name="tgl_agenda" value="{{ old('tgl_agenda') }}" id="tgl_agenda" placeholder="dd/mm/yyyy">
                            @error('tgl_agenda')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="tempat">Tempat</label>
                            <input type="text" class="form-control form-control-sm @error('tempat') is-invalid @enderror" name="tempat" value="{{ old('tempat') }}" id="tempat" placeholder="Masukan Tempat Acara">
                            @error('tempat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" class="form-control form-control-sm @error('jam_mulai') is-invalid @enderror" name="jam_mulai" value="{{ old('jam_mulai') }}" id="jam_mulai" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_selesai" name="is_selesai">
                                        <label class="form-check-label" for="is_selesai">s/d Selesai?</label>
                                    </div>
                                    <input type="time" class="form-control form-control-sm @error('jam_berakhir') is-invalid @enderror" name="jam_berakhir" value="{{ old('jam_berakhir') }}" id="jam_berakhir" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group mb-3">
                            <label for="is_public">Publikasi Absensi?</label>
                            <select name="is_public" class="form-control form-control-sm @error('is_public') is-invalid @enderror" id="is_public" required>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                            @error('is_public')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-sm mr-2 mt-2">Submit</button>
                        <a href="#" class="btn btn-secondary btn-sm mt-2" role="button" aria-pressed="true" value="Go Back" onclick="history.back(-1)">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.c  ontent-wrapper -->
@endsection

@push('addon-style')

@endpush

@push('addon-script')

<script>
    var checkbox = document.querySelector("input[name=is_selesai]");
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                console.log("Checkbox is checked..");
                document.getElementById('jam_berakhir').disabled = true;
            } else {
                console.log("Checkbox is not checked..");
                document.getElementById('jam_berakhir').disabled = false;

            }
        });
</script>
    
@endpush