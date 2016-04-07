<div class="page-title">
    <div class="title_left">
        <h3>
	        Pelanggan
	    </h3>
    </div>

</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                        <button class="btn btn-success" onclick="pelanggan_add()">Tambah Pelanggan</button>
                        </li>
                    </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="asuransi_datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr class="headings">
                            <th>No</th>
                            <th>Nama </th>
                            <th>Alamat </th>
                            <th>IBU Kandung</th>
                            <th>JK </th>
                            <th>No Passport </th>
                            <th>Status </th>
                            <th class=" no-link last"><span class="nobr">Action</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function pelanggan_add() {
		 window.location.href = '<?php echo site_url('pelanggan/add') ?>';
	}

	function edit(id) {
		 window.location.href = '<?php echo site_url() ?>/pelanggan/edit/'+id;
	}

	function lihat(id) {
		 window.location.href = '<?php echo site_url() ?>/pelanggan/lihat/'+id;
	}

	function hapus(id) {
		$.post('<?php echo site_url() ?>/pelanggan/delete/'+id, {a:a}, function(data, textStatus, xhr) {
			location.reload();
		});
	}
</script>

    <script>
    var datatable = new Datatable();
    datatable.init({
        src: $("#asuransi_datatable"),
        onSuccess: function (grid, response) {
            // grid:        grid object
            // response:    json object of server side ajax response
            // execute some code after table records loaded
        },
        onError: function (grid) {
            // execute some code on network or other general error  
        },
        onDataLoad: function(grid) {
            // execute some code on ajax data load
        },
        loadingMessage: 'Loading...',
        dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
            
            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            //  fixedHeader: {
            //     header: true,
            //     headerOffset: fixedHeaderOffset
            // },
            "sDom": "flitpli",//Rfprltpi
            "lengthMenu": [
                [10, 20, 50, 100, 150, -1],
                [10, 20, 50, 100, 150, "All"] // change per page values here
            ],
            
            "pageLength": 10, // default record count per page
            "ajax": {
                "url": "<?php echo site_url('pelanggan/get') ?>", // ajax source
            },
            "columns": [
                {"orderable": false},
                {"orderable": true},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
                {"orderable": false},
            ],
            "order": [
                [1, "asc"]
            ]// set first column as a default sort by asc
        }
    });
    </script>

