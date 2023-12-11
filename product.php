<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="css/style.css">

    <title>product page</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body> 
<div id="header"></div>
  <main>
  <div class="p-container">

        <?php
        include 'connection.php';

        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              
              echo '<div class="product">';
              echo '<a href="#" class="product-link" data-productid="'.$row["id"].'">';
                echo '<div class="p-img">';
                echo '<img src="'.$row["image_url"].'" alt="product">';
                echo '</div>';
                echo '<div class="product-title">';
                echo '<h2 class="title">'.$row["product_name"].'</h2>';
                
                echo '<div class="detail">';
                echo '<div>';
                echo '<span class="price">$ '.$row["price"].'</span>';
                echo '</div>';
                echo '<div class="to-cart">';
                echo '<button class="btn-add">Add to Cart</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    
    
      </div>
      </div>
      
      </main>
      <div id="footer"></div>
        
       <script>
        $(function(){
          $("#header").load("header.html");
          $("#footer").load("footer.html");

        })
       </script> 
      

        
        
</body>



</html>