<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tindakan</th>
            <th>Tarif Tindakan</th>
            <th>Fee Dokter</th>
            <th>Fee Asisten</th>
            <th>Fee Klinik</th>
            <th>Poliklinik</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row['No'] }}</td>
                <td>{{ $row['Nama Tindakan'] }}</td>
                <td>{{ $row['Tarif Tindakan'] }}</td>
                <td>{{ $row['Fee Dokter'] }}</td>
                <td>{{ $row['Fee Asisten'] }}</td>
                <td>{{ $row['Fee Klinik'] }}</td>
                <td>{{ $row['Poliklinik'] }}</td>
                <td>{{ $row['Status'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
