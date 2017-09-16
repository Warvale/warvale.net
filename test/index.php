<?php
include 'header.php';
?>
		<!-- FIREFLIES -->

		<canvas id="pixie"></canvas>

		<div class="main-background-content">
			<div class="main-page-content">
				<div id="main-title">
					<p>Warvale</p>
				</div>
				<p id="info-paragraph">Play. Compete. Repeat.</p>
				<p id="main-background-ip-text">IP: warvale.net&nbsp;<button id="copyip" class="btn btn-info" onclick="copyToClipboard('#main-background-ip-text')">Copy</button></p>
			</div>
			<a href="#wv" class="btn btn-success">Learn More</a><br>
			<div class="bounce">
				<img id="arrowdown" src="http://www.freeiconspng.com/uploads/white-down-arrow-png-2.png"/>
			</div>
		</div>
	</div>

<!-- FIREFLIES Javascript -->
	<script>
	var WIDTH;
	var HEIGHT;
	var canvas;
	var con;
	var g;
	var pxs = new Array();
	var rint = 50;

	$(document).ready(function(){
		WIDTH = window.innerWidth;
		HEIGHT = window.innerHeight;
		canvas = document.getElementById('pixie');
		$(canvas).attr('width', WIDTH).attr('height',HEIGHT);
		con = canvas.getContext('2d');
		for(var i = 0; i < 50; i++) {
			pxs[i] = new Circle();
			pxs[i].reset();
		}
		setInterval(draw,rint);
		setInterval(draw,rint2);

	});

	function draw() {
		con.clearRect(0,0,WIDTH,HEIGHT);
		for(var i = 0; i < pxs.length; i++) {
			pxs[i].fade();
			pxs[i].move();
			pxs[i].draw();
		}
	}

	function Circle() {
		this.s = {ttl:8000, xmax:5, ymax:2, rmax:10, rt:1, xdef:960, ydef:540, xdrift:4, ydrift: 4, random:true, blink:true};

		this.reset = function() {
			this.x = (this.s.random ? WIDTH*Math.random() : this.s.xdef);
			this.y = (this.s.random ? HEIGHT*Math.random() : this.s.ydef);
			this.r = ((this.s.rmax-1)*Math.random()) + 1;
			this.dx = (Math.random()*this.s.xmax) * (Math.random() < .5 ? -1 : 1);
			this.dy = (Math.random()*this.s.ymax) * (Math.random() < .5 ? -1 : 1);
			this.hl = (this.s.ttl/rint)*(this.r/this.s.rmax);
			this.rt = Math.random()*this.hl;
			this.s.rt = Math.random()+1;
			this.stop = Math.random()*.2+.4;
			this.s.xdrift *= Math.random() * (Math.random() < .5 ? -1 : 1);
			this.s.ydrift *= Math.random() * (Math.random() < .5 ? -1 : 1);
		}

		this.fade = function() {
			this.rt += this.s.rt;
		}

		this.draw = function() {
			if(this.s.blink && (this.rt <= 0 || this.rt >= this.hl)) this.s.rt = this.s.rt*-1;
			else if(this.rt >= this.hl) this.reset();
			var newo = 1-(this.rt/this.hl);
			con.beginPath();
			con.arc(this.x,this.y,this.r,0,Math.PI*2,true);
			con.closePath();
			var cr = this.r*newo;
			g = con.createRadialGradient(this.x,this.y,0,this.x,this.y,(cr <= 0 ? 1 : cr));
			g.addColorStop(0.0, 'rgba(238,180,28,'+newo+')');
			g.addColorStop(this.stop, 'rgba(238,180,28,'+(newo*.2)+')');
			g.addColorStop(1.0, 'rgba(238,180,28,0)');
			con.fillStyle = g;
			con.fill();
		}

		this.move = function() {
			this.x += (this.rt/this.hl)*this.dx;
			this.y += (this.rt/this.hl)*this.dy;
			if(this.x > WIDTH || this.x < 0) this.dx *= -1;
			if(this.y > HEIGHT || this.y < 0) this.dy *= -1;
		}

		this.getX = function() { return this.x; }
		this.getY = function() { return this.y; }
	}
	</script>

	<div id="wv">
	</div>

<!-- VIDEO section -->
	<div class="gradientbk">
		<div class="container-fluid">
			<div class="row justify-content-center col-md-12 text-center">

				<div class="col-md-6">
					<span id="gif-icon-1" class="glyphicon glyphicon-tower"></span><p id="gif-title-1">Play Competitively</p>
					<p id="gif-desc-1">Warvale is all about competing against your opponents.<br>Battle it out against your enemies!</p>
					<img id="video1" src="https://media.giphy.com/media/t92YxAYom1PbO/giphy.gif"/>
				</div>

				<div class="col-md-6">
					<span id="gif-icon-2" class="glyphicon glyphicon-globe"></span><p id="gif-title-2">Join the Community</p>
					<p id="gif-desc-2">Play with people and friends from around the globe.<br>The Warvale community is fun and growing!</p>
					<img id="video2" src="https://media.giphy.com/media/3ZYoIj4c1NNjq/giphy.gif"/>
				</div>
			</div>

			<div class="row justify-content-center col-md-12 text-center">
				<div class="col-md-6">
					<span id="gif-icon-3" class="glyphicon glyphicon-heart"></span><p id="gif-title-3">Play with Friends</p>
					<p id="gif-desc-3">Have fun in our beach lobby!<br>Join forces with your friends to conquer the games to come.</p>
					<img id="video3" src="https://media.giphy.com/media/CfhkbV4p0MlUY/giphy.gif"/>
				</div>

				<div class="col-md-6">
					<span id="gif-icon-4" class="glyphicon glyphicon-user"></span><p id="gif-title-4">Team-Based Games</p>
					<p id="gif-desc-4">Games on Warvale are also and team-based.<br>Help your team be victorious!</p>
					<img id="video4" src="https://media.giphy.com/media/INSyUc0yh0vfi/giphy.gif"/>
				</div>
			</div>

			<div class="row justify-content-center col-md-12 text-center">
				<div class="col-md-12">
					<p id="heart-text">Made with <span id="heart" class="glyphicon glyphicon-heart"></span> by <a href="https://warvale.net">Warvale</a></p>
				</div>
			</div>

			<div class="row justify-content-center col-md-12 text-center">
				<div class="col-md-6">
					<a href="https://warvale.net/rules">Rules</a> —
					<a href="https://warvale.net/staff">Staff</a> —
					<a href="https://docs.google.com/document/d/16N1iwBLhCHvCwF5Ljy_keG3udgTudJFFANE10Uk9eng/edit?usp=sharing">Help Warvale</a>
				</div>

				<div class="col-md-6 text-center">
					<div class="footer_right">
						<p>&nbsp; &nbsp; &nbsp;&copy; 2017 <a href="https://warvale.net">Warvale</a></p>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>
