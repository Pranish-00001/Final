<html>
<link rel="stylesheet" type="text/css" href="Form_edit.css">
<head>
<title>Form</title>
</head>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
           -webkit-appearance: none;
            margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<body>
<div class="box">
<form method="post" action="Addition_DB.php">
    <label for="Item_name">Item:</label>
    <input type = "text" name="name" required id="Item_name"><br>
    <label>Quantity (0 if you want to remove):</label>
    <input type = "number" name="Amount" min="0" required><br>
    <br>
    <input type="submit">
</form>
</div>
<style>
        /* Add your custom styles here */
        .btn {
            display: block;
            margin: 10px auto; /* Adjust the margin and centering as needed */
            text-align: center;
        }
    </style>
<center>
    <a href="Home_page.html" class="btn">Back</a>
</center>

<center>
    <a href="Data.html" class="btn">Table</a>
</center>
</body>
</html>