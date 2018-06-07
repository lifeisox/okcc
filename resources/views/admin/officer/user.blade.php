@extends('admin.layouts.master')

@section('styles')
{{-- Latest compiled and minified CSS for Bootstrap Table --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
@endsection

@section('content')
<div class='container p-4'>
    <div id="toolbar">
        <div class='form-inline'>
            <h2>@lang('admin.title.user')</h2>
        </div>
    </div>
    <table  id="table" 
            class="table table-striped table-bordered" 
            data-toolbar="#toolbar"
            data-side-pagination="client"
            data-search="true" 
            data-search-on-enter-key="true"
            data-pagination="true" 
            data-page-list="[5, 10, 25, ALL]" 
            data-row-style="rowStyle"
            data-show-columns="true"
            >
        <thead>
            <tr>
                <th data-field="id" data-align="center" data-searchable="false" data-visible="false">@lang('admin.table.id')</th>
                <th data-field="name" data-align="left" data-sortable="true">@lang('admin.table.userName')</th>
                <th data-field="email" data-align="left" data-sortable="true">@lang('admin.table.userEmail')</th>
                <th data-field="privilege" data-align="center" data-sortable="true" data-formatter="privilegeFormatter">@lang('admin.table.userStatus')</th>
                <th data-field="edit" data-align="center" data-width="3%" data-formatter="editFormatter" data-searchable="false" data-click-to-select="false" data-events="editEvents">@lang('admin.table.editButton')</th>
                <th data-field="delete" data-align="center" data-width="3%" data-formatter="deleteFormatter" data-searchable="false" data-click-to-select="false" data-events="deleteEvents">@lang('admin.table.delButton')</th>
            </tr>
        </thead>
    </table>

    @include('admin.officer.includes.user.edit')
    @include('admin.officer.includes.user.show')
    @include('admin.officer.includes.user.delete')

</div>
@endsection

@section('scripts')
{{-- Latest compiled and minified JavaScript, Locales for Bootstrap Table --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
{{-- jQuery UI is a curated set of user interface interactions, effects, widgets, and themes built on top of the jQuery JavaScript Library. Official Site: https://jqueryui.com/ CDN: https://code.jquery.com/ui/ --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="  crossorigin="anonymous"></script>

<script type="text/javascript">

    const $table = $('#table');
    const URL = '{!! route('admin.users.index') !!}';

    var source;
    var saveIndex; // Row index of the table
    var saveId; // Primary key of the table

    /* initialize bootstrap table */
    // row style
    function rowStyle(row, index) { return { css: { "padding": "5px 10px 3px 10px" } }; }

    // Privilege Formatter
    function privilegeFormatter(value, row, index) { return getPrivilegeById(value); }

    // compose the column for edit button 
    function editFormatter(value, row, index) {
        return [
            '<a href="javascript:void(0)"><span class="text-primary h6-font-size"><i class="fas fa-check-circle fa-lg" aria-hidden="true"></i></span></a>'
        ].join('');
    }

    // compose the column for delete button
    function deleteFormatter(value, row, index) {
        return [
            '<a href="javascript:void(0)"><span class="text-danger h6-font-size"><i class="fas fa-times-circle fa-lg" aria-hidden="true"></i></span></a>'
        ].join('');
    }

    // compute height of the table and return 
    function getHeight() { $(window).height() - $('h4').outerHeight(true); }

    // reload data from server and refresh table
    function reloadList() {
        axios({ method: 'GET', url: URL })
        .then(function (response) {
            source = response.data.data;
            $table.bootstrapTable( 'load', { data: source } );
        })
        .catch(function (error) {
            axiosErrorMessage(error);
        });
    } 

    $(document).ready(function($) {
        // Initialize bootstrap table
        $table.bootstrapTable({ height: getHeight() });
        // whenever being changed window's size, table's size should be also changed
        $(window).resize(function () {
            $table.bootstrapTable('resetView', { height: getHeight() });
        });

        $('#editPrivilegeCombo').append(buildPrivilegesCombo());

        // 테이블의 Column을 클릭하면 발생하는 이벤트를 핸들한다.
        $table.on('click-cell.bs.table', function (field, column, row, rec) {
            saveId = Number(rec.id);
            if (column === 'edit') {
                var form = $("#editForm");
                form.find("input[name='name']").val(rec.name);
                form.find("input[name='email']").val(rec.email);
                $('#editPrivilegeCombo').val(rec.privilege)
                $("#editModal").modal('show').draggable({ handle: ".modal-header" });
            } else if (column === 'delete') {
                // Open Bootstrap Model without Button Click
                $("#deleteModal").modal('show').draggable({ handle: ".modal-header" });
            } else {
                var dispId = $("#showModal");
                dispId.find("span[name='name']").text(rec.name);
                dispId.find("span[name='email']").text(rec.email);
                dispId.find("span[name='privilege']").text(getPrivilegeById(rec.privilege));
                // Open Bootstrap Model without Button Click
                $("#showModal").modal('show').draggable({ handle: ".modal-header" });
            }
        });

        // 테이블의 Row를 클릭하면 발생하는 이벤트를 핸들한다: Bootstrap Table에서 Index를 구하기 위한 유일한 방법(Maybe)
        $table.on('click-row.bs.table', function (e, row, $element) {
            saveIndex = $element.index();
        });

        // press save button to edit
        $(".editButton").click( function(e) {
            e.preventDefault();
            const $element = $("#editModal");
            var postData = {
                name: $element.find("input[name='name']").val(),
                email: $element.find("input[name='email']").val(),
                privilege: $('#editPrivilegeCombo').val(),
            };

            axios({ method: 'PUT', data: postData, url: URL + '/' + saveId })
            .then(function (response) {
                saveSuccessMessage();
                $table.bootstrapTable('updateRow', {index: saveIndex, row: postData});
                $('#editForm')[0].reset(); // Clear create form 
                $(".modal").modal('hide'); // hide model form
                reloadList();
            })
            .catch(function (error) {
                axiosErrorMessage(error);
            });
        });

        // delete record but I will just add 'DELETED' to email address 
        $(".deleteButton").click( function(e) {
            e.preventDefault();
            axios({ method: 'DELETE', url: URL + '/' + saveId })
            .then(function (response) {
                deleteSuccessMessage();
                $table.bootstrapTable('remove', {field: 'id', values: [saveId]});
                $(".modal").modal('hide'); // hide model form
                reloadList();
            })
            .catch(function (error) {
                axiosErrorMessage(error);
            });
        });

        reloadList();

    });
</script>
@endsection