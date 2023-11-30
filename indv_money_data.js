document.addEventListener("DOMContentLoaded", function() {
    const salesmanSelect = document.getElementById("salesmanSelect");
    const fromDateInput = document.getElementById("fromDate");
    const toDateInput = document.getElementById("toDate");
    const moneyDataContainer = document.getElementById("moneyData");
    const salesDataContainer = document.getElementById("salesData");

    function fetchSalesData() {
        const name = salesmanSelect.value;
        const fromDate = fromDateInput.value;
        const toDate = toDateInput.value;

        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const data = JSON.parse(this.responseText);
                displaySalesData(data);
            }
        };
        xhttp.open("GET", `get_indv_money_data.php?name=${name}&fromDate=${fromDate}&toDate=${toDate}`, true);
        xhttp.send();
    }

    function displaySalesData(data) {
        let totalSold = 0;
        let totalCashSale = 0;
        let totalDueTaka = 0;
        let totalNetDeposit = 0;
    
        let html = "<h1 style='color: #fff; font-size: 24px; padding: 10px;'>Money Info :</h1><table border='1'>";
        html += "<tr><th style='color: #fff; padding: 8px;'>Date</th><th style='color: #fff; padding: 8px;'>Total Sale</th><th style='color: #fff; padding: 8px;'>Cash Sale & Collection</th><th style='color: #fff; padding: 8px;'>Due Taka</th><th style='color: #fff; padding: 8px;'>Net Deposit</th></tr>";
    
        data.forEach(row => {
            html += `<tr><td style='color: #fff; padding: 8px;'>${row.Date}</td><td style='color: #fff; padding: 8px;'>${row.Total_sold}</td><td style='color: #fff; padding: 8px;'>${row.S_c}</td><td style='color: #fff; padding: 8px;'>${row.Due_tk}</td><td style='color: #fff; padding: 8px;'>${row.Net_deposit}</td></tr>`;
    
            totalSold += parseInt(row.Total_sold);
            totalCashSale += parseInt(row.S_c);
            totalDueTaka += parseInt(row.Due_tk);
            totalNetDeposit += parseInt(row.Net_deposit);
        });
    
        // Add total row
        html += `<tr><td style='color: #fff; padding: 8px;'>Total</td><td style='color: #fff; padding: 8px;'>${totalSold}</td><td style='color: #fff; padding: 8px;'>${totalCashSale}</td><td style='color: #fff; padding: 8px;'>${totalDueTaka}</td><td style='color: #fff; padding: 8px;'>${totalNetDeposit}</td></tr>`;
    
        html += "</table>";
        moneyDataContainer.innerHTML = html;
    }
    

    salesmanSelect.addEventListener("change", fetchSalesData);
    fromDateInput.addEventListener("change", fetchSalesData);
    toDateInput.addEventListener("change", fetchSalesData);

    // Adjust the position of the tables
    moneyDataContainer.style.marginTop = "10px" ;
    moneyDataContainer.style.marginLeft = "110px";
});
