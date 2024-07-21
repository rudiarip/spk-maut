<script>
    $(document).ready(function() {
        loadTable()

        // INPUT
        $('#inputform').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('subkriteria/store') ?>",
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

                        loadTable()
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

    addData = (id_kriteria) => {
        $('#modalLabel').text('Tambah Data Sub Kriteria');
        $('#id_kriteria').val(id_kriteria)
        $('#id_sub_kriteria').val('')
        $('.form-input').val('')
        $('#modal-add').modal('show');
    }

    editData = (id_kriteria, id_sub_kriteria, nama, nilai) => {
        $('#modalLabel').text('Edit Data Kriteria');
        $('#id_kriteria').val(id_kriteria);
        $('#id_sub_kriteria').val(id_sub_kriteria);
        $('#nama').val(nama);
        $('#nilai').val(nilai);
        $('#modal-add').modal('show');
    }

    loadTable = () => {
        $.ajax({
            type: "GET",
            url: "<?= base_url('subkriteria/loadTable') ?>",
            dataType: "HTML",
            beforeSend: function(data) {
                $('#isiTable').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only"> LOADING...</span></div>')
            },
            success: function(data) {
                $('#isiTable').html(data);
                $('.isi-table').DataTable({});
            }
        });
    }
</script>