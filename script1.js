document.addEventListener("DOMContentLoaded", () => {
    const addUniversityForm = document.getElementById("add-university-form");
    const universityList = document.getElementById("university-items");

    // Function to refresh the university list
    function refreshUniversityList() {
        // Clear the current list
        universityList.innerHTML = "";

        // Fetch and display the updated list of universities
        fetch("manage_university.php?action=get")
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    data.universities.forEach((university) => {
                        const universityItem = document.createElement("li");
                        universityItem.textContent = `${university.name} - ${university.location}`;
                        universityList.appendChild(universityItem);
                    });
                } else {
                    console.error(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    // Add university form submission
    addUniversityForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const universityName = document.getElementById("university-name").value;
        const location = document.getElementById("location").value;

        fetch("manage_university.php?action=add", {
            method: "POST",
            body: JSON.stringify({ name: universityName, location: location }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    refreshUniversityList();
                    addUniversityForm.reset();
                } else {
                    console.error(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });

    // Function to delete a university
    function deleteUniversity(id) {
        fetch("manage_university.php?action=delete", {
            method: "POST",
            body: JSON.stringify({ id: id }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    refreshUniversityList();
                } else {
                    console.error(data.message);
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    // Attach a click event to dynamically added delete buttons
    universityList.addEventListener("click", (e) => {
        if (e.target.tagName === "BUTTON") {
            const universityId = e.target.getAttribute("data-id");
            deleteUniversity(universityId);
        }
    });

    // Initial load of university list
    refreshUniversityList();
});
