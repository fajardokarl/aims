<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="">
	<style>
		.header {
			display: grid;
			grid-template-columns: repeat(12,1fr);
			grid-auto-rows: minmax(50px, auto);
		}
		.rubix {
			display: grid;
			grid-template-columns: repeat(12,1fr);
			grid-auto-rows: minmax(50px, auto);
		}	
	/*side up*/
		#r1d4 {
			border: 1px solid black;
			grid-column: 4;
			grid-row: 1;
			background-color: #FF0000;
		}
		#r1d5 {
			border: 1px solid black;
			grid-column: 5;
			grid-row: 1;
			background-color: #Ff0000;
		}
		#r1d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 1;
			background-color: #FF0000;
		}
		#r2d4 {
			border: 1px solid black;
			grid-column: 4;
			grid-row: 2;
			background-color: #FF0000;
		}
		#r2d5 {
			border: 1px solid black;
			grid-column: 5;
			grid-row: 2;
			background-color: #Ff0000;
		}
		#r2d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 2;
			background-color: #FF0000;
		}
		#r3d4 {
			border: 1px solid black;
			grid-column: 4;
			grid-row: 3;
			background-color: #FF0000;
		}
		#r3d5 {
			border: 1px solid black;
			grid-column: 5;
			grid-row: 3;
			background-color: #Ff0000;
		}
		#r3d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 3;
			background-color: #FF0000;
		}

	/*side left */
		#r4d1{
			border: 1px solid black;
			grid-column: 1;
			grid-row: 4;
			background-color: #0000FF;
		}
		#r4d2{
			border: 1px solid black;
			grid-column: 2;
			grid-row: 4;
			background-color: #0000FF;
		}
		#r4d3{
			border: 1px solid black;
			grid-column: 3;
			grid-row: 4;
			background-color: #0000FF;
		}		
		#r5d1{
			border: 1px solid black;
			grid-column: 1;
			grid-row: 5;
			background-color: #0000FF;
		}
		#r5d2{
			border: 1px solid black;
			grid-column: 2;
			grid-row: 5;
			background-color: #0000FF;
		}
		#r5d3{
			border: 1px solid black;
			grid-column: 3;
			grid-row: 5;
			background-color: #0000FF;
		}	
		#r6d1{
			border: 1px solid black;
			grid-column: 1;
			grid-row: 6;
			background-color: #0000FF;
		}
		#r6d2{
			border: 1px solid black;
			grid-column: 2;
			grid-row: 6;
			background-color: #0000FF;
		}
		#r6d3{
			border: 1px solid black;
			grid-column: 3;
			grid-row: 6;
			background-color: #0000FF;
		}	

		/*side front*/
		#r4d4{
			border: 1px solid black;
			grid-column: 4;
			grid-row: 4;
			background-color: #FFFFFF;
		}
		#r4d5{
			border: 1px solid black;
			grid-column: 5;
			grid-row: 4;
			background-color: #FFFFFF;
		}
		#r4d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 4;
			background-color: #FFFFFF;
		}		
		#r5d4{
			border: 1px solid black;
			grid-column: 4;
			grid-row: 5;
			background-color: #FFFFFF;
		}
		#r5d5{
			border: 1px solid black;
			grid-column: 5;
			grid-row: 5;
			background-color: #FFFFFF;
		}
		#r5d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 5;
			background-color: #FFFFFF;
		}	
		#r6d4{
			border: 1px solid black;
			grid-column: 4;
			grid-row: 6;
			background-color: #FFFFFF;
		}
		#r6d5{
			border: 1px solid black;
			grid-column: 5;
			grid-row: 6;
			background-color: #FFFFFF;
		}
		#r6d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 6;
			background-color: #FFFFFF;
		}	

		/*side right*/
		#r4d7{
			border: 1px solid black;
			grid-column: 7;
			grid-row: 4;
			background-color: green;
		}
		#r4d8{
			border: 1px solid black;
			grid-column: 8;
			grid-row: 4;
			background-color: green;
		}
		#r4d9{
			border: 1px solid black;
			grid-column: 9;
			grid-row: 4;
			background-color: green;
		}		
		#r5d7{
			border: 1px solid black;
			grid-column: 7;
			grid-row: 5;
			background-color: green;
		}
		#r5d8{
			border: 1px solid black;
			grid-column: 8;
			grid-row: 5;
			background-color: green;
		}
		#r5d9{
			border: 1px solid black;
			grid-column: 9;
			grid-row: 5;
			background-color: green;
		}	
		#r6d7{
			border: 1px solid black;
			grid-column: 7;
			grid-row: 6;
			background-color: green;
		}
		#r6d8{
			border: 1px solid black;
			grid-column: 8;
			grid-row: 6;
			background-color: green;
		}
		#r6d9{
			border: 1px solid black;
			grid-column: 9;
			grid-row: 6;
			background-color: green;
		}	

		/*side back*/
		#r4d10{
			border: 1px solid black;
			grid-column: 9;
			grid-row: 8;
			background-color: #FFFF00;
		}
		#r4d11{
			border: 1px solid black;
			grid-column: 10;
			grid-row: 8;
			background-color: #FFFF00;
		}
		#r4d12{
			border: 1px solid black;
			grid-column: 11;
			grid-row: 8;
			background-color: #FFFF00;
		}		
		#r5d10{
			border: 1px solid black;
			grid-column: 9;
			grid-row: 9;
			background-color: #FFFF00;
		}
		#r5d11{
			border: 1px solid black;
			grid-column: 10;
			grid-row: 9;
			background-color: #FFFF00;
		}
		#r5d12{
			border: 1px solid black;
			grid-column: 11;
			grid-row: 9;
			background-color: #FFFF00;
		}	
		#r6d10{
			border: 1px solid black;
			grid-column: 9;
			grid-row: 10;
			background-color: #FFFF00;
		}
		#r6d11{
			border: 1px solid black;
			grid-column: 10;
			grid-row: 10;
			background-color: #FFFF00;
		}
		#r6d12{
			border: 1px solid black;
			grid-column: 11;
			grid-row: 10;
			background-color: #FFFF00;
		}	

	/*side down*/
		#r7d4 {
			border: 1px solid black;
			grid-column: 4;
			grid-row: 7;
			background-color: #FFA500;
		}
		#r7d5 {
			border: 1px solid black;
			grid-column: 5;
			grid-row: 7;
			background-color: #FFA500;
		}
		#r7d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 7;
			background-color: #FFA500;
		}
		#r8d4 {
			border: 1px solid black;
			grid-column: 4;
			grid-row: 8;
			background-color: #FFA500;
		}
		#r8d5 {
			border: 1px solid black;
			grid-column: 5;
			grid-row: 8;
			background-color: #FFA500;
		}
		#r8d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 8;
			background-color: #FFA500;
		}
		#r9d4 {
			border: 1px solid black;
			grid-column: 4;
			grid-row: 9;
			background-color: #FFA500;
		}
		#r9d5 {
			border: 1px solid black;
			grid-column: 5;
			grid-row: 9;
			background-color: #FFA500;
		}
		#r9d6{
			border: 1px solid black;
			grid-column: 6;
			grid-row: 9;
			background-color: #FFA500;
		}

	</style>
	<script type="text/javascript">
		window.onload = function (){
 			eventHandler = function (e){
    		if (e.keyCode == 40)
   			{
      		downView();
    		}
    		if (e.keyCode == 39)
   			{
      		rightView();
    		}
    		if (e.keyCode == 38)
   			{
      		upView();
    		}
    		if (e.keyCode == 37)
   			{
      		leftView();
    		}
  		}
 		 window.addEventListener('keydown', eventHandler, false);
		}

		var sideup = ['red','red','red','red','red','red','red','red','red'];
		var sideleft = ['blue','blue','blue','blue','blue','blue','blue','blue','blue'];
		var sidefront = ['white','white','white','white','white','white','white','white','white'];
		var sideright = ['green','green','green','green','green','green','green','green','green'];
		var sideback = ['yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow'];
		var sidedown = ['orange','orange','orange','orange','orange','orange','orange','orange','orange']; 

		function drawRubix(){
			document.getElementById("r1d4").style.backgroundColor = sideup[0];
			document.getElementById("r1d5").style.backgroundColor = sideup[1];
			document.getElementById("r1d6").style.backgroundColor = sideup[2];
			document.getElementById("r2d4").style.backgroundColor = sideup[3];
			document.getElementById("r2d5").style.backgroundColor = sideup[4];
			document.getElementById("r2d6").style.backgroundColor = sideup[5];
			document.getElementById("r3d4").style.backgroundColor = sideup[6];
			document.getElementById("r3d5").style.backgroundColor = sideup[7];
			document.getElementById("r3d6").style.backgroundColor = sideup[8];

			document.getElementById("r4d1").style.backgroundColor = sideleft[0];
			document.getElementById("r4d2").style.backgroundColor = sideleft[1];
			document.getElementById("r4d3").style.backgroundColor = sideleft[2];
			document.getElementById("r5d1").style.backgroundColor = sideleft[3];
			document.getElementById("r5d2").style.backgroundColor = sideleft[4];
			document.getElementById("r5d3").style.backgroundColor = sideleft[5];
			document.getElementById("r6d1").style.backgroundColor = sideleft[6];
			document.getElementById("r6d2").style.backgroundColor = sideleft[7];
			document.getElementById("r6d3").style.backgroundColor = sideleft[8];
			
			document.getElementById("r4d4").style.backgroundColor = sidefront[0];
			document.getElementById("r4d5").style.backgroundColor = sidefront[1];
			document.getElementById("r4d6").style.backgroundColor = sidefront[2];
			document.getElementById("r5d4").style.backgroundColor = sidefront[3];
			document.getElementById("r5d5").style.backgroundColor = sidefront[4];
			document.getElementById("r5d6").style.backgroundColor = sidefront[5];
			document.getElementById("r6d4").style.backgroundColor = sidefront[6];
			document.getElementById("r6d5").style.backgroundColor = sidefront[7];
			document.getElementById("r6d6").style.backgroundColor = sidefront[8];

			document.getElementById("r4d7").style.backgroundColor = sideright[0];
			document.getElementById("r4d8").style.backgroundColor = sideright[1];
			document.getElementById("r4d9").style.backgroundColor = sideright[2];
			document.getElementById("r5d7").style.backgroundColor = sideright[3];
			document.getElementById("r5d8").style.backgroundColor = sideright[4];
			document.getElementById("r5d9").style.backgroundColor = sideright[5];
			document.getElementById("r6d7").style.backgroundColor = sideright[6];
			document.getElementById("r6d8").style.backgroundColor = sideright[7];
			document.getElementById("r6d9").style.backgroundColor = sideright[8];

			document.getElementById("r7d4").style.backgroundColor = sidedown[0];
			document.getElementById("r7d5").style.backgroundColor = sidedown[1];
			document.getElementById("r7d6").style.backgroundColor = sidedown[2];
			document.getElementById("r8d4").style.backgroundColor = sidedown[3];
			document.getElementById("r8d5").style.backgroundColor = sidedown[4];
			document.getElementById("r8d6").style.backgroundColor = sidedown[5];
			document.getElementById("r9d4").style.backgroundColor = sidedown[6];
			document.getElementById("r9d5").style.backgroundColor = sidedown[7];
			document.getElementById("r9d6").style.backgroundColor = sidedown[8];

			document.getElementById("r4d10").style.backgroundColor = sideback[0];
			document.getElementById("r4d11").style.backgroundColor = sideback[1];
			document.getElementById("r4d12").style.backgroundColor = sideback[2];
			document.getElementById("r5d10").style.backgroundColor = sideback[3];
			document.getElementById("r5d11").style.backgroundColor = sideback[4];
			document.getElementById("r5d12").style.backgroundColor = sideback[5];
			document.getElementById("r6d10").style.backgroundColor = sideback[6];
			document.getElementById("r6d11").style.backgroundColor = sideback[7];
			document.getElementById("r6d12").style.backgroundColor = sideback[8];
		}

		function leftRotateInv(){
			temp = sideup[0];
			sideup[0] = sidefront[0];
			sidefront[0] = sidedown[0];
			sidedown[0] = sideback[8];
			sideback[8] = temp;

			temp = sideup[3];
			sideup[3] = sidefront[3];
			sidefront[3] = sidedown[3];
			sidedown[3] = sideback[5];
			sideback[5] = temp;

			temp = sideup[6];
			sideup[6] = sidefront[6];
			sidefront[6] = sidedown[6];
			sidedown[6] = sideback[2];
			sideback[2] = temp;

			temp = sideleft[2];
			sideleft[2] = sideleft[8];
			sideleft[8] = sideleft[6];
			sideleft[6] = sideleft[0];
			sideleft[0] = temp;

			temp = sideleft[5];
			sideleft[5] = sideleft[7];
			sideleft[7] = sideleft[3];
			sideleft[3] = sideleft[1];
			sideleft[1] = temp;
			drawRubix();
		}

		function leftRotate(){
			temp = sideup[0];
			sideup[0] = sideback[8];
			sideback[8] = sidedown[0];
			sidedown[0] = sidefront[0];
			sidefront[0] = temp;

			temp = sideup[3];
			sideup[3] = sideback[5];
			sideback[5] = sidedown[3];
			sidedown[3] = sidefront[3];
			sidefront[3] = temp;

			temp = sideup[6];
			sideup[6] = sideback[2];
			sideback[2] = sidedown[6];
			sidedown[6] = sidefront[6];
			sidefront[6] = temp;

			temp = sideleft[2];
			sideleft[2] = sideleft[0];
			sideleft[0] = sideleft[6];
			sideleft[6] = sideleft[8];
			sideleft[8] = temp;
			

			temp = sideleft[5];
			sideleft[5] = sideleft[1];
			sideleft[1] = sideleft[3];
			sideleft[3] = sideleft[7];
			sideleft[7] = temp;
			drawRubix();
		}

		function rightRotate(){
			temp = sideup[2];
			sideup[2] = sidefront[2];
			sidefront[2] = sidedown[2];
			sidedown[2] = sideback[6];
			sideback[6] = temp;

			temp = sideup[5];
			sideup[5] = sidefront[5];
			sidefront[5] = sidedown[5];
			sidedown[5] = sideback[3];
			sideback[3] = temp;

			temp = sideup[8];
			sideup[8] = sidefront[8];
			sidefront[8] = sidedown[8];
			sidedown[8] = sideback[0];
			sideback[0] = temp;

			temp = sideright[0];
			sideright[0] = sideright[6];
			sideright[6] = sideright[8];
			sideright[8] = sideright[2];
			sideright[2] = temp;

			temp = sideright[3];
			sideright[3] = sideright[7];
			sideright[7] = sideright[5];
			sideright[5] = sideright[1];
			sideright[1] = temp;

			drawRubix();
		}

		function rightRotateInv(){
			temp = sideup[2];
			sideup[2] = sideback[6];
			sideback[6] = sidedown[2];
			sidedown[2] = sidefront[2];
			sidefront[2] = temp;

			temp = sideup[5];
			sideup[5] = sideback[3];
			sideback[3] = sidedown[5];
			sidedown[5] = sidefront[5];
			sidefront[5] = temp;

			temp = sideup[8];
			sideup[8] = sideback[0];
			sideback[0] = sidedown[8];
			sidedown[8] = sidefront[8];
			sidefront[8] = temp;

			temp = sideright[0];
			sideright[0] = sideright[2];
			sideright[2] = sideright[8];
			sideright[8] = sideright[6];
			sideright[6] = temp;

			temp = sideright[1];
			sideright[1] = sideright[5];
			sideright[5] = sideright[7];
			sideright[7] = sideright[3];
			sideright[3] = temp;
			drawRubix();
		}

		function upRotate(){
			temp = sidefront[0];
			sidefront[0] = sideright[0];
			sideright[0] = sideback[0];
			sideback[0] = sideleft[0];
			sideleft[0] = temp;

			temp = sidefront[1];
			sidefront[1] = sideright[1];
			sideright[1] = sideback[1];
			sideback[1] = sideleft[1];
			sideleft[1] = temp;

			temp = sidefront[2];
			sidefront[2] = sideright[2];
			sideright[2] = sideback[2];
			sideback[2] = sideleft[2];
			sideleft[2] = temp;

			temp = sideup[6];
			sideup[6] = sideup[8];
			sideup[8] = sideup[2];
			sideup[2] = sideup[0];
			sideup[0] = temp;

			temp = sideup[7];
			sideup[7] = sideup[5];
			sideup[5] = sideup[1];
			sideup[1] = sideup[3];
			sideup[3] = temp;

			drawRubix();
		}

		function upRotateInv(){
			temp = sidefront[0];
			sidefront[0] = sideleft[0];
			sideleft[0] = sideback[0];
			sideback[0] = sideright[0];
			sideright[0] = temp;

			temp = sidefront[1];
			sidefront[1] = sideleft[1];
			sideleft[1] = sideback[1];
			sideback[1] = sideright[1];
			sideright[1] = temp;

			temp = sidefront[2];
			sidefront[2] = sideleft[2];
			sideleft[2] = sideback[2];
			sideback[2] = sideright[2];
			sideright[2] = temp;

			temp = sideup[6];
			sideup[6] = sideup[0];
			sideup[0] = sideup[2];
			sideup[2] = sideup[8];
			sideup[8] = temp;

			temp = sideup[7];
			sideup[7] = sideup[3];
			sideup[3] = sideup[1];
			sideup[1] = sideup[5];
			sideup[5] = temp;
			drawRubix();
		}

		function downRotate(){
			temp = sidefront[8];
			sidefront[8] = sideleft[8];
			sideleft[8] = sideback[8];
			sideback[8] = sideright[8];
			sideright[8] = temp;

			temp = sidefront[7];
			sidefront[7] = sideleft[7];
			sideleft[7] = sideback[7];
			sideback[7] = sideright[7];
			sideright[7] = temp;

			temp = sidefront[6];
			sidefront[6] = sideleft[6];
			sideleft[6] = sideback[6];
			sideback[6] = sideright[6];
			sideright[6] = temp;

			temp = sidedown[2];
			sidedown[2] = sidedown[0];
			sidedown[0] = sidedown[6];
			sidedown[6] = sidedown[8];
			sidedown[8] = temp;

			temp = sidedown[1];
			sidedown[1] = sidedown[3];
			sidedown[3] = sidedown[7];
			sidedown[7] = sidedown[5];
			sidedown[5] = temp;
			drawRubix();
		}

		function downRotateInv(){
			temp = sidefront[8];
			sidefront[8] = sideright[8];
			sideright[8] = sideback[8];
			sideback[8] = sideleft[8];
			sideleft[8] = temp;

			temp = sidefront[7];
			sidefront[7] = sideright[7];
			sideright[7] = sideback[7];
			sideback[7] = sideleft[7];
			sideleft[7] = temp;

			temp = sidefront[6];
			sidefront[6] = sideright[6];
			sideright[6] = sideback[6];
			sideback[6] = sideleft[6];
			sideleft[6] = temp;

			temp = sidedown[2];
			sidedown[2] = sidedown[8];
			sidedown[8] = sidedown[6];
			sidedown[6] = sidedown[0];
			sidedown[0] = temp;

			temp = sidedown[1];
			sidedown[1] = sidedown[5];
			sidedown[5] = sidedown[7];
			sidedown[7] = sidedown[3];
			sidedown[3] = temp;
			drawRubix();
		}

		function frontRotate(){
			temp = sideup[8];
			sideup[8] = sideleft[2];
			sideleft[2] = sidedown[0];
			sidedown[0] = sideright[6];
			sideright[6] = temp;

			temp = sideup[7];
			sideup[7] = sideleft[5];
			sideleft[5] = sidedown[1];
			sidedown[1] = sideright[3];
			sideright[3] = temp;

			temp = sideup[6];
			sideup[6] = sideleft[8];
			sideleft[8] = sidedown[2];
			sidedown[2] = sideright[0];
			sideright[0] = temp;

			temp = sidefront[2];
			sidefront[2] = sidefront[0];
			sidefront[0] = sidefront[6];
			sidefront[6] = sidefront[8];
			sidefront[8] = temp;

			temp = sidefront[1];
			sidefront[1] = sidefront[3];
			sidefront[3] = sidefront[7];
			sidefront[7] = sidefront[5];
			sidefront[5] = temp;
			drawRubix();
		}

		function frontRotateInv(){
			temp = sideup[8];
			sideup[8] = sideright[6];
			sideright[6] = sidedown[0];
			sidedown[0] = sideleft[2];
			sideleft[2] = temp;

			temp = sideup[7];
			sideup[7] = sideright[3];
			sideright[3] = sidedown[1];
			sidedown[1] = sideleft[5];
			sideleft[5] = temp;

			temp = sideup[6];
			sideup[6] = sideright[0];
			sideright[0] = sidedown[2];
			sidedown[2] = sideleft[8];
			sideleft[8] = temp;

			temp = sidefront[2];
			sidefront[2] = sidefront[8];
			sidefront[8] = sidefront[6];
			sidefront[6] = sidefront[0];
			sidefront[0] = temp;

			temp = sidefront[1];
			sidefront[1] = sidefront[5];
			sidefront[5] = sidefront[7];
			sidefront[7] = sidefront[3];
			sidefront[3] = temp;
			drawRubix();
		}

		function backRotate(){
			temp = sideright[2];
			sideright[2] = sidedown[8];
			sidedown[8] = sideleft[6];
			sideleft[6] = sideup[0];
			sideup[0] = temp;

			temp = sideright[5];
			sideright[5] = sidedown[7];
			sidedown[7] = sideleft[3];
			sideleft[3] = sideup[1];
			sideup[1] = temp;

			temp = sideright[8];
			sideright[8] = sidedown[6];
			sidedown[6] = sideleft[0];
			sideleft[0] = sideup[2];
			sideup[2] = temp;

			temp = sideback[0];
			sideback[0] = sideback[6];
			sideback[6] = sideback[8];
			sideback[8] = sideback[2];
			sideback[2] = temp;

			temp = sideback[1];
			sideback[1] = sideback[3];
			sideback[3] = sideback[7];
			sideback[7] = sideback[5];
			sideback[5] = temp;
			drawRubix();
		}

		function backRotateInv(){
			temp = sideright[2];
			sideright[2] = sideup[0];
			sideup[0] = sideleft[6];
			sideleft[6] = sidedown[8];
			sidedown[8] = temp;

			temp = sideright[5];
			sideright[5] = sideup[1];
			sideup[1] = sideleft[3];
			sideleft[3] = sidedown[7];
			sidedown[7] = temp;

			temp = sideright[8];
			sideright[8] = sideup[2];
			sideup[2] = sideleft[0];
			sideleft[0] = sidedown[6];
			sidedown[6] = temp;

			temp = sideback[0];
			sideback[0] = sideback[2];
			sideback[2] = sideback[8];
			sideback[8] = sideback[6];
			sideback[6] = temp;

			temp = sideback[1];
			sideback[1] = sideback[5];
			sideback[5] = sideback[7];
			sideback[7] = sideback[3];
			sideback[3] = temp;
			drawRubix();
		}

		function leftView(){
			//up side
			temp = sideup[0];
			sideup[0] = sideup[2];
			sideup[2] = sideup[8];
			sideup[8] = sideup[6];
			sideup[6] = temp;

			temp = sideup[1];
			sideup[1] = sideup[5];
			sideup[5] = sideup[7];
			sideup[7] = sideup[3];
			sideup[3] = temp;

			//down side
			temp = sidedown[0];
			sidedown[0] = sidedown[6];
			sidedown[6] = sidedown[8];
			sidedown[8] = sidedown[2];
			sidedown[2] = temp;

			temp = sidedown[1];
			sidedown[1] = sidedown[3];
			sidedown[3] = sidedown[7];
			sidedown[7] = sidedown[5];
			sidedown[5] = temp;

			//side
			temp = sideleft[0];
			sideleft[0] = sideback[0];
			sideback[0] = sideright[0];
			sideright[0] = sidefront[0];
			sidefront[0] = temp;
			temp = sideleft[1];
			sideleft[1] = sideback[1];
			sideback[1] = sideright[1];
			sideright[1] = sidefront[1];
			sidefront[1] = temp;
			temp = sideleft[2];
			sideleft[2] = sideback[2];
			sideback[2] = sideright[2];
			sideright[2] = sidefront[2];
			sidefront[2] = temp;
			temp = sideleft[3];
			sideleft[3] = sideback[3];
			sideback[3] = sideright[3];
			sideright[3] = sidefront[3];
			sidefront[3] = temp;
			temp = sideleft[4];
			sideleft[4] = sideback[4];
			sideback[4] = sideright[4];
			sideright[4] = sidefront[4];
			sidefront[4] = temp;
			temp = sideleft[5];
			sideleft[5] = sideback[5];
			sideback[5] = sideright[5];
			sideright[5] = sidefront[5];
			sidefront[5] = temp;
			temp = sideleft[6];
			sideleft[6] = sideback[6];
			sideback[6] = sideright[6];
			sideright[6] = sidefront[6];
			sidefront[6] = temp;
			temp = sideleft[7];
			sideleft[7] = sideback[7];
			sideback[7] = sideright[7];
			sideright[7] = sidefront[7];
			sidefront[7] = temp;
			temp = sideleft[8];
			sideleft[8] = sideback[8];
			sideback[8] = sideright[8];
			sideright[8] = sidefront[8];
			sidefront[8] = temp;
			
			drawRubix();
		}

		function upView(){
			temp = sideleft[0];
			sideleft[0] = sideleft[6];
			sideleft[6] = sideleft[8];
			sideleft[8] = sideleft[2];
			sideleft[2] = temp;
			temp = sideleft[1];
			sideleft[1] = sideleft[3];
			sideleft[3] = sideleft[7];
			sideleft[7] = sideleft[5];
			sideleft[5] = temp;

			temp = sideright[0];
			sideright[0] = sideright[2];
			sideright[2] = sideright[8];
			sideright[8] = sideright[6];
			sideright[6] = temp;
			temp = sideright[1];
			sideright[1] = sideright[5];
			sideright[5] = sideright[7];
			sideright[7] = sideright[3];
			sideright[3] = temp;

			temp = sideup[0];
			sideup[0] = sideback[8];
			sideback[8] = sidedown[0];
			sidedown[0] = sidefront[0];
			sidefront[0] = temp;
			temp = sideup[1];
			sideup[1] = sideback[7];
			sideback[7] = sidedown[1];
			sidedown[1] = sidefront[1];
			sidefront[1] = temp;
			temp = sideup[2];
			sideup[2] = sideback[6];
			sideback[6] = sidedown[2];
			sidedown[2] = sidefront[2];
			sidefront[2] = temp;
			temp = sideup[3];
			sideup[3] = sideback[5];
			sideback[5] = sidedown[3];
			sidedown[3] = sidefront[3];
			sidefront[3] = temp;
			temp = sideup[4];
			sideup[4] = sideback[4];
			sideback[4] = sidedown[4];
			sidedown[4] = sidefront[4];
			sidefront[4] = temp;
			temp = sideup[5];
			sideup[5] = sideback[3];
			sideback[3] = sidedown[5];
			sidedown[5] = sidefront[5];
			sidefront[5] = temp;
			temp = sideup[6];
			sideup[6] = sideback[2];
			sideback[2] = sidedown[6];
			sidedown[6] = sidefront[6];
			sidefront[6] = temp;
			temp = sideup[7];
			sideup[7] = sideback[1];
			sideback[1] = sidedown[7];
			sidedown[7] = sidefront[7];
			sidefront[7] = temp;
			temp = sideup[8];
			sideup[8] = sideback[0];
			sideback[0] = sidedown[8];
			sidedown[8] = sidefront[8];
			sidefront[8] = temp;
 			drawRubix();
		}

		function downView(){
			temp = sideleft[0];
			sideleft[0] = sideleft[2];
			sideleft[2] = sideleft[8];
			sideleft[8] = sideleft[6];
			sideleft[6] = temp;
			temp = sideleft[1];
			sideleft[1] = sideleft[5];
			sideleft[5] = sideleft[7];
			sideleft[7] = sideleft[3];
			sideleft[3] = temp;

			temp = sideright[0];
			sideright[0] = sideright[6];
			sideright[6] = sideright[8];
			sideright[8] = sideright[2];
			sideright[2] = temp;
			temp = sideright[1];
			sideright[1] = sideright[3];
			sideright[3] = sideright[7];
			sideright[7] = sideright[5];
			sideright[5] = temp;

			temp = sideup[0];
			sideup[0] = sidefront[0];
			sidefront[0] = sidedown[0];
			sidedown[0] = sideback[8];
			sideback[8] = temp;
			temp = sideup[1];
			sideup[1] = sidefront[1];
			sidefront[1] = sidedown[1];
			sidedown[1] = sideback[7];
			sideback[7] = temp;
			temp = sideup[2];
			sideup[2] = sidefront[2];
			sidefront[2] = sidedown[2];
			sidedown[2] = sideback[6];
			sideback[6] = temp;
			temp = sideup[3];
			sideup[3] = sidefront[3];
			sidefront[3] = sidedown[3];
			sidedown[3] = sideback[5];
			sideback[5] = temp;
			temp = sideup[4];
			sideup[4] = sidefront[4];
			sidefront[4] = sidedown[4];
			sidedown[4] = sideback[4];
			sideback[4] = temp;
			temp = sideup[5];
			sideup[5] = sidefront[5];
			sidefront[5] = sidedown[5];
			sidedown[5] = sideback[3];
			sideback[3] = temp;
			temp = sideup[6];
			sideup[6] = sidefront[6];
			sidefront[6] = sidedown[6];
			sidedown[6] = sideback[2];
			sideback[2] = temp;
			temp = sideup[7];
			sideup[7] = sidefront[7];
			sidefront[7] = sidedown[7];
			sidedown[7] = sideback[1];
			sideback[1] = temp;
			temp = sideup[8];
			sideup[8] = sidefront[8];
			sidefront[8] = sidedown[8];
			sidedown[8] = sideback[0];
			sideback[0] = temp;
			drawRubix();
		}

		function rightView(){
			temp = sideup[0];
			sideup[0] = sideup[6];
			sideup[6] = sideup[8];
			sideup[8] = sideup[2];
			sideup[2] = temp;
			temp = sideup[1];
			sideup[1] = sideup[3];
			sideup[3] = sideup[7];
			sideup[7] = sideup[5];
			sideup[5] = temp;

			temp = sidedown[0];
			sidedown[0] = sidedown[2];
			sidedown[2] = sidedown[8];
			sidedown[8] = sidedown[6];
			sidedown[6] = temp;
			temp = sidedown[1];
			sidedown[1] = sidedown[5];
			sidedown[5] = sidedown[7];
			sidedown[7] = sidedown[3];
			sidedown[3] = temp;

			temp = sideleft[0];
			sideleft[0] = sidefront[0];
			sidefront[0] = sideright[0];
			sideright[0] = sideback[0];
			sideback[0] = temp;
			temp = sideleft[1];
			sideleft[1] = sidefront[1];
			sidefront[1] = sideright[1];
			sideright[1] = sideback[1];
			sideback[1] = temp;
			temp = sideleft[2];
			sideleft[2] = sidefront[2];
			sidefront[2] = sideright[2];
			sideright[2] = sideback[2];
			sideback[2] = temp;
			temp = sideleft[3];
			sideleft[3] = sidefront[3];
			sidefront[3] = sideright[3];
			sideright[3] = sideback[3];
			sideback[3] = temp;
			temp = sideleft[4];
			sideleft[4] = sidefront[4];
			sidefront[4] = sideright[4];
			sideright[4] = sideback[4];
			sideback[4] = temp;
			temp = sideleft[5];
			sideleft[5] = sidefront[5];
			sidefront[5] = sideright[5];
			sideright[5] = sideback[5];
			sideback[5] = temp;
			temp = sideleft[6];
			sideleft[6] = sidefront[6];
			sidefront[6] = sideright[6];
			sideright[6] = sideback[6];
			sideback[6] = temp;
			temp = sideleft[7];
			sideleft[7] = sidefront[7];
			sidefront[7] = sideright[7];
			sideright[7] = sideback[7];
			sideback[7] = temp;
			temp = sideleft[8];
			sideleft[8] = sidefront[8];
			sidefront[8] = sideright[8];
			sideright[8] = sideback[8];
			sideback[8] = temp;
			drawRubix();
		}

	</script>
</head>
<body>

	<div class="header">
		<button type="button" onclick="leftRotate()">Left</button>
		<button type="button" onclick="leftRotateInv()">Left Invert</button>	
		<button type="button" onclick="upRotate()">Up</button>
		<button type="button" onclick="upRotateInv()">Up Invert</button>
		<button type="button" onclick="downRotate()">Down</button>
		<button type="button" onclick="downRotateInv()">Down Invert</button>
		<button type="button" onclick="frontRotate()">Front</button>
		<button type="button" onclick="frontRotateInv()">Front Invert</button>
		<button type="button" onclick="backRotate()">Back</button>
		<button type="button" onclick="backRotateInv()">Back Invert</button>
		<button type="button" onclick="rightRotate()">Right</button>
		<button type="button" onclick="rightRotateInv()">Right Invert</button>
	</div>
	<div class="rubix">
		<!-- row 1 -->
		<div id="r1d4"></div>
		<div id="r1d5"></div>
		<div id="r1d6"></div>
		
		<!-- row 2 -->
		<div id="r2d4"></div>
		<div id="r2d5"></div>
		<div id="r2d6"></div>

		<!-- row 3 -->
		<div id="r3d4"></div>
		<div id="r3d5"></div>
		<div id="r3d6"></div>

		<!-- row 4 -->
		<div id="r4d1"></div>
		<div id="r4d2"></div>
		<div id="r4d3"></div>
		<div id="r4d4"></div>
		<div id="r4d5"></div>
		<div id="r4d6"></div>
		<div id="r4d7"></div>
		<div id="r4d8"></div>
		<div id="r4d9"></div>
		<div id="r4d10"></div>
		<div id="r4d11"></div>
		<div id="r4d12"></div>

		<!-- row 5 -->
		<div id="r5d1"></div>
		<div id="r5d2"></div>
		<div id="r5d3"></div>
		<div id="r5d4"></div>
		<div id="r5d5"></div>
		<div id="r5d6"></div>
		<div id="r5d7"></div>
		<div id="r5d8"></div>
		<div id="r5d9"></div>
		<div id="r5d10"></div>
		<div id="r5d11"></div>
		<div id="r5d12"></div>

		<!-- row 6 -->
		<div id="r6d1"></div>
		<div id="r6d2"></div>
		<div id="r6d3"></div>
		<div id="r6d4"></div>
		<div id="r6d5"></div>
		<div id="r6d6"></div>
		<div id="r6d7"></div>
		<div id="r6d8"></div>
		<div id="r6d9"></div>
		<div id="r6d10"></div>
		<div id="r6d11"></div>
		<div id="r6d12"></div>

		<!-- row 7 -->
		
		<div id="r7d4"></div>
		<div id="r7d5"></div>
		<div id="r7d6"></div>
		

		<!-- row 8 -->
		
		<div id="r8d4"></div>
		<div id="r8d5"></div>
		<div id="r8d6"></div>
		

		<!-- row 9 -->
		
		<div id="r9d4"></div>
		<div id="r9d5"></div>
		<div id="r9d6"></div>
		
	</div>
	<div>
		<button type="button" onclick="leftView()">View Left</button>
		<button type="button" onclick="upView()">View Up</button>
		<button type="button" onclick="downView()">View Down</button>
		<button type="button" onclick="rightView()">View Right</button>
	</div>

</body>
</html>