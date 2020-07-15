<div class="row table-row">
    <div class="col-12">
        <div class="clearfix">
            <div style="float: left;" > <h5> {{$title}}
                    <span class="red"></span> </h5></div>

            <div class="pull-right tableTools-container"></div>
        </div>

        <table class="table table-main table-bordered display" id="dynamic-table" >
            <thead>

            <tr>
                <th> # </th>
                <th> รหัสสถานพยาบาล </th>
                <th> โรงพยาบาล </th>
                <th> HN </th>
                {{--                            <th> ชื่อ-สกุล </th>--}}
                <th>วันที่เกิดเหตุ</th>
                <th>เวลาที่เกิดเหตุ</th>
                <th>วันที่มาถึง</th>
                <th>เวลาที่มาถึง</th>
                <th> lastupdate </th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody class="table-striped">

            @foreach($list as $item)
                <tr>
                    <td> {{ $loop->iteration }}</td>
                    <td>{{ $item->hosp ?? "" }}</td>
                    <td> {{ $hosp_name->name ?? "" }}   </td>
                    <td> {{ $item->hn ?? "" }}  </td>
{{--                    <td> {{ $item->prename ?? "" }} {{ $item->name ?? "" }} {{ $item->fname ?? "" }}  </td>--}}
                    <td> {{ $item->adate ?? "" }}  </td>
                    <td> {{ $item->atime ?? "" }}  </td>
                    <td> {{ $item->hdate ?? "" }}  </td>
                    <td> {{ $item->htime ?? "" }}  </td>
                    <td> {{ $item->lastupdate ?? "" }}  </td>
                    <td> </td>


                </tr>

            @endforeach


            </tbody>
        </table>
    </div>
</div>
