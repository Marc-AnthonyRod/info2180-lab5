window.onload = function () {
    const lookupBtn = document.getElementById("lookup");
    const lookupCitiesBtn = document.getElementById("lookupCities");
    const resultDiv = document.getElementById("result");

    lookupBtn.addEventListener("click", function () {


        const country = document.getElementById("country").value.trim();

        
        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => response.text()) 
            .then(data => resultDiv.innerHTML = data)
            .catch(error => {
                console.error("Error fetching data:", error);
                resultDiv.innerHTML = "<p>Unable to load data.</p>";
            });
    });

    
    lookupCitiesBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();
        fetch(`world.php?country=${encodeURIComponent(country)}&lookup=cities`)
            .then(response => response.text())
            .then(data => resultDiv.innerHTML = data)
            .catch(error => {
                console.error("Error fetching data:", error);
                resultDiv.innerHTML = "<p>Unable to load data.</p>";
            });
    });
};