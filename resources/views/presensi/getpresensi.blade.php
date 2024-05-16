@php
    $iterationCounter = 1;
@endphp
@foreach ($getpresensi as $p)
    <tr>
        <td>{{$iterationCounter}}</td>
        <td>{{$p->id_pkl}}</td>
        <td>{{$p->nama_lengkap}}</td>
        <td>{{$p->nama_instansi}}</td>
        <td>{{$p->nama_divisi}}</td>
        <td>{{$p->nama_lokasi}}</td>
        <?php
            if ($p->jam_in <= '08:00:00') {
        ?>
                <td><span class="badge bg-success text-white">{{$p->jam_in}}</span></td>
        <?php
            }else {
        ?>
                <td><span class="badge bg-danger text-white">{{$p->jam_in}}</span></td>
        <?php
            };
        ?>
        <td>-</td>
    </tr>
    @php
        $iterationCounter++;
    @endphp
@endforeach
@foreach ($getizin as $i)
    <tr>
        <td>{{$iterationCounter}}</td>
        <td>{{$i->id_pkl}}</td>
        <td>{{$i->nama_lengkap}}</td>
        <td>{{$i->nama_instansi}}</td>
        <td>{{$i->nama_divisi}}</td>
        <td>{{$i->nama_lokasi}}</td>
        <td>-</td>
        <?php
            if ($i->status == 'i') {
        ?>
                <td><span class="badge bg-danger text-white">Izin</span></td>
        <?php
            }elseif ($i->status == 's') {
        ?>
                <td><span class="badge bg-danger text-white">Sakit</span></td>
        <?php
            };
        ?>

    </tr>
    @php
        $iterationCounter++;
    @endphp
@endforeach
