function cekform(){    
    if (!$('#nama_lengkap').val()) {
        alert('Nama lengkap Tidak Boleh Kosong');
        $('#nama_lengkap').focus()
        return false;
    }
    if (!$('#nipeg').val()) {
        alert('Nipeg Tidak Boleh Kosong');
        $('#nipeg').focus()
        return false;
    }
    if (!$('#email').val()) {
        alert('Email Tidak Boleh Kosong');
        $('#email').focus()
        return false;
    }
    if (!$('#tempat_lahir').val()) {
        alert('Tempat Lahir Tidak Boleh Kosong');
        $('#tempat_lahir').focus()
        return false;
    }
    if (!$('#tgl_lahir').val()) {
        alert('Tanggal Lahir Tidak Boleh Kosong');
        $('#tgl_lahir').focus()
        return false;
    }
    if (!$('#no_telpon').val()) {
        alert('No Whatsapp Tidak Boleh Kosong');
        $('#no_telpon').focus()
        return false;
    }
    if (!$('#unit_id').val()) {
        alert('Unit harus dipilih');
        $('#unit_id').focus()
        return false;
    }
    if (!$('#size_id').val()) {
        alert('Ukuran Baju harus dipilih');
        $('#size_id').focus()
        return false;
    }
    if (!$('#grade').val()) {
        alert('Grade harus dipilih');
        $('#grade').focus()
        return false;
    }
    if (!$('#signature64').val()) {
        alert('Tanda Tangan digital wajib diisi');
        $('#signature64').focus()
        return false;
    }
    if (!$('#captcha').val()) {
        alert('Captcha Tidak Boleh Kosong');
        $('#captcha').focus()
        return false;
    }
    console.log('ini data togle untuk modal');
    $('#exampleModal').modal('show')
}