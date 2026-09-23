<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Management System</title>

    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <header class="header">
        <div>
            <h1>Employee Management System</h1>
            <p>Manage employee records</p>
        </div>

        <div id="connectionStatus" class="connection-status">
            Checking connection...
        </div>
    </header>


    <main class="container">

        
        <div class="top-bar">

            <div>
                <h2>Employees</h2>
                <p>View and manage employee records.</p>
            </div>

            <button id="addEmployeeBtn" class="btn btn-primary">
                + Add Employee
            </button>

        </div>


        
        <div class="search-container">

            <input
                type="text"
                id="searchInput"
                placeholder="Search employees..."
            >

        </div>


       
        <div class="table-container">

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="employeeTableBody">

                    <tr>
                        <td colspan="7">
                            Loading employees...
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </main>


    

    <div id="addModal" class="modal">

        <div class="modal-content">

            <div class="modal-header">

                <h2>Add Employee</h2>

                <button
                    type="button"
                    class="close-btn"
                    id="closeAddModal"
                >
                    &times;
                </button>

            </div>


            <form id="addEmployeeForm">

                <div class="form-group">
                    <label for="addFirstName">First Name</label>

                    <input
                        type="text"
                        id="addFirstName"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="addLastName">Last Name</label>

                    <input
                        type="text"
                        id="addLastName"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="addEmail">Email</label>

                    <input
                        type="email"
                        id="addEmail"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="addDepartment">Department</label>

                    <input
                        type="text"
                        id="addDepartment"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="addSalary">Salary</label>

                    <input
                        type="number"
                        id="addSalary"
                        step="0.01"
                        required
                    >
                </div>


                <div class="form-actions">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        id="cancelAddBtn"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Employee
                    </button>

                </div>

            </form>

        </div>

    </div>


  

    <div id="editModal" class="modal">

        <div class="modal-content">

            <div class="modal-header">

                <h2>Edit Employee</h2>

                <button
                    type="button"
                    class="close-btn"
                    id="closeEditModal"
                >
                    &times;
                </button>

            </div>


            <form id="editEmployeeForm">

                <input
                    type="hidden"
                    id="editId"
                >


                <div class="form-group">
                    <label for="editFirstName">First Name</label>

                    <input
                        type="text"
                        id="editFirstName"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="editLastName">Last Name</label>

                    <input
                        type="text"
                        id="editLastName"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="editEmail">Email</label>

                    <input
                        type="email"
                        id="editEmail"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="editDepartment">Department</label>

                    <input
                        type="text"
                        id="editDepartment"
                        required
                    >
                </div>


                <div class="form-group">
                    <label for="editSalary">Salary</label>

                    <input
                        type="number"
                        id="editSalary"
                        step="0.01"
                        required
                    >
                </div>


                <div class="form-actions">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        id="cancelEditBtn"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Update Employee
                    </button>

                </div>

            </form>

        </div>

    </div>


    <script src="../javascript/functions.js"></script>
    <script src="employee.js"></script>

</body>

</html>