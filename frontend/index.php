<html>
	<head>
		<title>Synlighet API Center</title>
		<meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- SnackbarJS plugin -->
		<script src="https://cdn.rawgit.com/FezVrasta/snackbarjs/1.1.0/dist/snackbar.min.js"></script>
		<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>

		<style>
			body {
				background-color: #f5f5f5;
			}
		</style>

		<script>
			$(document).ready(function() { 
				$('body').bootstrapMaterialDesign(); 
				$('[data-toggle="tooltip"]').tooltip()
			});

			$.get( "logs.php", 
				{ api: "", token: "2064861518432154" } 
				).done(function( data ) {
			    	$("#logs").empty();
			    	$("#logs").append(data);
			  });

			$.get( "accounts.php", 
				{ api: "", token: "2064861518432154" } 
				).done(function( data ) {
			    	$("#accounts").empty();
			    	$("#accounts").append(data);
			  });

			$.get( "../backend/php/services.php", 
				{ api: "", token: "2064861518432154" } 
				).done(function( data ) {
			    	$("#services").empty();
			    	$("#services").append(data);
			  });

			function newCustomer() {
				$("#acc_numb").val("");
				$("#acc_name").val("");
				$('#exampleModalLabel').text("Legg til ny kunde");
				$('#delete_customer').hide();
				$("#deletionpsw").hide();

				$('#exampleModal').modal('toggle');
				$("#btnSubmitCustomer").text("Lagre kunde");

				$('#exampleModal').on('shown.bs.modal', function () {
					$("#acc_numb").prop("disabled", false);
					$('#acc_numb').trigger('focus');
				})
			}

			function debug_app() {
				$('#debugModal').modal('toggle');
			}

			function run_debug_api(api) {
				if ($("#dev_psw").val() == "Smuget1000") {
					$("#resultTextarea").hide();
					$("#imgLoaderModal").show();
					switch (api) {
						case 1:
							$.get( "../backend/php/debug.php", 
								{ apicall: "api_weather/native_weather", token: "2064861518432154" } 
								).done(function( data ) {
							    	$("#resultTextarea").empty();
							    	$("#resultTextarea").append("Weather API\n\n");
							    	$("#resultTextarea").append(data);

							    	$("#imgLoaderModal").hide();
							    	$("#resultTextarea").show();
							  });
								
						break;

						case 2:
							$.get( "../backend/php/debug.php", 
								{ apicall: "api_events/native_events", token: "2064861518432154" } 
								).done(function( data ) {
							    	$("#resultTextarea").empty();
							    	$("#resultTextarea").append("Events API\n\n");
							    	$("#resultTextarea").append(data);

							    	$("#imgLoaderModal").hide();
							    	$("#resultTextarea").show();
							  });
								
						break;

						case 3:
							$.get( "../backend/php/debug.php", 
								{ apicall: "api_seasons/native_seasons", token: "2064861518432154" } 
								).done(function( data ) {
							    	$("#resultTextarea").empty();
							    	$("#resultTextarea").append("Seasons API\n\n");
							    	$("#resultTextarea").append(data);

							    	$("#imgLoaderModal").hide();
							    	$("#resultTextarea").show();
							  });
								
						break;

						default:
							alert("Kritisk feil");
						break;
					}
					$.snackbar({content: "Kjører debug!"});
				} else {
					$.snackbar({content: "Passord er feil!"});
				}
			}

			function toggle_customer(cid, status) {
				$.post("events/acc_update.php", {
			      cid: cid,
			      status: status
			    },
			    function(data,status){
			      $.get( "accounts.php", 
					{ api: "", token: "2064861518432154" } 
					).done(function( data ) {
				    	$("#accounts").empty();
				    	$("#accounts").append(data);
				    	$.snackbar({content: "Kontostatus endret!"});
				  });
			    });
			}

			function send_customer_data() {
				var cid = $("#acc_numb").val();
				var name = $("#acc_name").val();
				var services = "Weather";
				var pri = $("#acc_pri").val();

				var res = "";

				if ($('#weather').is(':checked')) {
					res = res.concat("weather");
				} 

				if ($('#event').is(':checked')) {
					res = res.concat("event");
				} 

				if ($('#season').is(':checked')) {
					res = res.concat("season");
				}

				if (cid == "" || name == "" || services == "" || pri == "") {
					alert("Fyll inn all informasjonen!");
				} else {
					var change = "";

					if ($("#btnSubmitCustomer").text() == "Oppdater") {
						change = "update";
					} else {
						change = "new";
					}

					$.post("events/acc_new.php", {
				      cid: cid,
				      name: name,
				      services: res,
				      status: 0,
				      pri: pri,
				      change: change
				    },
				    function(data,status){
				      // $('#status-message').fadeIn();
				      // alert("Data: " + data + "\nStatus: " + status);
				      $('#exampleModal').modal('toggle');
				      $.get( "accounts.php", 
						{ api: "", token: "2064861518432154" } 
						).done(function( data ) {
					    	$("#accounts").empty();
					    	$("#accounts").append(data);
					    	$.snackbar({content: "Endring lagret!"});
					    	// $('#status-message').fadeOut();
					  });
				    });
				}
			}

			function edit_customer(act_id, act_name, act_services, act_pri) {

				$("#acc_numb").val("");
				$("#acc_name").val("");
				$('#exampleModalLabel').text('Endre kunde');
				$('#delete_customer').show();

				$("#acc_numb").val(act_id);
				$("#acc_name").val(act_name);
				$("#acc_pri").val(act_pri);
				$("#btnSubmitCustomer").text("Oppdater");

				$("#acc_name").focus();
				

				// Make switch statement
				if (act_services.includes("weather") == true) {
					$("#weather").prop("checked", true);
					// $('#weather').attr('Checked','Checked'); 
				} else {
					$("#weather").prop("checked", false);
				}

				if (act_services.includes("event") == true) {
					$("#event").prop("checked", true);
				} else {
					$("#event").prop("checked", false);
				}

				if (act_services.includes("season") == true) {
					$("#season").prop("checked", true);
				} else {
					$("#season").prop("checked", false);
				}

				$('#exampleModal').modal('toggle');

				$('#exampleModal').on('shown.bs.modal', function () {
					$('#acc_name').trigger('focus');
				})

				// $("#acc_numb").prop("disabled", true);
				// UA-126830484-1
			}

			function delete_customer(name) {

				if ($("#deletionpsw").is(":visible")) {
					console.log("shown");
					if ($("#deletionpsw").val() == $("#acc_name").val()) {
						console.log("the same");
					} else {
						console.log("not the same");
					}
				} else {
					$("#deletionpsw").fadeIn();
				}
<<<<<<< HEAD

				// count = 0;
				// if (count == 0) {
					
				// 	console.log("count: " + count);
				// } else {
				// 	$("#deletionpsw").fadeIn();
				// 	count+1;
				// 	console.log("count: " + count);
				// }



				// var count = 0;
				// var psw = $("#deletionpsw").val();
				// // $("#deletionpsw")

				// if(psw == name) {

				// } else {
				// 	alert("Wrong name, are you sure you want to continue?");
				// }
=======
>>>>>>> d050fcacf2240d7cd453e7c1bbe98685fd589609
			}

			function update_service(act_id, c) {
				switch (c) {
					case 1:
						$.get( "events/acc_service_update.php", 
							{ cid: act_id, services: c } 
							).done(function( data ) {
								setTimeout(function() {
								  $.get( "accounts.php", 
									{ api: "", token: "2064861518432154" } 
									).done(function( data ) {
								    	$("#accounts").empty();
								    	$("#accounts").append(data);
								    	$.snackbar({content: "Weather API på " + act_id + " endret!"});
								  });
								}, 500);
						  });
							
					break;

					case 2:
						$.get( "events/acc_service_update.php", 
							{ cid: act_id, services: c } 
							).done(function( data ) {
								setTimeout(function() {
								  $.get( "accounts.php", 
									{ api: "", token: "2064861518432154" } 
									).done(function( data ) {
								    	$("#accounts").empty();
								    	$("#accounts").append(data);
								    	$.snackbar({content: "Events API på " + act_id + " endret!"});
								  });
								}, 300);

						  });
					break;

					case 3:
						$.get( "events/acc_service_update.php", 
							{ cid: act_id, services: c } 
							).done(function( data ) {
								setTimeout(function() {
								  $.get( "accounts.php", 
									{ api: "", token: "2064861518432154" } 
									).done(function( data ) {
								    	$("#accounts").empty();
								    	$("#accounts").append(data);
								    	$.snackbar({content: "Seasons API på " + act_id + " endret!"});
								  });
								}, 500);
						  });
					break;

					default:
						alert(act_id + ": error. Choice: " + c);
					break;
				}

				$.get( "accounts.php", 
					{ api: "", token: "2064861518432154" } 
					).done(function( data ) {
				    	$("#accounts").empty();
				    	$("#accounts").append(data);
				  });
			}

			function navigate(c) {
				switch (c) {
					case 0:
						$("#nav-home").addClass("active");
						$("#nav-services").removeClass("active");
						$("#nav-accounts").removeClass("active");
						$("#nav-logs").removeClass("active");

						$("#card-logs").hide();
						$("#card-accounts").hide();
						$("#card-services").hide();
						$("#card-dashboard").show();
						
					break;

					case 1:
						// $("#dashboard").fadeIn();
						$("#card-logs").hide();
						$("#card-accounts").hide();
						$("#card-dashboard").hide();
						$("#card-services").show();

						$("#nav-services").addClass("active");
						$("#nav-home").removeClass("active");
						$("#nav-accounts").removeClass("active");
						$("#nav-logs").removeClass("active");
					break;

					case 2:
						$("#card-dashboard").hide();
						$("#card-logs").hide();
						$("#card-services").hide();
						$("#card-accounts").show();

						$("#nav-accounts").addClass("active");
						$("#nav-home").removeClass("active");
						$("#nav-services").removeClass("active");
						$("#nav-logs").removeClass("active");
					break;

					case 3:
						$("#card-dashboard").hide();
						$("#card-accounts").hide();
						$("#card-services").hide();
						$("#card-logs").show();
						

						$("#nav-logs").addClass("active");
						$("#nav-home").removeClass("active");
						$("#nav-accounts").removeClass("active");
						$("#nav-services").removeClass("active");
					break;

					default:

				}
			}
		</script>
	</head>

	<body>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Legg til ny kunde</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form>
				  <div class="form-group">
				    <label for="acc_numb" class="bmd-label-floating">Kontonummer</label>
				    <input type="text" class="form-control" id="acc_numb">
				    <span class="bmd-help">Legg inn kontonummer du finner i Business Manager</span>
				  </div>
				  <div class="form-group">
				    <label for="acc_name" class="bmd-label-floating">Navn på kunde</label>
				    <input type="text" class="form-control" id="acc_name">
				  </div>
				  <div class="form-group">
				    <label for="acc_pri" class="bmd-label-floating">Kunde prioritert</label>
				    <select class="form-control" id="acc_pri">
				      <option value="0">Høy</option>
				      <option value="1">Middel</option>
				      <option value="2">Lav</option>
				    </select>
				  </div>	
				  
				  <div class="switch">
				    <label>
				      <input type="checkbox" id="weather">
				      Weather API
				    </label>
				  </div>  

				  <div class="switch">
				    <label>
				      <input type="checkbox" id="event">
				      Events API
				    </label>
				  </div> 

				  <div class="switch">
				    <label>
				      <input type="checkbox" id="season">
				      Seasons API
				    </label>
				  </div> 
				</form>
				
				<div class="form-group">
					<button type="button" class="btn btn-danger" id="delete_customer" style="display: none; float: left; width: 100%;" onclick="delete_customer()">Slett konto</button>
				    <input type="text" class="form-control" id="deletionpsw" style="display: none;" placeholder="Navn på konto">
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: left;">Lukk</button>
		        <button type="submit" id="btnSubmitCustomer" class="btn btn-primary btn-raised" onclick="send_customer_data()">Lagre endringer</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Debug Modal -->
		<div class="modal fade" id="debugModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Application debug & test</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<table style="width: 100%;">
		      		<tr>
		      			<td><b>Service</b></td>
		      			<td><b>Last Runtime</b></td>
		      			<td></td>
		      		</tr>
		      		<tr>
		      			<td>Weather API</td>
		      			<td>18.07.2019 11:01:29</td>
		      			<td><button type="button" class="btn btn-warning" style="float: right;" onclick="run_debug_api(1)">Debug</button></td>
		      		</tr>
		      		<tr>
		      			<td>Events API</td>
		      			<td>18.07.2019 11:01:29</td>
		      			<td><button type="button" class="btn btn-warning" style="float: right;" onclick="run_debug_api(2)">Debug</button></td>
		      		</tr>
		      		<tr>
		      			<td>Seasons API</td>
		      			<td>18.07.2019 11:01:29</td>
		      			<td><button type="button" class="btn btn-warning" style="float: right;" onclick="run_debug_api(3)">Debug</button></td>
		      		</tr>
		      	</table>
		        <form>
				  <div class="form-group">
				    <label for="exampleTextarea" class="bmd-label-floating"></label>
				    <textarea class="form-control" id="resultTextarea" rows="10" style="resize: none; display: none;"></textarea>
				    <center><img id="imgLoaderModal" src="https://media0.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" style="display: none;" /></center>
				  </div>

				  <div class="form-group">
				    <label for="acc_name" class="bmd-label-floating">Dev password</label>
				    <input type="password" class="form-control" id="dev_psw">
				  </div>
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: left;">Lukk</button>
		      </div>
		    </div>
		  </div>
		</div>

		<ul class="nav nav-tabs bg-dark" style="width: 100%;">
		  <li class="nav-item">
		    <a class="nav-link disabled" href="#">Synlighet API Center</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link active" href="#">Facebook Ads</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="#">Google Ads</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="#">Bing Ads</a>
		  </li>
		  <li class="nav-item" style="float: right;">
		    
		  </li>
		</ul>

		<div class="g-signin2" data-onsuccess="onSignIn" style="float: right; margin-top: 2%; margin-right: 3%;"></div>

		<div class="" style="margin-top: 5%; margin-right: 3%; margin-left: 3%; padding-top: 3%; padding-right: 1%; padding-left: 1%; padding-bottom: 1%; background-color: white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height: 80%; overflow-y: auto;">

			<div class="alert alert-success" id="status-message" role="alert" style="display: none;">
				<center>Endring lagret!</center>
			</div>

		  <div class="row">
		    <div class="col-2" style="">
		    	<ul class="list-group" style="position: fixed; width: 14%;">
				  <a href="#dashboard" id="nav-home" onclick="navigate(0)" class="list-group-item active">Dashboard</a>
				  <!-- <a href="#services" id="nav-services" onclick="navigate(1)" class="list-group-item">Tjenester</a> -->
				  <a href="#accountsview" id="nav-accounts" onclick="navigate(2)" class="list-group-item">Kundekontoer</a>
				  <a href="#logsview" id="nav-logs" onclick="navigate(3)" class="list-group-item">Logger</a>
				</ul>
		    </div>

		    <div class="col-10" id="card-dashboard">
		    	<ul class="list-group" style="margin-bottom: 4%;">
					<li class="list-group-item active">DASHBOARD</li>
				</ul>

				<div class="card" style="width: 18rem; float: left; margin-right: 2%; height: 260px;">
				  <div class="card-body">
				    <h1 class="card-title" style="font-size: 70px;"><center>
				    	<?php
							include '../backend/php/includes/db_conf.php';

							$sql="SELECT * FROM accounts";

							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$rowcount = mysqli_num_rows($result);
							}

							if ($result=mysqli_query($conn,$sql))
							  {
							  // Return the number of rows in result set
							  $rowcount=mysqli_num_rows($result);
							  echo $rowcount;
							  // Free result set
							  mysqli_free_result($result);
							  }

							mysqli_close($con);
							?>
				    </center></h1>
				    <h5 class="card-title"><center>KUNDER</center></h5>
				    <p class="card-text">Kunder som er registrert med våre tileggstjenester til Facebook Ads</p>
				    <center><small><a href="#" class="card-link">SE KUNDER</a></small></center>
				  </div>
				</div>

				<div class="card col-5" style="float: left; height: 260px;">
				  <div class="card-header">
				    <h5 class="card-title">Tjenester</h5>
				  </div>
				  <div class="card-body">
				    
				    <ul class="list-group" style="float:left;">
				    	<small>
				    		<li class="list-group-item"><b>API</b></li>
							<li class="list-group-item">Weather API</li>
							<li class="list-group-item">Events API</li>
						</small>
					</ul>
					<ul class="list-group" style="float:left;">
				    	<small>
				    		<li class="list-group-item"><b>STATUS</b></li>
							<li class="list-group-item">
								<?php include 'statuscheck.php'; ?>..
							</li>
							<li class="list-group-item">Not running..</li>
						</small>
					</ul>
					<ul class="list-group" style="float:left;">
				    	<small>
				    		<li class="list-group-item"><b>Informasjon</b></li>
							<li class="list-group-item"><a href="#">Les mer</a></li>
							<li class="list-group-item"><a href="#">Les mer</a></li>
						</small>
					</ul>
				  </div>
				</div>

				<div class="card" style="width: 18rem; float: right; margin-right: 2%; height: 260px;">
				  <div class="card-body">
				  	<small class="card-title"><center>TIME</center></small>
				    <h1 class="card-title" style="font-size: 40px;"><center>
				    	11:01:29
				    </center></h1>
				    <br><br>
				    <small class="card-title"><center>DATE</center></small>
				    <h5 class="card-title"><center>10.07.2019</center></h5><br>

				    <center><small><a href="#" class="card-link">SE LOGG</a></small></center>
				  </div>
				</div>

		    </div>

		    <div class="col-10" id="card-accounts" style="display: none;">
		    	<ul class="list-group">
					<li class="list-group-item active" style="float: left;">KUNDEKONTOER</li>
				</ul>
				<table class="table table-hover">
					<thead>
					  	<tr>
					      <th scope="col"></th>
					      <th scope="col"></th> 
					      <th scope="col"></th>
					      <th scope="col"><center></center></th>
					      <th><button type="button" class="btn btn-info" style="float: right;" onclick="newCustomer()">Legg til kunde</button></th>
					    </tr>
					</thead>
				</table>
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">CID</th>
				      <th scope="col">Navn</th> 
				      <th scope="col">Weather API</th> 
				      <th scope="col">Events API</th>
				      <th scope="col">Seasons API</th>
				      <th scope="col"><center>Status</center></th>
				    </tr>
				  </thead>
				  <tbody id="accounts">
				    
				  </tbody>
				</table>
		    </div>

		    <div class="col-10" id="card-logs" style="display: none;">
		    	<ul class="list-group">
					<li class="list-group-item active">LOGGER</li>
				</ul>

				<div class="dropdown" style="float: right;">
					  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Konto
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

					  	<?php
							include '../backend/php/includes/db_conf.php';

							$sql = "SELECT * FROM accounts";
							$result = $conn->query($sql);
							// date_default_timezone_set("Europe/Oslo");
							if ($result->num_rows > 0) {
							    // output data of each row
							    $campaign_name = "";
							    while($row = $result->fetch_assoc()) {
							    	echo '<a class="dropdown-item" href="#">'.$row['name'].'</a>';
							    }
							}

							mysqli_close($con);
							?>

					    <a class="dropdown-item" href="#">Action</a>
					    <a class="dropdown-item" href="#">Another action</a>
					    <a class="dropdown-item" href="#">Something else here</a>
					  </div>
					</div>

					<div class="dropdown" style="float: right;">
					  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    API
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href="avascript:void(0)">Weather API</a>
					    <a class="dropdown-item" href="avascript:void(0)">Events API</a>
					    <a class="dropdown-item" href="javascript:void(0)">Seasons API</a>
					  </div>
					</div>

				<div class="bmd-form-group bmd-collapse-inline pull-xs-left">
				  <button class="btn bmd-btn-icon" for="search" data-toggle="collapse" data-target="#collapse-search" aria-expanded="false" aria-controls="collapse-search">
				    <i class="material-icons">search</i>
				  </button>  
				  <span id="collapse-search" class="collapse">
				    <input class="form-control" type="text" id="search" style="margin-left: 5px;" placeholder="Kunde/kampanje/api">
				  </span>
				  <button type="button" class="btn btn-warning" style="float: right;" onclick="debug_app()">Debug</button>



				</div>
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">AdCampaign</th>
				      <th scope="col">Sted</th> 
				      <th scope="col">Vær</th>
				      <th scope="col">AdSet Status</th>
				    </tr>
				  </thead>
				  <tbody id="logs">
				    
				  </tbody>
				</table>
		    </div>
		    <div class="col" style="display: none;">
		    	<ul class="list-group">
					<li class="list-group-item active">Detaljer</li>
					<li class="list-group-item">Dato/tid: 12.06.2019 20:20:19</li>
					<li class="list-group-item">Endring:</li>
					<li class="list-group-item">Resultat: </li>
				</ul>
		    </div>
		  </div>
		</div>
		<br>
		<center><small>&copy; Synlighet AS 2019</small></center>
	</body>
</html>