<!DOCTYPE html>
<html>
<head>
    <title>Scrap Rates Gallery</title>
    <!-- search bar -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            background-color: #f2f2f2;
            /* background-color: black; */
            font-family: "Lato", sans-serif;
        }
        /* Scrap rates section */
        .scrap-rates {
            display: flex;
            align-items: center;
            place-items:center;
            padding: 20px;
            margin-bottom: 20px;
        }
        /* search bar */
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            /* border:2px solid green: */
            }

        .search-bar input {
            width: 500px;
            height: 45px;
            background: transparent;
            border: 2px solid green;
            border-radius: 10px;
            padding-left: 10px;
            font-size: 16px;
            color: black;
            }

         .search-bar input::placeholder {
            color: #252525;
            /* font-weight:400px; */
            }

        .search-bar button {
            width: 40px;
            height: 45px;
            background: transparent;
            border: none;
            outline: none;
            display: flex;
            justify-content: center;
            align-items: center;
            }

        .search-bar button i {
            font-size: 22px;
            color: black;
            }

    /* search bar ends */
        .scrap-image {
            flex: 1;
            padding-right: 50px;
        }

        .scrap-image img {
            width: 100%;
        }

        .scrap-info {
            flex: 2;
        }

        .scrap-info h2 {
            font-size: 20px;
			margin-bottom: 10px;
        }

        .scrap-info p {
            font-size: 16px;
			
        }

        /*.plastic-types,
        .paper-types  Rates section */

        /* types rate */
        .plastic-types,
        .paper-types {
            display: flex; 
            flex-wrap:wrap;
            margin-bottom: 20px;
			
        } 

        /* typeko. */   
        .plastic-type,
        .paper-type {
            margin-right: 20px;
            margin-bottom: 20px;
            background-color:teal;
            padding: 12px;
            border-radius: 10px;
            box-shadow: 2px 0px 10px #ccc;
            /* display: flex;    */
            flex-basis: 150px;
			cursor: pointer;
			/* opacity: 100%; */
        }

		
         .plastic-type:last-child,
        .paper-type:last-child {
            margin-right: 0;
        } 

        .plastic-type h3,
        .paper-type h3 {
            font-size: 20px;
            margin-top: 4%;
			margin-bottom: 10px;
            color: #0a0909;
            padding: 0px;
			
        }
        .plastic-type p,
        .paper-type p {
            font-size: 12px;
            line-height: 0.71;
            margin-bottom: 10px;
            color: black;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
<?php
include('include/navbar.php')
?>
	<!-- for scrap rates -->
	<h1 style="color:rgb(39, 38, 38);text-align:center; font-weight: 700px;
	letter-spacing: -.03rem;
	line-height: 250%; 
	font-size:50px;" ><b>Scrap Rates</b></h1>

<!-- search bar -->
<!-- <div class="search-bar">
  <input type="text" placeholder="Search products..." name="search">
  <button type="submit"><i class='bx bx-search-alt'></i></button>
</div> -->
<!-- search bar ends -->
    <!-- Scrap rates section -->
    <div class="scrap-rates">
        <div class="scrap-image">
            <img src="images/imgcat/plastic.jpeg" alt="Plastic scrap">
            <h2 style="margin-bottom: 10px;">Plastic</h2>
            <p>Plastic is a synthetic material made from polymers that can be molded 
				into various shapes and forms. It is widely used in the manufacturing 
				of consumer goods, packaging, and construction materials due to its 
				durability and versatility.</p>
        </div>

        <div class="scrap-info">
            <div class="plastic-types">
                <div class="plastic-type">
                    <h3>Plastic</h3>
                    <p>Rs 10/kg</p>
                </div>
                <div class="plastic-type">
                    <h3>Plastic jar</h3>
                    <p>Rs 20/kg</p>
                </div>
                <div class="plastic-type">
                    <h3>Polyethene</h3>
                    <p>Rs 14/kg</p>
                </div>
                <div class="plastic-type">
                    <h3>bottle</h3>
                    <p>Rs 16/kg</p>
                </div>
                <!-- <div class="plastic-type">
                    <h3>Hard Plastic</h3>
                    <p>Rs 0.25/kg</p>
                </div>
                <div class="plastic-type">
                    <h3>Hard Plastic</h3>
                    <p>Rs 0.25/kg</p>
                </div> -->
            </div>
        </div>
    </div>

    <div class="scrap-rates">
        <div class="scrap-image">
            <img src="images/imgcat/papers.jpg" alt="Paper scrap">
			<h2 style="margin-bottom: 10px;">Papers</h2>
            <p>Papers are documents that contain written information, typically presented
                 in a formal and structured manner. They serve as a means of communicating 
                 research findings, ideas, arguments, and analysis within various academic 
                 and professional fields. </p>
        </div>

        <div class="scrap-info">
            <div class="paper-types">
                <div class="paper-type">
                    <h3>Copies</h3>
                    <p>Rs10/kg</p>
                </div>
                <div class="paper-type">
                    <h3>Book</h3>
                    <p>Rs 12/kg</p>
                </div>
				<div class="paper-type">
                    <h3>Cartoon</h3>
                    <p>Rs 15/kg</p>
                </div>
				<div class="paper-type">
                    <h3>Book</h3>
                    <p>Rs 0.05/kg</p>
                </div>
				<div class="paper-type">
                    <h3>Book</h3>
                    <p>Rs 0.05/kg</p>
                </div>
            </div>
        </div>
    </div>
	<?php
include('include/footer.php')
?>
</body>
</html>
