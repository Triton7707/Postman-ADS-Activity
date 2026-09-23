const API_URL = "../api/employee_api.php";




const employeeTableBody =
    document.getElementById("employeeTableBody");

const searchInput =
    document.getElementById("searchInput");

const connectionStatus =
    document.getElementById("connectionStatus");



const addModal =
    document.getElementById("addModal");

const addEmployeeBtn =
    document.getElementById("addEmployeeBtn");

const closeAddModal =
    document.getElementById("closeAddModal");

const cancelAddBtn =
    document.getElementById("cancelAddBtn");

const addEmployeeForm =
    document.getElementById("addEmployeeForm");



const editModal =
    document.getElementById("editModal");

const closeEditModal =
    document.getElementById("closeEditModal");

const cancelEditBtn =
    document.getElementById("cancelEditBtn");

const editEmployeeForm =
    document.getElementById("editEmployeeForm");




async function loadEmployees() {

    try {

        const response = await fetch(API_URL);

        const result = await response.json();

        if (!response.ok || result.status !== "success") {

            throw new Error(
                result.message || "Unable to load employees."
            );
        }

        displayEmployees(result.data);

        connectionStatus.textContent = "API Connected";

    } catch (error) {

        console.error("Error:", error);

        connectionStatus.textContent = "Connection Failed";

        employeeTableBody.innerHTML = `
            <tr>
                <td colspan="7">
                    Unable to load employees.
                </td>
            </tr>
        `;
    }
}




function displayEmployees(employees) {

    employeeTableBody.innerHTML = "";

    if (employees.length === 0) {

        employeeTableBody.innerHTML = `
            <tr>
                <td colspan="7">
                    No employees found.
                </td>
            </tr>
        `;

        return;
    }


    employees.forEach(employee => {

        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${escapeHTML(employee.id)}</td>

            <td>${escapeHTML(employee.first_name)}</td>

            <td>${escapeHTML(employee.last_name)}</td>

            <td>${escapeHTML(employee.email)}</td>

            <td>${escapeHTML(employee.department)}</td>

            <td>
                ₱${Number(employee.salary).toLocaleString()}
            </td>

            <td>

                <button
                    class="btn btn-edit"
                    onclick="openEditEmployee(${employee.id})"
                >
                    Edit
                </button>

                <button
                    class="btn btn-delete"
                    onclick="deleteEmployee(${employee.id})"
                >
                    Delete
                </button>

            </td>
        `;

        employeeTableBody.appendChild(row);

    });
}



addEmployeeBtn.addEventListener("click", function () {

    addEmployeeForm.reset();

    showModal(addModal);

});



closeAddModal.addEventListener("click", function () {

    hideModal(addModal);

});


cancelAddBtn.addEventListener("click", function () {

    hideModal(addModal);

});




addEmployeeForm.addEventListener("submit", async function (event) {

    event.preventDefault();


    const employeeData = {

        first_name:
            document.getElementById("addFirstName").value.trim(),

        last_name:
            document.getElementById("addLastName").value.trim(),

        email:
            document.getElementById("addEmail").value.trim(),

        department:
            document.getElementById("addDepartment").value.trim(),

        salary:
            parseFloat(
                document.getElementById("addSalary").value
            )
    };


    try {

        const response = await fetch(API_URL, {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify(employeeData)

        });


        const result = await response.json();


        if (!response.ok || result.status !== "success") {

            throw new Error(
                result.message || "Failed to add employee."
            );
        }


        alert("Employee added successfully!");


        hideModal(addModal);

        addEmployeeForm.reset();

        await loadEmployees();


    } catch (error) {

        console.error("Error:", error);

        alert("Error adding employee: " + error.message);

    }

});




async function openEditEmployee(id) {

    try {

        const response = await fetch(
            `${API_URL}?id=${id}`
        );


        const result = await response.json();


        if (!response.ok || result.status !== "success") {

            throw new Error(
                result.message || "Employee not found."
            );
        }


        const employee = result.data;


        document.getElementById("editId").value =
            employee.id;

        document.getElementById("editFirstName").value =
            employee.first_name;

        document.getElementById("editLastName").value =
            employee.last_name;

        document.getElementById("editEmail").value =
            employee.email;

        document.getElementById("editDepartment").value =
            employee.department;

        document.getElementById("editSalary").value =
            employee.salary;


        showModal(editModal);


    } catch (error) {

        console.error("Error:", error);

        alert(
            "Error loading employee: " +
            error.message
        );

    }
}




closeEditModal.addEventListener("click", function () {

    hideModal(editModal);

});


cancelEditBtn.addEventListener("click", function () {

    hideModal(editModal);

});




editEmployeeForm.addEventListener("submit", async function (event) {

    event.preventDefault();


    const employeeData = {

        id:
            parseInt(
                document.getElementById("editId").value
            ),

        first_name:
            document.getElementById("editFirstName").value.trim(),

        last_name:
            document.getElementById("editLastName").value.trim(),

        email:
            document.getElementById("editEmail").value.trim(),

        department:
            document.getElementById("editDepartment").value.trim(),

        salary:
            parseFloat(
                document.getElementById("editSalary").value
            )
    };


    try {

        const response = await fetch(API_URL, {

            method: "PUT",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify(employeeData)

        });


        const result = await response.json();


        if (!response.ok || result.status !== "success") {

            throw new Error(
                result.message || "Failed to update employee."
            );
        }


        alert("Employee updated successfully!");


        hideModal(editModal);

        await loadEmployees();


    } catch (error) {

        console.error("Error:", error);

        alert(
            "Error updating employee: " +
            error.message
        );

    }

});




async function deleteEmployee(id) {

    const confirmed = confirm(
        "Are you sure you want to delete this employee?"
    );


    if (!confirmed) {
        return;
    }


    try {

        const response = await fetch(
            `${API_URL}?id=${id}`,
            {
                method: "DELETE"
            }
        );


        const result = await response.json();


        if (!response.ok || result.status !== "success") {

            throw new Error(
                result.message || "Failed to delete employee."
            );
        }


        alert("Employee deleted successfully!");


        await loadEmployees();


    } catch (error) {

        console.error("Error:", error);

        alert(
            "Error deleting employee: " +
            error.message
        );

    }
}




searchInput.addEventListener("input", function () {

    const searchTerm =
        this.value.toLowerCase();


    const rows =
        employeeTableBody.querySelectorAll("tr");


    rows.forEach(row => {

        const text =
            row.textContent.toLowerCase();


        row.style.display =
            text.includes(searchTerm)
                ? ""
                : "none";

    });

});




loadEmployees();