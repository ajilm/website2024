<?php
/**
 * Template Name: Test Template
 * Description:  
 */
get_header();
?>  
 <style>
      
 

        h1 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
        }

        #monthly-payment {
            font-size: 24px;
            color: green;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Car Loan Calculator</h1>
        <form id="loan-form">
            <div class="form-group">
                <label for="amount">Loan Amount:</label>
                <input type="number" id="amount" placeholder="Enter loan amount" required>
            </div>
            <div class="form-group">
                <label for="interest">Annual Interest Rate (%):</label>
                <input type="number" id="interest" step="0.01" placeholder="Enter interest rate" required>
            </div>
            <div class="form-group">
                <label for="years">Loan Term (Years):</label>
                <input type="number" id="years" placeholder="Enter number of years" required>
            </div>
            <div class="form-group">
                <label for="currency">Select Currency:</label>
                <select id="currency">
                    <option value="$">USD ($)</option>
                    <option value="€">EUR (€)</option>
                    <option value="£">GBP (£)</option>
                    <option value="₹">INR (₹)</option>
                    <option value="¥">JPY (¥)</option>
                </select>
            </div>
            <button type="submit" class="btn">Calculate</button>
        </form>

        <div id="result">
            <h2>Monthly Payment: <span id="monthly-payment">$0</span></h2>
        </div>

        <canvas id="balanceChart"></canvas>
    </div>

    <script>
        document.getElementById('loan-form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get input values
            const amount = parseFloat(document.getElementById('amount').value);
            const interest = parseFloat(document.getElementById('interest').value) / 100 / 12;
            const years = parseInt(document.getElementById('years').value);
            const payments = years * 12;
            const currencySymbol = document.getElementById('currency').value;

            // Calculate monthly payment
            const x = Math.pow(1 + interest, payments);
            const monthly = (amount * x * interest) / (x - 1);

            // Display monthly payment with selected currency symbol
            document.getElementById('monthly-payment').innerHTML = `${currencySymbol}${monthly.toFixed(2)}`;

            // Calculate balance over time
            let balance = amount;
            const balances = [];
            for (let i = 0; i <= payments; i++) {
                balances.push(balance);
                balance -= (monthly - balance * interest);
            }

            // Generate chart
            generateChart(balances, currencySymbol);
        });

        function generateChart(balances, currencySymbol) {
            const ctx = document.getElementById('balanceChart').getContext('2d');
            const labels = balances.map((_, index) => `Month ${index}`);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: `Remaining Loan Balance (${currencySymbol})`,
                        data: balances,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });
        }
    </script>
<?php get_footer(); ?>