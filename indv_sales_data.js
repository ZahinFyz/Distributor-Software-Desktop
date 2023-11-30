document.addEventListener("DOMContentLoaded", function() {
    const salesmanSelect = document.getElementById("salesmanSelect");
    const fromDateInput = document.getElementById("fromDate");
    const toDateInput = document.getElementById("toDate");
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
        xhttp.open("GET", `get_indv_sales_data.php?name=${name}&fromDate=${fromDate}&toDate=${toDate}`, true);
        xhttp.send();
    }

    function displaySalesData(data) {
        let html = "<h1 style='color: #fff; font-size: 24px; padding: 10px;'>Sales Info :</h1><table border='1'>";
        html += "<tr><th style='color: #fff; padding: 8px;'>Date</th><th style='color: #fff; padding: 8px;'>Product Name</th><th style='color: #fff; padding: 8px;'>Free</th><th style='color: #fff; padding: 8px;'>Total Sale</th><th style='color: #fff; padding: 8px;'>Taka</th></tr>";
        let totalFree = 0;
        let totalTotalSale = 0;
        let totalTaka = 0;
    
        data.forEach(row => {
            html += `<tr><td style='color: #fff; padding: 8px;'>${row.Date}</td><td style='color: #fff; padding: 8px;'>${row.Product_name}</td><td style='color: #fff; padding: 8px;'>${row.Free}</td><td style='color: #fff; padding: 8px;'>${row.Total_sale}</td><td style='color: #fff; padding: 8px;'>${row.Taka}</td></tr>`;
            totalFree += parseInt(row.Free);
            totalTotalSale += parseInt(row.Total_sale);
            totalTaka += parseInt(row.Taka);
        });
    
        // Add total row
        html += `<tr><td style='color: #fff; padding: 8px;'>Total</td><td></td><td style='color: #fff; padding: 8px;'>${totalFree}</td><td style='color: #fff; padding: 8px;'>${totalTotalSale}</td><td style='color: #fff; padding: 8px;'>${totalTaka}</td></tr>`;
    
        html += "</table>";
        salesDataContainer.innerHTML = html;
    }

    

    salesmanSelect.addEventListener("change", fetchSalesData);
    fromDateInput.addEventListener("change", fetchSalesData);
    toDateInput.addEventListener("change", fetchSalesData);

    // Adjust the position of the table
    salesDataContainer.style.marginTop = "10px";
    salesDataContainer.style.marginLeft = "110px";
   
});
