@extends('secured-layouts.app')
@section('title', 'Neighborhoods')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Neighborhoods</h1>
            <a href="javascript:void(0);" id="add_neighborhood" data-toggle="modal" data-target="#add-neighborhood" class="btn-default">
                <i class="fa fa-plus"></i>
                Add Neighborhood</a>
        </div>
        <div class="block listing-container manage-accounts">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-1">Manhattan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-2">Brooklyn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-3">Queens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-4">Bronx</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-5">Staten Island</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-6">Other</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                {{--Agent Table--}}
                <div class="tab-pane active" id="tab-1">
                    <div class="table-responsive neighbourhood-table">
                        <table class="datatable dataTable table table-hover display" style="width: 100%;" id="manhattan">
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
                <div class="tab-pane" id="tab-2">
                    <div class="table-responsive neighbourhood-table">
                        <table class="datatable dataTable table table-hover display" style="width: 100%;" id="brooklyn">
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
                <div class="tab-pane" id="tab-3">
                    <div class="table-responsive neighbourhood-table">
                        <table class="datatable dataTable table table-hover display" style="width: 100%;" id="queens">
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
                <div class="tab-pane" id="tab-4">
                    <div class="table-responsive neighbourhood-table">
                        <table class="datatable dataTable table table-hover display" style="width: 100%;" id="bronx">
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
                <div class="tab-pane" id="tab-5">
                    <div class="table-responsive neighbourhood-table">
                        <table class="datatable dataTable table table-hover display" style="width: 100%;" id="staten_island">
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
                <div class="tab-pane" id="tab-6">
                    <div class="table-responsive neighbourhood-table">
                        <table class="datatable dataTable table table-hover display" style="width: 100%;" id="other">
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
                let $content = 'Null';

                if(row.content !== null) {
                    $content = row.content.substr(0, 10) + (row.content.length > 10 ? ' ...' : '');
                }

                return $content;
            }, targets: 2,

        }, {
            render: (data, type, row) => {
                return `
                    <i class="fa fa-eye action-btn" id="viewNeighborhoodContent" ref_id="${row.id}" route="/admin/neighborhood/edit/${row.id}"></i>
                    <i class="fa fa-edit px-2 action-btn" id="updateNeighborhood" ref_id="${row.id}" route="/admin/neighborhood/edit/${row.id}"></i>
                    <i class="fa fa-trash action-btn" id="deleteNeighborhood" ref_id="${row.id}" route="/admin/neighborhood/delete/${row.id}"></i>`;
            }, targets: 3
        }];

        dataTables('#manhattan', '/admin/manhattan-neighborhoods', null, column);

        dataTables('#bronx', '/admin/bronx-neighborhoods', null, column);

        dataTables('#brooklyn', '/admin/brooklyn-neighborhoods', null, column);

        dataTables('#queens', '/admin/queens-neighborhoods', null, column);

        dataTables('#staten_island', '/admin/staten_island-neighborhoods', null, column);

        dataTables('#other', '/admin/other-neighborhoods', null, column);
    </script>
@endsection

