<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 5.8 - Individual Column Search in Datatables using Ajax</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 </head>
 <body>
<div class="container">    
     <br />
     <h3 align="center">Furniture Data Tables</h3>
     <br />
            <br />
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="filter_state" id="filter_state" class="form-control" required>
                            <option value="">Select State</option>
                            @foreach($state_name as $state)

                            <option value="{{ $state->state }}">{{ $state->state }}</option>

                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <select name="filter_year" id="filter_year" class="form-control" required>
                            <option value="">Select Year</option>
                            @foreach($year_name as $year)

                            <option value="{{ $year->year }}">{{ $year->year }}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="filter_quality" id="filter_quality" class="form-control" required>
                            <option value="">Select Quality Type</option>
                            @foreach($quality_name as $quality)

                            <option value="{{ $quality->quality }}">{{ $quality->quality }}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="filter_typeintervention" id="filter_typeintervention" class="form-control" required>
                            <option value="">Select Intervention Type</option>
                            @foreach($interventiontype_name as $typeintervention)

                            <option value="{{ $typeintervention->typeintervention }}">{{ $typeintervention->typeintervention }}</option>

                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group" align="center">
                        <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

                        <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br />
   <div class="table-responsive">
    <table id="customer_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>State</th>
                            <th>Type of Intervention</th>
                            <th>Year</th>
                            <th>Quality</th>
                            <th>Total Cost</th>
                            <th>Actual Cost</th>
                        </tr>
                    </thead>
                </table>
   </div>
            <br />
            <br />
  </div>
  </body>
</html>

<script>
$(document).ready(function(){

    fill_datatable();

    function fill_datatable(filter_state = '', filter_year = '', filter_quality = '', filter_typeintervention = '')
    {
        var dataTable = $('#customer_data').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('customsearch.index') }}",
                data:{filter_state:filter_state, filter_year:filter_year, filter_quality:filter_quality, filter_typeintervention:filter_typeintervention}
            },
            columns: [
                {
                    data:'title',
                    name:'title'
                },
                {
                    data:'state',
                    name:'state'
                },
                {
                    data:'typeintervention',
                    name:'typeintervention'
                },
                {
                    data:'year',
                    name:'year'
                },
                {
                    data:'quality',
                    name:'quality'
                },
                {
                    data:'totalcost',
                    name:'totalcost'
                },
                {
                    data:'actualcost',
                    name:'actualcost'
                }
            ]
        });
    }

    $('#filter').click(function(){
        var filter_state = $('#filter_state').val();
        var filter_year = $('#filter_year').val();
        var filter_quality = $('#filter_quality').val();
        var filter_typeintervention = $('#filter_typeintervention').val();


        if(filter_state != '' &&  filter_state != '')
        {
            $('#customer_data').DataTable().destroy();
            fill_datatable(filter_state, filter_year, filter_quality, filter_typeintervention);
        }
        else
        {
            alert('Select All filter option');
        }
    });

    $('#reset').click(function(){
        $('#filter_state').val('');
        $('#filter_year').val('');
        $('#filter_quality').val('');
        $('#filter_typeintervention').val('');
        $('#customer_data').DataTable().destroy();
        fill_datatable();
    });

});
</script>