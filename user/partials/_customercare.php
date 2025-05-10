<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Care Modal</title>
    <style>
        /* Styling for modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
        
        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        
        /* Styling for button */
        .open-modal-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<button class="open-modal-btn" onclick="openModal()">Open Customer Care</button>

<div id="myModal" class="modal" style="background-color:#cdecf4;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Contact Customer Care</h2>
        <p>Please fill out the form below to get in touch with our customer care team:</p>
        
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>

</body>
</html>

';
?>