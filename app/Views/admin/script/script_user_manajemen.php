<script>
    $(document).ready(function() {
        tampildata();

        function tampildata() {
            $('#user_manajemen').DataTable({
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
                    url: "<?= base_url('usermanajemen/datatables') ?>",
                    type: "POST",
                    data: function(d) {
                        d.search = $('#user_manajemen_filter input').val();
                    }
                },
            });
        }

        // INPUT
        $('#inputform').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('usermanajemen/store') ?>",
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

                        $('#user_manajemen').DataTable().ajax.reload();
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
    })

    addData = () => {
        $('#modalLabel').text('Tambah Data User');
        $('.form-input').val('')
        $('#modal-add').modal('show');
        $('#showStatus').hide();
        $('#hidePassword').show();
    }

    editData = (id, username, nama, status) => {
        $('#hidePassword').hide();
        $('#showStatus').show();
        $('#modalLabel').text('Edit Data User');
        $('#modal-add').modal('show');
        $('#id_user').val(id);
        $('#username').val(username);
        $('#nama_lengkap').val(nama);
        $('#status').val(status);
    }
</script>