<?php


/* @var $this \yii\web\View */

/* @var $data array */

$formatter = Yii::$app->formatter;
?>

<div class="karyawan-index">

    <?php $no = 1 ?>
    <?php foreach ($data as $key => $karyawan) : ?>
        <div>
            <h3><?= $no ?>. <?= $karyawan['nama'] ?></h3>
            <br/>
            <table class="table-bordered-outside">
                <thead>
                <tr>
                    <th colspan="6" style="text-align: left">Biodata</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="title">NIK</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_induk_karyawan'] ?></td>

                    <td>Nama Panggilan</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nama_panggilan'] ?></td>
                </tr>

                <tr>
                    <td class="title">Tempat & Tgl Lahir</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['tempat_lahir'] ?>,
                        <?= $formatter->asDate($karyawan['tanggal_lahir']) ?>
                    </td>

                    <td class="title">Status Kewarganegaraan</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['status_kewarganegaraan'] ?></td>
                </tr>

                <tr>
                    <td>Nomor KTP.</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_kartu_tanda_penduduk'] ?></td>

                    <td>NPWP</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_pokok_wajib_pajak'] ?></td>
                </tr>

                <tr>
                    <td>Nomor Kitas</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_kitas_atau_sejenisnya'] ?></td>

                    <td>Jenis Kelamin</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['jenis_kelamin'] ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['agama']['nama'] ?></td>

                    <td>Nama Ayah</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nama_ayah'] ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nama_ibu'] ?></td>

                    <td class="title">Pendidikan Terakhir</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['pendidikan_terakhir'] ?></td>
                </tr>
                <tr>
                    <td class="title">Tanggal Mulai Bekerja</td>
                    <td class="divider">:</td>
                    <td><?= $formatter->asDate($karyawan['tanggal_mulai_bekerja']) ?></td>

                    <td>Aturan Absensi</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['jadwalKerja']['kode'] ?></td>
                </tr>
                </tbody>

            </table>
            <br/>
            <table class="table-bordered-outside">
                <thead>
                <tr>
                    <th colspan="6" style="text-align: left">Alamat Karyawan</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($karyawan['alamatKaryawans'] as $keyAlamat => $alamat): ?>
                    <tr>
                        <td>Type</td>
                        <td class="divider">:</td>
                        <td>
                            <?= $alamat['type'] ?>
                        </td>

                        <td>Atas Nama</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['atas_nama'] ?></td>
                    </tr>

                    <tr>
                        <td>Jalan</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['jalan'] ?></td>

                        <td>Block</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['block'] ?></td>
                    </tr>

                    <tr>
                        <td>Nomor</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['nomor'] ?></td>

                        <td>RT</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['rt'] ?></td>
                    </tr>

                    <tr>
                        <td>RW</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['rw'] ?></td>

                        <td>Kecamatan</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['kecamatan'] ?></td>
                    </tr>

                    <tr>
                        <td>Kelurahan</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['kelurahan'] ?></td>

                        <td>Kabupaten</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['kabupaten'] ?></td>
                    </tr>

                    <tr>
                        <td>Propinsi</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['propinsi'] ?></td>

                        <td>Kode POS</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['kode_pos'] ?></td>
                    </tr>

                    <tr>
                        <td>No. Telepon</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['nomor_telepon'] ?></td>

                        <td>Email</td>
                        <td class="divider">:</td>
                        <td><?= $alamat['email'] ?></td>
                    </tr>

                    <tr>
                        <td style="border-bottom: 1px solid black">Keterangan</td>
                        <td class="divider" style="border-bottom: 1px solid black">:</td>
                        <td colspan="4" style="border-bottom: 1px solid black"><?= $alamat['keterangan'] ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <br/>
            <table class="table table-gridview">
                <thead>
                <tr>
                    <th colspan="5" style="text-align: left">Kerabat Karyawan | PTKP</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Hubungan</th>
                    <th>Nama Tanggungan</th>
                    <th>Tempat & Tgl Lahir</th>
                    <th>Terhitung PTKP</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($karyawan['karyawanPtkps'] as $keyPtkp => $ptkp): ?>
                    <tr>
                        <td><?= ($keyPtkp + 1) ?></td>
                        <td><?= $ptkp['hubunganPtkp']['nama'] ?></td>
                        <td><?= $ptkp['nama_tanggungan'] ?></td>
                        <td><?= $ptkp['tempat_lahir'] ?>,
                            <?= $formatter->asDate( $ptkp['tanggal_lahir']) ?>

                        </td>
                        <td>
                            <?= $ptkp['terhitung_sebagai_ptkp'] ?>
                            <?= !empty($ptkp['batal_ptkp_id']) ?
                                "karena Tanggungan adalah ". $ptkp['batalPtkp']['nama'] :
                                null
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <br/>
            <table class="table table-gridview">
                <thead>
                <tr>
                    <th colspan="7" style="text-align: left">Struktur Organisasi</th>
                </tr>
                <tr>
                    <th>#</th>
                    <th>Jenis Jabatan</th>
                    <th>Struktur</th>
                    <th>Surat Pengangkatan</th>
                    <th>Tanggal Aktif</th>
                    <th>Tanggal Berakhir</th>
                    <th>Alasan Berakhir</th>
                </tr>
                </thead>

                <?php if ($karyawan['karyawanStrukturOrganisasis']) : ?>
                    <tbody>
                    <?php foreach ($karyawan['karyawanStrukturOrganisasis'] as $keyOrg => $org): ?>
                        <tr>
                            <td><?= ($keyOrg + 1) ?></td>
                            <td><?= $org['jenis_jabatan'] ?></td>
                            <td><?= $org['strukturOrganisasi']['nama'] ?></td>
                            <td><?= $org['nomor_surat_pengangkatan'] ?></td>
                            <td><?= $org['tanggal_aktif'] ?></td>
                            <td><?= $org['tanggal_berakhir'] ?></td>
                            <td><?= $org['alasan_berakhir'] ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php else: ?>
                    <tbody>
                    <tr>
                        <td colspan="7">Data belum tersedia</td>
                    </tr>
                    </tbody>
                <?php endif ?>
            </table>
        </div>
        <?php $no++; ?>
    <pagebreak>
    <?php endforeach; ?>
</div>

