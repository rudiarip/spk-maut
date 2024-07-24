<script>
    $(document).ready(function() {
        // tampildata();

        // function tampildata() {
        //     $('#penilaian').DataTable({
        //         "responsive": true,
        //         "lengthChange": true,
        //         "autoWidth": false,
        //         "paging": true,
        //         "serverSide": true,
        //         "searching": true,
        //         "language": {
        //             "processing": "Loading. Please wait..."
        //         },
        //         "ajax": {
        //             url: "<?= base_url('penilaian/datatables') ?>",
        //             type: "POST",
        //             data: function(d) {
        //                 d.search = $('#penilaian_filter input').val();
        //             }
        //         },
        //     });
        // }

        // // INPUT
        // $('#inputform').submit(function(e) {
        //     e.preventDefault();

        //     $.ajax({
        //         type: "POST",
        //         url: "<?php echo base_url('penilaian/store') ?>",
        //         data: new FormData(this),
        //         processData: false,
        //         contentType: false,
        //         dataType: 'JSON',
        //         beforeSend: function() {
        //             $('#btn-simpan').html('<i id="spinn" class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span> LOADING...</span>')
        //             $('#btn-simpan').attr('disabled', '');
        //         },
        //         success: function(response) {
        //             $('#btn-simpan').removeAttr('disabled', '');
        //             $("#btn-simpan").html('<i class="fas fa-save"></i> Simpan')
        //             if (response.status) {

        //                 toastr.success(response.message);

        //                 $('#penilaian').DataTable().ajax.reload();
        //                 $('#modal-add').modal('hide');
        //             } else {
        //                 toastr.error(response.message);
        //             }
        //         },

        //         error: function(response) {
        //             $('#btn-simpan').removeAttr('disabled', '');
        //             $("#btn-simpan").html('<i class="fas fa-save"></i> Simpan')
        //             Swal.fire({
        //                 type: 'error',
        //                 title: 'OOPS!!',
        //                 text: 'Server Error!'
        //             });
        //         }
        //     });
        // });
    })

    // addData = () => {
    //     $('#modalLabel').text('Tambah Data Alternatif');
    //     $('.form-input').val('')
    //     $('#modal-add').modal('show');
    // }

    // editData = (id, nama) => {
    //     $('#modalLabel').text('Edit Data Alternatif');
    //     $('#modal-add').modal('show');
    //     $('#id_alternatif').val(id);
    //     $('#nama').val(nama);
    // }

    // loadModal = (id) => {
    //     $('#id_alternatif').val(id)
    //     $('#modal-add').modal('show');

    //     $.ajax({
    //         type: "POST",
    //         url: "<?= base_url('penilaian/loadModal') ?>",
    //         data: {
    //             id_alternatif: id
    //         },
    //         dataType: "HTML",
    //         beforeSend: function(data) {
    //             $('#isiModal').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only"> LOADING...</span></div>')
    //         },
    //         success: function(data) {
    //             $('#isiModal').html(data);
    //         }
    //     });
    // }
</script>