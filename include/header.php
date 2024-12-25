<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/bootstrap.min.css"/>
    <script src="<?php echo BASE_URL ?>assets/js/a0c7076c1c.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style.css"/>
    <title>Dashboard | Online Library Management System</title>
    <style>
    /* Style the star ratings */
    .star-rating {
      direction: rtl; /* Align the stars from right to left */
      display: inline-block;
    }

    input[type="radio"] {
      display: none;
    }

    .star {
      font-size: 30px;
      color: #ccc; /* Default color of stars */
      cursor: pointer;
    }

    input:checked ~ label.star {
      color: gold; /* Highlight selected stars */
    }

    /* Change color of stars on hover */
    label.star:hover,
    input:checked ~ label.star:hover {
      color: #ffcc00;
    }

    input:checked ~ label.star:active {
      color: #ff9900;
    }
  </style>
    </head>
    <body>