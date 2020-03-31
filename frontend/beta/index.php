<html>
	<head>
		<title>BETA - Facebook API Center</title>
		<!-- Compiled and minified CSS -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	    <!-- Compiled and minified JavaScript -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	    <script type="text/javascript">
	    	window.onload = function() {
			   	var ctx = document.getElementById('apicallchart').getContext('2d');
				var chart = new Chart(ctx, {
				    // The type of chart we want to create
				    type: 'line',

				    // The data for our dataset
				    data: {
				        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				        datasets: [{
				            label: '',
				            borderColor: 'rgb(255, 99, 132)',
				            data: [100, 10, 5, 2, 20, 30, 45]
				        }],
				    },

				    // Configuration options go here
				    options: {
				    	maintainAspectRatio: false
				    }
				});
			}
	    </script>
	    <script>
	    	function navigation(c) {
				switch (c) {
					case 0:
						$(".logs").hide();
						$(".kunder").hide();
						$(".dashboard").show();
						
					break;

					case 1:
						// $("#dashboard").fadeIn();
						$(".logs").hide();
						$(".dashboard").hide();
						$(".kunder").show();

						// $("#nav-services").addClass("active");
						// $("#nav-home").removeClass("active");
						// $("#nav-accounts").removeClass("active");
						// $("#nav-logs").removeClass("active");
					break;

					case 2:
						$(".kunder").hide();
						$(".dashboard").hide();
						$(".logs").show();
					break;

					default:

				}
			}

			function newCustomer() {
				$("#acc_numb").val("");
				$("#acc_name").val("");
				$('#exampleModalLabel').text("Legg til ny kunde");

				// $('#modal1').toggle();
				$('.modal').modal('open');
				$("#btnSubmitCustomer").text("Lagre kunde");

				$('#exampleModal').on('shown.bs.modal', function () {
					$("#acc_numb").prop("disabled", false);
					$('#acc_numb').trigger('focus');
				})
			}
			$(document).ready(function(){
			    $('.modal').modal();
			    $('select').formSelect();
			  });


			$.get("../accounts.php", 
				{ api: "", token: "2064861518432154" } 
				).done(function( data ) {
			    	$("#accounts").empty();
			    	$("#accounts").append(data);
			  });
	    </script>
		<style>
			body {
				margin: 0;
				padding: 0;
				/*padding-top: 2%;
				padding-left: 2%;
				padding-right: 2%;
				padding-bottom: 0px;
				background-color: #465250;*/
			}

			.col-left {
				width: 15%;
				height: 100%;
				background-color: #EFF4F8;
				float: left;
			}
			.col-right {
				width: 85%;
				height: 100%;
				background-color: #FFF;
				float: right;
			}

			.profile {
				width: 100%;
				height: 200px;
				padding-top: 10px;
				padding-left: 5px;
				padding-right: 5px;
				padding-bottom: 5px;
			}
			.profile-img {
				width: 130px;
				height: 130px;
				margin: 0 auto;
				background-color: blue;
				margin-bottom: 5px;
				border-radius: 50%;
			}
			.profile-name {
				width: 90%;
				height: 40px;
				line-height: 40px;
				margin: 0 auto;
				text-align: center;
				font-size: 14px;
			}

			.nav {
				width: 100%;
				height: 70px;
				background-color: red;
			}

			#modified-item {
				background-color: #EFF4F8;
			}

			#modified-item:hover {
				background-color: #fff;
			}
			#apicallchart {
				height: 300px;
			}
			.collection-item:active { 
				background-color: red;
			}
		</style>
	</head>
	<body>

		<!-- Modal Structure -->
		<div id="modal1" class="modal" style="z-index: 9;">
			<div class="modal-content" style="overflow: hidden;">
			  <h4 id="modal-header">Legg til kunde</h4>
			  <div class="row">
			    <form class="col s12">
			      <div class="row">
			        <div class="input-field col s12">
			          <input id="acc_numb" type="text" class="validate">
			          <label for="acc_numb">Kontonummer</label>
			        </div>
			        <div class="input-field col s12">
			          <input id="acc_name" type="text" class="validate">
			          <label for="acc_name">Kontonavn</label>
			        </div>

			        <div class="input-field col s12">
				        <select>
					      <option value="" disabled selected>Velg</option>
					      <option value="1">Høy</option>
					      <option value="2">Medium</option>
					      <option value="3">Lav</option>
					    </select>
					    <label>Prioritering</label>
					</div>
			      </div>
			      
			      	<!-- <script>
					    function toggle_switches(c) {
					    	switch (c) {
					    		case "weather":
					    			if ($('#switch_'+c).is(":checked")) {
							        	// alert("checked");
							        	// $("#switch_status_"+c).text("På");
							            // var returnVal = confirm("Are you sure?");
							            // $(this).attr("checked", returnVal);
							        } else {
							        	// alert("unchecked");
							        	// $("#switch_status_"+c).text("Av");
							        }
					    		break;

					    		default:
					    		break;
					    	}  
					    }
			      	</script> -->
			    <div class="switch">
				    <label>
				      <input type="checkbox" id="switch_weather" onclick="toggle_switches('weather');">
				      <span class="lever"></span>
				      <span id="switch_status_weather">Weather API</span>
				    </label>

				    <label>
				      <input type="checkbox" id="switch_event" onclick="toggle_switches('event');">
				      <span class="lever"></span>
				      <span id="switch_status_event">Event API</span>
				    </label>

				    <label>
				      <input type="checkbox" id="switch_season" onclick="toggle_switches('season');">
				      <span class="lever"></span>
				      <span id="switch_status_season">Season API</span>
				    </label>
				  </div>
				  <br>
				  <!-- <div class="switch">
				    <label>
				      
				      <input type="checkbox" id="switch_event" onclick="toggle_switches('event');">
				      <span class="lever"></span>
				      <span id="switch_status_event">Event API</span>
				    </label>
				  </div>
				  <br>
				  <div class="switch">
				    <label>
				      <input type="checkbox" id="switch_season" onclick="toggle_switches('season');">
				      <span class="lever"></span>
				      <span id="switch_status_season">Season API</span>
				    </label>
				  </div> -->
			  </form>
			</div>

			  <!-- <form>
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
				</form> -->
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-primary btn-flat" data-dismiss="modal" style="float: left;">Lukk</button>
		      <button type="submit" id="btnSubmitCustomer" class="btn btn-primary btn-raised" onclick="send_customer_data()">Lagre</button>
			</div>
		</div>

		<!-- Modal -->
		<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 999;">
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
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: left;">Lukk</button>
		        <button type="submit" id="btnSubmitCustomer" class="btn btn-primary btn-raised" onclick="send_customer_data()">Lagre endringer</button>
		      </div>
		    </div>
		  </div>
		</div> -->

		<div class="col-left">
			<div class="profile">
				<div class="profile-img">
					<img class="profile-img" src="https://cdn1.medicalnewstoday.com/content/images/articles/322/322868/golden-retriever-puppy.jpg" />
				</div>
				<div class="profile-name">
					OLA NORDMANN
				</div>
			</div>

			<div class="collection" style="border: 0; margin: 0; text-transform: uppercase; font-size: 14px;">
		        <a href="#!" onclick="navigation(0)" class="collection-item" id="modified-item active">Dashboard</a>
		        <a href="#!" onclick="navigation(1)" class="collection-item" id="modified-item">Kunder</a>
		        <a href="#!" onclick="navigation(2)" class="collection-item" id="modified-item">Logger</a>
		    </div>
		</div>
		<div class="col-right">
			<div class="nav"></div>
			<div class="dashboard">

				<div class="row" style="padding-top: 50px; padding-left: 20px; padding-right: 20px;">
				    <div class="col s12">
				      <div class="card white" style="height: 550px;">
				        <div class="card-content black-text">
				          <span class="card-title">DASHBOARD</span>
				          <canvas id="apicallchart" style="color: #fff;"></canvas>
				        </div>
				      </div>
				    </div>
				  </div>


				<div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
				    <div class="col s12" style="margin: 0 auto;">

				      <div class="card blue-grey darken-1 col s3" style="margin-right: 2%; text-align: center;">
				        <div class="card-content white-text">
				          <span class="card-title">Antall kunder</span>
				          <h3>2</h3>
				        </div>
				        <div class="card-action">
				          <center><a href="#">Vis kunder</a></center>
				        </div>
				      </div>

				      <div class="card blue-grey darken-1 col s3" style="margin-right: 2%; text-align: center;">
				        <div class="card-content white-text">
				          <span class="card-title">Tjenerstatus</span>
				          <p>I am a very simple card. I am good at containing small bits of information.
				          I am convenient because I require little markup to use effectively.</p>
				        </div>
				        <div class="card-action">
				          <center><a href="#">Se status</a></center>
				        </div>
				      </div>

				      <div class="card blue-grey darken-1 col s3" style="text-align: center;">
				        <div class="card-content white-text">
				          <span class="card-title">Siste runtime</span>
				          <p>I am a very simple card. I am good at containing small bits of information.
				          I am convenient because I require little markup to use effectively.</p>
				        </div>
				        <div class="card-action">
				          <center><a href="#">Se logg</a></center>
				        </div>
				    </div>

				    </div>
				</div>
			</div>

			<div class="kunder" style="display: none;">
				<div class="row" style="padding-top: 50px; padding-left: 20px; padding-right: 20px;">
				    <div class="col s12">
				      <div class="card white" style="">
				        <div class="card-content black-text">
				          <span class="card-title">KUNDER</span>

				          <table>
							<thead>
							  	<tr style="border: 0;">
							      <th scope="col"></th>
							      <th scope="col"></th> 
							      <th scope="col"></th>
							      <th scope="col"><center></center></th>
							      <th><button type="button" class="btn btn-info btn-flat" style="float: right;" onclick="newCustomer()">Legg til kunde</button></th>
							    </tr>
							</thead>
						</table>
						<table class="highlight">
						  <thead style="border: 0;">
						    <tr>
						      <th scope="col">CID</th>
						      <th scope="col">Navn</th> 
						      <th scope="col">Weather API</th> 
						      <th scope="col">Events API</th>
						      <th scope="col">Seasons API</th>
						      <th scope="col"><center>Status</center></th>
						      <th scope="col"></th>
						    </tr>
						  </thead>
						  <tbody id="accounts">
						    
						  </tbody>
						</table>


				          <!-- <table class="highlight">
					        <thead>
					          <tr>
					              <th>Name</th>
					              <th>Item Name</th>
					              <th>Item Price</th>
					          </tr>
					        </thead>

					        <tbody>
					          <tr>
					            <td>Alvin</td>
					            <td>Eclair</td>
					            <td>$0.87</td>
					          </tr>
					          <tr>
					            <td>Alan</td>
					            <td>Jellybean</td>
					            <td>$3.76</td>
					          </tr>
					          <tr>
					            <td>Jonathan</td>
					            <td>Lollipop</td>
					            <td>$7.00</td>
					          </tr>
					        </tbody>
					      </table> -->
				        </div>
				      </div>
				    </div>
				</div>
			</div>

			<div class="logs" style="display: none;">
				<div class="row" style="padding-top: 50px; padding-left: 20px; padding-right: 20px;">
				    <div class="col s12">
				      <div class="card white" style="height: 500px;">
				        <div class="card-content black-text">
				          <span class="card-title">Logger</span>
<<<<<<< HEAD
				          <div class="dropdown" style="float: right;">
=======
				          <!-- <div class="dropdown" style="float: right;">
>>>>>>> d050fcacf2240d7cd453e7c1bbe98685fd589609
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
<<<<<<< HEAD
							</div>
=======
							</div> -->
>>>>>>> d050fcacf2240d7cd453e7c1bbe98685fd589609

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
				      </div>
				    </div>
				</div>
			</div>




		</div>
	</body>
</html>