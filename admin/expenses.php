<?php 
// logout Automatically
include '../backend/logout.php';
//Connection
include '../backend/dbcon.php';

// Active Page
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[2];

$sqlExpenses = "SELECT * FROM expenses";
$resultExpenses = $conn->query($sqlExpenses);

$expensesData = array();
if ($resultExpenses->num_rows > 0) {
    while ($row = $resultExpenses->fetch_assoc()) {
        $expensesData[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---WEB TITLE--->
    <link rel="short icon" href="../picture/shortcut-logo.png" type="x-icon">
    <title>
        <?php echo "Admin | Finance"; ?>
    </title>

    <!---CSS--->
    <link rel="stylesheet" href="../css/admin.css">

    <!--ICON LINKS-->
    <link rel="stylesheet" href="../font-awesome-6/css/all.css">

    <!--FONT LINKS-->
    <link rel="stylesheet" href="../css/fonts.css">
    
    <style>
        body {
            overflow-y: auto;
        }       
    </style>
    
</head>
    
<body>

    <section class="expenses">
        <div class="row">
            <h3 id="monthHeader">Month <?php echo date('Y'); ?></h3>
            <div class="select">
                <select id="monthSelect" onchange="showSelectedMonth()" placeholder="Select">
                    <option value="" selected disabled>Select Month</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                    <option value="<?php echo date('F'); ?>">Current Month</option>
                </select>                       
                <button><i class="fa-solid fa-print"></i> Print</button>
            </div>
        </div>
        <div class="exp-box">
            <button class="add-button"><i class="fa-solid fa-plus"></i> Add New</button>
            <div class="search-bar">
                <input type="text" placeholder="Search expenses " id="client-search">
                  <i class="fa-solid fa-magnifying-glass" type="button" onclick="searchClient()" title="Search"></i>
            </div>
            <div class="exp-tbl">
                <table class="header-table">
                    <thead>
                        <tr>
                            <th>Expenses ID</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                <div class="data-container">
                    <table class="data-table">
                    <tbody>
                        <?php if (empty($expensesData)) : ?>
                            <tr>
                                <td colspan="6">No expenses found</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($expensesData as $expense) : ?>
                                <tr>
                                    <td><?php echo $expense['expensesID']; ?></td>
                                    <td><?php echo date('F j, Y', strtotime($expense['date'])); ?></td>
                                    <td><?php echo $expense['category']; ?></td>
                                    <td><?php echo $expense['description']; ?></td>
                                    <td><?php echo '₱' . number_format($expense['amount'], 2); ?></td>
                                    <td>
                                        <form method="post" action="../backend/expenses.php">
                                            <input type="hidden" name="expensesID" value="<?php echo $expense['expensesID']; ?>">
                                            <button type="submit" name="delete">Delete</button>
                                        </form>                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- Popup -->
            <div id="popup" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="hidePopup()">&times;</span>
                    <div class="form-container">
                        <form method="post" action="" id="expensesForm">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category-exp" class="form-control">
                                    <option value="Travel">Travel</option>
                                    <option value="Equipment">Equipment</option>
                                    <option value="Food">Food</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description-exp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <div class="input-group">
                                    <input type="text" name="amount" id="amount-exp" class="form-control" oninput="formatAmount()">
                                </div>
                            </div>
                            <button type="button" class="btn-save-event" onclick="addExpenses()">Add Report</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="popupDelete" id="deleteExpensePopup">
                <div class="modal">
                    <p>Do you want to delete this expenses report?</p>
                    <button id="deleteNo">No</button>
                    <button id="deleteYes">Yes</button>
                </div>
            </div>  
        </div>
    </section>
    <!----Navbar&Sidebar----->
    <?php 
        include '../admin/sidebar.php';
        include '../admin/navbar.php';
    ?>  

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const revenueData = [100, 150, 200, 180, 250, 220];

            const ctx = document.getElementById('revenueChart').getContext('2d');

            const revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: revenueData,
                        borderColor: 'background-color: #0d0a0b;',
                        borderWidth: 3,
                        pointBackgroundColor: 'background-color:  #7a7adb;',
                        pointRadius: 5,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        

        function showSelectedMonth() {
            var monthHeader = document.getElementById("monthHeader");
            var selectedMonth = document.getElementById("monthSelect").value;
            var currentYear = new Date().getFullYear(); // Get the current year
            
            if (selectedMonth === "") {
                monthHeader.textContent = "Month " + currentYear;
            } else {
                monthHeader.textContent = selectedMonth + " " + currentYear;
            }
        }
        // Function to automatically select the current month
        window.onload = function() {
            var currentMonth = new Date().toLocaleString('default', { month: 'long' });
            var selectElement = document.getElementById("monthSelect");
            
            for (var i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value === currentMonth) {
                    selectElement.selectedIndex = i;
                    break;
                }
            }

            // Trigger the function to display the selected month
            showSelectedMonth();
        };
        
        
        function formatAmount() {
            var amountInput = document.getElementById('amount-exp');
            var amountValue = amountInput.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except for the period
            var numericValue = parseFloat(amountValue);

            if (!isNaN(numericValue)) {
                var formattedAmount = '₱' + numericValue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                amountInput.value = formattedAmount;
            } else {
                amountInput.value = '₱';
            }
        }


        // Set the default value of the input field to '₱'
        document.getElementById('amount-exp').value = '₱';
        
    // Function to show the popup
    function showPopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "block";
    }

    function hidePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }

    document.addEventListener('DOMContentLoaded', function () {
        var addButton = document.querySelector('.add-button');
        addButton.addEventListener('click', function () {
            showPopup();
        });

        var closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', function () {
            hidePopup();
        });

        window.addEventListener('click', function (event) {
            var popup = document.getElementById("popup");
            if (event.target == popup) {
                hidePopup();
            }
        });
    });

    function addExpenses() {
    var form = document.getElementById('expensesForm');
    var formData = new FormData(form);

    // Remove formatting from the amount before sending it to the server
    var amountInput = document.getElementById('amount-exp');
    formData.set('amount', removeFormatting(amountInput.value));

    // Add additional data to the form data
    formData.append('action', 'add_expenses');

    // Make an AJAX request to handle the form submission
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../backend/expenses.php', true);
    xhr.onload = function () {
        if (xhr.status == 200) {
            // Handle success, e.g., show a success message or redirect
            hidePopup();
            location.reload(); // You may customize this based on your needs
        } else {
            // Handle errors
            alert('Error: ' + xhr.responseText);
        }
    };
    xhr.send(formData);
}

    function removeFormatting(amount) {
        // Remove currency symbol, comma, and period
        return parseFloat(amount.replace(/[^\d]/g, ''));
    }

    
    // Add the following script to periodically check for inactivity and logout
    var inactivityTimeout = 900; // 15 minutes in seconds

function checkInactivity() {
    setTimeout(function () {
        window.location.href = '../login.php'; // Replace 'logout.php' with the actual logout page
    }, inactivityTimeout * 1000);
}

// Start checking for inactivity when the page loads
document.addEventListener('DOMContentLoaded', function () {
    checkInactivity();
});

// Reset the inactivity timer when there's user activity
document.addEventListener('mousemove', function () {
    clearTimeout(checkInactivity);
    checkInactivity();
});

document.addEventListener('keypress', function () {
    clearTimeout(checkInactivity);
    checkInactivity();
});
</script>
</html>