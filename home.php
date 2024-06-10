<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Sade Grocery Store</title>
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <section></section>
    <div class="text">
        <h2>Welcome To<br><span>Sade Store</span></h2>
    </div>
    <div class= "header">
        <p><img src="l2.png" alt="Logo"><a href="#">SADE GROCERY</a></p>
        <div class="nav-menu" id="navMenu">
                <a href="index.php" class="link active">LOG OUT</a>
        </div>
    </div>
    <section class="et-hero-tabs">
        <h1>SADE GROCERY STORE</h1>
        <h3>Where variety meets affordability.</h3>
        <button>
            <span>PROJECT</span>
            <div class="container">
                <a href="testing.php">
              <img
                src="database.png"
                alt="Icon"
                width="45"
                height="35"
                class="icon"
              > </a>
            </img>
            <a href="queries.php">
            <img
            src="edit.png"
            alt="Icon"
            width="45"
            height="35"
            class="icon"
          ></a>
        </img>
            </div>
          </button>

          <div class="values">
      <div class="val-box">
          <div>
            <h3>55</h3>
            <span>Total Products</span>
          </div>
      </div>
      <div class="val-box">
          <div>
            <h3>25</h3>
            <span>Total Category</span>
          </div>
      </div>
      <div class="val-box">
          <div>
            <h3>50</h3>
            <span>Total Suppliers</span>
          </div>
      </div>
    </div>

    </section>

    <script>
        let layer = document.querySelector('.layer');
        window.addEventListener('scroll', function(){
            let value = window.scrollY;
            layer.style.left = value*2+'px';
        })
    </script>

    
</body>
</html>
