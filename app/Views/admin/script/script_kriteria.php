<script>
    $(document).ready(function() {
        tampildata();

        function tampildata() {
            $('#kriteria').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paging": true,
                "serverSide": true,
                "searching": true,
                "language": {
                    "processing": "Loading. Please wait..."
                },
                "ajax": {
                    url: "<?= base_url('kriteria/datatables') ?>",
                    type: "POST",
                    data: function(d) {
                        d.search = $('#kriteria_filter input').val();
                    }
                },
            });
        }

        // INPUT
        $('#inputform').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('kriteria/store') ?>",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btn-simpan').html('<i id="spinn" class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span> LOADING...</span>')
                    $('#btn-simpan').attr('disabled', '');
                },
                success: function(response) {
                    $('#btn-simpan').removeAttr('disabled', '');
                    $("#btn-simpan").html('<i class="fas fa-save"></i> Simpan')
                    if (response.status) {

                        toastr.success(response.message);

                        $('#kriteria').DataTable().ajax.reload();
                        $('#modal-add').modal('hide');
                    } else {
                        toastr.error(response.message);
                    }
                },

                error: function(response) {
                    $('#btn-simpan').removeAttr('disabled', '');
                    $("#btn-simpan").html('<i class="fas fa-save"></i> Simpan')
                    Swal.fire({
                        type: 'error',
                        title: 'OOPS!!',
                        text: 'Server Error!'
                    });
                }
            });
        });

        //editview
        // $('#userGroup').on('click', '.bedit', function() {
        //     var id = $(this).attr('data');
        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo base_url() ?>usergroup/showedit",
        //         dataType: "JSON",
        //         data: {
        //             id: id
        //         },
        //         success: function(response) {
        //             if (response.status) {
        //                 let data = response.data

        //                 $('#modal-edit').modal('show');
        //                 $('[name="kodedit"]').val(data.id);
        //                 $('[name="enama"]').val(data.nama);
        //                 $('[name="eketerangan"]').val(data.keterangan);
        //             } else {
        //                 toastr.error(response.message);
        //             }
        //         }
        //     });
        //     return false;
        // });

        //aksi edit
        $('#editform').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>usergroup/store_edit",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#btn_edit').html('<i id="spinn" class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span> LOADING...</span>')
                    $('#btn_edit').attr('disabled', '');
                },
                success: function(response) {

                    $('#btn_edit').removeAttr('disabled', '');
                    $("#btn_edit").html('<i class="fas fa-save"></i> Simpan')

                    if (response.status) {
                        toastr.success(response.message);
                        $('#userGroup').DataTable().ajax.reload();
                        $('#modal-edit').modal('hide');
                    } else {
                        toastr.warning(response.message);
                    }
                },

                error: function(response) {
                    $('#btn_edit').removeAttr('disabled', '');
                    $("#btn_edit").html('<i class="fas fa-save"></i> Simpan')

                    Swal.fire({
                        type: 'error',
                        title: 'OOPS!!',
                        text: 'Server Error!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });

        // hapus
        $('#userGroup').on('click', '.bhapus', function() {
            var id = $(this).attr('data');
            swal.fire({
                title: 'Yakin Menghapus data ini?',
                text: "Tekan YES jika anda yakin ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?php echo base_url() ?>usergroup/destroy',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.status) {
                                toastr.success(response.message);

                                $('#userGroup').DataTable().ajax.reload();
                            } else {
                                toastr.warning(response.message);

                            }
                        },
                        error: function(response) {
                            data = JSON.parse(response.responseText);
                            Swal.fire({
                                icon: 'error',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

                    });
                }
            });

        });

        // $('#modal-add').on('hidden.bs.modal', function() {
        //     $('#nama').val('')
        //     $('#keterangan').val('')
        // });

        // $('#modal-edit').on('hidden.bs.modal', function() {
        //     $('#kodedit').val('')
        //     $('#enama').val('')
        //     $('#eketerangan').val('')
        // });

    })

    addData = () => {
        $('#modalLabel').text('Tambah Data Kriteria');
        $('.form-input').val('')
        $('#modal-add').modal('show');
    }

    editData = (id, kode, nama, bobot) => {
        $('#modalLabel').text('Edit Data Kriteria');
        $('#modal-add').modal('show');
        $('#id_kriteria').val(id);
        $('#kode').val(kode);
        $('#nama').val(nama);
        $('#bobot').val(bobot);

        // $.ajax({
        //     type: "POST",
        //     url: "<?php echo base_url('kriteria/getEdit') ?>",
        //     dataType: "JSON",
        //     data: {
        //         id: id
        //     },
        //     success: function(response) {
        //         if (response.status) {
        //             let data = response.data

        //             $('#modal-add').modal('show');
        //             $('#id_kriteria').val(id);
        //             $('#kode').val(data.kode);
        //             $('#nama').val(data.nama);
        //             $('#bobot').val(data.bobot);
        //         } else {
        //             toastr.error(response.message);
        //         }
        //     }
        // });
    }
</script>