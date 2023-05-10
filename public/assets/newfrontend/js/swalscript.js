document.querySelector(".eksportdata").addEventListener('click', function () {
    Swal.fire({
        title: 'Ekspor Data?',
        text: "Apakah anda yakin ingin mengekspor data saat ini?",
        // imageUrl: 'https://i.ibb.co/8cB628n/itembiru.png',
        // imageWidth: 400,
        // imageHeight: 30,
        // imageAlt: 'Custom image',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Data anda sudah di ekspor.',
                'success'
            )
        }
    })
});

function alertDelete() {
    Swal.fire({
        title: 'Hapus Data?',
        text: "Apakah anda yakin untuk menghapus?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Data sudah di hapus.',
                'success'
            )
        }
    });
}

function alertedit() {
    Swal.fire({
        title: 'Edit Data?',
        text: "Apakah anda yakin untuk mengedit data ini?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Data sudah di edit.',
                'success'
            )
        }
    });
}

function alertsave() {
    Swal.fire({
        title: 'Tambah Data?',
        text: "Apakah anda yakin ingin menambah data baru?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Data baru sudah ditambahkan',
                'success'
            )
                .then(function () {
                    window.location = "/daftar-pegawai";
                });
        }
    });
}

function alertshift() {
    Swal.fire({
        title: 'Ganti Shift?',
        text: "Apakah anda yain untuk mengganti shift saat ini?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Data baru sudah ditambahkan',
                'success'
            )
                .then(function () {
                    window.location = "/daftar-schedule";
                });
        }
    });
}

document.querySelector(".save").addEventListener('click', function() {
    Swal.fire({
        title: 'Ekspor Data?',
        text: "Apakah anda yakin ingin manambah data " + nama + " ?",
        // imageUrl: 'https://i.ibb.co/8cB628n/itembiru.png',
        // imageWidth: 400,
        // imageHeight: 30,
        // imageAlt: 'Custom image',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Data anda sudah di ekspor.',
                'success'
            )
        }
    })
});

function alertTolak() {
    Swal.fire({
        title: 'Alasan Penolakan',
        text: "Apakah anda yakin untuk menolak time off ini?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Selesai!',
                'Alasan Penolakan Dikirim',
                'success'
            )
                .then(function () {
                    window.location = "/daftar-time-off";
                });
        }
    });
}