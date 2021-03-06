<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load the Visualization API and the controls package.
google.charts.load('current', {'packages':['corechart', 'controls', 'table']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawDashboard);

function drawDashboard() {

// Create our data table.
var query = new google.visualization.Query(
'https://docs.google.com/spreadsheets/d/1TWQ11MrXIGnVjoc76iV8uI9GEUZCR9a-R4nMQWil52k/gviz/tq?headers=1');

// Apply query language statement.
query.setQuery('SELECT A, B, C');

// Send the query with a callback function.
query.send(handleQueryResponse);

//If something goes wrong with the query, we want to know about it, otherwise go ahead and build
//Monkey'd from API docs
function handleQueryResponse(response) {
  if (response.isError()) {
    alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
    return;
  }
  var data = response.getDataTable();
  // Create a dashboard.
  var dashboard = new google.visualization.Dashboard(
  document.getElementById('poetry-dashboard'));

  // Search works for a given word or phrase
  var poetrySearch = new google.visualization.ControlWrapper({
    'controlType': 'StringFilter',
    'containerId': 'poetry-search',
    'options': {
      'filterColumnLabel': 'Poem',
      'matchType': 'any',
      'ui': {'label': 'Give me a poem about'},
    }
  });

  // Display search results list
  var poetryTable = new google.visualization.ChartWrapper({
    'chartType': 'Table',
    'containerId': 'poetry-table',
    'view': {'columns': [0, 2]},
    'options': {
      'allowHtml': 'true',
      'width': '100%',
      'height': '100%',
      'page': 'enable',
      'pageSize': '1',
      'alternatingRowStyle': 'false',

      'cssClassNames': {
        headerRow: 'f2',
        tableRow: 'f4',
        oddTableRow: 'f4'
      }
    }
  });

/* TODO: Y U NO WURK?

  //To make the pie chart maker happy we've got to mess with the data a bit, which means a chance to practice aggregation!

  var pieTable = google.visualization.data.group(
    data,
    [{'column': 1, 'type': 'string', label: 'Number of Lines'}],
    [{'column': 1, 'aggregation': google.visualization.data.count, 'type': 'number'}]
  );

  var poetryPie = new google.visualization.ChartWrapper({
    'chartType': 'PieChart',
    'containerId': 'poetry-pie',
    'options': {
      'width': '100%',
      'height': '100%',
    }
  });

*/

  // Establish dependencies, declaring that 'poetrySearch' drives 'poetryTable',
  // so that the table will only display entries that are let through
  // given the search query.
  dashboard.bind(poetrySearch, poetryTable);

  // Draw the dashboard.
  dashboard.draw(data);
  }
}
</script>
