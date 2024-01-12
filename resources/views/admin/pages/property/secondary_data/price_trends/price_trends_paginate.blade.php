<table class="table-bordered table table-stripped mt-3 mb-3">

    <thead style="background: #c0cfff;">

        <tr>

            <th>Sl.no</th>

            <th>Project Name</th>

            <th>
                @if ($property->residential_type == 7)
                    Tower
                @else
                    Unit
                @endif
            </th>

            <th>Status of the Project /
                @if ($property->residential_type == 7)
                    Tower
                @else
                    Unit
                @endif
            </th>

            <th>Date</th>

            <th>Price In Sq.fts</th>
            <th>Action</th>
        </tr>

    </thead>

    <tbody>

        @foreach ($price_trends as $price_trend)
            <tr>

                <td>{{ $loop->iteration ?? 'N/A' }}</td>

                <td>{{ $property->project_name ?? 'N/A' }}</td>

                <td>{{ $price_trend->tower->tower_name ?? 'N/A' }}</td>

                <td>
                    @if (empty($price_trend->tower->tower_name))
                        {{ $price_trend->projectStatus->name ?? '' }}
                    @else
                        {{ $price_trend->towerStatus->name ?? '' }}
                    @endif
                </td>

                <td>{{ date('d-m-Y', strtotime($price_trend->date)) ?? 'N/A' }} </td>

                <td>{{ $price_trend->price ? $price_trend->price : 'N/A' }}</td>
                <td><button class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></td>
            </tr>
        @endforeach

    </tbody>

</table>

<div id="pagination">

    {{ $price_trends->links('pagination::bootstrap-4', ['secure' => true]) }}

</div>
