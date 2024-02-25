<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        
      }
      .payment-page  h1 {
          color: red;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
     .payment-page   p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
     .payment-page i {
        color: red;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 15px;
        /*border-radius: 4px;*/
        /*box-shadow: 0 2px 3px #C8D0D8;*/
        display: inline-block;
        margin: 0 auto;
        border: none;
      }
      .card .checkmark {
    border-radius: 6px;
    position: relative;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
         background-color: #f8faf5 !important;
}
    </style>
    <body>
      <div class="card payment-page" style="">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5;  margin:0 auto;">
        <i class="checkmark">!</i>
      </div>
        <h1>Payment Error ! </h1> 
        <p><?=$msg?></p>
        <?php
 header('Refresh:5; url= '. base_url().'buy'); 
  echo "You will be redirected in 5 seconds...";
?>
      </div>
    </body>
</html>