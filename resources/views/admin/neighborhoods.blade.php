@extends('secured-layouts.app')
@section('title', 'No Fee Rental')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Neighborhoods</h1>
            <a href="#" data-toggle="modal"  id="new-neighborhood"class="btn-default">New Neighborhood</a>
        </div>
        <div class="block">
            <div class="table-responsive neighbourhood-table">
                <table class="datatable dataTable table table-hover display" style="width: 100%;" id="neighborhoods_table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    {{--Add Neighbour--}}
    @include('admin.modals.add_neighborhood')
    {{--View Content--}}
    @include('admin.modals.view_neighborhood_content')
    {!! HTML::script('assets/js/neighborhoods.js') !!}
    <script>
        let column = [{
            render: (data, type, row) => {
                return `
                <i class="fa fa-eye action-btn" id="viewNeighborhoodContent" ref_id="${row.id}" route="/admin/neighborhood/edit/${row.id}"></i>
                <i class="fa fa-edit px-2 action-btn" id="updateNeighborhood" ref_id="${row.id}" route="/admin/neighborhood/edit/${row.id}"></i>
                <i class="fa fa-trash action-btn" id="deleteNeighborhood" ref_id="${row.id}" route="/admin/neighborhood/delete/${row.id}"></i>`;
            }, targets: 3
        }];

        dataTables('#neighborhoods_table', '/admin/get-neighborhoods', null, column);
    </script>
@endsection

