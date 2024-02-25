<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
      * {
        box-sizing: border-box;
      }

      .table-bordered td,
      .table-bordered th {
        border: 1px solid #ddd;
        padding: 10px;
        word-break: break-all;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        font-size: 16px;
      }
      .h4-14 h4 {
        font-size: 12px;
        margin-top: 0;
        margin-bottom: 5px;
      }
      .img {
        margin-left: "auto";
        margin-top: "auto";
        height: 30px;
      }
      pre,
      p {
        /* width: 99%; */
        /* overflow: auto; */
        /* bpicklist: 1px solid #aaa; */
        padding: 0;
        margin: 0;
      }
      table {
        font-family: arial, sans-serif;
        width: 100%;
        border-collapse: collapse;
        padding: 1px;
      }
      .hm-p p {
        text-align: left;
        padding: 1px;
        padding: 5px 4px;
      }
      td,
      th {
        text-align: left;
        padding: 8px 6px;
      }
      .table-b td,
      .table-b th {
        border: 1px solid #ddd;
      }
      th {
        /* background-color: #ddd; */
      }
      .hm-p td,
      .hm-p th {
        padding: 3px 0px;
      }
      .cropped {
        float: right;
        margin-bottom: 20px;
        height: 100px; /* height of container */
        overflow: hidden;
      }
      .cropped img {
        width: 400px;
        margin: 8px 0px 0px 80px;
      }
      .main-pd-wrapper {
        box-shadow: 0 0 10px #ddd;
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
      }
      .table-bordered td,
      .table-bordered th {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
      }
      .invoice-items {
        font-size: 14px;
        border-top: 1px dashed #ddd;
      }
      .invoice-items td{
        padding: 14px 0;
       
      }
    </style>
  </head>
  <body>
    <section class="main-pd-wrapper" style=" margin: auto;background: antiquewhite;">
      <div style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                ">
                <img width="220" height="73" src="<?=base_url()?><?=system_settings('company_logo')?>">

                <p style="font-weight: bold; color: #000;text-transform: capitalize; margin-top: 5px; font-size: 18px;">
                  <?=system_settings('site_title')?>
                </p>
                <p style="text-transform: capitalize;"><?=system_settings('site_tagline')?></p>
                <p style="margin: 5px auto;">
                  <?=system_settings('company_address')?>
                </p>
                <p>
                  <b>Phone:</b> <?=system_settings('company_phone')?>
                </p>
                <p>
                  <b>Email:</b> <?=system_settings('company_email')?>
                </p>
                <p style="text-align: left;">
                    <b>Invoice No. :</b> <?=$friend_subscription_payment['order_id']?> 
                </p>
                
                <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
              </div>
              <table style="width: 100%; table-layout: fixed">
                <thead>
                  <tr>
                    <th style="width: 50px; padding-left: 0;">Sr.No.</th>
                    <th style="width: 220px;">Package Name</th>
                    <th>Package Duration</th>
                    <th style="text-align: right; padding-right: 0;">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="invoice-items">
                    <td>01.</td>
                    <td><?=$friend_subscription_payment['pkg_name']?> Package</td>
                    <td><?=$friend_subscription_payment['duration']?> Months</td>
                    <td style="text-align: right;"><?=system_settings('currency_sign')?> <?=$friend_subscription_payment['order_amount']?></td>
                  </tr>
                </tbody>
              </table>

              <table style="width: 100%;
              background: #fcbd024f;
              border-radius: 4px;">
                <thead>
                  <tr>
                    <th>Total</th>
                    <th style="text-align: center;">Item (1)</th>
                    <th>&nbsp;</th>
                    <th style="text-align: right;"><?=system_settings('currency_sign')?> <?=$friend_subscription_payment['order_amount']?></th>
                  </tr>
                </thead>
             
              </table>

              

    </section>
  </body>
</html>
