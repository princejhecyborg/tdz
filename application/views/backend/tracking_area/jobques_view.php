<head>
	<style>
            .subheadingTable{
                font-size: 12px;
                border-collapse: collapse;
            }
            .subheadingTable>tbody>tr>td{
                padding-right: 10px;
            }
            .bandTable{
                width:100%;
                height: 500px;
                border:1px solid lightgray;
                font-size: 12px!important;
            }
            .slick-row, .alt_drop_div{
                font-size: 12px!important;
            }
            .slick-cell{
                font-size: 11px!important;
                cursor: pointer;
                text-align: center;
            }
            .slick-header-column{
                background: #000000!important;
                padding:5px 10px!important;
                color:#FFF!important;
                text-align: center!important;
                font-size: 12px!important;
            }
            .slick-row:hover {
                background: #44a7cc!important;
            }
            .slick-cell.selected, .slick-row.active{
                background: #ff8f47!important;
            }
            .slick-cell.description, .slick-cell.text{
                text-align: left;
            }
            .filterArea{
                border-collapse: collapse;
                font-size: 12px;
                margin-left: 10px\  ;
            }
            .filterArea>tbody>tr>td:first-child{
                font-weight: bold;
            }
            .filter, .exclude{
                padding: 5px 8px!important;
            }
            .subheadingBtn{
                cursor: pointer;
            }
            .rowSelected{
                text-align: right;
                font-size: 10px;
                font-weight: bold;
                color: #515151;
            }
            .slickTitle{
                font-family: "Arial", sans-serif!important;
                background: #000000;
                padding: 10px;
                z-index: 999;
                font-size: 12px;
                position: absolute;
                color: #ffffff;
                border-radius: 5px;
                width: 450px;
                word-break: break-all;
            }
            /*to fix bootstrap problem*/
            .rateGrid, .rateGrid div {
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
            }
        </style>
</head>
<div class="col-lg-12 row">
	<div class="col-sm-4 row">
		<div id="datagrid" class="bandTable"></div>
	</div>
	<div class="col-sm-8">
		<div class="bandTable"></div>
	</div>
</div>
<script language="JavaScript">
 var grid,
 gridSortCol = "bandwidth_code",
 gridSort = true;
  var columns = [
    {id: "bandwidth_code", name: "Code", field: "bandwidth_code"},
    {id: "bandwidth_sku", name: "SKU", field: "bandwidth_sku"},
    {id: "bandwidth_rate", name: "Rate", field: "bandwidth_rate"},
    {id: "bandwidth_discount", name: "Discount", field: "bandwidth_discount"},
  ];
  var options = {
    enableCellNavigation: true,
    enableColumnReorder: true,
    multiColumnSort: true,
    forceFitColumns: true,
    editable: true,
    enableAddRow: false,
    enableCellNavigation: true,
    asyncEditorLoading: false,
  };
  $(function (e) {
    var editGridContainer = $('#editGridContainer');
    var code = $('#code'),
    sku = $('#sku'),
    rate = $('.rate'),
    discount = $('.discount'),
    iden = $('#iden'),
    importContainer = ('#importContainer');
    var rateDataView = new Slick.Data.DataView({ inlineFilters: true });
    var data =  <?php echo $rateBand ? $rateBand : '[]'; ?>;
    // console.log(data);
    grid = new Slick.Grid("#rateGrid", data, columns, options);
    grid.setSortColumn(gridSortCol, gridSort);
    grid.setSelectionModel(new Slick.RowSelectionModel());  
    grid.onDblClick.subscribe(function(e, args) {
           // console.log('clicked: ');
           // console.log(args);
        var item = args.grid.getData()[args.row];
        editGridContainer.css('display', 'inline');
        iden.attr('value', item.bandwidth_id);
        code.attr('value', item.bandwidth_code);
        sku.attr('value', item.bandwidth_sku);
        rate.attr('value', item.bandwidth_rate);
        discount.attr('value', item.bandwidth_discount);
    });
  });
</script>