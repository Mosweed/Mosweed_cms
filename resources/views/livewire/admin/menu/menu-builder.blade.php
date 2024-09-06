<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

<style>
    .caret {
        display: inline;
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: 2px;
        vertical-align: middle;
        border-top: 4px dashed;
        border-right: 4px solid transparent;
        border-left: 4px solid transparent;
    }
</style>
<div
    class="min-h-screen antialiased font-normal fi-body fi-panel-admin bg-gray-50 text-gray-950 dark:bg-gray-950 dark:text-white pb-9 pt-6">
    <div class="p-6 fi-section-content  bg-white  dark:divide-white/10 dark:bg-gray-900  mx-6">
    <div class="bg-blue-700">
        <!-- Assuming 'primary' is blue in your theme -->

    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h5 class="pull-left text-gray-800 ">Menu</h5>

                    </div>
                    <div class="panel-body" id="cont">
                        <ul id="myEditor" class="sortableLists list-group">
                            <!-- Menu items will be dynamically added here -->
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <button id="btnupdate" type="" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>
                        Update</button>
                </div>
                <div class="form-group">
                    @csrf

                </div>

            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading text-gray-800">Edit item</div>
                    <div class="panel-body">
                        <form id="frmEdit" class="form-horizontal">
                            <div class="form-group">
                                <label for="text" class="col-sm-2 control-label text-gray-800">Text</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text"
                                            placeholder="Text">
                                        <div class="input-group-btn">
                                            <button type="button" id="myEditor_icon" class="btn btn-default text-dark"
                                                data-iconset="fontawesome"></button>
                                        </div>
                                        <input type="hidden" name="icon" class="item-menu">
                                    </div>
                                </div>
                            </div>


                            <!-- Dropdown menu to display all routes -->
                            <div class="form-group">
                                <label for="href" class="col-sm-2 control-label text-gray-800">URL</label>
                                <div class="col-sm-10">
                                    <select class="form-control item-menu" id="href" name="href">
                                        <option value="">Select a route</option>
                                        @foreach (\Illuminate\Support\Facades\Route::getRoutes() as $route)
                                        <option value="{{ $route->uri }}">{{ $route->uri }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="form-group">


                        <button id="btnUpdate" type="button" class="btn btn-primary" disabled><i
                                class="fa fa-refresh"></i> Update</button>
                        <button id="btnAdd" type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add Menu
                            Item</button>



                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>






    <script>
        jQuery(document).ready(function () {
        // Menu items
        var strjson = {!! str_replace('\\', '', $menus->data) !!};


        var iconPickerOptions = { searchText: 'Buscar...', labelHeader: '{0} de {1} Pags.' };

        // Sortable list options
        var sortableListOptions = { placeholderCss: { 'background-color': 'cyan' } };

        var editor = new MenuEditor('myEditor', { listOptions: sortableListOptions, iconPicker: iconPickerOptions, labelEdit: 'Edit' });
        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));

        // Reload button click event
        $('#btnReload').on('click', function () {
            editor.setData(strjson);
        });

        // Out button click event
        $('#btnOut').on('click', function () {
            var str = editor.getString();
            $("#out").val(str);
            $('#menu_builder').submit();
        });

        // Update button click event
        $("#btnUpdate").click(function () {
            editor.update();
        });

        // Add button click event
        $('#btnAdd').click(function () {

            var text = $('#text').val();
            var href = $('#href').val();
            if (text == '' || href == '') {
                alert('Text and URL are required');
                return;
            }

            editor.add();
        });

        // Out change event
        $('#out').change(function () {
            var str = editor.getString();
            $("#out").val(str);
        });

        // Update button click event for Livewire
        $('#btnupdate').click(function () {
            var str = editor.getString();
            Livewire.dispatch('MenuWerwerken', [str]);
        });

         $('#btnAddMenu').click(function () {
             Livewire.dispatch('createMenu');

         });


        console.log(strjson);
        editor.setData(strjson);
    });
    </script>
</div>
</div>
