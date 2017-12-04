<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>
			#video, #canvas, #buttons {
				margin: 5px auto;
				display: block;
				clear: both;
			}
			#buttons {
				text-align: center;
			}
		</style>
                <video id="video" width="640" height="480" autoplay></video>
		<div id="buttons">
			<button id="take">take it</button>
                        
			<a id="savePic" onclick="downloadCam()" href="#">save it local</a>
			<a id="savePicServer" onclick="downloadCamServer()" href="#">save on Server</a>
		</div>
		<canvas id="canvas" width="640" height="480"></canvas>
		
		<form method="post" accept-charset="utf-8" name="form1">
                    <input name="hidden_data" id='hidden_data' type="hidden"/>
                </form>
		

		<script>

			// Grab elements, create settings, etc.
			//var video = document.getElementById('video');
			var video = $('#video');

			// Get access to the camera!
			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
				// Not adding `{ audio: true }` since we only want video now
				navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
					video.get(0).src = window.URL.createObjectURL(stream);
					video.get(0).play();
				});
			}
			
			// Elements for taking the snapshot
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');
			//var video = document.getElementById('video');

			// Trigger photo take
			$("#take").click(function(){
				context.drawImage(video.get(0), 0, 0, 640, 480);
				
				//console.log(context.getImageData(50, 50, 640, 480));
			});

			function downloadCam() {
				var dt = canvas.toDataURL('image/jpeg');
				//alert(dt);
                
				document.getElementById("savePic").href = dt;
				document.getElementById("savePic").download = 'hesam.jpg';
			};
			
			function downloadCamServer(){

                            var dataURL = canvas.toDataURL("image/jpeg");
                            document.getElementById('hidden_data').value = dataURL;
                            var fd = new FormData(document.forms["form1"]);

                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', 'savePic.php', true);

                            xhr.upload.onprogress = function(e) {
                                if (e.lengthComputable) {
                                    var percentComplete = (e.loaded / e.total) * 100;
                                    //console.log(percentComplete + '% uploaded');
                                    alert('Succesfully uploaded');
                                }
                            };

                            xhr.onload = function() {
                                
                            };
                            xhr.send(fd);
                            
//                            var dataURL = canvas.toDataURL();
//				
//				$.ajax({
//					type: "POST",
//					url: "savePic.php",
//					data: { 
//						imgBase64: dataURL
//					}
//				}).done(function(o) {
//					console.log('saved'); 
//				});
                        }
			
		</script>