<script>
    const modal_form = document.querySelector('#modal_form');
    const btn_submit = modal_form.querySelector('#btn_submit');

    const setForm = (title, data) => {
        modal_form.querySelector('#title_form').innerHTML = `${title} data <?= $service_name ?>`
        const service_name = '<?= $service_name ?>';

        const fields = <?= json_encode($fields); ?>;

        fields.forEach((e, i) => {
            const element = modal_form.querySelector(`#${fields[i]}`);

            if (title === 'detail') {
                element.setAttribute('disabled', '');
            } else {
                element.removeAttribute('disabled', '');
            }

            if (element.tagName == 'INPUT' || element.tagName == 'SELECT') {
                element.value = title === 'tambah' ? '' : data[i];
            } else {
                element.innerHTML = title === 'tambah' ? '' : data[i];
            }

            if (service_name == 'pasien') {
                if (e == 'kode_pasien') {
                    element.value = title === 'tambah' ? '<?= $kode_pasien ?? '' ?>' : data[i];
                }
            }

            if (service_name == 'petugas') {
                if (e == 'kode_petugas') {
                    element.value = title === 'tambah' ? '<?= $kode_petugas ?? '' ?>' : data[i];
                }

                if (e == 'password') {
                    element.setAttribute('readonly', '');
                }
            }

            if (service_name == 'pmi') {
                if (e == 'kode_pmi') {
                    element.value = title === 'tambah' ? '<?= $kode_pmi ?? '' ?>' : data[i];
                }
            }

            if (service_name == 'kurir') {
                if (e == 'kode_kurir') {
                    element.value = title === 'tambah' ? '<?= $kode_kurir ?? '' ?>' : data[i];
                }
            }

            if (service_name == 'dokter') {
                if (e == 'kode_dokter') {
                    element.value = title === 'tambah' ? '<?= $kode_dokter ?? '' ?>' : data[i];
                }
            }

            if (service_name == 'penerima') {
                if (e == 'kode_penerima') {
                    element.value = title === 'tambah' ? '<?= $kode_penerima ?? '' ?>' : data[i];
                }
            }
            if (service_name == 'ruangan') {
                if (e == 'kode_ruangan') {
                    element.value = title === 'tambah' ? '<?= $kode_ruangan ?? '' ?>' : data[i];
                }
            }
            if (service_name == 'darah') {
                if (e == 'kode_darah' || e == 'jenis_darah' || e == 'golongan_darah' || e == 'rhesus') {
                    element.setAttribute('disabled', '');
                    element.value = title === 'tambah' ? '<?= $kode_ruangan ?? '' ?>' : data[i];
                }
            }
        })

        btn_submit.removeAttribute('hidden');

        if (title === 'detail') {
            btn_submit.setAttribute('hidden', '')
        }

        if (title === 'tambah') {
            modal_form.querySelector('form').setAttribute('action', '<?= base_url("$service_name/insert") ?>');
            btn_submit.innerHTML = 'Simpan';
        }

        if (title === 'edit') {
            modal_form.querySelector('form').setAttribute('action', '<?= base_url("$service_name/edit") ?>');
            btn_submit.innerHTML = 'Edit';
        }

        if (service_name == 'petugas') {
            const password = modal_form.querySelector('#password')
            const passwordHelpBlock = modal_form.querySelector('#passwordHelpBlock')
            if (title == 'edit') {
                password.removeAttribute('required');
            } else {
                password.setAttribute('required', '')
            }

            if (title == 'detail') {
                passwordHelpBlock.innerHTML = '';
                password.setAttribute('disabled', '');
            } else {
                passwordHelpBlock.innerHTML = title == 'tambah' ? 'Panjang Passowrd Minimal 8 Karakter' : 'Biarkan Input Password Kosong, Bila Tidak Ingin Merubah Password'
                password.removeAttribute('disabled');
            }
        }
    }
</script>