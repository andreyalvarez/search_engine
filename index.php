<!DOCTYPE html>
<!--
    Date: 10-20-2020
    Author: Carlos Alvarez
    This file makes an API call to a php file, it returns a JSON then it displays the results of the matches.
-->

<html>
<head>
    <title>Search Engine PHP / JSON </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <style>         
        .hidden{display: none;}
    </style>
</head>
<body>

    <div id="search_area">
        <form>
	   <label>Keyword</label>
           <input type="text" id="search_field" name="search_field" value="">
           <input type="button" id="send" name="send" onclick="myFunction()"  value="Submit">
        </form>
    </div>

    <div id="results_area">
        <div class="table-responsive">
            <table id="result_table" class="hidden">
             <tbody></tbody>
	    </table>
            <div id="message"></div>
	</div>
    </div>

    <script>
    /*
    * This function is called when we click on the submit button, it calls a PHP file the same way we would call an API. 
    * */
    function myFunction() {

        var search_field = document.getElementById("search_field").value; 
        document.getElementById('result_table').innerHTML = ''; 
        document.getElementById("message").innerHTML = "";
        $.ajax({
            url:"api/search_engine.php",
            type: 'GET',
            data: {search_field: search_field} ,	    
            success:function(data)
            {
	         if (data != null)
	         {	    
	    
                     var len = data.length;
	             var header = "<tr><td>Name</td> <td>City</td> <td>State</td></tr>";
                     var txt ="";
 	             if (len > 0){
	                 for (var i=0; i < len; i++)
	                 {
		              if (data[i].name && data[i].city && data[i].state){ 
			           txt += "<tr><td>"+data[i].name+"</td><td>"+data[i].city+"</td><td>"+data[i].state+"</td></tr>";
		              }	
                         }  
                     }               	
	             if(txt != ""){
	                 txt = header + txt; 	
                         $("#result_table").append(txt).removeClass("hidden");
	             }
                 } else {
                      document.getElementById("message").innerHTML = "No Results";
	         }	
            }
         })
    }
    </script>
</body>
</html>
